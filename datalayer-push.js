
jQuery(document).ready(function() {
    var elementToLoad = jQuery('#mc_signup'); // Replace 'yourElement' with the ID or selector of the element you want to target

    elementToLoad.on('load', function() {
        jQuery('#mc_signup_form').submit(function() {
            // Prevent the form from submitting
            event.preventDefault();
            console.log(jQuery('#mc_mv_EMAIL'));
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                'event': 'signup_completed',
                'email': jQuery('#mc_mv_EMAIL'),
            });

        });
    });
});
