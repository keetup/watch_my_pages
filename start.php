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
    
    elgg_register_js('wmp.js','mod/watch_my_pages/js/ajax_pagination.js');
    elgg_register_css('wmp.css','mod/watch_my_pages/css/ajax_pagination.css');
    
    elgg_load_css('wmp.css');
    elgg_load_js('wmp.js');
    
}

function wmp_view_paginator_hook($hook, $type, $return, $params) {
    if (!empty($return)) {
        return elgg_view('wmp/navigation/pagination', array_merge($params, array('hidden_paginator' => $return)));
    }
}