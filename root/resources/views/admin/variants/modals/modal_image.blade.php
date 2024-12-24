@foreach ($variants as $variant)
    <div id="modal-{{ $variant->id }}"
        class="modal hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div class="bg-white rounded-lg shadow-lg p-6 max-h-[80%] overflow-y-auto w-auto relative">
            <!-- Nút đóng căn góc trên cùng bên phải -->
            <button class="close-modal-btn absolute top-2 right-2 bg-gray-900 text-white px-3 py-1 rounded-full text-lg">
                ✖
            </button>

            <!-- Tiêu đề -->
            <h2 class="text-xl font-bold mb-4 text-center">
                {{ $variant->name }} - {{ __('content.variant.images') }}
            </h2>

            <!-- Lưới ảnh -->
            <div class="grid gap-4" style="grid-template-columns: repeat(3, 1fr); max-width: 90vw;">
                @foreach ($variant->images as $image)
                    <img src="{{ asset('storage/' . $image->image) }}" alt=""
                        class="modal-image h-32 w-32 object-cover rounded-md">
                @endforeach
            </div>
        </div>
    </div>
@endforeach



