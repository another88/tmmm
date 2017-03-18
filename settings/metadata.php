<?php

global $metadata;
$metadata = array(
    'user' => array(
        'title' => 'user',
        'name' => 'user',
        'fields' => array(
            'userId' => array('title'=> 'Primary Key', 'type'=> 'pk', 'showInListing' => '3'),
            'firstName' => array('title'=> 'Имя', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'lastName' => array('title'=> 'Фамилия', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'country' => array('title'=> 'Страна', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'city' => array('title'=> 'Город', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'phone' => array('title'=> 'Телефон', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'email' => array('title'=> 'email', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'vklink' => array('title'=> 'vklink', 'type'=> 'string', 'showInListing' => '3','default'=>''),
            'secrethash' => array('title'=> 'secrethash', 'type'=> 'string', 'showInListing' => '0','default'=>''),
            'password' => array('title'=> 'password', 'type'=> 'string', 'showInListing' => ''),
            'isAdmin' => array('title'=> 'isAdmin', 'type'=> 'int', 'default'=>0),
            'dateAdded' => array('title'=> 'dateAdded', 'type'=> 'date', 'validate' => 'require', 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1',
        'view' => '1'
    ),
    'permission_group' => array (
        'title' => 'permission_group',
        'name' => 'permission_group',
        'fields' => array (
            'permission_groupId' => array ('title' => 'Id','type' => 'pk','validate' => 'require',),
            'title' => array ('title' => 'title', 'type' => 'string', 'showInListing'=>3, 'validate' => 'require',),
            'description' => array ('title' => 'description','type' => 'textarea','showInListing'=>3 , 'default'=>''),
            'deleted' => array ('title' => 'delete','type' => 'int','default' => '0', 'showInListing'=>1),
        ),
    ),
    'permission_group_user' => array(
        'title' => 'permission_group_user',
        'name' => 'permission_group_user', 
        'fields' => array(
            'permission_group_userId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'userId' => array('title'=> 'user', 'type'=> 'int', 'validate' => 'require', 'showInListing'=>3),
            'permission_groupId' => array('title'=> 'permission group', 'type'=> 'int', 'validate' => 'require', 'showInListing'=>3),
            'dateAdded' => array('title'=> 'date Added', 'type'=> 'date', 'validate' => 'require', 'showInListing'=>3),
            'deleted' => array('title'=> 'delete', 'type'=> 'int', 'default' => '0', 'validate' => 'require', 'showInListing'=>3),
        )
    ),
    'permission_group_object' => array(
        'title' => 'permission_group_object',
        'name' => 'permission_group_object', 
        'fields' => array(
            'permission_group_objectId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'permission_groupId' => array('title'=> 'Группа доступа', 'type'=> 'int', 'default' => '0', 'validate' => 'require', 'showInListing'=>3),
            'permission_objectId' => array('title'=> 'Объект доступа', 'type'=> 'int', 'default' => '0', 'validate' => 'require', 'showInListing'=>3),
            'deleted' => array('title'=> 'delete', 'type'=> 'int', 'default' => '0', 'showInListing'=>3),
        )
    ),
    'permission_object' => array(
        'title' => 'permission_object',
        'name' => 'permission_object', 
        'fields' => array(
            'permission_objectId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'code' => array('title'=> 'code', 'type'=> 'string', 'validate' => 'require','showInListing'=>3),
            'description' => array('title'=> 'description', 'type'=> 'textarea','showInListing'=>3, 'default'=>''),
            'deleted' => array('title'=> 'delete', 'type'=> 'int', 'default' => '0', 'showInListing'=>1),
        )
    ),
    'content' => array(
        'title' => 'content',
        'name' => 'content',
        'fields' => array(
            'contentId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Название', 'type'=> 'string', 'showInListing' => '3', 'validate' => 'require'),
            'url' => array('title'=> 'url', 'type'=> 'string', 'showInListing' => '3', 'validate' => 'require', 'uniq'=>1),
            'description' => array('title'=> 'Текст', 'type'=> 'text', 'showInListing' => '3', 'validate' => 'require'),  
            'shortDescription' => array('title'=> 'Короткий Текст', 'type'=> 'text', 'showInListing' => '2', 'default'=>''),
            'imageOriginal' => array(
                'title'=> 'imageOriginal',
                'type'=> 'image',
                'showInListing'=>3,
                'default'=>'',
                'imagesDir'=>'images/content/',
                'size'=>array(
                    'imageOriginal'=>'1024x1024',
                    'imageMedium'=>'205x205',
                    'imageSmall'=>'60x60'
                    ),
                'cropSmart'=>FALSE
                ),            
            'imageSmall' => array('title' => 'imageSmall','type' => 'string', 'default'=>''),            
            'imageMedium' => array('title'=> 'imageMedium', 'type'=> 'string', 'default'=>''),        
            'metaTitle' => array('title'=> 'metaTitle', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'metaDescription' => array('title'=> 'metaDescription', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'metaKeywords' => array('title'=> 'metaKeywords', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'isInteresting' => array('title'=> 'Интересное', 'type'=> 'active','default'=>0, 'showInListing' => '3'),
            'veiwCount' => array('title'=> 'Просмторов', 'type'=> 'int','default'=>0, 'showInListing' => '1'),
            'deleted' => array('title'=> 'Удалить', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1',
        'view' => '1'
    ),
//    'slider' => array(
//        'title' => 'slider',
//        'name' => 'slider',
//        'fields' => array(
//            'sliderId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
//            'title' => array('title'=> 'title', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
//            'url' => array('title'=> 'url', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
//            'imageOriginal' => array(
//                'title'=> 'imageOriginal',
//                'type'=> 'image',
//                'validate' => 'require',
//                'showInListing'=>3,
//                'imagesDir'=>'images/slider/',
//                'size'=>array(
//                    'imageOriginal'=>'1024x768',
//                    'imageMedium'=>'990x300',
//                    'imageSmall'=>'60x30'
//                    ),
//                'cropSmart'=>FALSE
//                ),            
//            'imageSmall' => array('title' => 'imageSmall','type' => 'string'),            
//            'imageMedium' => array('title'=> 'imageMedium', 'type'=> 'string'),  
//            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
//            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
//        ),
//        'edit' => '1',
//        'add' => '1',
//        'view' => '1'
//    ),
//    'callorder' => array(
//        'title' => 'callorder',
//        'name' => 'callorder',
//        'fields' => array(
//            'callOrderId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
//            'name' => array('title'=> 'name', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
//            'email' => array('title'=> 'email', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
//            'phone' => array('title'=> 'phone', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
//            'dateAdded' => array('title'=> 'dateAdded', 'type'=> 'date', 'validate' => 'require', 'showInListing' => '3'),
//            'completed' => array('title'=> 'completed', 'type'=> 'active','default'=>0, 'showInListing' => '3'),
//            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
//        ),
//        'view' => '1'
//    ),     
    'productcategory' => array(
        'title' => 'productcategory',
        'name' => 'productcategory',
        'fields' => array(
            'productCategoryId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Название', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'url' => array('title'=> 'url', 'type'=> 'string', 'showInListing' => '3', 'validate' => 'require', 'uniq'=>1),
            'pageTitle' => array('title'=> 'Название на страницу', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'description' => array('title'=> 'Описание', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '3'),
            'metaTitle' => array('title'=> 'metaTitle', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'metaDescription' => array('title'=> 'metaDescription', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'metaKeywords' => array('title'=> 'metaKeywords', 'type'=> 'string', 'showInListing' => '2','default'=>''),            
            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1',
        'view' => '1'
    ),    
    'product' => array(
        'title' => 'product',
        'name' => 'product',
        'fields' => array(
            'productId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Название', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'url' => array('title'=> 'url', 'type'=> 'string', 'showInListing' => '3', 'validate' => 'require', 'uniq'=>1),
            'productCategoryId' => array('title'=> 'Категория', 'type'=> 'select', 'table'=>'productcategory', 'validate' => 'require', 'showInListing' => '3'),
//            'shortDescription' => array('title'=> 'Короткое описание', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '2'),
            'description' => array('title'=> 'Описание', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '2'),
            'imageOriginal' => array(
                'title'=> 'Картинка',
                'type'=> 'image',
                'validate' => 'require',
                'showInListing'=>3,
                'imagesDir'=>'images/product/',
                'size'=>array(
                    'imageOriginal'=>'480x840',
                    'imageBig'=>'240x420',
                    'imageMedium'=>'120x210',
                    'imageSmall'=>'60x105'
                    ),
                'cropSmart'=>FALSE
                ),            
            'imageSmall' => array('title' => 'imageSmall','type' => 'string'),            
            'imageMedium' => array('title'=> 'imageMedium', 'type'=> 'string'),  
            'imageBig' => array('title'=> 'imageBig', 'type'=> 'string'),  
            'price' => array('title'=> 'Цена', 'type'=> 'double', 'default' => '0', 'validate' => 'require', 'showInListing' => '3', 'quickChange'=>1),
            'metaTitle' => array('title'=> 'metaTitle', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'metaDescription' => array('title'=> 'metaDescription', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'metaKeywords' => array('title'=> 'metaKeywords', 'type'=> 'string', 'showInListing' => '2','default'=>''),            
            'rate' => array('title'=> 'Рейтинг', 'type'=> 'int','default'=>0, 'showInListing' => '1', 'quickChange'=>1),
            'viewCount' => array('title'=> 'Просмотров', 'type'=> 'int','default'=>0, 'showInListing' => '1'),
            'buyCount' => array('title'=> 'Куплено', 'type'=> 'int','default'=>0, 'showInListing' => '1'),
            'inMain' => array('title'=> 'Главная', 'type'=> 'active','default'=>0, 'showInListing' => '3'),
            'inLike' => array('title'=> 'Справа', 'type'=> 'active','default'=>0, 'showInListing' => '3'),
            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1',
        'view' => '1',
        'additionalFields'=>array(
            array('title'=>'Карт.', 'link'=>'admin/product/image/id/', 'inner'=>'<img src="icon/images.png" />'),
            array('title'=>'Комм.', 'link'=>'admin/product/comment/id/', 'inner'=>'<img src="icon/comment.png" />')
        ),      
    ),    
    'productimage' => array(
        'title' => 'productimage',
        'name' => 'productimage',
        'fields' => array(
            'productImageId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'productId' => array('title'=> 'productId', 'type'=> 'int', 'validate' => 'require', 'showInListing' => ''),
            'imageSmall' => array('title'=> 'imageSmall', 'type'=> 'string', 'validate' => 'require', 'showInListing' => ''),
            'imageMedium' => array('title'=> 'imageMedium', 'type'=> 'string', 'validate' => 'require', 'showInListing' => ''),
            'imageBig' => array('title'=> 'imageBig', 'type'=> 'string', 'validate' => 'require', 'showInListing' => ''),
            'imageOriginal' => array('title'=> 'imageOriginal', 'type'=> 'string', 'validate' => 'require', 'showInListing' => ''),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0),
        ),
        'edit' => '1',
        'add' => '1',
        'view' => '1'
    ),        
    'buyonclick' => array(
        'title' => 'buyonclick',
        'name' => 'buyonclick',
        'fields' => array(
            'buyOnClickId' => array('title'=> 'ID', 'type'=> 'pk', 'showInListing' => '3'),
            'productId' => array('title'=> 'Товар', 'type'=> 'select','table'=>'product', 'validate' => 'require', 'showInListing' => '3'),
            'userId' => array('title'=> 'Пользователь', 'type'=> 'select', 'table'=>'user', 'showInListing' => '3', 'default' => '0'),
            'name' => array('title'=> 'Имя', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'email' => array('title'=> 'email', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'phone' => array('title'=> 'Телефон', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'city' => array('title'=> 'Город', 'type'=> 'string', 'showInListing' => '3', 'default' => ''),
            'price' => array('title'=> 'Цена', 'type'=> 'double', 'default' => '0', 'validate' => 'require', 'showInListing' => '3'),
            'deliveryType' => array('title' => 'Доставка','type' => 'select','showInListing'=>'3',
                    'values'=>array(
                        'samo'=>'Самовывоз',
                        'company'=>'Транспортной'
                    ), 'default'=>'samo'
            ),        
            'emailOpen' => array('title' => 'Статус письма','type' => 'select','showInListing'=>'3',
                    'values'=>array(
                        '0'=>'Не просмотренно',
                        '1'=>'Просмотренно'
                    ), 'default'=>'0'
            ),               
            'dateAdded' => array('title'=> 'Дата', 'type'=> 'date', 'validate' => 'require', 'showInListing' => '3'),
            'completed' => array('title'=> 'Зав.', 'type'=> 'active', 'default' => '0', 'validate' => 'require', 'showInListing' => '3'),
            'deleted' => array('title'=> 'Удал.', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'view' => '1'
    ),    
    'setting' => array(
        'title' => 'setting',
        'name' => 'setting',
        'fields' => array(
            'settingId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Название', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'value' => array('title'=> 'Значение', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'code' => array('title'=> 'Код', 'type'=> 'string', 'uniq'=>1, 'validate' => 'require', 'showInListing' => '3'),
            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1',
    ),    
//    'productcomment' => array(
//        'title' => 'productcomment',
//        'name' => 'productcomment',
//        'fields' => array(
//            'productCommentId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
//            'productId' => array('title'=> 'productId', 'type'=> 'int', 'default' => '0', 'validate' => 'require'),
//            'rate' => array('title'=> 'rate', 'type'=> 'int', 'default' => '0', 'validate' => 'require', 'showInListing' => '3'),
//            'userId' => array('title'=> 'userId', 'type'=> 'int', 'default' => '0', 'validate' => 'require', 'showInListing' => '3'),
//            'name' => array('title'=> 'name', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
//            'comment' => array('title'=> 'comment', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '3'),
//            'dateAdded' => array('title'=> 'dateAdded', 'type'=> 'date', 'validate' => 'require', 'showInListing' => '3'),
//            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>0, 'showInListing' => '3'),
//            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
//        ),
//        'view' => '1'
//    ),    
    'meta' => array(
        'title' => 'meta',
        'name' => 'meta',
        'fields' => array(
            'metaId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'title', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'code' => array('title'=> 'code', 'type'=> 'string', 'uniq'=>1, 'validate' => 'require', 'showInListing' => '3'),
            'metaTitle' => array('title'=> 'metaTitle', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'metaDescription' => array('title'=> 'metaDescription', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'metaKeywords' => array('title'=> 'metaKeywords', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1',
        'view' => '1'
    ),    
    'feedback' => array(
        'title' => 'feedback',
        'name' => 'feedback',
        'fields' => array(
            'feedbackId' => array('title'=> 'ID', 'type'=> 'pk', 'showInListing' => '1'),
            'name' => array('title'=> 'Имя', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'email' => array('title'=> 'email', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'comment' => array('title'=> 'Комментарий', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '3'),
            'dateAdded' => array('title'=> 'Дата', 'type'=> 'date', 'validate' => 'require', 'showInListing' => '3'),
            'approved' => array('title'=> 'Зав.', 'type'=> 'active','default'=>0, 'showInListing' => '3'),
            'deleted' => array('title'=> 'Удал.', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'view' => '1'
    ),    
    'order' => array(
        'title' => 'order',
        'name' => 'order',
        'fields' => array(
            'orderId' => array('title'=> 'ID', 'type'=> 'pk', 'showInListing' => '1'),
            'userId' => array('title'=> 'Пользователь', 'type'=> 'select', 'table'=>'user', 'showInListing' => '2','default'=>0),
            'firstName' => array('title'=> 'Имя', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'lastName' => array('title'=> 'Фамилия', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'country' => array('title'=> 'Страна', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'city' => array('title'=> 'Город', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'phone' => array('title'=> 'Телефон', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'email' => array('title'=> 'email', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'deliveryType' => array('title' => 'Доставка','type' => 'select','showInListing'=>'3',
                    'values'=>array(
                        'samo'=>'Самовывоз',
                        'company'=>'Транспортной'
                    ), 'default'=>'samo'
            ),        
            'emailOpen' => array('title' => 'Статус письма','type' => 'select','showInListing'=>'3',
                    'values'=>array(
                        '0'=>'Не просмотренно',
                        '1'=>'Просмотренно'
                    ), 'default'=>'0'
            ),              
            'comment' => array('title'=> 'Коммент', 'type'=> 'text', 'showInListing' => '2'),
            'adminComment' => array('title'=> 'Ком. Адм.', 'type'=> 'text', 'showInListing' => '3'),
            'dateAdded' => array('title'=> 'Дата', 'type'=> 'date', 'validate' => 'require', 'showInListing' => '3'),
            'price' => array('title'=> 'Цена', 'type'=> 'double', 'validate' => 'require', 'showInListing' => '3'),
            'discount' => array('title'=> 'Скидка', 'type'=> 'double', 'showInListing' => '3','default'=>0),
            'isHaveConstructor' => array('title'=> 'isHaveConstructor', 'type'=> 'int','default'=>0),
            'approved' => array('title'=> 'Зав.', 'type'=> 'active','default'=>0, 'showInListing' => '3'),
            'deleted' => array('title'=> 'Удал.', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'additionalFields'=>array(
            array('title'=>'Дет.', 'link'=>'admin/order/details/id/', 'inner'=>'<img src="icon/view.png" />'),
        ),
    ),    
    'orderproduct' => array(
        'title' => 'orderproduct',
        'name' => 'orderproduct',
        'fields' => array(
            'orderProductId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'orderId' => array('title'=> 'orderId', 'type'=> 'int', 'validate' => 'require', 'showInListing' => ''),
            'productId' => array('title'=> 'productId', 'type'=> 'int', 'validate' => 'require', 'showInListing' => ''),
            'price' => array('title'=> 'price', 'type'=> 'double', 'validate' => 'require', 'showInListing' => ''),
            'totalPrice' => array('title'=> 'totalPrice', 'type'=> 'double', 'validate' => 'require', 'showInListing' => ''),
            'amount' => array('title'=> 'amount', 'type'=> 'int', 'default' => '0', 'validate' => 'require', 'showInListing' => ''),
            'consBludceId' => array('title'=> 'consBludceId', 'type'=> 'int', 'default' => '0'),
            'consBowlId' => array('title'=> 'consBowlId', 'type'=> 'int', 'default' => '0'),
            'consKolbaId' => array('title'=> 'consKolbaId', 'type'=> 'int', 'default' => '0'),
            'consTrybkaId' => array('title'=> 'consTrybkaId', 'type'=> 'int', 'default' => '0'),
            'consShaxtaId' => array('title'=> 'consShaxtaId', 'type'=> 'int', 'default' => '0'),
            'consShipciId' => array('title'=> 'consShipciId', 'type'=> 'int', 'default' => '0'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0),
        ),
        'edit' => '1',
        'add' => '1',
        'view' => '1'
    ),    
    'special' => array(
        'title' => 'special',
        'name' => 'special',
        'fields' => array(
            'specialId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'title', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'description' => array('title'=> 'description', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '3'),
            'imageOriginal' => array(
                'title'=> 'imageOriginal',
                'type'=> 'image',
                'validate' => 'require',
                'showInListing'=>3,
                'imagesDir'=>'images/special/',
                'size'=>array(
                    'imageOriginal'=>'1024x1024',
                    'imageMedium'=>'205x205',
                    'imageSmall'=>'60x60'
                    ),
                'cropSmart'=>FALSE
                ),            
            'imageSmall' => array('title' => 'imageSmall','type' => 'string'),            
            'imageMedium' => array('title'=> 'imageMedium', 'type'=> 'string'),
            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>0, 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1',
        'view' => '1'
    ),    
    'consbludce' => array(
        'title' => 'consbludce',
        'name' => 'consbludce',
        'fields' => array(
            'consBludceId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Название', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'description' => array('title'=> 'Описание', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '2'),
            'price' => array('title'=> 'Цена', 'type'=> 'double', 'validate' => 'require', 'showInListing' => '3', 'quickChange'=>1),
            'imageOriginal' => array(
                'title'=> 'Картинка',
                'type'=> 'image',
                'validate' => 'require',
                'showInListing'=>3,
                'imagesDir'=>'images/consbludce/',
                'size'=>array(
                    'imageOriginal'=>'1024x1024',
                    'imageSmall'=>'150x150'
                    ),
                'cropSmart'=>FALSE
                ),            
            'imageSmall' => array('title' => 'imageSmall','type' => 'string'),   
            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1'
    ),  
    'consbowl' => array(
        'title' => 'consbowl',
        'name' => 'consbowl',
        'fields' => array(
            'consBowlId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'title', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'description' => array('title'=> 'description', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '2'),
            'price' => array('title'=> 'price', 'type'=> 'double', 'validate' => 'require', 'showInListing' => '3', 'quickChange'=>1),
            'imageOriginal' => array(
                'title'=> 'imageOriginal',
                'type'=> 'image',
                'validate' => 'require',
                'showInListing'=>3,
                'imagesDir'=>'images/consbowl/',
                'size'=>array(
                    'imageOriginal'=>'1024x1024',
                    'imageSmall'=>'150x150'
                    ),
                'cropSmart'=>FALSE
                ),            
            'imageSmall' => array('title' => 'imageSmall','type' => 'string'),   
            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1'
    ),     
    'conskolba' => array(
        'title' => 'conskolba',
        'name' => 'conskolba',
        'fields' => array(
            'consKolbaId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'title', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'description' => array('title'=> 'description', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '2'),
            'price' => array('title'=> 'price', 'type'=> 'double', 'validate' => 'require', 'showInListing' => '3', 'quickChange'=>1),
            'imageOriginal' => array(
                'title'=> 'imageOriginal',
                'type'=> 'image',
                'validate' => 'require',
                'showInListing'=>3,
                'imagesDir'=>'images/conskolba/',
                'size'=>array(
                    'imageOriginal'=>'1024x1024',
                    'imageSmall'=>'240x240'
                    ),
                'cropSmart'=>FALSE
                ),            
            'imageSmall' => array('title' => 'imageSmall','type' => 'string'),   
            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1'
    ),       
    'consshaxta' => array(
        'title' => 'consshaxta',
        'name' => 'consshaxta',
        'fields' => array(
            'consShaxtaId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'title', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'description' => array('title'=> 'description', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '2'),
            'price' => array('title'=> 'price', 'type'=> 'double', 'validate' => 'require', 'showInListing' => '3', 'quickChange'=>1),
            'imageOriginal' => array(
                'title'=> 'imageOriginal',
                'type'=> 'image',
                'validate' => 'require',
                'showInListing'=>3,
                'imagesDir'=>'images/consshaxta/',
                'size'=>array(
                    'imageOriginal'=>'1024x1024',
                    'imageSmall'=>'240x420'
                    ),
                'cropSmart'=>FALSE
                ),            
            'imageSmall' => array('title' => 'imageSmall','type' => 'string'),   
            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1'
    ),
    'consshipci' => array(
        'title' => 'consshipci',
        'name' => 'consshipci',
        'fields' => array(
            'consShipciId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'title', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'description' => array('title'=> 'description', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '2'),
            'price' => array('title'=> 'price', 'type'=> 'double', 'validate' => 'require', 'showInListing' => '3', 'quickChange'=>1),
            'imageOriginal' => array(
                'title'=> 'imageOriginal',
                'type'=> 'image',
                'validate' => 'require',
                'showInListing'=>3,
                'imagesDir'=>'images/consshipci/',
                'size'=>array(
                    'imageOriginal'=>'1024x1024',
                    'imageSmall'=>'150x150'
                    ),
                'cropSmart'=>FALSE
                ),            
            'imageSmall' => array('title' => 'imageSmall','type' => 'string'),   
            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1'
    ),  
    'constrybka' => array(
        'title' => 'constrybka',
        'name' => 'constrybka',
        'fields' => array(
            'consTrybkaId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'title', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'description' => array('title'=> 'description', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '2'),
            'price' => array('title'=> 'price', 'type'=> 'double', 'validate' => 'require', 'showInListing' => '3', 'quickChange'=>1),
            'imageOriginal' => array(
                'title'=> 'imageOriginal',
                'type'=> 'image',
                'validate' => 'require',
                'showInListing'=>3,
                'imagesDir'=>'images/constrybka/',
                'size'=>array(
                    'imageOriginal'=>'1024x1024',
                    'imageSmall'=>'319x319'
                    ),
                'cropSmart'=>FALSE
                ),            
            'imageSmall' => array('title' => 'imageSmall','type' => 'string'),   
            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1'
    ),   
    'constructor' => array(
        'title' => 'constructor',
        'name' => 'constructor',
        'fields' => array(
            'constructorId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'bludceId' => array('title'=> 'Блюдце', 'type'=> 'select', 'table'=>'consbludce', 'default' => '0', 'validate' => 'require', 'showInListing' => '3'),
            'bowlId' => array('title'=> 'Чаша', 'type'=> 'select', 'table'=>'consbowl', 'default' => '0', 'validate' => 'require', 'showInListing' => '3'),
            'kolbaId' => array('title'=> 'Колба', 'type'=> 'select', 'table'=>'conskolba', 'default' => '0', 'validate' => 'require', 'showInListing' => '3'),
            'trybkaId' => array('title'=> 'Трубка', 'type'=> 'select', 'table'=>'constrybka', 'default' => '0', 'validate' => 'require', 'showInListing' => '3'),
            'shaxtaId' => array('title'=> 'Шахта', 'type'=> 'select', 'table'=>'consshaxta', 'default' => '0', 'validate' => 'require', 'showInListing' => '3'),
            'shipciId' => array('title'=> 'Щипцы', 'type'=> 'select', 'table'=>'consshipci', 'default' => '0', 'validate' => 'require', 'showInListing' => '3'),
            'author' => array('title'=> 'Автор', 'type'=> 'string', 'default' => '0', 'validate' => 'require', 'showInListing' => '3'),
            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1'
    ),
    'ourwork' => array(
        'title' => 'ourwork',
        'name' => 'ourwork',
        'fields' => array(
            'ourWorkId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Название', 'type'=> 'string', 'showInListing' => '3'),
            'description' => array('title'=> 'Описание', 'type'=> 'text', 'showInListing' => '2', 'default'=>''),
            'likeCount' => array('title'=> 'Like', 'type'=> 'int', 'default'=>0, 'showInListing' => '1'),
            'approved' => array('title'=> 'Актив.', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'Удалить', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1',
        'additionalFields'=>array(
            array('title'=>'Image', 'link'=>'admin/ourwork/image/id/', 'inner'=>'<img src="icon/images.png" />'),
        ), 
    ),    
    'ourworkimage' => array(
        'title' => 'ourworkimage',
        'name' => 'ourworkimage',
        'fields' => array(
            'ourWorkImageId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'ourWorkId' => array('title'=> 'ourWorkId', 'type'=> 'int', 'validate' => 'require', 'showInListing' => ''),
            'imageSmall' => array('title'=> 'imageSmall', 'type'=> 'string', 'validate' => 'require', 'showInListing' => ''),
            'imageMedium' => array('title'=> 'imageMedium', 'type'=> 'string', 'validate' => 'require', 'showInListing' => ''),
            'imageOriginal' => array('title'=> 'imageOriginal', 'type'=> 'string', 'validate' => 'require', 'showInListing' => ''),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0),
        ),
        'edit' => '1',
        'add' => '1',
        'view' => '1'
    ),     
    'mix' => array(
        'title' => 'mix',
        'name' => 'mix',
        'fields' => array(
            'mixId' => array('title'=> 'ID', 'type'=> 'pk', 'showInListing' => '1'),
            'title' => array('title'=> 'Название', 'type'=> 'string', 'showInListing' => '3','default'=>''),
            'description' => array('title'=> 'Описание', 'type'=> 'text', 'showInListing' => '3','default'=>''),
            'waterDescription' => array('title'=> 'В колбу', 'type'=> 'text', 'showInListing' => '3','default'=>''),
            'author' => array('title'=> 'Автор', 'type'=> 'string', 'showInListing' => '3','default'=>''),
            'authorId' => array('title'=> 'Автор ID', 'type'=> 'select', 'table'=>'user', 'default' => '0', 'showInListing' => '3'),
            'mixCode' => array('title'=> 'mixCode', 'type'=> 'string'),
            'saved' => array('title'=> 'saved', 'type'=> 'int','default'=>0),
            'approved' => array('title'=> 'Зав.', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'Удал.', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
//        'edit' => '1',
//        'add' => '1'
    ),     
    'tabac' => array(
        'title' => 'tabac',
        'name' => 'tabac',
        'fields' => array(
            'tabacId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Название', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'tabacCategoryId' => array('title'=> 'Марка', 'type'=> 'select', 'table'=>'tabaccategory','validate' => 'require', 'showInListing' => '3', 'mainSelect'=>1),
            'colorCode' => array('title'=> 'color', 'type'=> 'color', 'validate' => 'require', 'showInListing' => '3'),
            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1'
    ),    
    'tabaccategory' => array(
        'title' => 'tabaccategory',
        'name' => 'tabaccategory',
        'fields' => array(
            'tabacCategoryId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'title', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'description' => array('title'=> 'description', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '3'),
            'approved' => array('title'=> 'approved', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1',
        'additionalFields'=>array(
            array('title'=>'Табаки', 'link'=>'admin/mix/tabac/id/', 'inner'=>'<img src="icon/product.png" />', 'childOnly'=>1),
        ),    
    ),    
    'taste' => array(
        'title' => 'taste',
        'name' => 'taste',
        'fields' => array(
            'tasteId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Название', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'url' => array('title'=> 'Url', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'description' => array('title'=> 'Описание', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '2'),
            'shortDescription' => array('title'=> 'Короткое описание', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '2'),
            'workTime' => array('title'=> 'Время работы', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'yearLimit' => array('title'=> 'Возратсное огр', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'contacts' => array('title'=> 'Контакты', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'site' => array('title'=> 'Сайт', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'vk' => array('title'=> 'Группа ВК', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'barSpecial' => array('title'=> 'Особенности бара', 'type'=> 'text', 'showInListing' => '2','default'=>''),
            'kitchenSpecial' => array('title'=> 'Особенности кухни', 'type'=> 'text', 'showInListing' => '2','default'=>''),
            'hookahSpecial' => array('title'=> 'Особенности кальянов', 'type'=> 'text', 'showInListing' => '2','default'=>''),
            'placeFrame' => array('title'=> 'Местоположение', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'imageOriginal' => array(
                'title'=> 'Картинка',
                'type'=> 'image',
                'validate' => 'require',
                'showInListing'=>3,
                'imagesDir'=>'images/taste/',
                'size'=>array(
                    'imageOriginal'=>'1024x1024',
                    'imageMedium'=>'205x205',
                    'imageSmall'=>'60x60'
                    ),
                'cropSmart'=>FALSE
                ),            
            'imageSmall' => array('title' => 'imageSmall','type' => 'string'),            
            'imageMedium' => array('title'=> 'imageMedium', 'type'=> 'string'),
            'metaTitle' => array('title'=> 'metaTitle', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'metaDescription' => array('title'=> 'metaDescription', 'type'=> 'string', 'showInListing' => '2','default'=>''),
            'metaKeywords' => array('title'=> 'metaKeywords', 'type'=> 'string', 'showInListing' => '2','default'=>''),            
            'rate' => array('title'=> 'Рейтинг', 'type'=> 'int', 'default' => '1', 'showInListing' => '3', 'quickChange'=>1),
            'approved' => array('title'=> 'Показывать', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'Удалить', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1',
        'view' => '1',
        'additionalFields'=>array(
            array('title'=>'Карт.', 'link'=>'admin/taste/image/id/', 'inner'=>'<img src="icon/images.png" />'),
        ),   
    ),    
    'tasteimage' => array(
        'title' => 'tasteimage',
        'name' => 'tasteimage',
        'fields' => array(
            'tasteImageId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'tasteId' => array('title'=> 'tasteId', 'type'=> 'int', 'validate' => 'require', 'showInListing' => ''),
            'imageSmall' => array('title'=> 'imageSmall', 'type'=> 'string', 'validate' => 'require', 'showInListing' => ''),
            'imageMedium' => array('title'=> 'imageMedium', 'type'=> 'string', 'validate' => 'require', 'showInListing' => ''),
            'imageOriginal' => array('title'=> 'imageOriginal', 'type'=> 'string', 'validate' => 'require', 'showInListing' => ''),
            'deleted' => array('title'=> 'deleted', 'type'=> 'delete','default'=>0),
        ),
        'edit' => '1',
        'add' => '1',
        'view' => '1'
    ),       
    'testimonial' => array(
        'title' => 'testimonial',
        'name' => 'testimonial',
        'fields' => array(
            'testimonialId' => array('title'=> 'ID', 'type'=> 'pk', 'showInListing' => '1'),
            'userId' => array('title'=> 'Пользователь', 'type'=> 'select', 'table'=>'user', 'default' => '0', 'showInListing' => '3'),
            'firstName' => array('title'=> 'Имя', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'lastName' => array('title'=> 'Фамилия', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'imageOriginal' => array(
                'title'=> 'Фото',
                'type'=> 'image',
                'validate' => 'require',
                'showInListing'=>3,
                'imagesDir'=>'images/testimonial/',
                'size'=>array(
                    'imageOriginal'=>'1024x1024',
                    'imageMedium'=>'205x205',
                    'imageSmall'=>'60x60'
                    ),
                'cropSmart'=>FALSE
                ),            
            'imageSmall' => array('title' => 'imageSmall','type' => 'string'),            
            'imageMedium' => array('title'=> 'imageMedium', 'type'=> 'string'),
            'email' => array('title'=> 'email', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'vklink' => array('title'=> 'Ссылка вк', 'type'=> 'string', 'default' => '', 'showInListing' => '3'),
            'dateAdded' => array('title'=> 'Дата', 'type'=> 'string', 'default' => '', 'showInListing' => '3'),
            'comment' => array('title'=> 'Коммент', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '3'),
            'approved' => array('title'=> 'Зав.', 'type'=> 'active','default'=>0, 'showInListing' => '3'),
            'deleted' => array('title'=> 'Удал.', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'view' => '1'
    ),
    'exclusive' => array(
        'title' => 'exclusive',
        'name' => 'exclusive',
        'fields' => array(
            'exclusiveId' => array('title'=> 'ID', 'type'=> 'pk', 'showInListing' => '1'),
            'userId' => array('title'=> 'Пользователь', 'type'=> 'select', 'table'=>'user', 'default' => '0', 'showInListing' => '3'),
            'firstName' => array('title'=> 'Имя', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'lastName' => array('title'=> 'Фамилия', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'email' => array('title'=> 'email', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'phone' => array('title'=> 'Телефон', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'vklink' => array('title'=> 'Ссылка вк', 'type'=> 'string', 'default' => '', 'showInListing' => '3'),
            'description' => array('title'=> 'Описание', 'type'=> 'text', 'showInListing' => ''),
            'imageOriginal' => array(
                'title'=> 'Фото',
                'type'=> 'image',
                'validate' => 'require',
                'showInListing'=>3,
                'imagesDir'=>'images/exclusive/',
                'size'=>array(
                    'imageOriginal'=>'2048x2048',
                    ),
                'cropSmart'=>FALSE
                ),   
            'dateAdded' => array('title'=> 'Дата', 'type'=> 'string', 'validate' => 'require', 'showInListing' => ''),
            'approved' => array('title'=> 'Зав.', 'type'=> 'active','default'=>0, 'showInListing' => '3'),
            'deleted' => array('title'=> 'Удал.', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'view' => '1'
    ), 
    'socialpost' => array(
        'title' => 'socialpost',
        'name' => 'socialpost', 
        'fields' => array(
            'socialPostId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Название', 'type'=> 'string', 'showInListing' => '3', 'validate' => 'require'),
            'text' => array('title'=> 'Текст', 'type'=> 'text', 'showInListing' => '3', 'validate' => 'require'),
            'link' => array('title'=> 'Ссылка', 'type'=> 'string', 'showInListing' => '3','default'=>''),
            'tags' => array('title'=> 'Хештеги', 'type'=> 'string', 'showInListing' => '3', 'validate' => 'require'),
            'imageOriginal' => array(
                'title'=> 'Фото 806 на 806',
                'type'=> 'image',
                'showInListing'=>3,
                'imagesDir'=>'images/socialpost/',
                'size'=>array(
                    'imageOriginal'=>'806x806',
                    'imageBig'=>'700x700',
                    'imageMedium'=>'612x612',
                    'imageSmall'=>'60x60'
                    ),
                'cropSmart'=>FALSE,
                'default'=>''
                ),            
            'imageBig' => array('title'=> 'imageBig', 'type'=> 'string','default'=>''),
            'imageMedium' => array('title'=> 'imageMedium', 'type'=> 'string','default'=>''),
            'imageSmall' => array('title'=> 'imageSmall', 'type'=> 'string','default'=>''),
            'deleted' => array('title'=> 'Удалить', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1', 
        'view' => '1',
        'additionalFields'=>array(
            array('title'=>'Запостить', 'link'=>'admin/socialpost/doit/id/', 'inner'=>'<img src="icon/power_on.png" />'),
        ), 
    ),    
    'subscribe' => array(
        'title' => 'subscribe',
        'name' => 'subscribe', 
        'fields' => array(
            'subscribeId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'name' => array('title'=> 'Имя', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'email' => array('title'=> 'email', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'subsType' => array('title'=> 'Тип подписки', 'type'=> 'select',
                    'values' => array
                    (
                            'user' => 'Юзер',
                            'commerce1' => 'КП общее',
                            'commerce2' => 'КП эксклюзивные',
                    ), 'validate' => 'require', 'showInListing' => '3'),            
            'approved' => array('title'=> 'Подписан?', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'Удалить', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1'
    ),    
    'guest' => array(
        'title' => 'guest',
        'name' => 'guest', 
        'fields' => array(
            'guestId' => array('title'=> 'ID', 'type'=> 'pk'),
            'cardNumber' => array('title'=> 'Номер карты', 'type'=> 'string','showInListing' => '3', 'validate' => 'require'),
            'idHush' => array('title'=> 'idHush', 'type'=> 'string'),
            'name' => array('title'=> 'Имя', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'secondName' => array('title'=> 'Отчество', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'thirdName' => array('title'=> 'Фамилия', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'birthday' => array('title'=> 'Дата рождения', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'phone' => array('title'=> 'Телефон', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'email' => array('title'=> 'email', 'type'=> 'string', 'showInListing' => '3', 'default'=>''),
            'city' => array('title'=> 'Город', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3', 'default'=>'Севастополь'),
            'country' => array('title'=> 'Страна', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3', 'default'=>'Россия'),
            'dateAdded' => array('title'=> 'Дата', 'type'=> 'string', 'default'=>''),
            'remark' => array('title'=> 'remark', 'type'=> 'string', 'default'=>'', 'showInListing' => '2'),
            'imageOriginal' => array(
                'title'=> 'Фото',
                'type'=> 'image',
                'showInListing'=>3,
                'default'=>'',
                'imagesDir'=>'images/guest/',
                'size'=>array(
                    'imageOriginal'=>'1024x1024',
                    'imageBig'=>'480x480',
                    'imageSmall'=>'60x60'
                    ),
                'cropSmart'=>FALSE
            ),            
            'imageSmall' => array('title' => 'imageSmall','type' => 'string', 'default'=>''),            
            'imageBig' => array('title'=> 'imageMedium', 'type'=> 'string', 'default'=>''), 
            'bdYearUsed' => array('title'=> 'Кальян ДР', 'type'=> 'int','default'=>'0'),
            'points' => array('title'=> 'Очков', 'type'=> 'string','default'=>'0', 'showInListing' => '1'),
            'inside' => array('title'=> 'Внутри', 'type'=> 'int','default'=>'0'),
            'insideSort' => array('title'=> 'insideSort', 'type'=> 'int','default'=>'0'),
            'inTable' => array('title'=> 'inTable', 'type'=> 'int','default'=>0),
            'send' => array('title'=> 'Send', 'type'=> 'int','default'=>0),
            'subs' => array('title'=> 'Subs', 'type'=> 'int','default'=>1),
            'approved' => array('title'=> 'Акт.', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'Удалить', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1', 
        'view' => '1' 
    ),     
    'letter' => array(
        'title' => 'letter',
        'name' => 'letter', 
        'fields' => array(
            'letterId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Заголовок', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'text' => array('title'=> 'Текст', 'type'=> 'text', 'validate' => 'require', 'showInListing' => '3'),
            'status' => array('title'=> 'Статус', 'type'=> 'select',
                    'values' => array
                    (
                            'new' => 'новая',
                            'sended' => 'отправляется',
                            'send' => 'отправлена',
                    ), 'default' => 'new', 'validate' => 'require', 'showInListing' => '3'),
            'letterCount' => array('title'=> 'Отправленно писем', 'type'=> 'int', 'default'=>0, 'showInListing' => '1'),
            'deleted' => array('title'=> 'Удалить', 'type'=> 'delete','default'=>0, 'showInListing' => '1'),
        ),
        'edit' => '1',
        'add' => '1',
        'view' => '1' 
    ), 
    'guesttable' => array(
        'title' => 'guesttable',
        'name' => 'guesttable', 
        'fields' => array(
            'guestTableId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Заголовок', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'dateAdded' => array('title'=> 'Дата Откр', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'dateClosed' => array('title'=> 'Дата Закр', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'guestDayId' => array('title'=> 'Отчетный день', 'type'=> 'int', 'validate' => 'require', 'showInListing' => '3'),
            'price' => array('title'=> 'Цена', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3', 'default'=>''),
            'sale' => array('title'=> 'Скидка', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3', 'default'=>''),
            'saleCode' => array('title'=> 'Код скидки', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3', 'default'=>''),
            'pointSale' => array('title'=> 'Баллами', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3', 'default'=>''),
            'totalPrice' => array('title'=> 'Цена итого', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3', 'default'=>''),
            'remark' => array('title'=> 'remark', 'type'=> 'string', 'showInListing' => '3', 'default'=>''),
            'isOpen' => array('title'=> 'Открыт', 'type'=> 'int', 'default'=>0, 'showInListing' => '1'),
            'isAdmin' => array('title'=> 'Админский', 'type'=> 'int', 'default'=>0, 'showInListing' => '1'),
            'isCheck' => array('title'=> 'Чек был?', 'type'=> 'int', 'default'=>0, 'showInListing' => '1'),
            'deleted' => array('title'=> 'Удалить', 'type'=> 'delete','default'=>0, 'showInListing' => '1'),
        )
    ),   
    'guestday' => array(
        'title' => 'guestday',
        'name' => 'guestday', 
        'fields' => array(
            'guestDayId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'currentDate' => array('title'=> 'Дата', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'totalSum' => array('title'=> 'Касса', 'type'=> 'int', 'validate' => 'require', 'showInListing' => '3'),
            'hookahSum' => array('title'=> 'Касса кальяны', 'type'=> 'int', 'validate' => 'require', 'showInListing' => '3'),
            'barSum' => array('title'=> 'Касса бар', 'type'=> 'int', 'validate' => 'require', 'showInListing' => '3'),
            'pointSale' => array('title'=> 'Баллами', 'type'=> 'int', 'validate' => 'require', 'showInListing' => '3'),
            'whoWork' => array('title'=> 'Смена', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3', 'default'=>''),
            'openDate' => array('title'=> 'openDate', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3', 'default'=>''),
            'closeDate' => array('title'=> 'closeDate', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3', 'default'=>''),
            'hookahCount' => array('title'=> 'Количество кальянов', 'type'=> 'int', 'default'=>0, 'showInListing' => '1'),
            'tableCount' => array('title'=> 'Количество столов', 'type'=> 'int', 'default'=>0, 'showInListing' => '1'),
            'dayisopen' => array('title'=> 'Смена открыта', 'type'=> 'int', 'default'=>1, 'showInListing' => '1'),
            'deleted' => array('title'=> 'Удалить', 'type'=> 'delete','default'=>0, 'showInListing' => '1'),
        )
    ),       
    'guestproductcategory' => array(
        'title' => 'guestproductcategory',
        'name' => 'guestproductcategory',
        'fields' => array(
            'guestProductCategoryId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Название', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'approved' => array('title'=> 'Активно', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'Удалить', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1'
    ),    
    'guestproduct' => array(
        'title' => 'guestproduct',
        'name' => 'guestproduct',
        'fields' => array(
            'guestProductId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Название', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'guestProductCategoryId' => array('title'=> 'Категория', 'type'=> 'select', 'table'=>'guestproductcategory', 'validate' => 'require', 'showInListing' => '3'),
            'price' => array('title'=> 'Цена', 'type'=> 'int', 'default' => '0', 'validate' => 'require', 'showInListing' => '3', 'quickChange'=>1),
            'ssPrice' => array('title'=> 'С/С', 'type'=> 'double', 'default' => '0', 'validate' => 'require', 'showInListing' => '3', 'quickChange'=>1),
            'approved' => array('title'=> 'Активно', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'doSale' => array('title'=> 'Скидка', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'Удалить', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1'  
    ),  
    'guestsale' => array(
        'title' => 'guestsale',
        'name' => 'guestsale',
        'fields' => array(
            'guestSaleId' => array('title'=> 'Primary Key', 'type'=> 'pk'),
            'title' => array('title'=> 'Название', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'code' => array('title'=> 'Код', 'type'=> 'string', 'validate' => 'require', 'showInListing' => '3'),
            'salePercent' => array('title'=> 'Процент Скидки', 'type'=> 'int','default'=>0, 'showInListing' => '3', 'validate' => 'require'),
            'approved' => array('title'=> 'Активно', 'type'=> 'active','default'=>1, 'showInListing' => '3'),
            'deleted' => array('title'=> 'Удалить', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),
        ),
        'edit' => '1',
        'add' => '1'  
    ),      
);