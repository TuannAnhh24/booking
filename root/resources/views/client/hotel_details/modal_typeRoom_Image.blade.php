@foreach ($destination->rooms as $room)
    <div id="modal_container_{{ $room->id }}"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        <div class="bg-white w-3/4 max-w-6xl min-h-[500px] max-h-[600px] mx-auto rounded-lg shadow-lg relative overflow-y-auto"
            onclick="event.stopPropagation()">
            <div class="mt-4 flex justify-end">
                <button onclick="dongModal({{ $room->id }})" class="px-4 py-2 rounded-lg text-gray-600 hover:text-blue-500">X</button>
            </div>

            <div class="grid grid-cols-2 gap-4 p-4 relative">
                <!-- Cột 1: Hình ảnh -->
                <div class="relative col-span-1">
                    <div class="p-3 relative">
                        <!-- Nút điều hướng bên trái -->
                        <div class="absolute top-1/2 left-1 transform -translate-y-1/2 bg-white shadow-lg text-blue-300 rounded-full w-10 h-10 text-center cursor-pointer text-3xl"
                            onclick="changeImage({{ $room->id }}, -1)">
                            &#8249;
                        </div>

                        <!-- Ảnh chính -->
                        <img id="mainImage_{{ $room->id }}"
                            src="{{ asset('storage/' . $room->images[0]->image ?? 'default.jpg') }}" alt="Ảnh chính"
                            class="main-image w-full min-h-[340px] max-h-[340px] h-full object-cover rounded-lg cursor-pointer transition-transform duration-300 ease-in-out" />

                        <!-- Nút điều hướng bên phải -->
                        <div class="absolute top-1/2 right-2 transform -translate-y-1/2 bg-white shadow-lg text-blue-300 rounded-full w-10 h-10 text-center cursor-pointer text-3xl"
                            onclick="changeImage({{ $room->id }}, 1)">
                            &#8250;
                        </div>
                    </div>

                    <!-- Các ảnh nhỏ -->
                    <div class="flex flex-wrap gap-2 justify-start">
                        @foreach ($room->images as $index => $image)
                            <img src="{{ asset('storage/' . $image->image) }}" alt="Ảnh nhỏ {{ $index + 1 }}"
                                class="small-image object-cover rounded-lg cursor-pointer transition-transform duration-300 ease-in-out hover:scale-110 hover:border-2 hover:border-blue-500 hover:opacity-50 small-image"
                                onclick="setMainImage({{ $room->id }}, {{ $index }})"
                                onmouseover="setMainImage({{ $room->id }}, {{ $index }})" />
                        @endforeach
                    </div>
                </div>

                <!-- Cột 2: Text -->
                <div class="w-full pl-4 space-y-3 col-span-1">
                    <h2 class="text-2xl font-semibold mb-4">{{ $room->name }}</h2>
                    <span>{{ $room->description }}</span>
                </div>
            </div>
        </div>
    </div>
@endforeach
