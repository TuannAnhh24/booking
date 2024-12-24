<script>
    const messages = {
        email_required: @json(__('content.validate_login_and_register.email_required')),
        email_check: @json(__('content.validate_login_and_register.email_check')),
        password_required: @json(__('content.validate_login_and_register.password_required')),
        password_min: @json(__('content.validate_login_and_register.password_min')),
        password_comfirm_required: @json(__('content.validate_login_and_register.password_comfirm_required')),
        password_comfirm_check: @json(__('content.validate_login_and_register.password_comfirm_check')),
        termsError: @json(__('content.validate_login_and_register.termsError')),
    };

    const togglePassword = document.querySelector('#togglePassword');
    const toggleConfirmPassword = document.querySelector('#toggleConfirmPassword');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirm-password');

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    toggleConfirmPassword.addEventListener('click', function (e) {
        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPassword.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });

    $(document).ready(function() {
        function validateEmail(email) {
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailPattern.test(email);
    }

    function validatePassword(password) {
        return password.length >= 8;
    }

    function validateForm() {
        var email = $('#email').val().trim();
        var password = $('#password').val().trim();
        var confirmPassword = $('#confirm-password').val().trim();
         var termsAccepted = $('#terms').is(':checked');
        var valid = true;

        $('#emailError').addClass('hidden');
        $('#passwordError').addClass('hidden');
        $('#confirmPasswordError').addClass('hidden');
        $('#termsError').addClass('hidden')

        if (email === '') {
            $('#emailError').text(messages.email_required).removeClass('hidden');
            valid = false;
        } else if (!validateEmail(email)) {
            $('#emailError').text(messages.email_check).removeClass('hidden');
            valid = false; 
        }

        if (password === '') {
            $('#passwordError').text(messages.password_required).removeClass('hidden');
            valid = false; 
        } else if (!validatePassword(password)) {
            $('#passwordError').text(messages.password_min).removeClass('hidden');
            valid = false; 
        }

        if (confirmPassword === '') {
            $('#confirmPasswordError').text(messages.password_comfirm_required).removeClass('hidden');
            valid = false; 
        } else if (password !== confirmPassword) {
            $('#confirmPasswordError').text(messages.password_comfirm_check).removeClass('hidden');
            valid = false; 
        }
        
        if (!termsAccepted) {
            $('#termsError').text(messages.termsError).removeClass('hidden');
            valid = false; 
        }
        return valid; 
    }

    $('input').on('blur', function() {
        var inputId = $(this).attr('id');
        var inputValue = $(this).val().trim();

        if (inputValue === '') {
            if (inputId === 'email') {
                $('#emailError').text(messages.email_required).removeClass('hidden');
            } else if (inputId === 'password') {
                $('#passwordError').text(messages.password_required).removeClass('hidden');
            } else if (inputId === 'confirm-password') {
                $('#confirmPasswordError').text(messages.password_comfirm_required).removeClass('hidden');
            }
        }
    });
    
    $('#terms').change(function() {
        if ($(this).is(':checked')) {
            $('#termsError').addClass('hidden'); 
        }
    });

    $('input').on('input', function() {
        var inputId = $(this).attr('id');
        var inputValue = $(this).val().trim();

        if (inputId === 'email') {
            if (inputValue === '') {
                $('#emailError').text(messages.email_required).removeClass('hidden');
            } else if (!validateEmail(inputValue)) {
                $('#emailError').text(messages.email_check).removeClass('hidden');
            } else {
                $('#emailError').addClass('hidden');
            }
        } else if (inputId === 'password') {
            if (inputValue === '') {
                $('#passwordError').text(messages.password_required).removeClass('hidden');
            } else if (!validatePassword(inputValue)) {
                $('#passwordError').text(messages.password_min).removeClass('hidden');
            } else {
                $('#passwordError').addClass('hidden');
            }
        } else if (inputId === 'confirm-password') {
            if (inputValue === '') {
                $('#confirmPasswordError').text(messages.password_comfirm_required).removeClass('hidden');
            } else if (inputValue !== $('#password').val().trim()) {
                $('#confirmPasswordError').text(messages.password_comfirm_check).removeClass('hidden');
            } else {
                $('#confirmPasswordError').addClass('hidden');
            }
        }
    });

    $('#registrationForm').on('submit', function(event) {
        event.preventDefault(); 
        if (validateForm()) {
            this.submit();
        }
    });
});
</script>