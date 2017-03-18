<?php

class InterestingController extends BaseController
{    
    public function init()
    {
        parent::init();
        $this->_view->current = 'interesting';
    }        
    
    public function indexAction()
    {
        $list = $this->Content->listing(0, 1, array('isInteresting'=>1));
        $this->_view->list = $list;
        
        $meta = $this->Meta->getMeta('interesting');
        $this->_view->pageTitle = $meta['metaTitle'];
        $this->_view->styles = array('interesting.css');    
        $this->_view->scripts = array('interesting.js');
        parent:: setRightBlock(array('mostViewedProduct'));
        parent:: setBread(array('Интересное'));
        parent:: setMetaTags($meta);
        $this->_smarty->display('interesting/index.tpl');
    }  
    
    public function viewAction()
    {
        $id = $this->_request->getParam('id');
        if(empty($id))
            parent::redirect('#');
        
        if( (int)$id !=0 )
        {
            $content = $this->Content->details($id);
            parent::redirect301('interesting/'.$content['url'].'.html');
        }
        
        $content = $this->Content->urlDetail($id);
        
        if( empty($content) )
            parent::redirect('#');
        
        $this->_view->content = $content;
        
        if( !isset($_SESSION['userContentViewCount'][$content['contentId']]) )
        {
            $this->Content->addViewCount($content['contentId']);
            $_SESSION['userContentViewCount'][$content['contentId']] = true;
        }        
        
        $list = $this->Content->listing(0, 1, array('isInteresting'=>1));
        for( $i=0; $i<count($list['data']); $i++ )
        {
            $list['data'][$i]['shortDescription'] = substr(strip_tags($list['data'][$i]['shortDescription']), 0, 172).'...';
        }
        $this->_view->list = $list;        
        
        $this->_view->pageTitle = $content['title'];
        $this->_view->styles = array('interesting.css');          
        parent:: setBread(array('<a href="interesting">Интересное</a>', $content['title']));
        parent:: setMetaTags($content);
        $this->_smarty->display('interesting/view.tpl');
    }    
}