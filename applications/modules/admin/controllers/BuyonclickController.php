<?php

class Admin_BuyonclickController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'buyonclick';
    }

    public function indexAction()
    {
        $this->_view->html = $this->BuyOnClick->listingHTML(
            array(
                'controller'=>'buyonclick',
                'modelName'=>'BuyOnClick',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Покупки в один клик';
        $this->_smarty->display('default.tpl');
    }
}