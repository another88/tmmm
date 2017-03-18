<?php

class Admin_OurworkController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'ourwork';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Ourwork->listingHTML(
            array(
                'controller'=>'ourwork',
                'modelName'=>'Ourwork',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Наши работы';
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
                parent::redirect('admin/ourwork/image/id/' . $id);
            }

            $files = array(
                "imageOriginal"=>array(
                    "title"=> "imageOriginal",
                    "imagesDir"=>"images/ourwork/". $id . "/",
                    "sizes"=> array(
                        "imageOriginal"=>"1024x1024",
                        "imageMedium"=>"204x370",
                        "imageSmall"=> "57x105"
                    ),
                    "cropSmart"=>false,
                    "cropSkip"=>false            
                  )
            );            
            $productImgData = $this->_uploadPhotoNew($files);

            $productImgData['ourWorkId'] = $id;
            $this->OurworkImage->add($productImgData);
            parent::redirect('admin/ourwork/image/id/' . $id);
        }
        $this->_view->ourwork = $this->Ourwork->details($id);
        $this->_view->image = $this->OurworkImage->listing(0, 1, array('ourworkId' => $id));
        $this->_view->title = 'Изображения работы: "'.$this->_view->ourwork['title'].'"';
        $this->_smarty->display('ourwork/image.tpl');
    }

    public function imagedeleteAction()
    {
        $id = $this->_request->getParam('id');
        if (empty($id)) {
            $_SESSION['notice'] = 'Ошибка: не указан идентефикатор изображения.';
            $this->_redirect('admin/ourwork');
        }
        $productImage = $this->OurworkImage->details($id);
        $cnf = Zend_Registry::get('cnf');
        @unlink($cnf->path->images->ourwork . '/' . $productImage['ourWorkId'] . '/' . $productImage['imageSmall']);
        @unlink($cnf->path->images->ourwork . '/' . $productImage['ourWorkId'] . '/' . $productImage['imageMedium']);
        @unlink($cnf->path->images->ourwork . '/' . $productImage['ourWorkId'] . '/' . $productImage['imageOriginal']);
        
//        $this->ProductImage->delete($id);
        $sql = "DELETE FROM `ourworkimage`
            WHERE `ourWorkImageId` =".intval($id);
        $this->_db->query($sql);
        
        parent::redirect('admin/ourwork/image/id/' . $productImage['ourWorkId']);
    }    
}