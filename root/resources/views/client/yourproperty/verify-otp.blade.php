@extends('client.yourproperty.yourproperty')

@section('content')
    <div class="flex flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm bg-white rounded-lg shadow-sm p-4">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                {{ __('content.verify_otp.enter_otp') }}
            </h2>
            <p class="mt-2 text-center text-sm text-red-600">
                {{ __('content.verify_otp.otp_expiration') }} 5 {{ __('content.verify_otp.minutes') }}.
            </p>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('users.property.verifyOtp') }}" method="POST">
                @csrf
                <div>
                    <label for="otp_code" class="block text-sm font-medium leading-6 text-gray-900">
                        {{ __('content.verify_otp.otp_code') }}
                    </label>
                    <div class="mt-2">
                        <input type="text" name="otp_code" id="otp_code"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Enter OTP" required>
                        @error('otp_code')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                    {{ __('content.verify_otp.submit') }}
                </button>
            </form>

            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">{{ __('content.verify_otp.did_not_receive') }}</p>
                <form action="{{ route('users.property.start') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-indigo-600 hover:text-indigo-500 font-medium">
                        {{ __('content.verify_otp.resend_otp') }}
                    </button>
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection