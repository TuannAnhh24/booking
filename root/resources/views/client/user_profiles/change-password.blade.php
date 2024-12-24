@extends('client.user_profiles.profiles')
@section('proFiles')
    <div class="w-full p-6 bg-white overflow-x-auto">
        <h2 class="text-2xl font-semibold mb-6">{{ __('content.userProfile.change_password') }}</h2>

        <form id="changePasswordForm" method="POST">
            @csrf
            <div class="space-y-6">
                <!-- Current Password -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700">
                        {{ __('content.userProfile.current_password') }}
                    </label>
                    <input type="password" id="current_password" name="current_password" 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" 
                         />
                    <p id="current_password_error" class="mt-2 text-sm text-red-600"></p>
                </div>

                <!-- New Password -->
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700">
                        {{ __('content.userProfile.new_password') }}
                    </label>
                    <input type="password" id="new_password" name="new_password" 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" 
                         />
                    <p id="new_password_error" class="mt-2 text-sm text-red-600"></p>
                </div>

                <!-- Confirm New Password -->
                <div>
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">
                        {{ __('content.userProfile.confirm_new_password') }}
                    </label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" 
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500" 
                         />
                    <p id="new_password_confirmation_error" class="mt-2 text-sm text-red-600"></p>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" 
                        class="w-full py-2 px-4 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ __('content.userProfile.update_password') }}
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#changePasswordForm').on('submit', function(e) {
                e.preventDefault();

                // Reset error messages
                $('#current_password_error').text('');
                $('#new_password_error').text('');
                $('#new_password_confirmation_error').text('');

                // Get form data
                var formData = $(this).serialize();

                // AJAX request
                $.ajax({
                    url: '{{ route('user.changePassword') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            location.reload(); // Reload the page if needed
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;

                        // Handle validation errors
                        if (errors.current_password) {
                            $('#current_password_error').text(errors.current_password[0]);
                        }
                        if (errors.new_password) {
                            $('#new_password_error').text(errors.new_password[0]);
                        }
                        if (errors.new_password_confirmation) {
                            $('#new_password_confirmation_error').text(errors.new_password_confirmation[0]);
                        }
                    }
                });
            });
        });
    </script>
@endsection
