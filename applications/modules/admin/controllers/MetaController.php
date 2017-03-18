<?php

class Admin_MetaController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'meta';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Meta->listingHTML(
            array(
                'controller'=>'meta',
                'modelName'=>'Meta',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Мета Данные';
        $this->_smarty->display('default.tpl');
    }
}