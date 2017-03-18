<?php

class Admin_SocialpostController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'socialpost';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Socialpost->listingHTML(
            array(
                'controller'=>'socialpost',
                'modelName'=>'Socialpost',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Посты в соц сети';
        $this->_smarty->display('default.tpl');
    }
    
    public function doitAction()
    {
        $id = $this->_request->getParam('id');
        $postDetails = $this->Socialpost->details($id);
        var_dump($postDetails);exit; 
    }    
}