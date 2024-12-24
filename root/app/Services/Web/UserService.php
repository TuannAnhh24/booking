<?php

namespace App\Services\Web;

use App\Models\User;
use App\Repositories\Contracts\UserRepository;
use App\Services\Contracts\UserServiceInterface;
use App\Traits\FileTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserService implements UserServiceInterface
{
    use FileTrait {
        delete as deleteFile;
    }

    protected $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll($request)
    {
        $orderBy['updated_at'] = 'desc';
        $filters = [];
        if (!empty($request['keyword'])) {
            $filters['keyword'] = $request['keyword'];
        }
        if (!empty($request['name'])) {
            $filters['name'] = $request['name'];
        }
        if (!empty($request['email'])) {
            $filters['email'] = $request['email'];
        }
        if (!empty($request['phoneNumber'])) {
            $filters['phoneNumber'] = $request['phoneNumber'];
        }
        if (!empty($request['status'])) {
            $filters['status'] = $request['status'];
        }
        $users = $this->userRepository->paginateByFilters(
            $filters,
            PAGINATE_MAX_RECORD,
            ['role'],
            $orderBy
        )->withQueryString();

        return $users;
    }
    // Thêm phương thức getUserById
    public function getUserById($uuid)
    {
        return User::where('uuid', $uuid)->first();
    }
    public function login($data)
    {
        $user = User::where('email', $data->email)->first();
        if (!$user || $user->status !== 1) {
            return false;
        }
        $params = [
            'email' => $data->email,
            'password' => $data->password,
        ];
        if (Auth::attempt($params)) {
            return Auth::user();
        }
        return false;
    }

    public function register($data)
    {
        $params = [
            'role_id' => 1,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'first_name' => explode('@', $data->email)[0],
            'last_name' => 'User',
            'avatar' => 'image/avatar_default.png',
            'status' => '1',
        ];
        $user = $this->userRepository->create($params);

        return $user;
    }
    public function changePassword($user, $data)
    {
        // Kiểm tra mật khẩu cũ có đúng không
        if (!Hash::check($data->current_password, $user->password)) {
            // Nếu mật khẩu cũ không đúng, trả về thông báo lỗi
            throw new \Exception('Mật khẩu cũ không đúng');
        }
        // Cập nhật mật khẩu mới
        $user->password = bcrypt($data->new_password);
        $user->save();

        return $user;
    }
    public function sendOtp($email)
    {
        $user = $this->userRepository->firstByWhere(['email' => $email]);

        if (!$user) {
            throw new \Exception("User with email {$email} not found.");
        }

        $otpCode = Str::random(6);
        $user->otp_code = $otpCode;
        $user->otp_expiration = Carbon::now()->addMinutes(5);
        $user->save();

        Mail::raw("Mã OTP của bạn là: $otpCode", function ($message) use ($user) {
            $message->to($user->email)->subject('Mã OTP để đặt lại mật khẩu');
        });

        return $otpCode;
    }
    public function verifyOtp($otpCode, $email)
    {
        $user = $this->userRepository->firstByWhere([
            'email' => $email,
            'otp_code' => $otpCode,
            ['otp_expiration', '>', Carbon::now()]
        ]);

        return $user ? true : false;
    }

    // Đặt lại mật khẩu mới
    public function resetPassword($email, $newPassword)
    {
        $user = $this->userRepository->firstByWhere(['email' => $email]);

        if (!$user) {
            throw new \Exception("User with email {$email} not found.");
        }

        $user->password = Hash::make($newPassword);
        $user->otp_code = null;
        $user->otp_expiration = null;
        $user->save();
    }
    public function updateAvatar($user, $avatarFile)
    {
        $filePath = $this->upload($avatarFile, USER_IMAGES_PATH);

        if ($user->avatar) {
            $this->deleteFile($user->avatar);
        }

        $user->avatar = $filePath;
        $user->save();

        return $user->avatar;
    }

    public function deleteAvatar($user)
    {
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
            $user->avatar = null;
            $user->save();
        }
    }

    public function updateName($user, $firstName, $lastName)
    {
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->save();
    }

    public function updateDisplayName($user, $displayName)
    {
        $user->display_name = $displayName;
        $user->save();
    }

    public function updateEmail($user, $email)
    {
        $user->email = $email;
        $user->email_verified_at = null;
        $user->save();

        $user->sendEmailVerificationNotification();
    }

    public function resendVerificationEmail($user)
    {
        if ($user->hasVerifiedEmail()) {
            return [
                'status' => false,
                'message' => 'Email của bạn đã được xác thực.'
            ];
        }

        $user->sendEmailVerificationNotification();

        return [
            'status' => true,
            'message' => 'Email xác thực đã được gửi lại.'
        ];
    }

    public function updatePhone($user, $countryCode, $phoneNumber)
    {
        $user->country_code = $countryCode;
        $user->phone_number = $phoneNumber;
        $user->save();
    }

    public function updateBirthday($user, $day, $month, $year)
    {
        $user->birthday = "$year-$month-$day";
        $user->save();
    }

    public function updateNationality($user, $nationality)
    {
        $user->nationality = $nationality;
        $user->save();
    }

    public function updateGender($user, $gender)
    {
        $user->gender = $gender;
        $user->save();
    }

    public function updateAddress($user, $country, $street, $city, $zip)
    {
        $addressData = [
            'country' => $country,
            'street' => $street,
            'city' => $city,
            'zip' => $zip,
        ];

        $user->address = json_encode($addressData);
        $user->save();
    }

    public function updatePassport($user, $passportData)
    {
        $passportInfo = [
            'first_name' => $passportData['first_name'],
            'last_name' => $passportData['last_name'],
            'country' => $passportData['country'],
            'number' => $passportData['number'],
            'expiry' => [
                'day' => $passportData['expiry_day'],
                'month' => $passportData['expiry_month'],
                'year' => $passportData['expiry_year']
            ],
        ];

        $user->passport = json_encode($passportInfo);
        $user->save();
    }

    public function deletePassport($user)
    {
        $user->passport = null;
        $user->save();
    }
    public function sendPropertyRegistrationOtp($email)
    {
        $user = $this->userRepository->firstByWhere(['email' => $email]);

        if (!$user) {
            throw new \Exception("User with email {$email} not found.");
        }

        $otpCode = Str::random(6);
        $cacheKey = "property_otp_{$email}";
        $expiration = Carbon::now()->addMinutes(5);

        // Lưu OTP và thời gian hết hạn vào cache
        cache()->put($cacheKey, [
            'otp_code' => $otpCode,
            'otp_expiration' => $expiration
        ], $expiration);

        Mail::raw("Mã OTP của bạn để đăng ký tài sản là: $otpCode", function ($message) use ($user) {
            $message->to($user->email)->subject('Mã OTP để đăng ký tài sản');
        });

        return $otpCode;
    }

    public function handlePropertyOtpVerification($otpCode, $user)
    {
        // Kiểm tra OTP hợp lệ
        if ($this->verifyPropertyRegistrationOtp($otpCode, $user->email)) {
            // Nếu OTP hợp lệ, cập nhật vai trò người dùng
            $user->role_id = 2;
            $user->save();

            // Xóa OTP khỏi cache để tránh tái sử dụng
            cache()->forget("property_otp_{$user->email}");

            return true;
        }

        return false;
    }

    public function verifyPropertyRegistrationOtp($otpCode, $email)
    {
        $cacheKey = "property_otp_{$email}";

        // Lấy OTP và thời gian hết hạn từ cache
        $cachedData = cache()->get($cacheKey);

        if ($cachedData && $cachedData['otp_code'] === $otpCode && $cachedData['otp_expiration']->gt(Carbon::now())) {
            return true;
        }

        return false;
    }

    public function updateStatus($status, $id)
    {
        $user = User::findOrFail($id);

        if ($status === 'locked') {
            $user->status = 0;
        } else {
            $user->status = 1;
        }
        $user->save();
        return $user;
    }

}
