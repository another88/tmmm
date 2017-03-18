<?php
/*
 * Developer Verbovsky Elisey -> elisey.atp@gmail.com
 * This config used by permission model
 * Massive offset  Module/Controller/Action
 * 
 * @param 'defaultAccess' ARRAY - Default access Module/Controller/Action. Also has param 'url' and 'message'
 * @param 'user.edit' string - access service name. Can be multiple! array('user.edit','admin.basic', ...)
 * @param 'url' string - redirect url if user haven`t access
 * @param 'message' string - Message after redirect to user
 */
global $access_config;
$access_config = array(
    'admin' => array(
        'defaultAccess'=>array('admin.basic', 'message'=>'Wrong module'),
        'permission' => array(
            'defaultAccess'=>array('admin.super', 'url'=>'admin/user', 'message'=>'You can`t do that!'), //Default permissios for controller
      //      'edit'=> array('admin.basic', 'url'=>'admin/user', 'message'=>'You haven`t rights to set permissions!'),// Permissions for Action edit
        ),
    ),
    'default' => array(
    )
);
