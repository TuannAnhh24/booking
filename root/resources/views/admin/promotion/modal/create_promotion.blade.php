<dialog id='modal_add_promotion' class='modal'>
    <div class='modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto min-w-[850px] p-4'>
        <form method='dialog'>
            <button class='btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3'><i
                    class="ri-close-line text-2xl"></i></button>
        </form>
        <h2 class='mb-4 text-xl font-bold text-gray-900'>{{ __('content.promotion.add_promotion') }}</h2>
        <section class='bg-white w-full flex justify-center'>
            <div class='pt-4 pb-8 px-4 min-w-[60%]'>
                <form action='{{ route('admin.promotion.store') }}' id="form-add-promotion" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class='grid gap-4 sm:grid-cols-2 sm:gap-6'>
                        <div class='sm:col-span-2'>
                            <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                {{ __('content.promotion.code') }}
                            </label>
                            <input type='text' id='code' name="code"
                                class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5'
                                value="" readonly placeholder='Type code promotion' />
                        </div>
                        @error('code')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror

                        <div class='w-full'>
                            <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                {{ __('content.promotion.start_date') }}
                            </label>
                            <input type='date' id='start_date' name='start_date'
                                class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5' />
                                <div class="text-red-500 text-xs mt-1"></div>
                        </div>
                        @error('start_date')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                        <div class='w-full'>
                            <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                {{ __('content.promotion.end_date') }}
                            </label>
                            <input type='date' id='end_date' name='end_date'
                                class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5' />
                                <div class="text-red-500 text-xs mt-1"></div>
                        </div>
                        @error('end_date')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                        <div class='w-full'>
                            <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                {{ __('content.promotion.quantity') }}
                            </label>
                            <input type='number' id='quantity' min="1" name='quantity'
                                placeholder="Number of discount codes"
                                class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5' />
                                <div class="text-red-500 text-xs mt-1"></div>
                        </div>
                        @error('quantity')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                        <div>
                            <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                {{ __('content.promotion.discount_type') }}
                            </label>
                            <select id='discount_type' name="discount_type"z
                                class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5'>
                                <option value='default' disabled selected>
                                    {{ __('content.promotion.select_discount_type') }}
                                </option>
                                <option value='percentage'>{{ __('content.promotion.percentage') }}</option>
                                <option value='amount'>{{ __('content.promotion.amount') }}</option>
                            </select>
                            <div id="error_selectPromotion" class="text-red-500 text-xs mt-1 hidden">Vui lòng chọn</div>
                        </div>
                        @error('discount_type')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror

                        <div id='percent_discount' class="hidden">
                            <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                {{ __('content.promotion.discount_percentage') }}
                            </label>
                            <input type='number' id='discount_percentage' name="discount_percentage"
                                class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5'
                                placeholder='Enter discount percentage' />
                                <div class="text-red-500 text-xs mt-1"></div>
                            @error('discount_percentage')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div id='amount_discount' class="hidden">
                            <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                {{ __('content.promotion.discount_amount') }}
                            </label>
                            <input type='number' id='discount_amount' name="discount_amount"
                                class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5'
                                placeholder='Enter discount amount' />
                                <div class="text-red-500 text-xs mt-1"></div>
                            @error('discount_amount')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class='sm:col-span-2'>
                            <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                {{ __('content.promotion.image') }}
                            </label>
                            <label htmlFor='image'
                                class='bg-white sm:col-span-2 text-gray-500 font-semibold text-base rounded w-full  h-52 flex flex-col items-center justify-center cursor-pointer border-2 border-gray-300 border-dashed mx-auto font-[sans-serif]'>
                                <svg xmlns='http://www.w3.org/2000/svg' class='w-11 mb-2 fill-gray-500'
                                    viewBox='0 0 32 32'>
                                    <path
                                        d='M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z'
                                        data-original='#000000' />
                                    <path
                                        d='M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z'
                                        data-original='#000000' />
                                </svg>
                                {{ __('content.promotion.upload_file') }}
                                <input type='file' id='image' class='hidden' name="image" />
                                <p class='text-xs font-medium text-gray-400 mt-2'>
                                    PNG, JPG SVG, WEBP, and GIF are Allowed.
                                </p>
                            </label>
                            <div class="mt-4">
                                <img id="preview-image" src="#" alt="Selected Image"
                                    class="hidden w-32 h-32 object-cover border border-gray-300 rounded-lg" />
                            </div>
                        </div>
                        
                        @error('image')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror

                        <!-- {/* Description */} -->
                        <div class='sm:col-span-2'>
                            <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                {{ __('content.promotion.short_description') }}
                            </label>
                            <input type='text' id='short_description' name="short_description"
                                class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5'
                                placeholder='Enter short Description' />
                                <div class="text-red-500 text-xs mt-1"></div>
                        </div>
                        @error('short_description')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror

                        <div class='sm:col-span-2'>
                            <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                {{ __('content.promotion.long_description') }}
                            </label>
                            <textarea id='long_description' name="long_description"
                                class='block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500'
                                placeholder='Your description here'></textarea>
                        </div>
                        @error('long_description')
                            <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type='button' id="add-button" onclick="submitForm()"
                        class='py-2 px-4 rounded-lg bg-[#EDA315] border-2 border-transparent hover:text-white text-white text-md mr-4 hover:bg-[#316887] inline-flex items-center mt-4 sm:mt-6 text-sm font-medium text-center bg-primary-700  focus:ring-4 focus:ring-primary-200 hover:bg-primary-800'>
                        <span id="button-text">{{ __('content.promotion.add_promotion') }}</span>
                        <span id="loading-spinner" style="display:none;">{{ __('content.promotion.Processing') }}</span>
                    </button>
                </form>
            </div>
        </section>
    </div>
</dialog>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const form = document.getElementById("form-add-promotion");

            function showError(input, message) {
                const errorDiv = input.nextElementSibling; 
                errorDiv.textContent = message;
                errorDiv.classList.add("text-red-500", "text-xs", "mt-1");
            }

            function clearError(input) {
                const errorDiv = input.nextElementSibling;
                errorDiv.textContent = "";
            }

            function validateField(input, validateFn, errorMessage) {
                if (!validateFn(input.value)) {
                    showError(input, errorMessage);
                    return false;
                }
                clearError(input);
                return true;
            }

            function validateRequired(value) {
                return value.trim() !== "";
            }

            function validatePositiveNumber(value) {
                return value > 0;
            }

            function validateDate(value) {
                return value && !isNaN(Date.parse(value));
            }

            // Gắn sự kiện validate cho từng input
            const inputs = [
                {
                    element: document.getElementById("start_date"),
                    validateFn: validateDate,
                    errorMessage: "Ngày bắt đầu không hợp lệ",
                },
                {
                    element: document.getElementById("end_date"),
                    validateFn: validateDate,
                    errorMessage: "Ngày kết thúc không hợp lệ",
                },
                {
                    element: document.getElementById("quantity"),
                    validateFn: validatePositiveNumber,
                    errorMessage: "Số lượng phải lớn hơn 0",
                },
                {
                    element: document.getElementById("discount_percentage"),
                    validateFn: validateRequired,
                    errorMessage: "Không được để trống",
                },
                {
                    element: document.getElementById("discount_amount"),
                    validateFn: validateRequired,
                    errorMessage: "Không được để trống",
                },
            ];

            inputs.forEach(({ element, validateFn, errorMessage }) => {
                element.addEventListener("input", () => validateField(element, validateFn, errorMessage));
                element.addEventListener("blur", () => validateField(element, validateFn, errorMessage));
            });

            // Xử lý khi submit form
            form.addEventListener("submit", (e) => {
                let isValid = true;
                // const discountType = document.getElementById('discount_type').value;
                // if (discountType === 'default') {
                //     document.getElementById('error_selectPromotion').classList.remove('hidden');
                // }else {
                //     document.getElementById('error_selectPromotion').classList.add('hidden');
                // }

                inputs.forEach(({ element, validateFn, errorMessage }) => {
                    if (!validateField(element, validateFn, errorMessage)) {
                        isValid = false;
                    }
                });

                if (!isValid) {
                    e.preventDefault(); 
                }
            });
        });
        function submitForm() {
            document.getElementById("add-button").disabled = true;
            document.getElementById("button-text").style.display = "none";
            document.getElementById("loading-spinner").style.display = "inline";

            document.getElementById("form-add-promotion").submit();
        }
        
        document.getElementById('discount_type').addEventListener('change', function() {
            const discountType = this.value;
            const percentDiscount = document.getElementById('percent_discount');
            const amountDiscount = document.getElementById('amount_discount');

            if (discountType === 'percentage') {
                percentDiscount.classList.remove("hidden")
                amountDiscount.classList.add("hidden")
            } else if (discountType === 'amount') {
                amountDiscount.classList.remove("hidden")
                percentDiscount.classList.add("hidden")
            } else {
                console.log("error")
            }
        });

        document.getElementById('image').addEventListener('change', function(event) {
            const input = event.target;
            const preview = document.getElementById('preview-image');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endpush
