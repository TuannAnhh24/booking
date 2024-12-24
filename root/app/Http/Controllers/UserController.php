<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\RequestsEditUser\UpdateAddressRequest;
use App\Http\Requests\RequestsEditUser\UpdateBirthdayRequest;
use App\Http\Requests\RequestsEditUser\UpdateCountryRequest;
use App\Http\Requests\RequestsEditUser\UpdateDisplayNameRequest;
use App\Http\Requests\RequestsEditUser\UpdateEmailRequest;
use App\Http\Requests\RequestsEditUser\UpdateGenderRequest;
use App\Http\Requests\RequestsEditUser\UpdateNameRequest;
use App\Http\Requests\RequestsEditUser\UpdatePassportRequest;
use App\Http\Requests\RequestsEditUser\UpdatePhoneRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Models\RoomBooking;
use App\Models\RoomListBooking;
use App\Services\Contracts\UserDeviceServiceInterface;
use App\Services\Contracts\UserServiceInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\UserStatusUpdated;
use Illuminate\Support\Facades\Mail;



class UserController extends Controller
{
    protected $userService;
    protected $userDeviceService;

    public function __construct(
        UserServiceInterface $userService,
        UserDeviceServiceInterface $userDeviceService,
    ) {
        $this->userService = $userService;
        $this->userDeviceService = $userDeviceService;
    }
    public function index(Request $request)
    {
        $users = $this->userService->getAll($request->all());

        if ($request->ajax()) {
            $html = view('admin.user.table', compact('users'))->render();
            return response()->json(['html' => $html]);
        }
        return view('admin.user.index', compact('users'));
    }
    public function updateStatus(Request $request, $id)
    {
        try {
            $status = $request->input('status');
            $user = $this->userService->updateStatus($status, $id);
            Mail::to($user->email)->send(new UserStatusUpdated($user, $status));
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.update_status.status_change')])
                ->log(__('content.update_status.status_update') . $user->email);
            return response()->json(['success' => true, 'message' => __('content.update_status.success')]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => __('content.update_status.error')]);
        }
    }



    public function showLogin()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return view('login');
    }

    public function login(LoginRequest $request)
    {

        $user = $this->userService->login($request);
        if (!$user) {
            return redirect()->back()->with('error', __('validation.login.check'));
        }
        $userDevice = $this->userDeviceService->saveDeviceInfo($user, $request);
        session(['device_id' => $userDevice->id]);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.login_title')])
            ->log(__('content.activity.login') . ': ' . $userDevice->device_type);
        return redirect()->route('home');
    }



    public function showRegister()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return view('register');
    }

    public function register(RegisterRequest $request)
    {
        try {
            $this->userService->register($request);
            return redirect()->route('login')->with('success', __('content.validate_login_and_register.registered_successfully'));
        } catch (Exception $e) {
            return redirect()->back();
        }
    }


    public function logout(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home');
        }
        $userDevice = $this->userDeviceService->updateStatusLogout($user, $request);
        Auth::logout();
        session()->forget('device_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.logout_title')])
            ->log(__('content.activity.logout') . ': ' . $userDevice->device_type);
        return redirect()->route('home')->with('success', __('content.validate_login_and_register.logout_successfully'));
        ;
    }

    public function showForgotPassword()
    {
        return view('forgot_password');
    }
    public function sendOtp(ForgotPasswordRequest $request)
    {
        try {
            $this->userService->sendOtp($request->email);
            session(['email' => $request->email]);

            return redirect()->route('password.verifyOtp')->with('success', __('content.forgot_password.otp_sent'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['email' => $e->getMessage()]);
        }
    }
    public function showOtpForm()
    {
        return view('verify-otp');
    }

    // Xác minh mã OTP
    public function verifyOtp(VerifyOtpRequest $request)
    {
        $email = session('email');

        if (!$this->userService->verifyOtp($request->otp_code, $email)) {
            return redirect()->back()->withErrors(['otp_code' => __('content.verify_otp.check')]);
        }
        session()->put('email', $email);

        return redirect()->route('password.resetForm');
    }

    public function showResetPasswordForm(Request $request)
    {
        if (!$request->session()->has('email')) {
            return redirect()->route('password.forgot');
        }

        return view('reset-password');
    }

    // Đặt lại mật khẩu
    public function resetPassword(ResetPasswordRequest $request)
    {
        $email = session('email');

        if (!$email) {
            return redirect()->route('password.forgot')->withErrors(['email' => '']);
        }

        $this->userService->resetPassword($email, $request->new_password);
        session()->forget('email');

        return redirect()->route('login')->with('success', __('content.reset_password.password_reset_successfully'));
    }
    public function resendOtp()
    {
        $email = session('email');
        if (!$email) {
            return redirect()->route('password.forgot')->withErrors([
                'email' => __('content.verify_otp.email_not_found')
            ]);
        }
        try {
            $this->userService->sendOtp($email);
            return redirect()->back()->with('success', __('content.verify_otp.otp_resent'));
        } catch (Exception $e) {
            return redirect()->back()->withErrors([
                'otp' => __('content.verify_otp.otp_resend_failed')
            ]);
        }
    }
    // Phương thức hiển thị trang profile của người dùng
    public function showProfile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'User not found.');
        }

        $address = json_decode($user->address, true);
        $passportData = json_decode($user->passport, true);

        return view('client.user_profiles.edit-profile', compact('user', 'address', 'passportData'));
    }

    public function updateAvatar(Request $request)
    {
        $user = Auth::user();
        if (!$request->hasFile('avatar')) {
            return redirect()->back()->with('error', __('validation.validation_edit_profile.avatar.error'));
        }

        try {
            $filePath = $this->userService->updateAvatar($user, $request->file('avatar'));
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.updateAvatar_title')])
                ->log(__('content.activity.update_avatar'));
            return redirect()->back()->with(['success' => __('validation.validation_edit_profile.avatar.success'), 'avatarPath' => $filePath]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('validation.validation_edit_profile.avatar.error_update'));
        }
    }

    public function deleteAvatar()
    {
        $user = Auth::user();
        try {
            $this->userService->deleteAvatar($user);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.deleteAvatar_title')])
                ->log(__('content.activity.delete_avatar'));
            return response()->json(['message' => 'Avatar deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete avatar'], 500);
        }
    }

    public function updateName(UpdateNameRequest $request)
    {
        $user = Auth::user();
        $this->userService->updateName($user, $request->first_name, $request->last_name);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.updateName_title')])
            ->log(__('content.activity.update_name') . ': ' . $user->first_name . ' ' . $user->last_name);
        return back()->with('success', __('validation.validation_edit_profile.success'));
    }

    public function updateDisplayName(UpdateDisplayNameRequest $request)
    {
        $user = Auth::user();
        $this->userService->updateDisplayName($user, $request->display_name);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.updateDisplay_title')])
            ->log(__('content.activity.update_display_name') . ': ' . $user->display_name);
        return back()->with('success', __('validation.validation_edit_profile.success'));
    }

    public function updateEmail(UpdateEmailRequest $request)
    {
        $user = Auth::user();
        $this->userService->updateEmail($user, $request->email);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.update_email_title')])
            ->log(__('content.activity.update_email') . ': ' . $user->email);
        return back()->with('success', __('validation.validation_edit_profile.success_email'));
    }

    public function resendVerificationEmail()
    {
        $user = Auth::user();
        $result = $this->userService->resendVerificationEmail($user);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.resendVerificationEmail_title')])
            ->log(__('content.activity.resendVerificationEmail') . ': ' . $user->email);
        return redirect()->back()->with($result['status'] ? 'success' : 'info', $result['message']);
    }

    public function updatePhone(UpdatePhoneRequest $request)
    {
        $user = Auth::user();
        $this->userService->updatePhone($user, $request->country_code, $request->phone_number);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.update_phone_title')])
            ->log(__('content.activity.update_phone') . ': ' . $user->phone_number);
        return back()->with('success', __('validation.validation_edit_profile.success'));
    }

    public function updateBirthday(UpdateBirthdayRequest $request)
    {
        $user = Auth::user();
        $this->userService->updateBirthday($user, $request->day, $request->month, $request->year);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.update_birthday_title')])
            ->log(__('content.activity.update_birthday') . ': ' . $user->birthday);
        return back()->with('success', __('validation.validation_edit_profile.success'));
    }

    public function updateNationality(UpdateCountryRequest $request)
    {
        $user = Auth::user();
        $this->userService->updateNationality($user, $request->nationality);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.update_national_title')])
            ->log(__('content.activity.update_national') . ': ' . $user->nationality);
        return back()->with('success', __('validation.validation_edit_profile.success'));
    }

    public function updateGender(UpdateGenderRequest $request)
    {
        $user = Auth::user();
        $this->userService->updateGender($user, $request->gender);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.update_gender_title')])
            ->log(__('content.activity.update_gender') . ': ' . $user->gender);
        return back()->with('success', __('validation.validation_edit_profile.success'));
    }

    public function updateAddress(UpdateAddressRequest $request)
    {
        $user = Auth::user();
        $this->userService->updateAddress($user, $request->country, $request->street, $request->city, $request->zip);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.update_address_title')])
            ->log(__('content.activity.update_address') . ': ' . $user->address);
        return back()->with('success', __('validation.validation_edit_profile.success'));
    }

    public function updatePassport(UpdatePassportRequest $request)
    {
        $user = Auth::user();
        $passportData = [
            'first_name' => $request->passport_first_name,
            'last_name' => $request->passport_last_name,
            'country' => $request->passport_country,
            'number' => $request->passport_number,
            'expiry_day' => $request->expiry_day,
            'expiry_month' => $request->expiry_month,
            'expiry_year' => $request->expiry_year,
        ];
        $this->userService->updatePassport($user, $passportData);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.update_passport_title')])
            ->log(__('content.activity.update_passport') . ': ' . $user->passport);
        return back()->with('success', __('validation.validation_edit_profile.success'));
    }

    public function deletePassport()
    {
        $user = Auth::user();
        $this->userService->deletePassport($user);
        activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.delete_passport_title')])
            ->log(__('content.activity.delete_passport'));
        return back()->with('success', __('validation.validation_edit_profile.success_delete'));
    }

    public function showDeviceManagement()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', __('content.user.not_logged_in'));
        }
        $userDevice = $this->userDeviceService->getDevicesByUserId($user);
        $currentIp = request()->ip();
        $currentUserAgent = request()->header('User-Agent');
        return view('client.user_profiles.user_device_management', compact('user', 'userDevice', 'currentIp', 'currentUserAgent'));
    }

    public function logoutAll()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('home');
            }
            $this->userDeviceService->logoutAllDevices($user);
            Auth::logout();
            session()->flush();
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.logout_all_title')])
                ->log(__('content.activity.logout_all'));
            return redirect()->route('home')->with('success', __('content.userDevice.success'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', __('content.userDevice.error'));
        }
    }

    public function logoutDevice($deviceId)
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('home');
            }
            $device = $this->userDeviceService->logoutDeviceById($user, $deviceId);
            activity()
                ->causedBy(auth()->user())
                ->withProperties(['title' => __('content.activity.logout_device_title')])
                ->log(__('content.activity.logout_device') . ': ' . $device->device_type);
            return redirect()->back()->with('success', __('content.userDevice.success'));
        } catch (Exception $e) {
            return redirect()->back()->with('success', __('content.userDevice.error'));
        }
    }

    public function showBookingHistory()
    {
        $userId = Auth::id();

        // Lấy lịch sử đặt phòng của người dùng
        $bookings = RoomBooking::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
        // Giải mã JSON trong `room_booking_detail` cho từng booking nếu là chuỗi
        foreach ($bookings as $booking) {
            $booking->room_details = is_string($booking->room_booking_detail)
                ? json_decode($booking->room_booking_detail, true)
                : $booking->room_booking_detail;
        }


        return view('client.historybooking.history-booking', compact('bookings'));
    }
    public function showInvoice($id)
    {
        $booking = RoomBooking::with('roomBookingDetail')->findOrFail($id);
        if ($booking->user_id != Auth::id()) {
            abort(403);
        }

        // Trả về hóa đơn chi tiết của booking
        return view('client.booking.invoice', compact('booking'));
    }
    public function cancelBooking($id)
    {
        $booking = RoomBooking::findOrFail($id);
        // Kiểm tra điều kiện hủy trước 2 ngày
        $checkInDate = Carbon::parse($booking->check_in);
        $currentDate = Carbon::now();

        // Nếu không đủ 2 ngày trước ngày check-in
        if ($currentDate->diffInDays($checkInDate, false) < 2) {
            if (request()->ajax()) {
                // Trả về JSON cho yêu cầu AJAX
                return response()->json([
                    'success' => false,
                    'message' => __('validation.history.error_day')
                ], 400);
            }
            // Nếu không phải AJAX, thực hiện redirect
            return redirect()->route('users.bookingHistory')->with('error', __('content.history.error_history'));
        }

        // Hủy các phòng liên quan
        $roomListBookings = RoomListBooking::where('booking_id', $id)->get();
        foreach ($roomListBookings as $roomListBooking) {
            $roomListBooking->status = CANCELED;
            $roomListBooking->save();
            activity()
            ->causedBy(auth()->user())
            ->withProperties(['title' => __('content.activity.cancel_booking_title')])
            ->log(__('content.activity.cancel_booking') . ': ' . $roomListBooking->name);
        }
     
        // Quay lại trang lịch sử đặt phòng với thông báo thành công
        return redirect()->route('users.bookingHistory')->with('success', __('content.history.text_request2'));
    }
    public function showPropertyPage()
    {
        return view('client.yourproperty.property');
    }

    public function startPropertyRegistration()
    {
        $user = Auth::user();

        // Gửi mã OTP để đăng ký tài sản
        $this->userService->sendPropertyRegistrationOtp($user->email);

        // Điều hướng đến trang nhập OTP
        return redirect()->route('users.property.verify.otp');
    }

    public function showVerifyOtpPage()
    {
        return view('client.yourproperty.verify-otp');
    }

    public function verifyPropertyOtp(Request $request)
    {
        $user = Auth::user();
        $otpCode = $request->input('otp_code');

        // Xử lý xác thực OTP thông qua service
        if ($this->userService->handlePropertyOtpVerification($otpCode, $user)) {
            return redirect()->route('admin.dashboard')->with('success', __('content.yourproperty.message'));
        }

        return back()->withErrors(['otp_code' => __('content.yourproperty.error')]);
    }
    public function showChangePasswordForm()
    {
        return view('client.user_profiles.change-password');
    }
    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            // Lấy người dùng hiện tại
            $user = auth()->user();
    
            // Gọi service để thay đổi mật khẩu
            $this->userService->changePassword($user, $request);
    
            // Trả về thông báo thành công dưới dạng JSON
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra (mật khẩu cũ không đúng), trả về thông báo lỗi dưới dạng JSON
            return response()->json(['errors' => ['current_password' => [$e->getMessage()]]], 422);
        }
    }
    
}
