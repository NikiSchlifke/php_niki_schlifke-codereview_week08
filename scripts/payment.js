/**
 * Created by niki on 10.05.17.
 */
$.validator.setDefaults({
    errorElement: "div",
    errorClass: "form-control-feedback",
    highlight: function (element, errorClass, validClass) {
        $(element).closest('.form-group').addClass('has-warning');
    },
    unhighlight: function (element, errorClass, validClass) {
        $(element).closest('.form-group').removeClass('has-warning');
    },
    errorPlacement: function (error, element) {
        if (element.parent('.input-group').length || element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});
$(document).ready(function(){
    $('#payment-form').validate({
        messages: {
            first_name: "Please enter your First Name.",
            last_name: "Please enter your Last Name.",
            e_mail: "Please enter your E-mail address.",
            address: "Please enter the delivery address.",
            card_number: "Please supply a valid credit card number."
        }
    })
});

/**



 **/