jQuery(document).ready(function ($) {
    // Open modal when clicking on links in row actions
    $('.row-actions .preview_pdf a, .row-actions .edit a, .row-actions .reset_template a, .row-actions .your_custom_option a').on('click', function (e) {
        e.preventDefault();
        // Open your modal here
        alert('Modal should open here');
        // You can replace the alert with your modal opening logic
    });
});