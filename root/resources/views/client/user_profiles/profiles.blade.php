@extends('client.layouts.master-layout')
@section('content')
    <div>
        <div>
            @include('client.layouts.header')
            <div class="container w-full mx-auto mt-10 bg-white flex flex-col md:flex-row px-16">
                <!-- Sidebar -->
                <div
                    class="w-full md:w-1/4 p-6 rounded-t-lg md:rounded-l-lg border border-gray-200 text-base h-2/3 rounded-lg">
                    <ul class="space-y-7">
                        <li class="bg-white p-4 hover:underline border-b border-gray-300">
                            <a href="{{ route('users.showProfile') }}" class="text-gray-600  hover:text-blue-600">
                                <i class="fas fa-user mr-2"></i>{{ __('content.profileSidebar.personal_information') }}
                            </a>
                        </li>
                        <li class="bg-white p-4 hover:underline border-b border-gray-300">
                            <a href="{{ route('user.changePasswordForm') }}" class="text-gray-600  hover:text-blue-600">
                                <i class="fas fa-cogs mr-2"></i>{{ __('content.profileSidebar.change_password') }}

                            </a>
                        </li>
                        <li class="bg-white p-4 hover:underline border-b border-gray-300">
                            <a href="{{ route('users.activities') }}" class="text-gray-600 hover:text-blue-600">
                                <i class="fa-solid fa-chart-line mr-2"></i>{{ __('content.activity.activity') }}
                            </a>
                        </li>
                        <li class="bg-white p-4 hover:underline">
                            <a href="{{ route('users.showProfiles') }}" class="text-gray-600 hover:text-blue-600">
                                <i class="fas fa-users mr-2"></i>{{ __('content.profileSidebar.device_management') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Main content -->
                <div class="w-full md:w-3/4 p-6">
                    @yield('proFiles')
                </div>

            </div>
        @endsection
        @push('scripts')
            <script>
                // Get modal elements
                const modal = document.getElementById("myModal");
                const closeModalButton = document.getElementById("close");
                const fileInput = document.getElementById("fileInput");
                const previewImageElement = document.getElementById("preview");
                const deleteButton = document.getElementById("delete");

                // Mở Modal
                function openModal() {
                    const avatarDisplay = document.getElementById("avatar-display");
                    const previewImageElement = document.getElementById("preview");
                    // Lấy src hiện tại của ảnh đại diện và đặt vào preview nếu có ảnh
                    if (avatarDisplay.src) {
                        previewImageElement.src = avatarDisplay.src;
                        previewImageElement.classList.remove("hidden");
                    } else {
                        previewImageElement.src = ""; // Không có ảnh, reset preview
                        previewImageElement.classList.add("hidden");
                    }
                    modal.classList.remove("hidden");
                }

                // Đóng Modal
                function closeModal() {
                    modal.classList.add("hidden");
                    clearPreview();
                }

                // Preview ảnh khi chọn file
                function previewImage(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewImageElement.src = e.target.result;
                            previewImageElement.classList.remove("hidden");
                        };
                        reader.readAsDataURL(file);
                    }
                }

                // Xóa preview và reset file input
                function clearPreview() {
                    previewImageElement.src = "";
                    previewImageElement.classList.add("hidden");
                    fileInput.value = "";
                }

                // Xóa ảnh
                function deleteAvatar() {
                    if (confirm('{{ __('content.editUserProfile.message_img') }}')) {
                        // Gọi route xóa avatar
                        fetch("{{ route('users.profile.avatar.delete') }}", {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        }).then(response => {
                            if (response.ok) {
                                location.reload();
                            }
                        }).catch(error => {
                            console.error('Error:', error);
                        });
                    }
                }

                // Đóng modal khi nhấn vào nút đóng
                closeModalButton.addEventListener("click", closeModal);

                function editField(spanId, inputId, actionsId, editBtnId) {
                    // Lấy phần tử span và nội dung của nó
                    const spanElement = document.getElementById(spanId);
                    const inputElement = document.getElementById(inputId);
                    const actionsElement = document.getElementById(actionsId);
                    const editButtonElement = document.getElementById(editBtnId);

                    // Tách họ và tên từ nội dung của span
                    const fullName = spanElement.textContent;
                    const [firstName, lastName] = fullName.split(" ").length > 1 ? fullName.split(" ") : [fullName, ""];

                    // Kiểm tra xem các input 'first-name' và 'last-name' có tồn tại trước khi gán giá trị
                    const firstNameInput = document.getElementById("first-name");
                    const lastNameInput = document.getElementById("last-name");
                    if (firstNameInput) firstNameInput.value = firstName;
                    if (lastNameInput) lastNameInput.value = lastName;

                    // Hiển thị ô input và các nút hành động, ẩn span và nút chỉnh sửa
                    spanElement.classList.add("hidden");
                    inputElement.classList.remove("hidden");
                    actionsElement.classList.remove("hidden");
                    editButtonElement.classList.add("hidden");
                }


                function cancelEdit(spanId, inputId, actionsId, editBtnId) {
                    // Khôi phục trạng thái ban đầu
                    document.getElementById(spanId).classList.remove("hidden"); // Hiện span
                    document.getElementById(inputId).classList.add("hidden"); // Ẩn input
                    document.getElementById(actionsId).classList.add("hidden"); // Ẩn các nút hành động
                    document.getElementById(editBtnId).classList.remove("hidden"); // Hiện nút chỉnh sửa
                }

                function saveEdit(spanId, inputId, actionsId, editBtnId) {
                    // Lưu giá trị từ input vào span và khôi phục lại trạng thái
                    const firstName = document.getElementById("first-name").value.trim();
                    const lastName = document.getElementById("last-name").value.trim();

                    // Cập nhật giá trị span với tên và họ
                    const displayValue = [firstName, lastName].filter(Boolean).join(" ") || "Nhập tên và họ";
                    document.getElementById(spanId).textContent = displayValue; // Cập nhật giá trị span

                    // Khôi phục trạng thái ban đầu
                    cancelEdit(spanId, inputId, actionsId, editBtnId);
                }
                document.addEventListener("DOMContentLoaded", function() {
                    const phoneInputField = document.querySelector("#phone");
                    const countryCodeInput = document.querySelector("#countryCode");

                    // Khởi tạo intlTelInput
                    const phoneInput = window.intlTelInput(phoneInputField, {
                        separateDialCode: true,
                        preferredCountries: ["vn", "us", "gb"],
                        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                    });

                    // Thiết lập quốc gia mặc định từ countryCode khi tải trang
                    const initialCountryCode = countryCodeInput.value;

                    if (initialCountryCode) {
                        const countryData = intlTelInputGlobals.getCountryData().find(
                            (country) => country.dialCode === initialCountryCode
                        );
                        if (countryData) {
                            phoneInput.setCountry(countryData.iso2);
                        }
                    }

                    // Cập nhật countryCode khi thay đổi quốc gia
                    phoneInputField.addEventListener("countrychange", function() {
                        const selectedCountryData = phoneInput.getSelectedCountryData();
                        countryCodeInput.value = selectedCountryData.dialCode;
                    });

                    // Ngăn chặn gửi form bằng phím Enter
                    phoneInputField.addEventListener("keydown", function(e) {
                        if (e.key === "Enter") {
                            e.preventDefault();
                        }
                    });
                });

                // Ngăn chặn gửi form khi nhấn Enter trong toàn bộ form
                document.getElementById("phoneNumberForm").addEventListener("keydown", function(e) {
                    if (e.key === "Enter") {
                        e.preventDefault();
                    }
                });
                document.addEventListener("DOMContentLoaded", function() {
                    // Lấy các phần tử select cho quốc tịch, địa chỉ và hộ chiếu
                    const nationalitySelect = document.getElementById("nationality-select");
                    const countrySelect = document.getElementById("country-select");
                    const passportCountrySelect = document.getElementById("passport-country-select");

                    // Giá trị quốc gia đã lưu từ backend (PHP)
                    const savedNationality = "{{ $user->nationality ?? '' }}";
                    const savedAddressCountry = "{{ $address['country'] ?? '' }}";
                    const savedPassportCountry = "{{ $passportData['country'] ?? '' }}";

                    // Hàm tải dữ liệu từ API
                    fetch("/api/api-countries")
                        .then(response => response.json())
                        .then(data => {
                            if (data.error === 0) {
                                // Tạo option cho mỗi quốc gia
                                data.data.forEach(country => {
                                    const option = document.createElement("option");
                                    option.value = country.name;
                                    option.textContent = country.name;

                                    // Đặt quốc gia đã chọn sẵn nếu có dữ liệu
                                    if (country.name === savedNationality) {
                                        option.selected = true;
                                    }
                                    nationalitySelect.appendChild(option);

                                    const optionAddress = option.cloneNode(true);
                                    if (country.name === savedAddressCountry) {
                                        optionAddress.selected = true;
                                    }
                                    countrySelect.appendChild(optionAddress);

                                    const optionPassport = option.cloneNode(true);
                                    if (country.name === savedPassportCountry) {
                                        optionPassport.selected = true;
                                    }
                                    passportCountrySelect.appendChild(optionPassport);
                                });
                            } else {
                                console.error(data.error_text);
                            }
                        })
                        .catch(error => console.error("Lỗi khi gọi API quốc gia:", error));
                });
            </script>
        @endpush
        @push('style')
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
            <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/country-select-js/build/js/countrySelect.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        @endpush
