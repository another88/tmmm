<?php

class Admin_SliderController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'slider';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Slider->listingHTML(
            array(
                'controller'=>'slider',
                'modelName'=>'Slider',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Slider';
        $this->_smarty->display('default.tpl');
    }
}