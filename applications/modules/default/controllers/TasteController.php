<?php

class TasteController extends BaseController
{    
    public function init()
    {
        parent::init();
        $this->_view->current = 'taste';
    }      
    
    public function indexAction()
    {
        $taste = $this->Taste->listing(0, 1, array('approved'=>1, 'order'=>'ORDER by `rate` DESC'));
        $this->_view->taste = $taste;
        
        $meta = $this->Meta->getMeta('taste');
        $this->_view->pageTitle = $meta['metaTitle'];
        $this->_view->styles = array('taste.css');        
        parent:: setRightBlock(array('mostViewedProduct', 'mostBuyedProduct'));
        parent:: setBread(array('Попробовать'));
        parent:: setMetaTags($meta);
        $this->_smarty->display('taste/index.tpl');
    }  
}