@extends('client.user_profiles.profiles')
@section('proFiles')
    <div>
        <h2 class="font-bold text-3xl">{{ __('content.editUserProfile.profile') }}</h2>

        <div id="circle" class="flex items-center justify-between">
            <div>
                <span class="text-gray-500 text-lg">{{ __('content.editUserProfile.title1') }}
                </span>
            </div>
            <!-- Avatar -->
            <div id="openModal"
                class="w-20 h-20 rounded-full border border-gray-300 bg-lightblue-500 cursor-pointer flex items-center justify-center overflow-hidden"
                onclick="openModal()">
                <!-- Hiển thị avatar của người dùng hoặc ảnh mặc định nếu chưa có -->
                <img id="avatar-display"
                    src="{{ !Auth::user()->avatar || empty(Auth::user()->avatar) ? asset('image/avatar_default.png')
                                        : (str_starts_with(Auth::user()->avatar, 'image/') ? asset(Auth::user()->avatar)
                                        : asset('storage/' . Auth::user()->avatar)) }}" alt="Avatar"
                    class="w-full h-full object-cover" />
            </div>

        </div>

        <!-- Modal -->
        <div id="myModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white rounded-lg shadow-2xl w-full max-w-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{__('content.editUserProfile.avatar_title')}}
                    </h2>
                    <span id="close"
                        class="cursor-pointer text-gray-500 text-2xl hover:text-gray-800 transition">&times;</span>
                </div>

                <form action="{{ route('users.profile.avatar.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex justify-between items-center space-x-6">
                        <div class="flex flex-col items-center">
                            <div
                                class="w-44 h-44 rounded-full border-2 border-gray-200 flex items-center justify-center bg-gray-100">
                                <img id="preview" src="" alt="Image Preview"
                                    class="rounded-full w-full h-full object-cover hidden" />
                            </div>
                            <!-- Nút Xóa -->
                            <button type="button" onclick="deleteAvatar()"
                                class="mt-4 bg-red-500 text-white px-4 py-2 rounded-full hover:bg-red-600 transition">      {{__('content.editUserProfile.delete')}}</button>
                        </div>
                        <div class="flex flex-col items-center">
                            <input type="file" name="avatar" id="fileInput" accept="image/*"
                                onchange="previewImage(event)"
                                class="cursor-pointer block text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition" />
                        </div>
                    </div>
                    <div class="mt-6 text-right">
                        <button id="save" type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition">{{ __('content.editUserProfile.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="py-8 space-y-10 ml-6">
        <div class="border-b pb-4"></div>
        {{-- <pre>{{ var_dump($user) }}</pre> --}}

        <!-- Tên -->
        <form id="nameForm" action="{{ route('users.profile.name.update') }}" method="POST"
            class="border-b pb-4 flex justify-between items-center">
            @csrf
            <div class="w-1/4">
                <span class="text-base">{{ __('content.editUserProfile.firstName') }}</span>
            </div>
            <div class="w-1/2">
                <div id="name-span" class="editable text-gray-600 text-base cursor-pointer"
                    onclick="editField('name-span', 'name-input', 'edit-actions-name', 'edit-btn-name')">
                    {{ old('first_name', $user->first_name) }} {{ old('first_name', $user->last_name) }}
                </div>
                <div class="hidden flex justify-between items-center gap-4" id="name-input">
                    <div class="flex flex-col w-1/2">
                        <div><span class="font-semibold text-base">{{ __('content.editUserProfile.firstName') }}</span>
                        </div>
                        <input type="text" name="first_name" placeholder="Nhập tên" class="border rounded-md p-2"
                            value="{{ old('first_name', $user->first_name) }}" />
                        <p id="first_name_error" class="text-red-500 text-base mt-1"></p>
                    </div>
                    <div class="flex flex-col w-1/2">
                        <div><span class="font-semibold text-base">{{ __('content.editUserProfile.lastName') }}</span>
                        </div>
                        <input type="text" name="last_name" placeholder="Nhập họ" class="border rounded-md p-2"
                            value="{{ old('last_name', $user->last_name) }}" />
                        <p id="last_name_error" class="text-red-500 text-base mt-1"></p>
                    </div>
                </div>

            </div>
            <div id="edit-btn-name" class="text-blue-600 cursor-pointer text-base font-semibold"
                onclick="editField('name-span', 'name-input', 'edit-actions-name', 'edit-btn-name')">
                {{ __('content.editUserProfile.edit') }}
            </div>
            <div id="edit-actions-name" class="hidden ml-5 flex flex-col space-y-16">
                <button type="button" class="text-blue-500 w-12 h-10 hover:bg-blue-50 rounded-md"
                    onclick="cancelEdit('name-span', 'name-input', 'edit-actions-name', 'edit-btn-name')">{{ __('content.editUserProfile.cancel') }}</button>
                <button type="button" class="save-btn text-white bg-blue-600 w-12 h-10 hover:bg-blue-700 rounded-md"
                    data-form="#nameForm"
                    data-errors="#first_name_error,#last_name_error">{{ __('content.editUserProfile.submit') }}</button>
            </div>
        </form>

        <!-- Tên hiển thị -->
        <form id="displayNameForm" action="{{ route('users.profile.display_name.update') }}" method="POST"
            class="border-b pb-4 flex justify-between items-center">
            @csrf
            <div class="w-1/4">
                <span class="text-base">{{ __('content.editUserProfile.displayName') }}</span>
            </div>
            <div class="w-1/2">
                <span id="display-name-span" class="editable text-gray-600 text-base"
                    onclick="editField('display-name-span', 'display-name-input', 'edit-actions-display-name', 'edit-btn-display-name')">{{ old('display_name', $user->display_name) ?: __('content.editUserProfile.add_displayName')}}</span>
                <div name="display_name" id="display-name-input" class="hidden">
                    <span class="font-semibold text-base">{{ __('content.editUserProfile.displayName') }}</span>
                    <input name="display_name" id="display-name-input" class="border rounded-md p-2  w-full h-10"
                        type="text" value="{{ old('display_name', $user->display_name) }}" />
                    <p id="display_name_error" class="text-red-500 text-sm mt-1"></p>
                </div>

            </div>
            <div id="edit-btn-display-name" class="text-blue-600 cursor-pointer text-base font-semibold"
                onclick="editField('display-name-span', 'display-name-input', 'edit-actions-display-name', 'edit-btn-display-name')">
                {{ __('content.editUserProfile.edit') }}</div>
            <div id="edit-actions-display-name" class="hidden ml-5 flex flex-col space-y-16">
                <button type="button" class="text-blue-500 w-12 h-10 hover:bg-blue-50 rounded-md"
                    onclick="cancelEdit('display-name-span', 'display-name-input', 'edit-actions-display-name', 'edit-btn-display-name')">{{ __('content.editUserProfile.cancel') }}</button>
                <button type="button" class="save-btn text-white bg-blue-600 w-12 h-10 hover:bg-blue-700 rounded-md"
                    data-form="#displayNameForm"
                    data-errors="#display_name_error">{{ __('content.editUserProfile.submit') }}</button>
            </div>
        </form>
        <!-- Email -->
        <form id="emailForm" action="{{ route('users.profile.email.update') }}" method="POST"
            class="border-b pb-4 flex justify-between items-center">
            @csrf
            <div class="w-1/4">
                <span class="text-base">{{ __('content.editUserProfile.email') }}</span>
            </div>
            <div class="w-1/2">
                <div class="space-y-5" id="email-display"
                    onclick="editField('email-display', 'email-input', 'edit-actions-email', 'edit-btn-email')">
                    <div class="flex gap-5">
                        <div>
                            <span class="editable text-gray-600 text-base">{{ old('email', $user->email) }}</span>
                        </div>
                        @if ($user->hasVerifiedEmail())
                            <div class="bg-green-600 text-white w-20 h-7 text-center rounded-md">
                                <span>{{ __('content.editUserProfile.active') }}</span>
                            </div>
                        @else
                            <button type="submit"
                                class="bg-red-700 text-white pl-1 pr-2 text-center rounded-md">{{ __('content.editUserProfile.in-active') }}</button>
                        @endif
                    </div>
                    <div>
                        <span class="text-gray-500">{{ __('content.editUserProfile.title2') }}</span>
                    </div>
                </div>
                <div class="space-y-5 hidden" id="email-input">
                    <div><span class="font-semibold text-base">{{ __('content.editUserProfile.email') }}</span></div>
                    <input class="border rounded-md p-2 w-full" type="text" name="email"
                        value="{{ old('email', $user->email) }}" />
                    <p id="email_error" class="text-red-500 text-sm mt-1"></p>
                </div>
            </div>
            <div id="edit-btn-email" class="text-blue-600 cursor-pointer text-base font-semibold"
                onclick="editField('email-display', 'email-input', 'edit-actions-email', 'edit-btn-email')">
                {{ __('content.editUserProfile.edit') }}
            </div>
            <div id="edit-actions-email" class="hidden ml-5 flex flex-col space-y-16">
                <button type="button" class="text-blue-500 w-12 h-10 hover:bg-blue-50 rounded-md"
                    onclick="cancelEdit('email-display', 'email-input', 'edit-actions-email', 'edit-btn-email')">{{ __('content.editUserProfile.cancel') }}</button>
                <button type="button" class="save-btn text-white bg-blue-600 w-12 h-10 hover:bg-blue-700 rounded-md"
                    data-form="#emailForm" data-errors="#email_error">{{ __('content.editUserProfile.submit') }}</button>
            </div>
        </form>


        <!-- Phone Number -->
        <form id="phoneNumberForm" action="{{ route('users.profile.phone.update') }}" method="POST"
            class="border-b pb-4 flex justify-between items-center">
            @csrf
            <div class="w-1/4">
                <span class="text-base">{{ __('content.editUserProfile.numberPhone') }}</span>
            </div>
            <div class="w-1/2">
                <div class="space-y-5" id="phone-display"
                    onclick="editField('phone-display', 'phone-input', 'edit-actions-phone', 'edit-btn-phone')">
                    <span class="editable text-gray-600 text-lg">+{{ old('country_code', $user->country_code) }}
                        {{ old('phone_number', $user->phone_number) ?:  __('content.editUserProfile.add_phone') }}</span><br>
                    <span class="text-gray-500">{{ __('content.editUserProfile.title3') }}</span>
                </div>
                <div class="hidden ml-5 flex flex-col space-y-6" id="phone-input">
                    <div class="phone-container">
                        <input type="text" id="phone" name="phone_number" placeholder=" {{__('content.editUserProfile.add_phone')}}"
                            class="border rounded-md p-2 w-full"
                            value="{{ old('phone_number', $user->phone_number) }}" />
                        <p id="phone_number_error" class="text-red-500 text-sm mt-1"></p>
                        <input type="hidden" id="countryCode" name="country_code"
                            value="{{ old('country_code', $user->country_code) }}" />
                    </div>
                </div>
            </div>
            <div id="edit-btn-phone" class="text-blue-600 cursor-pointer text-base font-semibold"
                onclick="editField('phone-display', 'phone-input', 'edit-actions-phone', 'edit-btn-phone')">
                {{ __('content.editUserProfile.edit') }}</div>
            <div id="edit-actions-phone" class="hidden ml-5 flex flex-col space-y-24">
                <button type="button" class="text-blue-500 w-12 h-10 hover:bg-blue-50 rounded-md"
                    onclick="cancelEdit('phone-display', 'phone-input', 'edit-actions-phone', 'edit-btn-phone')">{{ __('content.editUserProfile.cancel') }}</button>
                <button type="button" class="save-btn text-white bg-blue-600 w-12 h-10 hover:bg-blue-700 rounded-md"
                    data-form="#phoneNumberForm"
                    data-errors="#phone_number_error">{{ __('content.editUserProfile.submit') }}</button>
            </div>
        </form>

        <!-- Birthday -->
        @php
            $birthday = old('birthday', $user->birthday);
            $day = $birthday ? \Carbon\Carbon::parse($birthday)->day : '';
            $month = $birthday ? \Carbon\Carbon::parse($birthday)->month : '';
            $year = $birthday ? \Carbon\Carbon::parse($birthday)->year : '';
        @endphp

        <form id="birthdayForm" action="{{ route('users.profile.birthday.update') }}" method="POST"
            class="border-b pb-4 flex justify-between items-center">
            @csrf
            <div class="w-1/4">
                <span class="text-base">{{ __('content.editUserProfile.birth') }}</span>
            </div>
            <div class="w-1/2">
                <div class="space-y-5" id="birthday-display"
                    onclick="editField('birthday-display', 'birthday-input', 'edit-actions-birthday', 'edit-btn-birthday')">
                    <span class="editable text-gray-600 text-lg">{{ $birthday ?:  __('content.editUserProfile.add_birth') }}</span>
                </div>
                <div class="space-y-5 hidden" id="birthday-input">
                    <input type="text" name="day" class="border rounded-md p-2 w-20" placeholder=" {{__('content.editUserProfile.day')}}"
                        value="{{ $day }}" />

                    <select name="month" class="border rounded-md p-2 w-32">
                        <option value="">{{__('content.editUserProfile.month')}}</option>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>{{__('content.editUserProfile.month')}}
                                {{ $i }}</option>
                        @endfor
                    </select>

                    <input type="text" name="year" class="border rounded-md p-2 w-32" placeholder="{{__('content.editUserProfile.year')}}"
                        value="{{ $year }}" />
                    <p id="day_error" class="text-red-500 text-sm mt-1"></p>
                    <p id="month_error" class="text-red-500 text-sm"></p>
                    <p id="year_error" class="text-red-500 text-sm"></p>
                </div>

            </div>
            <div id="edit-btn-birthday" class="text-blue-600 cursor-pointer text-base font-semibold"
                onclick="editField('birthday-display', 'birthday-input', 'edit-actions-birthday', 'edit-btn-birthday')">
                {{ __('content.editUserProfile.edit') }}</div>
            <div id="edit-actions-birthday" class="hidden ml-5 flex flex-col space-y-20">
                <button type="button" class="text-blue-500 w-12 h-10 hover:bg-blue-50 rounded-md"
                    onclick="cancelEdit('birthday-display', 'birthday-input', 'edit-actions-birthday', 'edit-btn-birthday')">{{ __('content.editUserProfile.cancel') }}</button>
                <button type="button" class="save-btn text-white bg-blue-600 w-12 h-10 hover:bg-blue-700 rounded-md"
                    data-form="#birthdayForm"
                    data-errors="#day_error,#month_error, #year_error">{{ __('content.editUserProfile.submit') }}</button>
            </div>
        </form>

        <!-- Repeat similar structure for nationality, gender, address, and passport forms with appropriate fields and action routes -->


        <!-- Form Quốc tịch -->
        <form id="countryForm" action="{{ route('users.profile.nationality.update') }}" method="POST"
            class="border-b pb-4 flex justify-between items-center">
            @csrf
            <div class="w-1/4">
                <span class="text-base">{{ __('content.editUserProfile.nationally') }}</span>
            </div>
            <div class="w-1/2">
                <div class="space-y-5" id="nationality-display"
                    onclick="editField('nationality-display', 'nationality-input', 'edit-actions-nationality', 'edit-btn-nationality')">
                    <span
                        class="editable text-gray-600 text-base">{{ old('nationality', $user->nationality) ?: 'Thêm quốc tịch' }}</span>
                </div>
                <div class="space-y-5 hidden" id="nationality-input">
                    <label for="nationality">{{ __('content.editUserProfile.nationally') }}</label>
                    <select name="nationality" class="border rounded-md p-2 w-full" id="nationality-select">
                        <option value="">{{ __('content.editUserProfile.nationallySelect') }}</option>
                    </select>
                    <p id="nationality_error" class="text-red-500 text-sm mt-1"></p>
                </div>
            </div>
            <div id="edit-btn-nationality" class="text-blue-600 cursor-pointer text-base font-semibold"
                onclick="editField('nationality-display', 'nationality-input', 'edit-actions-nationality', 'edit-btn-nationality')">
                {{ __('content.editUserProfile.edit') }}
            </div>
            <div id="edit-actions-nationality" class="hidden ml-5 flex flex-col space-y-20">
                <button type="button" class="text-blue-500 w-12 h-10 hover:bg-blue-50 rounded-md"
                    onclick="cancelEdit('nationality-display', 'nationality-input', 'edit-actions-nationality', 'edit-btn-nationality')">{{ __('content.editUserProfile.cancel') }}</button>
                <button type="button" class="save-btn text-white bg-blue-600 w-12 h-10 hover:bg-blue-700 rounded-md"
                    data-form="#countryForm"
                    data-errors="#nationality_error">{{ __('content.editUserProfile.submit') }}</button>
            </div>
        </form>

        <!-- Giới tính -->
        <form id="genderForm" action="{{ route('users.profile.gender.update') }}" method="POST"
            class="border-b pb-4 flex justify-between items-center">
            @csrf
            <div class="w-1/4">
                <span class="text-base">{{ __('content.editUserProfile.gender') }}</span>
            </div>
            <div class="w-1/2">
                <div class="space-y-5" id="gender-display"
                    onclick="editField('gender-display', 'gender-input', 'edit-actions-gender', 'edit-btn-gender')">
                    <span class="editable text-gray-600 text-lg">{{ old('gender', $user->gender_text) }}</span>
                </div>
                <div class="space-y-5 hidden" id="gender-input">
                    <select name="gender" class="border rounded-md p-2 w-full" id="gender-select">
                        <option value="">{{ __('content.editUserProfile.genderSelect') }}</option>
                        <option value="1" {{ old('gender', $user->gender) == 1 ? 'selected' : '' }}>{{ __('content.editUserProfile.male')}}</option>
                        <option value="0" {{ old('gender', $user->gender) == 0 ? 'selected' : '' }}>{{ __('content.editUserProfile.female')}}</option>
                        <option value="2" {{ old('gender', $user->gender) == 2 ? 'selected' : '' }}>{{ __('content.editUserProfile.other')}}</option>
                    </select>
                    <p id="gender_error" class="text-red-500 text-sm mt-1"></p>

                </div>
            </div>
            <div id="edit-btn-gender" class="text-blue-600 cursor-pointer text-base font-semibold"
                onclick="editField('gender-display', 'gender-input', 'edit-actions-gender', 'edit-btn-gender')">
                {{ __('content.editUserProfile.edit') }}
            </div>
            <div id="edit-actions-gender" class="hidden ml-5 flex flex-col space-y-24">
                <button type="button" class="text-blue-500 w-12 h-10 hover:bg-blue-50 rounded-md"
                    onclick="cancelEdit('gender-display', 'gender-input', 'edit-actions-gender', 'edit-btn-gender')">{{ __('content.editUserProfile.cancel') }}</button>
                <button type="button" class="save-btn text-white bg-blue-600 w-12 h-10 hover:bg-blue-700 rounded-md"
                    data-form="#genderForm"
                    data-errors="#gender_error">{{ __('content.editUserProfile.submit') }}</button>
            </div>
        </form>

        <!-- Form Địa chỉ -->

        <form id="addressForm" action="{{ route('users.profile.address.update') }}" method="POST"
            class="border-b pb-4 flex justify-between items-center">
            @csrf
            <div class="w-1/4">
                <span class="text-base">{{ __('content.editUserProfile.address') }}</span>
            </div>
            <div class="w-1/2">
                <div class="space-y-5" id="address-display"
                    onclick="editField('address-display', 'address-input', 'edit-actions-address', 'edit-btn-address')">

                    <span class="editable text-gray-600 text-base">{{ __('content.editUserProfile.address') }}</span>
                    <span>{{ $address['street'] ?? '' }}</span><br>
                    <span>{{ $address['zip'] ?? '' }}</span>
                    <span>{{ $address['city'] ?? '' }}</span><br>
                    <span>{{ $address['country'] ?? '' }}</span>
                </div>
                <div class="space-y-7 hidden text-base" id="address-input">
                    <select name="country" class="border rounded-md p-2 w-full" id="country-select">
                        <option value="">{{ __('content.editUserProfile.countrySelect') }}</option>
                    </select>
                    <p id="country_error" class="text-red-500 text-sm mt-1"></p>
                    <input type="text" name="street" placeholder="{{__('content.editUserProfile.streetPlaceholder')}}"
                        class="border rounded-md p-2 w-full" value="{{ $address['street'] ?? '' }}" />
                    <p id="street_error" class="text-red-500 text-sm mt-1"></p>
                    <input type="text" name="city" placeholder="{{__('content.editUserProfile.cityPlaceholder')}}"
                        class="border rounded-md p-2 w-full" value="{{ $address['city'] ?? '' }}" />
                    <p id="city_error" class="text-red-500 text-sm mt-1"></p>
                    <input type="text" name="zip" placeholder="{{__('content.editUserProfile.zipPlaceholder')}}" class="border rounded-md p-2 w-full"
                        value="{{ $address['zip'] ?? '' }}" />
                    <p id="zip_error" class="text-red-500 text-sm mt-1"></p>
                </div>
            </div>
            <div id="edit-btn-address" class="text-blue-600 cursor-pointer text-base font-semibold"
                onclick="editField('address-display', 'address-input', 'edit-actions-address', 'edit-btn-address')">
                {{ __('content.editUserProfile.edit') }}
            </div>
            <div id="edit-actions-address" class="hidden ml-5 flex flex-col space-y-72">
                <button type="button" class="text-blue-500 w-12 h-10 hover:bg-blue-50 rounded-md"
                    onclick="cancelEdit('address-display', 'address-input', 'edit-actions-address', 'edit-btn-address')">{{ __('content.editUserProfile.cancel') }}</button>
                <button type="button" class="save-btn text-white bg-blue-600 w-12 h-10 hover:bg-blue-700 rounded-md"
                    data-form="#addressForm"
                    data-errors="#country_error, #street_error, #city_error, #zip_error">{{ __('content.editUserProfile.submit') }}</button>
            </div>
        </form>

        <!-- Passport Information -->

        <form id="passportForm" action="{{ route('users.profile.passport.update') }}" method="POST"
            class="border-b pb-4 flex justify-between items-center">
            @csrf
            <div class="w-1/4">
                <span class="text-base">{{ __('content.editUserProfile.passport') }}</span>
            </div>
            <div class="w-1/2 flex flex-col items-center">
                <div class="space-y-5 cursor-pointer" id="passport-display"
                    onclick="editField('passport-display', 'passport-input', 'edit-actions-passport', 'edit-btn-passport')">
                    <!-- Hiển thị số hộ chiếu với ẩn các ký tự ngoài 2 số cuối -->
                    @if (isset($passportData['number']))
                        <span class="editable text-gray-600 text-base">
                            {{ str_repeat('*', strlen($passportData['number']) - 2) . substr($passportData['number'], -2) }}
                        </span>
                    @else
                        <span class="editable text-gray-600"></span>
                    @endif
                </div>
                <div class="space-y-7 hidden" id="passport-input">
                    <input type="text" name="passport_first_name" placeholder="{{__('content.editUserProfile.firstName')}}"
                        class="border rounded-md p-2 w-full" value="{{ $passportData['first_name'] ?? '' }}" />
                    <p id="passport_first_name_error" class="text-red-500 text-sm mt-1"></p>
                    <input type="text" name="passport_last_name" placeholder="{{__('content.editUserProfile.lastName')}}"
                        class="border rounded-md p-2 w-full" value="{{ $passportData['last_name'] ?? '' }}" />
                    <p id="passport_last_name_error" class="text-red-500 text-sm mt-1"></p>
                    <select name="passport_country" class="border rounded-md p-2 w-full" id="passport-country-select">
                        <option value="">{{ __('content.editUserProfile.countrySelect') }}</option>
                    </select>
                    <p id="passport_country_error" class="text-red-500 text-sm mt-1"></p>
                    <input type="text" name="passport_number" placeholder="{{__('content.editUserProfile.passportNumber')}}"
                        class="border rounded-md p-2 w-full" value="{{ $passportData['number'] ?? '' }}" />
                    <p id="passport_number_error" class="text-red-500 text-sm mt-1"></p>
                    <div class="flex space-x-2">
                        <input type="text" name="expiry_day" placeholder="{{__('content.editUserProfile.day')}}" class="border rounded-md p-2 w-12"
                            value="{{ $passportData['expiry']['day'] ?? '' }}" />
                        <select name="expiry_month" class="border rounded-md p-2 w-24">
                            <option value="">MM</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ sprintf('%02d', $i) }}"
                                    {{ isset($passportData['expiry']['month']) && $passportData['expiry']['month'] == sprintf('%02d', $i) ? 'selected' : '' }}>
                                    {{ $i }}</option>
                            @endfor
                        </select>
                        <input type="text" name="expiry_year" placeholder="{{__('content.editUserProfile.year')}}" class="border rounded-md p-2 w-20"
                            value="{{ $passportData['expiry']['year'] ?? '' }}" />
                    </div>
                    <p id="expiry_day_error" class="text-red-500 text-sm mt-1"></p>
                    <p id="expiry_month_error" class="text-red-500 text-sm mt-1"></p>
                    <p id="expiry_year_error" class="text-red-500 text-sm mt-1"></p>
                    <p id="expiry_date_error" class="text-red-500 text-sm mt-1"></p>

                    <input type="checkbox" name="agree" id="agree-checkbox" class="w-5 h-5"
                        {{ isset($passportData['agree']) && $passportData['agree'] ? 'checked' : '' }} />
                    <label for="agree-checkbox" class="ml-2">{{ __('content.editUserProfile.checkbox') }}</label>
                </div>
            </div>


            @if (isset($passportData['number']))
                <form action="{{ route('users.profile.passport.delete') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 cursor-pointer text-base font-semibold"
                        onclick="return confirm({{ __('content.editUserProfile.remove') }})">
                        {{ __('content.editUserProfile.delete') }}
                    </button>
                </form>
            @else
                <div id="edit-btn-passport" class="text-blue-600 cursor-pointer text-base font-semibold"
                    onclick="editField('passport-display', 'passport-input', 'edit-actions-passport', 'edit-btn-passport')">
                    {{ __('content.editUserProfile.edit') }}
                </div>
                <div id="edit-actions-passport" class="hidden flex flex-col space-y-96">
                    <button type="button" class="text-blue-500 w-12 h-10 hover:bg-blue-50 rounded-md"
                        onclick="cancelEdit('passport-display', 'passport-input', 'edit-actions-passport', 'edit-btn-passport')">{{ __('content.editUserProfile.cancel') }}</button>
                    <button type="button" class="save-btn text-white bg-blue-600 w-12 h-10 hover:bg-blue-700 rounded-md"
                        data-form="#passportForm"
                        data-errors="#passport_first_name_error, #passport_last_name_error, #passport_country_error, #passport_number_error, #expiry_day_error, #expiry_month_error, #expiry_year_error">{{ __('content.editUserProfile.submit') }}</button>
                </div>
            @endif
        </form>
    </div>
    <script>
     $(document).ready(function () {
    $('.save-btn').on('click', function (e) {
        e.preventDefault();

        const formId = $(this).data('form');
        const errorFields = $(this).data('errors').split(',');
        const $button = $(this); // Nút hiện tại

        // Vô hiệu hóa nút và hiển thị spinner
        $button.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');

        // Xóa tất cả thông báo lỗi cũ
        errorFields.forEach(function (field) {
            $(field).text('');
        });

        // Gửi AJAX với form được xác định
        $.ajax({
            url: $(formId).attr('action'),
            type: 'POST',
            data: $(formId).serialize(),
            success: function (response) {
                location.reload(); // Tải lại trang nếu thành công
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;

                    // Chỉ xử lý các lỗi thực sự có trong phản hồi
                    for (const field in errors) {
                        const errorElementId = `#${field}_error`;
                        if ($(errorElementId).length) {
                            $(errorElementId).text(errors[field][0]);
                        }
                    }
                }

                // Kích hoạt lại nút nếu có lỗi
                $button.prop('disabled', false).html('Gửi');
            }
        });
    });
});

    </script>
@endsection
