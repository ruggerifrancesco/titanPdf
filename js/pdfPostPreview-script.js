jQuery(document).ready(function($) {
    // Bind the click event to a parent element that is not dynamically generated
    $(document).on('click', '.preview-pdf', function(e) {
        e.preventDefault();

        var post_id = $(this).data('post-id');
        var post_title = $(this).data('post-title');

        console.log('Post ID:', post_id);
        console.log('Post Title:', post_title);
        console.log('Before AJAX request is sent.');

        // AJAX request
        $.ajax({
            type: 'POST',
            url: ajax_object.ajaxurl,
            data: {
                action: 'custom_generate_pdf',  // Correct AJAX action name
                post_id: post_id,
                post_title: post_title,
            },
            success: function(response) {
                // Open the PDF in a new window or tab
                console.log('AJAX Success:', response);
                window.open(response, '_blank');
            },
            error: function(error) {
                console.error('AJAX Error:', error);
            },
        });

        console.log('AJAX Request complete.');
    });
});
