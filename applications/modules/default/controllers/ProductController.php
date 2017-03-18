<?php

class ProductController extends BaseController
{    
    public function detailsAction()
    {
        $id = $this->_request->getParam('id');
        if(empty($id))
            parent::redirect('#');
        
        if( (int)$id !=0 )
        {
            $dd = $this->Product->details($id);
            parent::redirect301('product/'.$dd['url'].'.html');
        }        
        
        if(!isset($_SESSION['userViewCount']))
        {
            $_SESSION['userViewCount'] = array();
        }
        
        $product = $this->Product->urlDetail($id);
        $this->_view->p = $product;
        $this->_view->productImages = $this->ProductImage->listing(0, 1, array('productId' => $product['productId']));
//        $this->_view->productComment = $this->ProductComment->listing(0, 1, array('productId' => $id, 'approved'=>1));
        $categoryDetails = $this->ProductCategory->details($product['productCategoryId']);
        parent::setBread(
                array(
                    '<a href="catalog/index/id/'.$product['productCategoryId'].'">'.$categoryDetails['title'].'</a>',
                    $product['title']
                )
        );
        $this->_view->pageTitle = $product['title'];
        $this->_view->styles = array('product.css'); 
        $this->_view->scripts = array('product.js'); 
        parent:: setMetaTags($product);
        if( !isset($_SESSION['userViewCount'][$product['productId']]) )
        {
            $this->Product->addProductCount($product['productId'], 'view');
            $_SESSION['userViewCount'][$product['productId']] = true;
        }
//        parent:: setRightBlock(array('productLike'));
        $this->_smarty->display('product/details.tpl');
    }
    
//    public function addcommentAction()
//    {
//        if($this->_request->isPost()) 
//        {
//            $data = $this->_request->getPost();
//            if (empty($data['productId'])) 
//            {
//                exit ('Ошибка определения товара. Попробуйте перезагрузить страницу и попробовать снова.');    
//            }  
//            if (empty($data['name'])) 
//            {
//                exit('Введите Ваше Имя!');
//            }
//            if (empty($data['comment'])) 
//            {
//                exit('Введите Ваше Комментарий!');
//            }            
//            $data['dateAdded'] = date('Y-m-d H:i:s');
//            $data['userId'] = 0;
//            if(isset($_SESSION['user']))
//            {
//                $data['userId'] = $_SESSION['user']['userId'];
//            }            
//            $this->ProductComment->add($data);
//            $cnf = Zend_Registry::get('cnf');
//            $adminMail = $cnf->adminMail;
//            $message = 'От: '.$data['name'].', '.$data['productId'].', '.$data['dateAdded'].' '.$data['comment'];
//            parent::sendMail($adminMail, 'Ace Hookah<manager@ace-hookah.com>', 'Новый комментарий к продукту', $message, $headers='', FALSE);            
//            exit('ok');
//        }
//    }      
}