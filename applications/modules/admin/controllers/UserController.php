<?php

class Admin_UserController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'user';
    }

    public function indexAction()
    {
        $this->_view->html = $this->User->listingHTML(
            array(
                'controller'=>'user',
                'modelName'=>'User',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Users List';
        $this->_smarty->display('default.tpl');
    }

}