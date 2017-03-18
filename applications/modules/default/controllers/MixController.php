<?php

class MixController extends BaseController
{    
    public function init()
    {
        parent::init();
        $this->_view->current = 'mix';
    }   
    
    public function saveallAction()
    {
        $mix = $this->Mix->listing(1, 1, array('saved'=>0));
        if( count($mix['data']) >0 )
        {
            for( $i=0; $i<count($mix['data']); $i++ )
            {
                $mix['data'][$i] = $this->Mix->getMix($mix['data'][$i]['mixId']);
                $mix['data'][$i]['json'] =json_encode($mix['data'][$i]['mixDetails']);
                $mix['data'][$i]['shareDesc'] = '';
                for( $j=0; $j<count($mix['data'][$i]['mixDetails']); $j++ )
                {
                    $mix['data'][$i]['shareDesc'] .= $mix['data'][$i]['mixDetails'][$j]['tabacCategoryTitle'].'-'.$mix['data'][$i]['mixDetails'][$j]['tabacTitle'].': '.$mix['data'][$i]['mixDetails'][$j]['percent'].'%; ';
                }
                $mix['data'][$i]['shareDesc'] .= 'В колбу: '.$mix['data'][$i]['waterDescription'];            
            }
            $this->_view->mix = $mix;
            $this->_view->scripts = array('mix.js', 'saveallmix.js', 'html2canvas.js', 'chart/Chart.js');
            $this->_view->styles = array('mix.css');        
            $this->_smarty->display('mix/saveall.tpl');
        }
    }    
    
    public function indexAction()
    {
        $content = $this->Content->details(5);
        $this->_view->content = $content;
        
        $mid = $this->_request->getParam('mid');
        if( !empty($mid) )
        {
            $mixDetails = $this->Mix->getMix($mid);
            $mixDetails['json'] =json_encode($mixDetails['mixDetails']);
            $mixDetails['shareDesc'] = '';
            for( $j=0; $j<count($mixDetails['mixDetails']); $j++ )
            {
                $mixDetails['shareDesc'] .= $mixDetails['mixDetails'][$j]['tabacCategoryTitle'].'-'.$mixDetails['mixDetails'][$j]['tabacTitle'].': '.$mixDetails['mixDetails'][$j]['percent'].'%; ';
            }
            $mixDetails['shareDesc'] .= 'В колбу: '.$mixDetails['waterDescription'];            
            $this->_view->mixDetails = $mixDetails;
        }
        
        $tabacCategoryAdd = $this->TabacCategory->listing(0, 1, array('approved'=>1, 'order'=>'ORDER by title ASC'));
        for( $i=0; $i<count($tabacCategoryAdd['data']); $i++ )
        {
            $tabacCategoryAdd['data'][$i]['tabac'] = $this->Tabac->listing(0, 1, array('approved'=>1, 'tabacCategoryId'=>$tabacCategoryAdd['data'][$i]['tabacCategoryId'], 'order'=>'ORDER by title ASC'));
        }
        $this->_view->tabacCategoryAdd = $tabacCategoryAdd;
        
        $tabacCategory = $this->TabacCategory->getUsedCategory();
        for( $i=0; $i<count($tabacCategory); $i++ )
        {
            $tabacCategory[$i]['tabac'] = $this->Tabac->listing(0, 1, array('approved'=>1, 'tabacCategoryId'=>$tabacCategory[$i]['tabacCategoryId'], 'order'=>'ORDER by title ASC'));
        }
        $this->_view->tabacCategory = $tabacCategory;        
        
        $this->_view->scripts = array('mix.js', 'html2canvas.js', 'chart/Chart.js');
        $this->_view->styles = array('mix.css');
        $this->_view->pageTitle = $content['title'];
        parent:: setBread(array('Миксы'));
        parent:: setMetaTags($content);
        $this->_smarty->display('mix/index.tpl');
    }
    
    public function gettabacAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if(empty($data['tabacCategoryId']))
                exit('Не выбрана фирма табака');
            
            $tabac = $this->Tabac->listing(0, 1, array('approved'=>1, 'tabacCategoryId'=>$data['tabacCategoryId']));
            $this->_view->tabac = $tabac;
            $this->_smarty->display('mix/tabac.tpl');
        }
    }    
    
    public function addmixAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !$this->Validate->id($data['authorId']) )
            {
                $data['authorId'] = 0;
            }
            
            if( !$this->Validate->string($data['author']) )
            {
                exit('Введите автора микса.');
            }
            
            $tabac = array();
            $tabacPercent = 0;
            foreach($data as $k=>$v)
            {
                $keyExplode = explode('_', $k);
                if( count($keyExplode) == 3 )
                {
                    if( $keyExplode[0] == 'tabac' && $v)
                    {
                        $toTabacArray = array(
                            'tabacId' => $keyExplode[1],
                            'tabacCategoryId' => $keyExplode[2],
                            'percent' => $v
                        );
                        $tabac[] = $toTabacArray;
                        $tabacPercent += $v;
                    }
                }
            }
            
            if( $tabacPercent != 100 )
            {
                exit('Процентоне соотношение ароматов в миксе должно равняться 100%');
            }
            
            asort($tabac);
            $mixCode = '';
            foreach($tabac as $k => $v)
            {
                $mixCode .= $v['tabacId'].'_'.$v['percent'];
                if( $i+1 < count($tabac) )
                    $mixCode .= '-';
            }            
            $mixCode = substr($mixCode, 0, strlen($mixCode)-1);
            $mixCheck = $this->Mix->checkMix($mixCode);
            if( !$mixCheck )
            {
                exit('Такой микс уже есть.');
            }
            else
            {
                $toMix = array(
                    'title' => '',
                    'description' => '',
                    'waterDescription' => $data['water'],
                    'author' => $data['author'],
                    'authorId' => $data['authorId'],
                    'mixCode' => $mixCode
                );    
                $mixId = $this->Mix->add($toMix);
                
                for( $i=0; $i<count($tabac); $i++ )
                {
                    $this->Mix->addTabacToMix($mixId, $tabac[$i]['tabacId'], 
                            $tabac[$i]['tabacCategoryId'], $tabac[$i]['percent']);
                }
                exit('ok');                
            }
        }
    }        
    
    public function searchmixAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            if( empty($data) )
            {
                exit('Выбирите вкусы табаков для поиска');
            }
            
            if( count($data) == 1 && isset($data['onlySelected']) )
            {
                exit('Выбирите вкусы табаков для поиска');
            }            
            
            $onlySelected = 0;
            if(isset($data['onlySelected']))
            {
                $onlySelected = 1;
            }
            
            $serachResult = $this->Mix->searchMix($data, $onlySelected);
            for( $i=0; $i<count($serachResult); $i++ )
            {
                $serachResult[$i]['json'] =json_encode($serachResult[$i]['mixDetails']);
                $serachResult[$i]['shareDesc'] = '';
                for( $j=0; $j<count($serachResult[$i]['mixDetails']); $j++ )
                {
                    $serachResult[$i]['shareDesc'] .= $serachResult[$i]['mixDetails'][$j]['tabacCategoryTitle'].'-'.$serachResult[$i]['mixDetails'][$j]['tabacTitle'].': '.$serachResult[$i]['mixDetails'][$j]['percent'].'%; ';
                }
                $serachResult[$i]['shareDesc'] .= 'В колбу: '.$serachResult[$i]['waterDescription'];
            }
            $this->_view->serachResult = $serachResult;
//            var_dump($serachResult);exit;
            $this->_smarty->display('mix/search.tpl');            
        }
    }
    
    public function saveimgAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            $cnf = Zend_Registry::get('cnf');
            $mixDir = $cnf->path->images->mix;
            if (!file_exists($mixDir)) {
                mkdir($mixDir, 0777, TRUE);
                @chmod($mixDir, 0777);
            }   
            $fileDir = $mixDir.'/mix_card_'.$data['mixId'].'.png';
            if (!file_exists($fileDir)) 
            {
                $img = $data['img'];
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $result = file_put_contents($fileDir, base64_decode($img));
            }   
//            $this->Mix->setAsSaved($data['mixId']);
            exit('ok');
        }
    }    
    
    public function takeimgAction()
    {
        $id = $this->_request->getParam('id');
        if(empty($id))
            parent::redirect('#');
        $cnf = Zend_Registry::get('cnf');
        $mixDir = $cnf->path->images->mix;

        $fileDir = $mixDir.'/mix_card_'.$id.'.png';
        
        if (!file_exists($fileDir)) 
        {
            parent::redirect('#');
        }           
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($fileDir));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($fileDir));
        // читаем файл и отправляем его пользователю
        readfile($fileDir);
        exit;
    }        
}

