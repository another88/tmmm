<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * File:     function.access.php
 * Type:     function
 * Name:     access
 * Purpose:  check user access
 * -------------------------------------------------------------
 */
function smarty_function_accessuser($params)
{
    $params['module'] = 'admin';
    $params['controller'] = 'user';
    $params['action'] = 'edit';

    global $access_config;
    $up = $_SESSION['user']['permission'];
    $rule = $access_config[$params['module']]
                          [$params['controller']]
                          [$params['action']];
    $access = FALSE;
    if(count($up) > count($rule) || count($up) == count($rule)) {
        foreach ($up as $v) {
            if(in_array($v, $rule)){
                $access = TRUE; break;
            }
        }
    } else {
        foreach ($rule as $v) {
            if(in_array($v, $up)){
                $access = TRUE; break;
            }
        }
    }
    return $access;
}
?>
