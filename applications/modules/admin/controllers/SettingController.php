<?php

class Admin_SettingController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'setting';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Setting->listingHTML(
            array(
                'controller'=>'setting',
                'modelName'=>'Setting',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Настройки';
        $this->_smarty->display('default.tpl');
    }
}