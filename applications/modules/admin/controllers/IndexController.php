<?php

class Admin_IndexController extends BaseController
{
    public function indexAction()
    {
        $this->_view->title = 'Не проверенные действия посетителей.';
        
        $this->_view->htmlBOC = $this->BuyOnClick->listingHTML(
            array(
                'controller'=>'buyonclick',
                'modelName'=>'BuyOnClick',
                'indexActionName'=>'index'
            ),
            0,
            1,
            array('completed'=>0),
            0,
            false
        );        
        
        $this->_view->htmlO = $this->Order->listingHTML(
            array(
                'controller'=>'order',
                'modelName'=>'Order',
                'indexActionName'=>'index'
            ),
            0,
            1,
            array('approved'=>0),
            0,
            false
        );        
        
        $this->_view->htmlFB = $this->Feedback->listingHTML(
            array(
                'controller'=>'feedback',
                'modelName'=>'Feedback',
                'indexActionName'=>'index'
            ),
            0,
            1,
            array('approved'=>0),
            0,
            false
        );       
        
        $this->_view->htmlEX = $this->Exclusive->listingHTML(
            array(
                'controller'=>'exclusive',
                'modelName'=>'Exclusive',
                'indexActionName'=>'index'
            ),
            0,
            1,
            array('approved'=>0),
            0,
            false
        );       
        
        $this->_view->htmlT = $this->Testimonial->listingHTML(
            array(
                'controller'=>'testimonial',
                'modelName'=>'Testimonial',
                'indexActionName'=>'index'
            ),
            0,
            1,
            array('approved'=>0),
            0,
            false
        );    
        
        $this->_view->htmlM = $this->Mix->listingHTML(
            array(
                'controller'=>'mix',
                'modelName'=>'Mix',
                'indexActionName'=>'index'
            ),
            0,
            1,
            array('approved'=>0),
            0,
            false
        );            
        
        $this->_smarty->display('index/index.tpl');
    }
    
}