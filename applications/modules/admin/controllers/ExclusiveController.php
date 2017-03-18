<?php

class Admin_ExclusiveController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'exclusive';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Exclusive->listingHTML(
            array(
                'controller'=>'exclusive',
                'modelName'=>'Exclusive',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Заказы именных';
        $this->_smarty->display('default.tpl');
    }
}