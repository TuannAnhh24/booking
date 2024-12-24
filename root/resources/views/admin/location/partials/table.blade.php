@foreach ($locations as $location)
    <tr class="text-gray-700">
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $location->id }}
        </td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $location->code }}
        </td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $location->name }}
        </td>
        <!-- Hiển thị ảnh đại diện -->
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left">
            @if ($location->images->isNotEmpty())
                <img src="{{ asset('storage/' . $location->images->first()->image) }}" alt="Product Image"
                    class="w-auto h-8 mr-3 cursor-pointer" onclick="openImageGalleryModal({{ $location->id }})" />
            @else
                No image!
            @endif
        </td>

        <!-- Modal hiển thị tất cả ảnh với ID và class riêng -->
        <div id="imageGalleryModal-{{ $location->id }}"
            class="image-gallery-modal hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg p-6 w-11/12 md:w-3/4 lg:w-1/2 max-h-screen overflow-auto relative">
                <button class="absolute top-2 right-2 text-red-500 font-bold text-2xl"
                    onclick="closeImageGalleryModal({{ $location->id }})">&times;</button>
                <h2 class="text-lg font-semibold mb-4">Tất cả ảnh</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach ($location->images as $image)
                        <img src="{{ asset('storage/' . $image->image) }}" alt="Image {{ $loop->index + 1 }}"
                            class="w-full h-32 object-cover rounded border shadow-sm" />
                    @endforeach
                </div>
            </div>
        </div>

        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs p-4 max-w-[300px] truncate">
            {{ $location->description }}
        </td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">

            <button
                class='edit-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                title='Edit' type='button' data-id="{{ $location->id }}">
                <i class="ri-pencil-line text-xl"></i>
            </button>

            <button
                class='delete-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-red-400 transition-all hover:bg-red-500/10 active:bg-red-500/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                type="button" title='Delete' data-id="{{ $location->id }}">
                <i class="ri-delete-bin-line text-xl"></i>
            </button>
        </td>
    </tr>
@endforeach
