@extends('client.layouts.master-layout')
@section('content')
    @include('client.login.header')

    <body>
        <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                    {{ __('content.reset_password.enter_new_password') }}</h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" action="{{ route('password.reset') }}" method="POST">
                    @csrf
                    <div>
                        <label for="new_password" class="block text-sm font-medium leading-6 text-gray-900">
                            {{ __('content.reset_password.new_password') }}
                        </label>
                        <div class="mt-2">
                            <input type="password" name="new_password" id="new_password"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="{{ __('content.reset_password.enter_new_password') }}" >
                            <p id="passwordError" class="mt-2 text-sm text-red-600 hidden"></p>
                        </div>
                    </div>

                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">
                            {{ __('content.reset_password.confirm_new_password') }}
                        </label>
                        <div class="mt-2">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                                placeholder="{{ __('content.reset_password.confirm_new_password') }}" >
                            <p id="confirmPasswordError" class="mt-2 text-sm text-red-600 hidden"></p>
                        </div>
                    </div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                        {{ __('content.reset_password.reset_password') }}
                    </button>
                </form>
            </div>
        </div>
    </body>
@endsection
@push('scripts')
    <script>
        const messages = {
            new_password_required: @json(__('content.reset_password.new_password_required')),
            confirm_password_required: @json(__('content.reset_password.confirm_password_required')),
            passwords_match: @json(__('content.reset_password.passwords_match')),
            password_length: @json(__('content.reset_password.password_length')),
            password_strength: @json(__('content.reset_password.password_strength')),
        };

        $(document).ready(function() {
            function validatePassword() {
                const password = $('#new_password').val().trim();
                const confirmPassword = $('#new_password_confirmation').val().trim();
                let isValid = true;

                $('#passwordError').addClass('hidden');
                $('#confirmPasswordError').addClass('hidden');

                // 1. Required check
                if (password === '') {
                    $('#passwordError').text(messages.new_password_required).removeClass('hidden');
                    isValid = false;
                }

                // 2. Length check (minimum 8 characters)
                if (password.length < 8) {
                    $('#passwordError').text(messages.password_length).removeClass('hidden');
                    isValid = false;
                }

                // 4. Confirm password required check
                if (confirmPassword === '') {
                    $('#confirmPasswordError').text(messages.confirm_password_required).removeClass('hidden');
                    isValid = false;
                } else if (password !== confirmPassword) { // 5. Password match check
                    $('#confirmPasswordError').text(messages.passwords_match).removeClass('hidden');
                    isValid = false;
                }

                return isValid;
            }

            // Gắn sự kiện để xác thực ngay khi người dùng nhập
            $('#new_password, #new_password_confirmation').on('blur input', function() {
                validatePassword();
            });

            // Xác thực khi submit form
            $('form').on('submit', function(event) {
                if (!validatePassword()) {
                    event.preventDefault();
                }
            });
        });
    </script>
@endpush
