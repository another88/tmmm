<?php

class OurworkController extends BaseController
{    
    public function init()
    {
        parent::init();
        $this->_view->current = 'ourwork';
    }        
    
    public function indexAction()
    {
        $pid = $this->_request->getParam('pid');
        if( empty($pid) )
        {
            $pid = 0;
        }
        $this->_view->pid = $pid;
        $list = $this->Ourwork->listing(0, 1, array('approved'=>1));
        for( $i=0; $i<count($list['data']); $i++ )
        {
            $list['data'][$i]['images'] = $this->OurworkImage->listing(0, 1, array('ourWorkId'=>$list['data'][$i]['ourWorkId']));
            
            if( isset($_COOKIE['ahLikeCount_'.$list['data'][$i]['ourWorkId']]))
                $list['data'][$i]['isLike'] = true;
            else
                $list['data'][$i]['isLike'] = false;
        }       
//        if( $_SESSION['user']['userId'] == 1 )
//        {
//            var_dump($_COOKIE);exit;
//        }
        $this->_view->list = $list;
        
        $meta = $this->Meta->getMeta('ourwork');
        $this->_view->pageTitle = $meta['metaTitle'];
        $this->_view->styles = array('ourwork.css');   
        $this->_view->scripts = array('ourwork.js');
        parent:: setBread(array('Портфолио'));
        parent:: setMetaTags($meta);
        
        $this->_smarty->display('ourwork/index.tpl');
    }  
 
    public function dolikeAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            if (empty($data['pid'])) 
            {
                exit('Ошибка определения ID. Попробуйте перезагрузить страницу и повторить.');
            }
            
            if( !isset($_COOKIE['ahLikeCount_'.$data['pid']]))
            {
                $this->Ourwork->addLike($data['pid']);
                setcookie ("ahLikeCount_".$data['pid'], 1, time()+60*60*24*30, "", ".ace-hookah.com");
            }
            $det = $this->Ourwork->details($data['pid']);
            exit(''.$det['likeCount'].'');
        }
    }        
}