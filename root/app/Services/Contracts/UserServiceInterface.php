<?php

namespace App\Services\Contracts;

interface UserServiceInterface
{
    public function getAll($request);
    public function updateStatus($request, $id);
    public function getUserById($id);
    public function login($data);
    public function register($data);
    public function changePassword($user, $data);


    public function sendOtp($request);

    public function verifyOtp($otp_code, $email);

    public function resetPassword($email, $newPassword);

    // Update profile information methods
    public function updateAvatar($user, $avatarPath);
    public function deleteAvatar($user);
    public function updateName($user, $firstName, $lastName);
    public function updateDisplayName($user, $displayName);
    public function updateEmail($user, $email);
    public function resendVerificationEmail($user);
    public function updatePhone($user, $countryCode, $phoneNumber);
    public function updateBirthday($user, $day, $month, $year);
    public function updateNationality($user, $nationality);
    public function updateGender($user, $gender);
    public function updateAddress($user, $country, $street, $city, $zip);
    public function updatePassport($user, $passportData);
    public function deletePassport($user);
    public function sendPropertyRegistrationOtp($email);
    public function verifyPropertyRegistrationOtp($otpCode, $email);
    public function handlePropertyOtpVerification($otpCode, $user);


}
