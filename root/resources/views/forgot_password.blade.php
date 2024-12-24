@extends('client.layouts.master-layout')
@section('content')
    @include('client.login.header')

    <body>
        <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                    {{ __('content.forgot_password.enter_email') }}</h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="{{ route('password.sendOtp') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email"
                            class="block text-sm font-medium leading-6 text-gray-900">{{ __('content.forgot_password.email_address') }}</label>
                        <div class="mt-2">
                            <input type="email" name="email" id="email"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="name@company.com">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p id="emailError" class="mt-2 text-sm text-red-600 hidden"></p>
                        </div>
                    </div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                        {{ __('content.forgot_password.send_otp') }}
                    </button>
                </form>
            </div>
        </div>
    </body>
@endsection

@push('scripts')
    <script>
        const messages = {
            email_required: @json(__('content.validate_login_and_register.email_required')),
            email_check: @json(__('content.validate_login_and_register.email_check')),
        };

        $(document).ready(function() {
            function validateEmail(email) {
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return emailPattern.test(email);
            }

            function validateForm() {
                var email = $('#email').val().trim();
                var isValid = true;

                $('#emailError').addClass('hidden');

                if (email === '') {
                    $('#emailError').text(messages.email_required).removeClass('hidden');
                    isValid = false;
                } else if (!validateEmail(email)) {
                    $('#emailError').text(messages.email_check).removeClass('hidden');
                    isValid = false;
                }
                return isValid;
            }

            $('#email').on('blur', function() {
                var email = $(this).val().trim();
                if (email === '') {
                    $('#emailError').text(messages.email_required).removeClass('hidden');
                } else if (!validateEmail(email)) {
                    $('#emailError').text(messages.email_check).removeClass('hidden');
                } else {
                    $('#emailError').addClass('hidden');
                }
            });

            // Kiểm tra lại khi người dùng nhập
            $('#email').on('input', function() {
                var email = $(this).val().trim();
                if (email === '') {
                    $('#emailError').text(messages.email_required).removeClass('hidden');
                } else if (!validateEmail(email)) {
                    $('#emailError').text(messages.email_check).removeClass('hidden');
                } else {
                    $('#emailError').addClass('hidden');
                }
            });

            // Xác thực khi submit form
            $('form').on('submit', function(event) {
                if (!validateForm()) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endpush
