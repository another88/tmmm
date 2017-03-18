<?php

class SpecialController extends BaseController
{    
    public function init()
    {
        parent::init();
        $this->_view->current = 'special';
    }       
    
    public function indexAction()
    {
        $specials = $this->Special->listing(0, 1, array('approved'=>1));
        $this->_view->specials = $specials;
        
        $meta = $this->Meta->getMeta('special');
        $this->_view->pageTitle = $meta['metaTitle'];
        $this->_view->styles = array('special.css');     
        $this->_view->scripts = array('special.js', 'jqscrollbox/jquery.scrollbox.min.js');
        parent:: setRightBlock(array('mostViewedProduct'));
        parent:: setBread(array('Специальные предложения'));
        parent:: setMetaTags($meta);
        $this->_smarty->display('special/index.tpl');
    }  
}