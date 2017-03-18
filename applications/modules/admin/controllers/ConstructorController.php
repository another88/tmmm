<?php

class Admin_ConstructorController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'constructor';
    }

    public function shaxtaAction()
    {
        $this->_view->html = $this->ConsShaxta->listingHTML(
            array(
                'controller'=>'constructor',
                'modelName'=>'ConsShaxta',
                'indexActionName'=>'shaxta'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Конструктор Шахта';
        $this->_smarty->display('default.tpl');
    }
    
    public function kolbaAction()
    {
        $this->_view->html = $this->ConsKolba->listingHTML(
            array(
                'controller'=>'constructor',
                'modelName'=>'ConsKolba',
                'indexActionName'=>'kolba'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Конструктор Колба';
        $this->_smarty->display('default.tpl');
    }
    
    public function bowlAction()
    {
        $this->_view->html = $this->ConsBowl->listingHTML(
            array(
                'controller'=>'constructor',
                'modelName'=>'ConsBowl',
                'indexActionName'=>'bowl'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Конструктор Чаша';
        $this->_smarty->display('default.tpl');
    }
    
    public function portvAction()
    {
        $this->_view->html = $this->ConsPortV->listingHTML(
            array(
                'controller'=>'constructor',
                'modelName'=>'ConsPortV',
                'indexActionName'=>'portv'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Конструктор Порт Верхний';
        $this->_smarty->display('default.tpl');
    }
    
    public function portnAction()
    {
        $this->_view->html = $this->ConsPortN->listingHTML(
            array(
                'controller'=>'constructor',
                'modelName'=>'ConsPortN',
                'indexActionName'=>'portn'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Конструктор Порт Нижний';
        $this->_smarty->display('default.tpl');
    }
    
    public function shlangAction()
    {
        $this->_view->html = $this->ConsShlang->listingHTML(
            array(
                'controller'=>'constructor',
                'modelName'=>'ConsShlang',
                'indexActionName'=>'shlang'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Конструктор Шланг';
        $this->_smarty->display('default.tpl');
    }
    
    public function bludceAction()
    {
        $this->_view->html = $this->ConsBludce->listingHTML(
            array(
                'controller'=>'constructor',
                'modelName'=>'ConsBludce',
                'indexActionName'=>'bludce'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Конструктор Блюдце';
        $this->_smarty->display('default.tpl');
    }
    
    public function shipciAction()
    {
        $this->_view->html = $this->ConsShipci->listingHTML(
            array(
                'controller'=>'constructor',
                'modelName'=>'ConsShipci',
                'indexActionName'=>'shipci'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Конструктор Щипцы';
        $this->_smarty->display('default.tpl');
    }  
    
    public function trybkaAction()
    {
        $this->_view->html = $this->ConsTrybka->listingHTML(
            array(
                'controller'=>'constructor',
                'modelName'=>'ConsTrybka',
                'indexActionName'=>'trybka'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Конструктор Трубка';
        $this->_smarty->display('default.tpl');
    }      
    
    public function baseAction()
    {
        $this->_view->html = $this->Constructor->listingHTML(
            array(
                'controller'=>'constructor',
                'modelName'=>'Constructor',
                'indexActionName'=>'base'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'База';
        $this->_smarty->display('default.tpl');
    }      
}