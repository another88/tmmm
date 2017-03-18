<?php

class Admin_CallorderController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'callorder';
    }

    public function indexAction()
    {
        $this->_view->html = $this->CallOrder->listingHTML(
            array(
                'controller'=>'callorder',
                'modelName'=>'CallOrder',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Заказ звонков';
        $this->_smarty->display('default.tpl');
    }
}