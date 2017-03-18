<?php

class Admin_LetterController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'letter';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Letter->listingHTML(
            array(
                'controller'=>'letter',
                'modelName'=>'Letter',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Рассылки';
        $this->_smarty->display('default.tpl');
    }
}