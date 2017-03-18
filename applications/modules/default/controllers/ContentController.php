<?php

class ContentController extends BaseController
{    
    public function viewAction()
    {
        $id = $this->_request->getParam('id');
        if(empty($id))
            parent::redirect('#');
        
        if( (int)$id !=0 )
        {
            $content = $this->Content->details($id);
            parent::redirect301('content/'.$content['url'].'.html');
        }
        
        $content = $this->Content->urlDetail($id);
        
        if( empty($content) )
            parent::redirect('#');
        
        $this->_view->content = $content;        
        
        $this->_view->pageTitle = $content['title'];
        
        $this->_view->current = $content['url'];
        $this->_view->styles = array('content.css');
        $this->_view->scripts = array('content.js');
        
        parent:: setBread(array($content['title']));
        parent:: setMetaTags($content);
        $this->_smarty->display('content/view.tpl');
    }
    
    public function addfeedbackAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            if (!$this->Validate->string($data['name'])) 
            {
                exit('Введите Ваше Имя!');
            }
            if(!$this->Validate->email($data['email']))
            {
                exit('Введите корректный e-mail.');
            }            
            if (!$this->Validate->string($data['comment'])) 
            {
                exit('Введите Ваш Вопрос!');
            }            
            $data['dateAdded'] = date('Y-m-d H:i:s');
            $this->Feedback->add($data);
            
            $letterSett = $this->Setting->getSetting('letter_count');
            $letterCount = (int)$letterSett['value'];
            
            if( $letterCount < 40 )
            {
                $message = 'От: '.$data['name'].', '.$data['email'].', '.$data['dateAdded'].' '.$data['content'];
                parent::sendMail('artem_zolkin@mail.ru', 'Ace Hookah<manager@ace-hookah.com>', 'Новое письмо обратной связи', $message, $headers='', FALSE);          
            
                $newLetterCount = $letterCount + 1;
                $this->Setting->setSetting('letter_count', $newLetterCount);
            }
            
            exit('ok');
        }
    }      
    
}