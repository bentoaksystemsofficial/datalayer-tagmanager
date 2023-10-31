jQuery(document).ready(function($) {
    $('#mc_signup_form').submit(function() {
        // Prevent the form from submitting
        event.preventDefault();
        // Log the message to the console
        console.log('form_submitted');
        // You can add additional logic here, e.g., send data to the server via AJAX
    });
});
$(document).ready(function() {
    var elementToLoad = $('#mc_signup'); // Replace 'yourElement' with the ID or selector of the element you want to target

    elementToLoad.on('load', function() {
        $('#mc_signup_form').submit(function() {
            // Prevent the form from submitting
            event.preventDefault();
            // Log the message to the console
            console.log('form_submitted');
            // You can add additional logic here, e.g., send data to the server via AJAX
        });
    });
});
