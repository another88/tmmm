<?php

class Admin_TasteController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'taste';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Taste->listingHTML(
            array(
                'controller'=>'taste',
                'modelName'=>'Taste',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Попробовать';
        $this->_smarty->display('default.tpl');
    }
}