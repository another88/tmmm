<?php

class ErrorController extends BaseController 
{
    public function errorAction() 
    {
		$smarty = Zend_Registry::get('smarty');
		$errors2 = $this->_getParam('error_handler');

                switch ($errors2->type) { 
                        case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER: 
                        case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION: 
                                // 404 error -- controller or action not found 
                                $this->getResponse()->setHttpResponseCode(404); 
                                header('HTTP/1.0 404 Not Found'); 
                                
                                parent:: setBread(array('Ошибка страницы'));
                                parent:: setMetaTags(array('metaTitle'=>'404. Такой страницы не существует'));  
                                parent:: setRightBlock(array('mostViewedProduct'));
                                
                                $categorySm = $this->ProductCategory->listing(0, 1, array('approved'=>1, 'order'=>'Order by title ASC'));   
                                for( $i=0; $i<count($categorySm['data']); $i++ )
                                {
                                    $categorySm['data'][$i]['product'] = $this->Product->listing(0, 1, array('approved'=>1, 'productCategoryId'=>$categorySm['data'][$i]['productCategoryId']));
                                }
                                $this->_view->categorySm = $categorySm;

                                $this->_view->interestingList = $this->Content->listing(0, 1, array('isInteresting'=>1));

                                $this->_view->styles = array('sitemap.css');
                                $this->_view->pageTitle = '404. Такой страницы не существует!';
        
                                $this->_smarty->display('error.tpl');
                                exit();
//                                exit("<html>
//                                <head>
//                                    <base href='http://ace-hookah.com' />
//                                    <title>404. Такой страницы не существует.</title>
//                                    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
//                                    <link rel='icon' type='image/png' href='http://ace-hookah.com/icon/favicon.png' />
//                                    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300italic,300,400italic,700' rel='stylesheet' type='text/css'>
//                                    <link rel='stylesheet' href='http://ace-hookah.com/styles/main.css' type='text/css' />
//                                    <script type='text/javascript' src='http://ace-hookah.com/scripts/jquery-1.8.2.min.js'></script>
//                                    <script type='text/javascript' src='http://ace-hookah.com/scripts/jquery-ui-1.9.1.min.js'></script>                                     
//                                    <script type='text/javascript' src='http://ace-hookah.com/scripts/main.js'></script>
//                                   
//                                </head>
//                                <body id='top'>
//                                    <div id='mask'></div>
//                                    <header>
//                                        <div class='header_top'>
//                                            <div class='centerPage'>
//                                                <div class='top_header_menu_block'>
//                                                    <a href='http://ace-hookah.com/interesting'>Интересное</a>
//                                                </div>  
//                                                <div class='top_header_menu_block'>
//                                                    <a href='http://ace-hookah.com/content/contacts.html'>Контакты</a>
//                                                </div>  
//                                                <div class='top_header_menu_block'>
//                                                    <a href='http://ace-hookah.com/content/pay_delivery.html'>Оплата и Доставка</a>
//                                                </div>    
//                                                <div class='top_header_menu_block'>
//                                                    <a href='http://ace-hookah.com/testimonial'>Отзывы</a>
//                                                </div>                            
//                                                <div class='clr'></div>
//                                            </div>
//                                            <div class='clr'></div>
//                                        </div>
//                                        <div class='clr'></div>
//                                        <div class='header_middle'>
//                                            <div class='header_logo'></div>
//                                            <div class='header_logo_subs'>
//                                                <div class='header_divider'></div>
//                                                <div class='header_logo_subs_text'>
//                                                    Деревянные шахты, моющиеся шланги, оригинальные решения
//                                                    <div class='header_phone'>
//                                                        +7<span class='color_orange'>(978)</span>739-04-99
//                                                    </div>
//                                                    <div class='header_phone'>
//                                                        +7<span class='color_orange'>(978)</span>719-98-87
//                                                    </div> 
//                                                    <div class='header_email'>
//                                                        manager<span class='color_orange'>@</span>ace-hookah.com
//                                                    </div>                             
//                                                    <div class='clr'></div>
//                                                </div>
//                                                <div class='header_divider'></div>
//                                                <div class='clr'></div>
//                                            </div>
//                                            <div class='clr'></div>
//                                        </div>
//                                        <div class='clr'></div>
//                                        <div class='header_menu'>
//                                            <div class='centerPage'>
//                                                <div class='header_menu_block home_icon'></div>
//                                                <div class='header_menu_block'>
//                                                    <a href='http://ace-hookah.com/catalog/hookah.html'>Кальяны</a>
//                                                </div>   
//                                                <div class='header_menu_block'>
//                                                    <a href='http://ace-hookah.com/catalog/shaft.html'>Шахты</a>
//                                                </div>   
//                                                <div class='header_menu_block'>
//                                                    <a href='http://ace-hookah.com/catalog/hose.html'>Шланги</a>
//                                                </div>                                                   
//                                                <div class='header_menu_block'>
//                                                    <a href='http://ace-hookah.com/constructor'>Конструктор</a>
//                                                </div>     
//                                                <div class='header_menu_block'>
//                                                    <a href='http://ace-hookah.com/ourwork'>портфолио</a>
//                                                </div>      
//                                                <div class='header_menu_block'>
//                                                    <a href='http://ace-hookah.com/mix'>миксы</a>
//                                                </div>    
//                                                <div class='header_menu_block'>
//                                                    <a href='http://ace-hookah.com/special'>Дешевле</a>
//                                                </div>    
//                                                <div class='header_menu_block last_menu_block'>
//                                                    <a href='http://ace-hookah.com/taste'>Попробовать</a>
//                                                </div>                                
//                                                <div class='clr'></div>
//                                            </div>
//                                            <div class='clr'></div>
//                                        </div>
//                                        <div class='clr'></div>
//                                    </header>
//                                    <div id='content'><div class='contentInner'><h1>Ошибка 404. Такой страницы не существует.</h1></div></div>
//                                    <div class='clr'></div>
//                                    <footer>
//                                        <div class='centerPage'>
//                                            <div class='footer_menu_block'>
//                                                <a href='http://ace-hookah.com/catalog/hookah.html'>Кальяны</a>
//                                            </div>   
//                                            <div class='footer_menu_block'>
//                                                <a href='http://ace-hookah.com/catalog/shaft.html'>Шахты</a>
//                                            </div>   
//                                            <div class='footer_menu_block'>
//                                                <<a href='http://ace-hookah.com/catalog/hose.html'>Шланги</a>
//                                            </div>                       
//                                            <div class='footer_menu_block'>
//                                                <a href='http://ace-hookah.com/constructor'>Конструктор</a>
//                                            </div>   
//                                            <div class='footer_menu_block'>
//                                                <a href='http://ace-hookah.com/ourwork'>портфолио</a>
//                                            </div>   
//                                            <div class='footer_menu_block'>
//                                                <a href='http://ace-hookah.com/mix'>миксы</a>
//                                            </div>   
//                                            <div class='footer_menu_block'>
//                                                <a href='http://ace-hookah.com/special'>Дешевле</a>
//                                            </div>   
//                                            <div class='footer_menu_block'>
//                                                <a href='http://ace-hookah.com/taste'>Попробовать</a>
//                                            </div>   
//                                            <div class='footer_menu_block'>
//                                                <a href='http://ace-hookah.com/interesting'>Интересное</a>
//                                            </div>                       
//                                            <div class='footer_menu_block'>
//                                                <a href='http://ace-hookah.com/content/pay_delivery.html'>Оплата и Доставка</a>
//                                            </div>   
//                                            <div class='footer_menu_block last_menu_block'>
//                                                <a href='http://ace-hookah.com/content/contacts.html'>Контакты</a>
//                                            </div>        
//                                            <div class='clr'></div><br/><br/><br/>
//                                            <div class='socialFooter'>
//                                                <div class='footer_social_button vk' onclick='window.open(\"http://vk.com/hookah_ace\");'></div>
//                                                <div class='footer_social_button fb' onclick='window.open(\"https://www.facebook.com/pages/Ace-Hookah/530153360452187\");'></div>
//                                                <div class='footer_social_button tw last_menu_block' onclick='window.open(\"https://twitter.com/hookahace\");'></div>
//                                                <div class='clr'></div>
//                                            </div>
//                                            <div class='clr'></div><br/><br/><br/>
//                                            <div class='authorFooter'>
//                                                &copy; ace-hookah.com
//                                            </div>                    
//                                            <div class='clr'></div>
//                                        </div>
//                                        <div class='clr'></div>          
//                                    </footer>
//                                    <div class='clr'></div></body></html>");
                                break; 
                        default: 
                                // application error 
                                $this->getResponse()->setHttpResponseCode(500); 
//                                $smarty->assign('message', 'Application error');
                                break; 
                } 

                $errors = $errors2->exception;
                Zend_Debug::dump($errors);exit;
                if($errors->getTrace()) {
                    $sql = $errors->getTrace();
                    if(is_string($sql[0]['args'][0]))
                        $sql = '<br><h3>Возможный неправильный SQL запрос</h3><br/>'.$sql[0]['args'][0];
                    else
                        $sql = '';
                } else
                    $sql='';
				if ( isset($_REQUEST['debug'])  )	{
					echo('<div style="  width:100%; 
										text-align: center; 
										font-size:20px; 
										fornt-weight:bold;
										border: 1px solid red;
										background-color: #ff9999;
										padding: 20px 0px;
						">
						<br />'.$errors->getMessage().$sql.'                      
					</div>');
					var_dump($errors);
                }
                exit;
    }
}

?>