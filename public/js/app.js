// Convert given form into ajax form
function handleForm(formId) {
    $(formId).on('submit', function (e) {
        e.preventDefault();

        var $form = $(this);
        var $action = $form.attr('action');
        var $data = $form.serialize();

        $.ajax({
            url: $action,
            method: 'POST',
            dataType: 'JSON',
            data: $data,
            success: function (data) {
                if (data.success) {
                    document.location.reload(true);
                }
            },
            error: function (err) {
                var errors = err.responseJSON.errors;

                for (var field in errors) {
                    if (errors.hasOwnProperty(field)) {
                        var $field = $form.find('input[type=' + field + ']');
                        $field.addClass('is-invalid');
                        $field.siblings('.invalid-feedback').find('strong').text(errors[field])
                    }
                }
            }
        });
    });
}

handleForm('#login-form');
handleForm('#register-form');

// Check if the email exists on the fly
$('#register-form input[type=email]').keyup(function () {
    var $email = $(this);
    var $token = $('input[name=_token]').val();

    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($email.val())) {
        $.ajax({
            url: '/check-email',
            method: 'POST',
            dataType: 'JSON',
            data: {
                _token: $token,
                email: $email.val()
            },
            success: function (data) {
                if (data.success) {
                    $email.addClass('is-invalid');
                    $email.siblings('.invalid-feedback').find('strong').text(data.message);
                } else {
                    $email.removeClass('is-invalid');
                    $email.siblings('.invalid-feedback').find('strong').text();
                }
            },
            error: function (err) {}
        });
    }
});
