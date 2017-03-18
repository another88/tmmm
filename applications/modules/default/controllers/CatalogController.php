<?php

class CatalogController extends BaseController
{    
    public function indexAction()
    {
        $id = $this->_request->getParam('id');
        if(empty($id))
            parent::redirect('#');
        
        if( (int)$id !=0 )
        {
            $dd = $this->ProductCategory->details($id);
            parent::redirect301('catalog/'.$dd['url'].'.html');
        }
        
        $currentCategory = $this->ProductCategory->urlDetail($id);
        $currentCategory['product'] = $this->Product->listing(0, 1, array('approved'=>1, 'productCategoryId'=>$currentCategory['productCategoryId']));
        
        $this->_view->currentCategory = $currentCategory;
        $this->_view->current = $id;
        
        $this->_view->pageTitle = $currentCategory['pageTitle'];
        $this->_view->styles = array('catalog.css');        
        
//        parent:: setRightBlock(array('mostViewedProduct', 'mostBuyedProduct'));
        parent:: setBread(array($currentCategory['title']));
        parent:: setMetaTags($currentCategory);
        $this->_smarty->display('catalog/index.tpl');
    }
    
    public function allAction()
    {
        $lpp = $this->_request->getParam('lpp');
        if( !empty($lpp) )
        {
            $products = $this->Product->listing(0, 1, array('approved'=>1));
            $this->_view->products = $products;    
            $this->_view->styles = array('all2.css');   
            $this->_smarty->display('catalog/all2.tpl');
        }
        else
        {
            $products = $this->Product->listing(0, 1, array('approved'=>1));
            $this->_view->products = $products;

            $this->_view->styles = array('all.css');        

            $meta = $this->Meta->getMeta('all_product');
            $this->_view->pageTitle = $meta['metaTitle'];        
            parent:: setBread(array('Вся продукция нашего магазина'));
            parent:: setMetaTags($meta);
            $this->_smarty->display('catalog/all.tpl');
        }
    }    
    
//    public function viewAction()
//    {
//        $id = $this->_request->getParam('id');
//        if(empty($id))
//            parent::redirect('#');
//        
//        $category = $this->ProductCategory->details($id);
//        $this->_view->categor = $category;
//        
//        $products = $this->Product->listing(0, 1, array('approved'=>1, 'productCategoryId'=>$id));
////        $isUserSale = $this->Setting->getSetting('reg_user_sale');
////        if($isUserSale)
////        {
////            for( $i=0; $i<count($products['data']); $i++ )
////            {
////                $products['data'][$i]['price'] = $products['data'][$i]['price']*(1-$isUserSale['value']/100);
////            }            
////        }        
//        $this->_view->products = $products;
//        parent:: setRightBlock(array('mostViewedProduct', 'mostBuyedProduct'));
//        parent:: setBread(array('<a href="catalog">Каталог товаров</a>', $category['title']));
//        parent:: setMetaTags($category);
//        $this->_smarty->display('catalog/view.tpl');
//    }
    
}