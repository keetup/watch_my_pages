<?php

/**
 * Watch my Pages
 * 
 * Add ajax features to native paginator
 *
 * @package WMP
 */
elgg_register_event_handler('init', 'system', 'wmp_init');

/**
 * Initialize the plugin 
 */
function wmp_init() {
    elgg_register_plugin_hook_handler('view', 'navigation/pagination', 'wmp_view_paginator_hook');
    
    elgg_register_css('wmp', elgg_get_simplecache_url('css', 'wmp'));
    elgg_register_simplecache_view('css/wmp');
    
    elgg_register_js('wmp', elgg_get_simplecache_url('js', 'wmp'));
    elgg_register_simplecache_view('js/wmp');
    
    elgg_load_js('wmp');
    elgg_load_css('wmp');
    
}

function wmp_view_paginator_hook($hook, $type, $return, $params) {
    if (!empty($return) && !elgg_in_context('admin')) {
        return elgg_view('wmp/navigation/pagination', array_merge($params, array('hidden_paginator' => $return)));
    }

    return $return;
}