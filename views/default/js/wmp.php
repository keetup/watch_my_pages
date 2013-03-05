<?php
/**
 * JAVASCRIPT LIBRARY TO HANDLE AJAX PAGINATION
 */
if (FALSE) { ?><script type='text/javascript'><?php }
?>

    elgg.provide('wmp');
    elgg.provide('wmp.paginator');
    elgg.provide('wmp.infinite');
    
    wmp.infinite.enabled = <?php echo json_encode( can_infinitive_scroll() ); ?>

    wmp.paginator.init = function() {
        if (wmp.infinite.enabled) {
            wmp.infinite.enableScroll();
        }

        $('a[data-pagination]').live('click touchend launch_apaginator', wmp.paginator.paginate);

        
    };

    wmp.paginator.paginate = function(event) {
        var element = $(this);
        var wrapper_element = element.parents('.wmpPaginatorWrapper');

        var hidden_paginator = $(wrapper_element, '.wmpHiddenPaginator');
        var next_item = hidden_paginator.find('.elgg-state-selected').next('li').not('.elgg-state-disabled');

        if (next_item.length === 0) {
            return false;
        }

        wrapper_element.find('.wmpAjaxLoader.hidden').removeClass('hidden');
        element.hide();

        var next_link = $('a', next_item);
        var next_url = next_link.attr('href');

        $.ajax({
            url: next_url,
            success: function(html_data) {
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
                    if (new_hidden_paginator.length === 0) {
                        $('.wmpPaginatorWrapper').remove();
                    } else {
                        $('.wmpPaginatorWrapper').replaceWith(new_pager);
                    }
                } else {
                    $('.wmpPaginatorWrapper').remove();
                }

            }
        });
    };

     wmp.infinite.enableScroll = function() {
        //Infinite scroll on pagination
        $(window).scroll(function() {

            var wintop = $(window).scrollTop(), docheight = $(document).height(), winheight = $(window).height();
            var scrolltrigger = 0.95;

            if ((wintop / (docheight - winheight)) > scrolltrigger) {
                
                //Have to check and click
                //We don't want to load scroll when we select order by rating.
                var next_pagination = $('.next_pagination-link');
                var ajax_loader = $('.wmpAjaxLoader:visible');

                if (typeof(next_pagination) !== 'undefined' && typeof(ajax_loader) !== 'undefined') {
                    if (next_pagination.length > 0 && ajax_loader.length === 0) {
                        
                        next_pagination.trigger('launch_apaginator');
                    }
                }
            } //Finish to check the scroll


        });
    };

    elgg.register_hook_handler('init', 'system', wmp.paginator.init);
