<dialog id='modal_detail_promotion' class='modal'>
    <div class='modal-box flex-col font-[sans-serif] bg-white max-w-4xl flex items-center mx-auto min-w-[850px] p-4'>
        <form method='dialog'>
            <button class='btn btn-sm btn-circle btn-ghost text-black absolute right-3 top-3'><i
                    class="ri-close-line text-2xl"></i></button>
        </form>
        <h2 class='mb-4 text-xl font-bold text-gray-900'>{{ __('content.promotion.show_promotion') }}
        </h2>
        <section class='bg-white w-full flex justify-center'>
            <div class='pt-4 pb-8 px-4 min-w-[60%]'>
                @if (!empty($promotion))
                    <form action='{{ route('admin.promotion.update', $promotion->id) }}' method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" id="promotion-id" name="promotion-id" value="">
                        <div class='grid gap-4 sm:grid-cols-2 sm:gap-6'>
                            <div class='sm:col-span-2'>
                                <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                    {{ __('content.promotion.code') }}
                                </label>
                                <input type='text' id='code' name="code"
                                    class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5'
                                    placeholder='Type code promotion' value="{{ $promotion->code }}" disabled />
                            </div>
                            <div class='w-full'>
                                <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                    {{ __('content.promotion.start_date') }}
                                </label>
                                <input type='date' id='start_date' name='start_date'
                                    class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5'
                                    value="{{ $promotion->start_date }}" disabled />
                            </div>
                            <div class='w-full'>
                                <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                    {{ __('content.promotion.end_date') }}
                                </label>
                                <input type='date' id='end_date' name='end_date'
                                    class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5'
                                    value="{{ $promotion->end_date }}" disabled />
                            </div>
                            <div class='w-full'>
                                <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                    {{ __('content.promotion.quantity') }}
                                </label>
                                <input type='number' id='quantity' min="1" name='quantity'
                                    placeholder="Number of discount codes"
                                    class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5'
                                    value="{{ $promotion->quantity }}" disabled />
                            </div>
                            <div>
                                <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                    {{ __('content.promotion.discount_type') }}
                                </label>
                                <select id='discount_type' name="discount_type"
                                    class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5'
                                    disabled>
                                    <option value='default' disabled selected disabled>
                                        {{ __('content.promotion.select_discount_type') }}
                                    </option>
                                    <option value='percentage'
                                        {{ $promotion->discount_type == 'percentage' ? 'selected' : '' }}>
                                        {{ __('content.promotion.percentage') }}</option>
                                    <option value='amount'
                                        {{ $promotion->discount_type == 'amount' ? 'selected' : '' }}>
                                        {{ __('content.promotion.amount') }}</option>
                                </select>
                            </div>

                            <div id='percent_discount'
                                style='{{ $promotion->discount_type == 'percentage' ? 'display: block;' : 'display: none;' }}'>
                                <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                    {{ __('content.promotion.discount_percentage') }}
                                </label>
                                <input type='number' id='discount_percent' name="discount_percentage"
                                    class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5'
                                    placeholder='Enter discount percentage'
                                    value="{{ $promotion->discount_percentage }}" disabled />
                            </div>

                            <div id='amount_discount'
                                style='{{ $promotion->discount_type == 'amount' ? 'display: block;' : 'display: none;' }}'>
                                <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                    {{ __('content.promotion.discount_amount') }}
                                </label>
                                <input type='number' id='discount_amount' name="discount_amount"
                                    class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5'
                                    placeholder='Enter discount amount' value="{{ $promotion->discount_amount }}"
                                    disabled />
                            </div>

                            <div class='sm:col-span-2'>
                                <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                    {{ __('content.promotion.image') }}
                                </label>
                                @if ($promotion->image)
                                    <div class='mt-2'>
                                        <img src="{{ asset('storage/' . $promotion->image) }}" alt="Thumbnail"
                                            class='w-32 h-32 object-cover'>
                                    </div>
                                @else
                                    <div class='mt-2'>
                                        <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/No_Image_Available.jpg"
                                            alt="Thumbnail" class='w-32 h-32 object-cover'>
                                    </div>
                                @endif
                            </div>

                            <!-- {/* Description */} -->
                            <div class='sm:col-span-2'>
                                <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                    {{ __('content.promotion.short_description') }}
                                </label>
                                <input type='text' id='short_description' name="short_description"
                                    class='bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5'
                                    placeholder='Enter short Description' value="{{ $promotion->short_description }}"
                                    disabled />
                            </div>

                            <div class='sm:col-span-2'>
                                <label class='text-base text-gray-500 font-semibold mb-2 block'>
                                    {{ __('content.promotion.long_description') }}
                                </label>
                                <textarea id='long_description' name="long_description"
                                    class='block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500'
                                    placeholder='Your description here' disabled>{{ $promotion->long_description }}</textarea>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </section>
    </div>
</dialog>

<script>
    document.getElementById('discount_type').addEventListener('change', function() {
        const discountType = this.value;
        const percentDiscount = document.getElementById('percent_discount');
        const amountDiscount = document.getElementById('amount_discount');

        if (discountType === 'percentage') {
            percentDiscount.style.display = 'block';
            amountDiscount.style.display = 'none';
        } else if (discountType === 'amount') {
            percentDiscount.style.display = 'none';
            amountDiscount.style.display = 'block';
        } else {
            percentDiscount.style.display = 'none';
            amountDiscount.style.display = 'none';
        }
    });
</script>
