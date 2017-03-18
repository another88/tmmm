<?php

class Admin_SpecialController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'special';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Special->listingHTML(
            array(
                'controller'=>'special',
                'modelName'=>'Special',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Специальные предложения';
        $this->_smarty->display('default.tpl');
    }
}