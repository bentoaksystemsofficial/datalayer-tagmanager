jQuery(document).ready(function($) {
    jQuery('#mc_signup_form').submit(function() {
        // Prevent the form from submitting
        event.preventDefault();
        // Log the message to the console
        console.log(jQuery("#mc_mv_EMAIL").val());
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': 'signup_completed',
            'email': jQuery("#mc_mv_EMAIL").val(),
        });
    });
    jQuery('.elementor-element-f304f2c .elementor-form').submit(function() {
        // Prevent the form from submitting
        event.preventDefault();
        // Log the message to the console
        console.log(jQuery("#form-field-email").val());
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': 'contact_form_completed',
            'email': jQuery("#form-field-email").val(),
        });
    });
});

