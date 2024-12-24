@if(isset($booking))
<div id="modal-id" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg w-1/3 p-6 space-y-4">
        <h2 class="text-lg font-semibold">{{ __('content.manage-booking.change_status') }}</h2>
        <p class="text-gray-600">{{ __('content.manage-booking.new_status') }}</p>
        <form id="statusForm" action="{{ route('admin.manage.updateStatus', ['id' => $booking->id]) }}" enctype="multipart/form-data" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" id="booking_id" name="booking_id" value="{{ $booking->id }}">
            <select id="status" name="status" class="w-full px-4 py-2 border rounded-lg">
                <option value="active">{{ __('content.manage-booking.active') }}</option>
                <option value="completed">{{ __('content.manage-booking.completed') }}</option>
                <option value="canceled">{{ __('content.manage-booking.canceled') }}</option>
            </select>
            <div class="flex justify-end space-x-2">
                <button onclick="closeModal('modal-id')" type="button" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">{{ __('content.manage-booking.no') }}</button>
                <button type="submit" id="confirmButton" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">{{ __('content.manage-booking.yes') }}</button>
            </div>
        </form>
    </div>
</div>
@endif
<script>
    function openModal(modalId, bookingId, status) {
        if (bookingId) {
        document.getElementById(modalId).classList.remove('hidden');
        document.getElementById('booking_id').value = bookingId; 
        document.getElementById('status').value = status;
        var form = document.getElementById('statusForm');
        form.action = "{{ url('admin/manage/updateStatus') }}/" + bookingId;
        }
    }
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }
</script>
