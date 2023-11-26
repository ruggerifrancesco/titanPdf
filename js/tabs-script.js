jQuery(document).ready(function($) {
    // Initial tab setup
    showTab('posts-tab');

    // Tab click event
    $('.nav-tab-wrapper a').on('click', function(e) {
        e.preventDefault();
        var tabId = $(this).data('tab');
        showTab(tabId);
    });

    // Function to show a specific tab
    function showTab(tabId) {
        $('.tab-content').hide();
        $('#' + tabId).show();
        $('.nav-tab').removeClass('nav-tab-active');
        $('.nav-tab[data-tab="' + tabId + '"]').addClass('nav-tab-active');
    }
});
