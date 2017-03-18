<?php

class ExclusiveController extends BaseController
{    
    public function indexAction()
    {

        $content = $this->Content->details(10);
        $this->_view->content = $content;        
        
        $exclAdded = false;
        if( isset($_SESSION['exclAdded']) )
        {
            unset($_SESSION['exclAdded']);
            $exclAdded = true;
        }        
        $this->_view->exclAdded = $exclAdded;
        
        $this->_view->pageTitle = $content['title'];
        $this->_view->styles = array('exclusive.css');        
        $this->_view->scripts = array('exclusive.js');        
//        parent:: setRightBlock(array('mostViewedProduct', 'mostBuyedProduct'));
        parent:: setMetaTags($content);
        parent:: setBread(array('Купить эксклюзивный кальян'));
        $this->_smarty->display('exclusive/index.tpl');
    }
    
    public function addexclAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            $data['dateAdded'] = date('Y-m-d H:i:s');
            $data['userId'] = 0;
            if(isset($_SESSION['user']))
            {
                $data['userId'] = $_SESSION['user']['userId'];
            }       
            
            if( !isset($data['description']) )
                $data['description'] = '';
            
            $data['imageOriginal'] = '';
            $tId = $this->Exclusive->add($data);
            
            if (!isset($_FILES) && isset($HTTP_POST_FILES))
                $_FILES = $HTTP_POST_FILES;

            $imgPath = '';
            if (!empty($_FILES['imageOriginal']['name'])) 
            {
                $files = array(
                    "imageOriginal"=>array(
                        "title"=> "imageOriginal",
                        "imagesDir"=>"images/exclusive/". $tId . "/",
                        "sizes"=> array(
                            "imageOriginal"=>"2048x2048"
                        ),
                        "cropSmart"=>false,
                        "cropSkip"=>false            
                      )
                );            
                $imgData = $this->_uploadPhotoNew($files);
                $this->Exclusive->save($imgData, $tId);
                
                $imgPath = 'images/exclusive/'. $tId .'/'.$imgData['imageOriginal'];
            }
            
            $letterSett = $this->Setting->getSetting('letter_count');
            $letterCount = (int)$letterSett['value'];

            if( $letterCount < 38 )
            {
                $cnf = Zend_Registry::get('cnf');
                $adminMail = $cnf->adminMail;
                $message = 'От: '.$data['firstName'].', E-mail: '.$data['email'].', Дата: '.$data['dateAdded'].', ВК: '.$data['vklink'].'. '.$data['description'];
                if( !empty($imgPath) )
                {
                    parent::sendMailFile($adminMail, 'Ace Hookah<manager@ace-hookah.com>', 'Новый именной', $message, $headers='', FALSE, $imgPath, $imgData['imageOriginal']);         
                }
                else
                {
                    parent::sendMail($adminMail, 'Ace Hookah<manager@ace-hookah.com>', 'Новый именной', $message);  
                }
                
                $newLetterCount = $letterCount + 3;
                $this->Setting->setSetting('letter_count', $newLetterCount);
            }            

            $_SESSION['exclAdded'] = 1;
            parent::redirect('exclusive');
        }
    }         
}