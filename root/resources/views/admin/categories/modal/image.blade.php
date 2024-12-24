{{-- Blade Template --}}
@foreach ($categories as $category)
    <div id="modal-{{ $category->id }}" class="modal hidden fixed z-50 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-4xl relative">
                <h2 class="text-2xl font-bold mb-4">{{ $category->name }} - {{ __('content.category.images') }}</h2>
                <div class="grid grid-cols-3 gap-2">
                    @foreach ($category->images as $index => $image)
                        <img src="{{ asset('storage/' . $image->image) }}" alt=""
                            data-modal-id="{{ $category->id }}" data-image-index="{{ $index }}"
                            class="modal-image h-48 w-48 object-cover rounded-md shadow-sm border border-gray-300 cursor-pointer">
                    @endforeach
                </div>
                <button class="close-modal-btn mt-4 bg-gray-900 text-white px-4 py-2 rounded-md">
                    {{ __('content.category.close') }}
                </button>
            </div>
        </div>
    </div>
@endforeach
