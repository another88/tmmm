<?php

class WholesaleController extends BaseController
{    
    public function indexAction()
    {
        $this->_view->styles = array('wholesale.css'); 
        $this->_view->pageTitle = 'Сотрудничество';
        parent:: setBread(array('Сотрудничество'));
        parent:: setMetaTags('wholesale');
        $this->_smarty->display('wholesale/index.tpl');
    }
    
    public function addsubcribeAction()
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
            
            $this->Subscribe->add($data);
            
            if( $data['subsType'] == 'user' )
            {
                $message = '<html>
                    <body style="margin: 0; padding: 0; font-size: 12px; color: black; line-height: 20px; background-color: white; width: 870px;">
                        <div style="height: 207px; background-color: black; padding: 15px 0; width: 870px;">
                            <div style="float: none; height: 70px; margin: 35px auto 0; width: 285px;">
                                <img src="http://ace-hookah.com/i/logo.png" width="285" height="70" />
                            </div>
                            <div style="float: none; height: 42px; margin: 35px auto 0; width: 490px;">
                                <div style="width: 39em; text-transform: uppercase; color: white;;">
                                    Деревянные шахты, моющиеся шланги, оригинальные решения
                                    <div style="color: white; float: left; width: 22.91%; margin-right: 26px;">
                                        +7<span style="color: #ef9a20;">(978)</span>739-04-99
                                    </div>
                                    <div style="color: white; float: left; width: 22.91%; margin-right: 26px;">
                                        +7<span style="color: #ef9a20;">(978)</span>719-98-87
                                    </div> 
                                    <div style="color: white; float: left; width: 41.87%;">
                                        manager<span style="color: #ef9a20;">@</span>ace-hookah.com
                                    </div>                             
                                    <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                </div>
                                <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                            </div>
                            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                        </div>
                        <div style="clear: both; height: 0; padding: 0; margin: 0 0 20px 0; overflow: hidden; font-size: 0;"></div>
                        '.$data['name'].', Вы успешно подписались на рассылку новостей от компании Ace Hookah. Обещаем присылать Вам только самое интересное. Спасибо, что с нами.'
                        . '<div style="clear: both; height: 0; padding: 0; margin: 0 0 20px 0; overflow: hidden; font-size: 0;"></div>'
                        . 'С ув. команда Ace Hookah.'
                        . '</body></html>';    
                
                $letterSett = $this->Setting->getSetting('letter_count');
                $letterCount = (int)$letterSett['value'];

                if( $letterCount < 40 )
                {
                    parent::sendMail('artem_zolkin@mail.ru, '.$data['email'], 'Ace Hookah<manager@ace-hookah.com>', 'Успешная подписка', $message, $headers='', FALSE);              

                    $newLetterCount = $letterCount + 1;
                    $this->Setting->setSetting('letter_count', $newLetterCount);
                }
            }

            exit('ok');
        }
    }        
    
}