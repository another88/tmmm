<?php

class Admin_ProductController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'product';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Product->listingHTML(
            array(
                'controller'=>'product',
                'modelName'=>'Product',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage(),
            array('order' => 'ORDER by productCategoryId ASC')
        );
        $this->_view->title = 'Товары';
        $this->_smarty->display('default.tpl');
    }
    
    public function imageAction()
    {
        $id = $this->_request->getParam('id');
        if ($this->_request->isPost()) 
        {
            if (!isset($_FILES) && isset($HTTP_POST_FILES))
                $_FILES = $HTTP_POST_FILES;

            if (empty($_FILES['imageOriginal']['name'])) 
            {
                $_SESSION['error'] = 'Select file.';
                parent::redirect('admin/product/image/id/' . $id);
            }

            $files = array(
                "imageOriginal"=>array(
                    "title"=> "imageOriginal",
                    "imagesDir"=>"images/product/". $id . "/",
                    "sizes"=> array(
                        "imageOriginal"=>"480x840",
                        "imageBig"=>"240x420",
                        "imageMedium"=>"120x210",
                        "imageSmall"=> "60x105"
                    ),
                    "cropSmart"=>false,
                    "cropSkip"=>false            
                  )
            );            
            $productImgData = $this->_uploadPhotoNew($files);

            $productImgData['productId'] = $id;
            $this->ProductImage->add($productImgData);
            parent::redirect('admin/product/image/id/' . $id);
        }
        $this->_view->product = $this->Product->details($id);
        $this->_view->image = $this->ProductImage->listing(0, 1, array('productId' => $id));
        $this->_view->title = 'Изображения товара "'.$this->_view->product['title'].'"';
        $this->_smarty->display('product/image.tpl');
    }

    public function imagedeleteAction()
    {
        $id = $this->_request->getParam('id');
        if (empty($id)) {
            $_SESSION['notice'] = 'Ошибка: не указан идентефикатор изображения.';
            $this->_redirect('admin/product');
        }
        $productImage = $this->ProductImage->details($id);
        $cnf = Zend_Registry::get('cnf');
        @unlink($cnf->path->images->product . '/' . $productImage['productId'] . '/' . $productImage['imageSmall']);
        @unlink($cnf->path->images->product . '/' . $productImage['productId'] . '/' . $productImage['imageMedium']);
        @unlink($cnf->path->images->product . '/' . $productImage['productId'] . '/' . $productImage['imageBig']);
        @unlink($cnf->path->images->product . '/' . $productImage['productId'] . '/' . $productImage['imageOriginal']);
        
//        $this->ProductImage->delete($id);
        $sql = "DELETE FROM `productimage`
            WHERE `productImageId` =".intval($id);
        $this->_db->query($sql);
        
        parent::redirect('admin/product/image/id/' . $productImage['productId']);
    }    
    
    public function commentAction()
    {
        $id = $this->_request->getParam('id');
        $this->_view->html = $this->ProductComment->listingHTML(
            array(
                'controller'=>'comment',
                'modelName'=>'ProductComment',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage(),
            array('productId'=>$id)
        );
        $productDetails = $this->Product->details($id);
        $this->_view->title = 'Комментарии к товару "'.$productDetails['title'].'"';
        $this->_smarty->display('default.tpl');
    }
    
//    public function likeAction()
//    {
//        $id = $this->_request->getParam('id');
//        if ($this->_request->isPost()) 
//        {
//            if (!isset($_FILES) && isset($HTTP_POST_FILES))
//                $_FILES = $HTTP_POST_FILES;
//
//            if (empty($_FILES['imageOriginal']['name'])) 
//            {
//                $_SESSION['error'] = 'Select file.';
//                parent::redirect('admin/product/image/id/' . $id);
//            }
//
//            $files = array(
//                "imageOriginal"=>array(
//                    "title"=> "imageOriginal",
//                    "imagesDir"=>"images/product/". $id . "/",
//                    "sizes"=> array(
//                        "imageOriginal"=>"1024x1024",
//                        "imageMedium"=>"205x205",
//                        "imageSmall"=> "60x60"
//                    ),
//                    "cropSmart"=>false,
//                    "cropSkip"=>false            
//                  )
//            );            
//            $productImgData = $this->_uploadPhotoNew($files);
//
//            $productImgData['productId'] = $id;
//            $this->ProductImage->add($productImgData);
//            parent::redirect('admin/product/image/id/' . $id);
//        }
//        $this->_view->product = $this->Product->details($id);
//        $products = $this->Product->listing();
//        $this->_view->title = 'Like товары для "'.$this->_view->product['title'].'"';
//        $this->_smarty->display('product/image.tpl');
//    }    
}