@if(isset($room))
<div id="modal-id" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg w-1/3 p-6 space-y-4">
        <h2 class="text-lg font-semibold">{{ __('content.manage-room.add_name_room') }}</h2>
        <form id="statusForm" action="{{ route('admin.manage.addNameRoom', ['id' => $room->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="text" id="name_room" name="name_room" class="w-full px-4 py-2 border rounded-lg">
            <div class="flex justify-end space-x-2">
                <button onclick="closeModal('modal-id')" type="button" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">{{ __('content.manage-room.no') }}</button>
                <button type="submit" id="confirmButton" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">{{ __('content.manage-room.yes') }}</button>
            </div>
        </form>
    </div>
</div>
@endif
<script>
    function openModal(modalId, roomId, status) {
        if (roomId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.getElementById('room_id').value = roomId; 
        var form = document.getElementById('statusForm');
        form.action = "{{ url('admin/manage/addNameRoom') }}/" + roomId;
        }
    }
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
