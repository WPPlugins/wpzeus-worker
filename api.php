<?php
/*************************************************************
 * 
 * api.php
 * 
 * addons api
 * 
 * Copyright (c) 2011 Loophole Studios
 * www.loopholestudios.co.uk
 **************************************************************/

function mmb_add_action($action = false, $callback = false)
{
    if (!$action || !$callback)
        return false;
    
    global $mmb_actions;
    mmb_function_exists($callback);
    
    if (isset($mmb_actions[$action]))
        wp_die('Cannot redeclare WPZeus action "' . $action . '".');
    
    $mmb_actions[$action] = $callback;
}

function mmb_function_exists($callback)
{
    global $mwp_core;
    if (count($callback) === 2) {
        if (!method_exists($callback[0], $callback[1]))
            wp_die($mwp_core->mwp_dashboard_widget('Information', '', '<p>Class ' . get_class($callback[0]) . ' does not contain <b>"' . $callback[1] . '"</b> function</p>', '', '50%'));
    } else {
        if (!function_exists($callback))
            wp_die($mwp_core->mwp_dashboard_widget('Information', '', '<p>Function <b>"' . $callback . '"</b> does not exists.</p>', '', '50%'));
    }
}

?>