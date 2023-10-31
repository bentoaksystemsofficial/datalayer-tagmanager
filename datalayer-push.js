jQuery(document).ready(function($) {
    $('#mc_signup_form').submit(function() {
        // Prevent the form from submitting
        event.preventDefault();
        // Log the message to the console
        console.log('form_submitted');
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': 'signup_completed',
            'email': 'test@test.com',
        });
    });
});

