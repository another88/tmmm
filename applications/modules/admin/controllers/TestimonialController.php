<?php

class Admin_TestimonialController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'testimonial';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Testimonial->listingHTML(
            array(
                'controller'=>'testimonial',
                'modelName'=>'Testimonial',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Отзывы';
        $this->_smarty->display('default.tpl');
    }
}