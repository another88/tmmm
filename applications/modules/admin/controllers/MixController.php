<?php

class Admin_MixController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'mix';
    }

    public function tabacAction()
    {
        $id = $this->_request->getParam('id');
        if(!empty($id))
        {
            $this->_view->html = $this->Tabac->listingHTML(
                array(
                    'controller'=>'mix',
                    'modelName'=>'Tabac',
                    'indexActionName'=>'tabac'
                ),
                15,
                parent::getPage(),
                array('tabacCategoryId'=>$id, 'order'=>'ORDER BY title ASC'),
                $id
            );   
            $catDet = $this->TabacCategory->details($id);
            $this->_view->title = 'Табаки фирмы "'.$catDet['title'].'"';
        } 
        else 
        {
            $this->_view->html = $this->Tabac->listingHTML(
                array(
                    'controller'=>'mix',
                    'modelName'=>'Tabac',
                    'indexActionName'=>'tabac'
                ),
                15,
                parent::getPage(),
                array('order'=>'ORDER BY title ASC')
            );
            $this->_view->title = 'Табаки';
        }
        $this->_smarty->display('default.tpl');
    }
    
    public function tabaccategoryAction()
    {
        $this->_view->html = $this->TabacCategory->listingHTML(
            array(
                'controller'=>'mix',
                'modelName'=>'TabacCategory',
                'indexActionName'=>'tabaccategory'
            ),
            15,
            parent::getPage(),
            array('order'=>'ORDER BY title ASC')
        );
        $this->_view->title = 'Категории табаков';
        $this->_smarty->display('default.tpl');
    }
}