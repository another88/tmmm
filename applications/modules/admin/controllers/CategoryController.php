<?php

class Admin_CategoryController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'category';
    }

    public function indexAction()
    {
        $this->_view->html = $this->ProductCategory->listingHTML(
            array(
                'controller'=>'category',
                'modelName'=>'ProductCategory',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Категории Товаров';
        $this->_smarty->display('default.tpl');
    }
}