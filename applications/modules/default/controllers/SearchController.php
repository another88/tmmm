<?php
class SearchController extends BaseController 
{
    public function indexAction()
    {
        $params = $this->_request->getParams();
        if(empty($params['searchKey']))
            parent::redirect('#');
        
        $this->_view->searchKey = $params['searchKey'];
        
        $result = $this->Search->searchFunc($params['searchKey']);
        $this->_view->result = $result;  
        
        $this->_view->pageTitle = 'Результаты поиска';
        $this->_view->styles = array('search.css');        
        parent:: setMetaTags($this->Meta->getMeta('search'));
        parent:: setBread(array('Результаты поиска "'.$params['searchKey'].'"'));
        parent:: setRightBlock(array('mostViewedProduct', 'mostBuyedProduct'));
        $this->_smarty->display('search/index.tpl');
    }   
}