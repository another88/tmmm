<?php

class Admin_ContentController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'content';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Content->listingHTML(
            array(
                'controller'=>'content',
                'modelName'=>'Content',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Content';
        $this->_smarty->display('default.tpl');
    }
}