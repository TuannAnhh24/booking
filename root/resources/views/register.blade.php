@extends('client.layouts.master-layout')
@section('content')

@include('client.login.header')
<body>
    <!-- <template> -->
    <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">{{ __('content.register.Create_an_account') }}
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('register.post')}}" method="POST" id="registrationForm" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">{{ __('content.register.Email_address') }}</label>
                    <div class="mt-2">
                        <input type="email" name="email" id="email"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="name@company.com">
                        @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <p id="emailError" class="mt-2 text-sm text-red-600 hidden"></p>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">{{ __('content.register.Password') }}</label>
                        <div class="text-sm">
                            <a href="{{route('password.forgot')}}" class="font-semibold text-indigo-600 hover:text-indigo-500">{{ __('content.register.Forgot_password') }}</a>
                        </div>
                    </div>
                    <div class="mt-2 relative">
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                            <svg class="h-4 text-gray-700" fill="none" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path
                                    d="M2.458 12C3.732 7.943 7.612 5 12 5c4.388 0 8.268 2.943 9.542 7-.7 1.832-1.913 3.446-3.542 4.626M12 5c-4.388 0-8.268 2.943-9.542 7 .7 1.832 1.913 3.446 3.542 4.626" />
                            </svg>
                        </button>
                    </div>
                    <p id="passwordError" class="mt-2 text-sm text-red-600 hidden"></p>
                </div>

                <div class="mt-2 relative">
                    <label for="confirm-password"
                        class="block mb-2 text-sm font-medium text-gray-900">{{ __('content.register.Confirm_password') }}</label>
                    <input type="password" name="password_confirmation" id="confirm-password" placeholder="••••••••"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror 
                    <button type="button" id="toggleConfirmPassword"
                        class="absolute inset-y-0 right-0 pr-3 mt-7 flex items-center text-sm leading-5">
                        <svg class="h-4 text-gray-700" fill="none" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path
                                d="M2.458 12C3.732 7.943 7.612 5 12 5c4.388 0 8.268 2.943 9.542 7-.7 1.832-1.913 3.446-3.542 4.626M12 5c-4.388 0-8.268 2.943-9.542 7 .7 1.832 1.913 3.446 3.542 4.626" />
                        </svg>
                    </button>
                </div>
                <p id="confirmPasswordError" class="mt-2 text-sm text-red-600 hidden"></p>

                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" aria-describedby="terms" type="checkbox"
                            class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 "
                           >
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="font-light text-gray-500 ">{{ __('content.register.I_accept_the') }} <a
                                class="font-medium text-primary-600 hover:underline "
                                href="#">{{ __('content.register.Terms_and_Conditions') }}</a></label>
                    </div>
                </div>
                <p id="termsError" class="mt-2 text-sm text-red-600 hidden"></p>
                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('content.register.register') }}</button>
                <p class="text-sm font-light text-gray-500 ">
                    {{ __('content.register.Already_have_an_account') }} <a href="{{ route('login')}}"
                        class="font-medium text-primary-600 hover:underline ">{{ __('content.register.login_here') }}</a>
                </p>
            </form>
        </div>
    </div>
</body>

@endsection

@push('scripts')
    @include('client.login.js-register')
@endpush