<?php

class SitemapController extends BaseController
{    
    public function indexAction()
    {
        $categorySm = $this->ProductCategory->listing(0, 1, array('approved'=>1, 'order'=>'Order by title ASC'));   
        for( $i=0; $i<count($categorySm['data']); $i++ )
        {
            $categorySm['data'][$i]['product'] = $this->Product->listing(0, 1, array('approved'=>1, 'productCategoryId'=>$categorySm['data'][$i]['productCategoryId']));
        }
        $this->_view->categorySm = $categorySm;
        
        $this->_view->interestingList = $this->Content->listing(0, 1, array('isInteresting'=>1));
        
        $this->_view->styles = array('sitemap.css');
        $this->_view->pageTitle = 'Карта сайта';
        parent:: setBread(array('Карта сайта'));
        parent:: setMetaTags($this->Meta->getMeta('sitemap'));
        parent:: setRightBlock(array('mostViewedProduct'));
        $this->_smarty->display('sitemap/index.tpl');
    }
}