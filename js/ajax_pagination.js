elgg.provide('wmp');
elgg.provide('wmp.paginator');

wmp.paginator.init = function() {
    // Code using $ as usual goes here.
    $('a[data-pagination]').live('click touchend launch_apaginator', wmp.paginator.paginate);
}

wmp.paginator.paginate = function(event) {
    var element = $(this);
    var wrapper_element = element.parents('.wmpPaginatorWrapper');

    var hidden_paginator = $(wrapper_element,'.wmpHiddenPaginator');
    var next_item = hidden_paginator.find('.elgg-state-selected').next('li').not('.elgg-state-disabled');

    if (next_item.length == 0) {
        return false;
    }

    wrapper_element.find('.wmpAjaxLoader.hidden').removeClass('hidden');
    element.hide();

    var next_link = $('a', next_item);
    var next_url = next_link.attr('href');

    $.ajax({
        url: next_url,
        success: function(html_data){
            var $new_data = $(html_data);

            var sidebar = $new_data.find('.elgg-sidebar');
            if (sidebar.length > 0) {
                $new_data.find('.elgg-sidebar').remove();
            }

            var listing = $new_data.find('.elgg-list:first');
            var gallery = $new_data.find('.elgg-gallery:first');
            var new_pager = $new_data.find('.wmpPaginatorWrapper');

            if (listing.length > 0) {
                $(wrapper_element).prev('.elgg-layout .elgg-list').append(listing.children());
            }

            if (gallery.length > 0) {
                $(wrapper_element).prev('.elgg-layout .elgg-gallery').append(gallery.children());
            }

            if (new_pager.length > 0) {

                var new_hidden_paginator = new_pager.find('.elgg-state-selected').next('li').not('.elgg-state-disabled');
                if (new_hidden_paginator.length == 0) {
                    $('.wmpPaginatorWrapper').remove();
                } else {
                    $('.wmpPaginatorWrapper').replaceWith(new_pager);
                }
            } else {
                $('.wmpPaginatorWrapper').remove();
            }

        }
    });
}

elgg.register_hook_handler('init', 'system', wmp.paginator.init);
