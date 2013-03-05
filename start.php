<?php

/**
 * Watch my Pages
 * 
 * Add ajax features to native paginator
 *
 * @package WMP
 */

/**
 * Constant to define the default value of infinitive scroll enabled/disabled
 */
define('WMP_CAN_INFINITIVE', TRUE);

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

function can_infinitive_scroll() {
    $default_value = WMP_CAN_INFINITIVE;
    $plugin = elgg_get_plugin_from_id('watch_my_pages');
    
    $infinite_scroll = $plugin->infinite_scroll;
    
    switch ($infinite_scroll) {
        case 'yes':
            return TRUE;
            break;
        
        case 'no':
            return FALSE;
            break;
    }
    
    return $default_value;
}

function wmp_view_paginator_hook($hook, $type, $return, $params) {
    
    $can_infinite = can_infinitive_scroll();
    
    static $infinite_loaded;
    
    //only one paginator with infinite scroll per page, otherwise it will bug
    if ($can_infinite) { 
        if (isset($infinite_loaded) && $infinite_loaded == TRUE) {
            return $return;
        }
    }
    
    if (!empty($return) && !elgg_in_context('admin')) {
        $infinite_loaded = TRUE;
        return elgg_view('wmp/navigation/pagination', array_merge($params, array('hidden_paginator' => $return)));
    }

    return $return;
}