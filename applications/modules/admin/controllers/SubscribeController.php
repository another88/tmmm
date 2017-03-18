<?php

class Admin_SubscribeController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'subscribe';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Subscribe->listingHTML(
            array(
                'controller'=>'subscribe',
                'modelName'=>'Subscribe',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Подписчики';
        $this->_smarty->display('default.tpl');
    }
}