<?php

class Admin_CommentController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'comment';
    }

    public function indexAction()
    {
        $this->_view->html = $this->ProductComment->listingHTML(
            array(
                'controller'=>'comment',
                'modelName'=>'ProductComment',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Комментарии к товару';
        $this->_smarty->display('default.tpl');
    }
}