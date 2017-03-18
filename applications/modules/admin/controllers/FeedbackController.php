<?php

class Admin_FeedbackController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'feedback';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Feedback->listingHTML(
            array(
                'controller'=>'feedback',
                'modelName'=>'Feedback',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Обратная связь';
        $this->_smarty->display('default.tpl');
    }
}