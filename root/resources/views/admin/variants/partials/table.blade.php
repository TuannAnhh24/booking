@foreach ($variants as $variant)
    <tr class="text-gray-700">
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $variant->name }}</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            @if ($variant->images->isNotEmpty())
                @php
                    $image = $variant->images->first();
                @endphp
                <button class="open-modal-btn" data-id="{{ $variant->id }}">
                    <img src="{{ asset('storage/' . $image->image) }}" alt=""
                         class="h-24 w-24 object-cover rounded-md shadow-sm border border-gray-300">
                </button>
            @else
                <p>{{ __('content.variant.no_image') }}</p>
            @endif
        </td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            {{ $variant->description }}</td>
        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
            <button
                class='edit-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-gray-900 transition-all hover:bg-gray-900/10 active:bg-gray-900/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                type='button' title='Edit' data-id='{{ $variant->id }}'>
                <i class="ri-pencil-line text-xl"></i>
            </button>
            <button
                class='delete-button relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg text-center align-middle font-sans text-xs font-medium uppercase text-red-500 transition-all hover:bg-red-500/10 active:bg-red-500/20 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none'
                type='button' title='Delete' data-id='{{ $variant->id }}'>
                <i class="ri-delete-bin-line text-xl"></i>
            </button>
        </td>
    </tr>
@endforeach
