
function renderSelectedNavItem(selectedNavItem) {
    let navTabs = $('.nav-tab-item');
    let navTabContents = $('.nav-tab-content');
    let selectedNavData = selectedNavItem ? selectedNavItem.data('tab') : '';

    navTabs.each(function() {
        $(this).removeClass('selected');
    });


    navTabContents.each(function() {
        if($(this).data('tab') === selectedNavData) {
            $(this).show();

            return;
        }
        $(this).hide();
    });

    if(!selectedNavData) {
        navTabs.first().addClass('selected');
        navTabContents.first().show();

        return;
    }

    selectedNavItem.addClass('selected');
}

$(document).ready(function() {

    // trigger first rendering onload
    renderSelectedNavItem(null);

    $('.nav-tab-item').on('click', function() {
        renderSelectedNavItem($(this));
    })
});
