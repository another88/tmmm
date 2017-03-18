<?php

class CheckoutController extends BaseController
{
    public function init()
    {
        parent::init();
        $this->_view->current = 'checkout';
    }
    
    public function letterAction()
    {
        $this->_view->cart = $_SESSION['cart'];
        $this->_smarty->display('checkout/letter.tpl');
    }    
    
    public function indexAction()
    {
        $cart = array();
        if( isset($_SESSION['cart']) )
        {
            $cart = $_SESSION['cart'];
        }
        else
        {
            parent::redirect('#');
        }
        $constructorIsset = false;
        foreach($cart as $k => $v)
        {
            if( (int)$k == 0 )
            {
                $cart[$k]['elementsJSON'] = json_encode($v['elements']);
                $constructorIsset = true;
            }
        }
//        var_dump($cart);exit;
        $this->_view->cart = $cart;
        $this->_view->constructorIsset = $constructorIsset;
        
        if( $constructorIsset )
        {
            $data = array(
                'shaxta' => array(
                    'title' => 'Шахта',
                    'code' => 'shaxta',
                    'data' =>  $this->ConsShaxta->getData()
                ),          
                'kolba' => array(
                    'title' => 'Колба',
                    'code' => 'kolba',
                    'data' =>  $this->ConsKolba->getData()
                ),      
                'trybka' => array(
                    'title' => 'Шланг',
                    'code' => 'trybka',
                    'data' =>  $this->ConsTrybka->getData()
                ),                      
                'bowl' => array(
                    'title' => 'Чаша',
                    'code' => 'bowl',
                    'data' =>  $this->ConsBowl->getData()
                ),            
                'bludce' => array(
                    'title' => 'Блюдце',
                    'code' => 'bludce',
                    'data' => $this->ConsBludce->getData()
                ),
                'shipci' => array(
                    'title' => 'Щипцы',
                    'code' => 'shipci',
                    'data' =>  $this->ConsShipci->getData()
                ),

            );
            $this->_view->json = json_encode($data);            
        }
        
        $this->_view->pageTitle = 'последний шаг оформления заказа';
        $this->_view->scripts = array('checkout.js' 
//            ,'jqscrollbox/jquery.scrollbox.min.js'
            );
        $this->_view->styles = array('checkout.css');        
        parent:: setBread(
                array(
                    'Корзина заказа'
                )
        );
        parent:: setMetaTags($this->Meta->getMeta('checkout'));
        parent:: setRightBlock(array('productLike'));
//        var_dump($this->_view->productLike);exit;
        $this->_smarty->display('checkout/index.tpl');
    }
    
    public function onclickAction()
    {
        if ($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if (!$this->Validate->id($data['productId'])) 
            {
                exit ('Ошибка определения товара. Попробуйте перезагрузить страницу и попробовать снова.');    
            }  
            if (!$this->Validate->string($data['name'])) 
            {
                exit ('Введите Ваше Имя.');    
            }            
            if(!$this->Validate->email($data['email']))
            {
                exit('Введите корректный e-mail.');
            }
            if(!$this->Validate->phone($data['phone'])) 
            {
                exit ('Введите Ваш Телефон. Например +79785555555');    
            }
            $data['dateAdded'] = date('Y-m-d H:i:s');
            $data['userId'] = 0;
            if(isset($_SESSION['user']))
            {
                $data['userId'] = $_SESSION['user']['userId'];
            }
            
            if(empty($data['city']))
                $data['city'] = '';
            
            if(empty($data['deliveryType']))
                $data['deliveryType'] = 'samo';            
            
            $productDetails = $this->Product->details($data['productId']);
            if( empty($productDetails) )
            {
                exit ('Ошибка определения товара. Попробуйте перезагрузить страницу и попробовать снова.');  
            }
            if( $productDetails['approved'] == 0 )
            {
                exit ('Ошибка определения товара. Попробуйте перезагрузить страницу и попробовать снова.');  
            }            
            $data['price'] = $productDetails['price'];
            $isUserSale = $this->Setting->getSetting('reg_user_sale');
            if( isset($_SESSION['user']) && $isUserSale )
            {
                $discount = $data['price']*($isUserSale['value']/100);
                $data['price'] = $data['price'] - $discount;
            }
                    
            $this->Product->addProductCount($data['productId'], 'buy');
            $buyId = $this->BuyOnClick->add($data);
            
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
                        <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                        <table style="width: 870px; border: none; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <td style="padding: 10px; background-color: black; border: 2px solid black; color: #ef9a20; text-transform: uppercase;">
                                        Картинка
                                    </td>
                                    <td style="padding: 10px; background-color: black; border: 2px solid black; color: #ef9a20; text-transform: uppercase;">
                                        Название
                                    </td> 
                                    <td style="padding: 10px; background-color: black; border: 2px solid black; color: #ef9a20; text-transform: uppercase;">
                                        Цена
                                    </td>
                                </tr>
                            </thead>
                            <tbody>';               
                

                    $message .= '<tr>
                                    <td style="padding: 10px; border: 2px solid black; text-align: center;" width="10%">';
                    if( $productDetails['imageSmall'] )
                    {
                        $message .= '<img src="http://ace-hookah.com/images/product/'.$productDetails['productId'].'/'.$productDetails['imageSmall'].'" />';
                    }                
                    $message .= '</td>';
                    $message .= '<td style="padding: 10px; border: 2px solid black; text-align: left;" width="40%">
                                    <a href="http://ace-hookah.com/product/'.$productDetails['url'].'.html" target="_blank" style="color: #EF9A20; text-decoration: underline; font-size: 14px;">'.$productDetails['title'].'</a>
                                </td>';
                    $message .= '<td style="padding: 10px; border: 2px solid black; text-align: center;" width="15%">
                                    '.$productDetails['price'].' рублей
                                </td>
                            </tr>';                    
                $message .= '</tbody>
                        </table> 
                        <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                        <div style="width: 870px; padding: 10px 0; background-color: black; color: white; font-size: 14px;">';
                
                if( isset($_SESSION['user']) && $isUserSale )
                {
                    $message .= '<div style="padding: 10px 0; float: right; width: 270px;">
                                     <div style="text-align: right; float: left; width: 160px; margin-right: 10px; font-weight: bold;">
                                         Стоимость без скидки:
                                     </div>
                                     <div style="text-align: left; float: left; width: 88px; color: #ef9a20;">
                                         '.$productDetails['price'].' рублей
                                     </div>                    
                                     <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                 </div>
                                 <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                 <div style="padding: 10px 0; float: right; width: 270px;">
                                     <div style="text-align: right; float: left; width: 160px; margin-right: 10px; font-weight: bold;">
                                         Скидка:
                                     </div>
                                     <div style="text-align: left; float: left; width: 88px; color: #ef9a20;">
                                         '.$discount.' рублей
                                     </div>                    
                                     <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                 </div>
                                 <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>';
                }
                
                $message .= ' <div style="padding: 10px 0; float: right; width: 340px;">
                                    <div style="text-align: left; float: right; width: 105px; color: #ef9a20;">
                                        '.$data['price'].' рублей
                                    </div>                       
                                    <div style="text-align: right; float: right; width: 160px; margin-right: 10px; font-weight: bold;">
                                        Стоимость заказа:
                                    </div>
                                    <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                </div>
                                <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                            </div>        
                            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div><br/>
                            <div style="padding: 10px 12px; font-size: 13px; width: 846px;">';
                
                $message .= $data['name'];
                
                $message .= ', Благодарим за покупку на сайте <a href="http://ace-hookah.com" target="_blank" style="color: #EF9A20; text-decoration: underline; font-size: 14px;">ace-hookah.com</a>. 
            Номер вашего заказа <span style="color: #ef9a20;">OC_'.$buyId.'</span>.
            Наш менеджер свяжется с Вами в близжайшее время.
            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
            Просим Вас оценить работу сайта и нашей команды по ссылке: <a href="http://ace-hookah.com/testimonial" target="_blank" style="color: #EF9A20; text-decoration: underline; font-size: 14px;">оставить отзыв</a>.
            </div>
            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
            <div style="padding: 10px 12px; font-size: 13px; width: 846px;">
                Ваши данные при оформлении заказа:<br/>
                <strong>Имя:</strong> '.$data['name'].'<br/>
                <strong>Город:</strong> '.$data['city'].'<br/>
                <strong>Телефон:</strong> '.$data['phone'].'<br/>
                <strong>E-mail:</strong> '.$data['email'].'<br/>
                <strong>Способ доставки:</strong> '; 

            if($data['deliveryType']=='samo')
                $message .= 'Самовывоз';
            else
                $message .= 'Траспортной компанией';

            $message .= '<br/>
            </div> 
            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>';

//            if( $data['deliveryType']=='company' )
//            {
//                $message .= '<div style="padding: 10px 12px; font-size: 13px; width: 846px;">
//                    При выборе доставки "Транспортной компанией" Вам необходимо проплатить заказ и сообщить о проплате 
//                    по номеру +7 978 739 04 99 или написать письмо по адрес manager@ace-hookah.com. Далее при получении
//                    оплаты мы упаковываем заказ и высылаем его Вам. Если возникли вопросы, то звоните по номеру +7 978 739 04 99.
//                    <br/><br/>
//                    <strong>Реквизиты для оплаты:</strong><br/>
//                    Банк получателя - РНКБ (ПАО)
//                    к/с 30101810335100000607 в отделении Банка России по Республике Крым
//                    БИК 043510607, ИНН 7701105460, КПП 910201001
//                    Счет получателя 30232810440002000004
//
//                    Если на карту, то Назначение платежа - пополнение карты 6054700051083654 Золкин Артем Юрьевич
//
//                    Если на счет, то счет получателя заменить на  40817810640070014554
//                </div>    
//                <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>';
//            }

            $messageToClient = $message.'<div style="padding: 10px 12px; font-size: 13px; width: 846px;">
                            С уважением, компания Ace Hookah.
                            <img src="http://ace-hookah.com/script/ckech_email.php?type=oc&id='.$buyId.'" />
                        </div>            
                        <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                    </body>
                </html>';
            
            $messageToAdmin = $message.'<div style="padding: 10px 12px; font-size: 13px; width: 846px;">
                            С уважением, компания Ace Hookah.
                        </div>            
                        <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                    </body>
                </html>';            
                
            $letterSett = $this->Setting->getSetting('letter_count');
            $letterCount = (int)$letterSett['value'];
            
            if( $letterCount < 38 )
            {
                $cnf = Zend_Registry::get('cnf');
                $adminMail = $cnf->adminMail;                
                parent::sendMail($data['email'], 'Ace Hookah<manager@ace-hookah.com>', 'Ваш заказ на сайте Ace Hookah', $messageToClient);
                parent::sendMail($adminMail, 'Ace Hookah<manager@ace-hookah.com>', 'Новый заказ в один клик', $messageToAdmin);            
            
                $newLetterCount = $letterCount + 3;
                $this->Setting->setSetting('letter_count', $newLetterCount);
            }
            exit('ok');
        }        
    }
    
    public function addtocartAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            if(!isset($_SESSION['cart']))
            {
                $_SESSION['cart'] = array();
            }
            
            if(empty($data['productId'])) 
            {
                exit('Ошибка продукта!');
            }
            
            if(empty($data['amount'])) 
            {
                $data['amount'] = 1;
            }            
                
            $uniKey = $data['productId'];            
            $productDetails = $this->Product->details($data['productId']);
            
            if(empty($_SESSION['cart'][$uniKey])) 
            {
                $_SESSION['cart'][$uniKey] = array();
                $_SESSION['cart'][$uniKey]['details'] = $productDetails;
                $_SESSION['cart'][$uniKey]['uniKey'] = $uniKey;
                $_SESSION['cart'][$uniKey]['amount'] = $data['amount'];
            } 
            else 
            {
                $_SESSION['cart'][$uniKey]['amount'] += $data['amount'];
            }
            parent::recalculateCart();
            $this->_smarty->display('cart.tpl');
        }
    }    
    
    public function removefromcartAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            if(empty($data['productId']))
            {
                exit('Ошибка удаления!');
            }
            if(isset($_SESSION['cart']))
            {
                if(!empty($_SESSION['cart'][$data['productId']]))
                {
                    if($_SESSION['cart'][$data['productId']]['amount'] == 1)
                    {
                        unset($_SESSION['cart'][$data['productId']]);
                    }
                    else
                    {
                        $_SESSION['cart'][$data['productId']]['amount']--;
                    }
                }
                parent::recalculateCart();
                $this->_smarty->display('cart.tpl');
            }
        }
    }    
    
    public function recalculateAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            if(empty($data['uniKey']) || empty($data['amount']))
            {
                exit('Ошибка! Попробуйте перезагрузить страницу и попробовать сново.');
            }
            if(isset($_SESSION['cart']))
            {
                if(isset($_SESSION['cart'][$data['uniKey']]))
                {                
                    $_SESSION['cart'][$data['uniKey']]['amount'] = $data['amount'];
                }
            }
            parent::recalculateCart();
            exit('ok');
        }
    }        
    
    public function orderAction()
    {
        if ($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if(isset($_SESSION['cart']))
            {
                if (!$this->Validate->string($data['firstName'])) 
                {
                    exit ('Введите Ваше Имя.');    
                }
                if (!$this->Validate->string($data['lastName'])) 
                {
                    exit ('Введите Вашу Фамилию.');    
                }
                if (!$this->Validate->string($data['country'])) 
                {
                    exit ('Введите Вашу Страну.');    
                }
                if (!$this->Validate->string($data['city'])) 
                {
                    exit ('Введите Ваш Город.');    
                }
                if (!$this->Validate->phone($data['phone'])) 
                {
                    exit ('Введите Ваш Телефон.');    
                }            
                if(!$this->Validate->email($data['email']))
                {
                    exit('Введите корректный e-mail.');
                }    
                $data['userId'] = 0;
                if( isset($_SESSION['user']) )
                {
                    $data['userId'] = $_SESSION['user']['userId'];
                }
                $data['dateAdded'] = date('Y-m-d H:i:s');
                $data['price'] = $_SESSION['cartPrice']['orderPrice'];
                $data['discount'] = $_SESSION['cartPrice']['discount'];
                $data['adminComment'] = '';
                $data['isHaveConstructor'] = 0;
                foreach($_SESSION['cart'] as $k => $v)
                {
                    if( (int)$k == 0 )
                    {
                        $data['isHaveConstructor'] = 1;
                    }
                }                
                $orderId = $this->Order->add($data);
                
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
                        <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                        <table style="width: 870px; border: none; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <td style="padding: 10px; background-color: black; border: 2px solid black; color: #ef9a20; text-transform: uppercase;">
                                        Картинка
                                    </td>
                                    <td style="padding: 10px; background-color: black; border: 2px solid black; color: #ef9a20; text-transform: uppercase;">
                                        Название
                                    </td> 
                                    <td style="padding: 10px; background-color: black; border: 2px solid black; color: #ef9a20; text-transform: uppercase;">
                                        Цена
                                    </td>
                                    <td style="padding: 10px; background-color: black; border: 2px solid black; color: #ef9a20; text-transform: uppercase;">
                                        Количество
                                    </td>     
                                    <td style="padding: 10px; background-color: black; border: 2px solid black; color: #ef9a20; text-transform: uppercase;">
                                        Стоимость позиции
                                    </td> 
                                </tr>
                            </thead>
                            <tbody>';                

                foreach( $_SESSION['cart'] as $k => $v )
                {
                    $message .= '<tr>
                                    <td style="padding: 10px; border: 2px solid black; text-align: center;" width="10%">';
                    if( $v['details']['imageSmall'] )
                    {
                        $message .= '<img src="http://ace-hookah.com/images/product/'.$v['details']['productId'].'/'.$v['details']['imageSmall'].'" />';
                    }                
                    $message .= '</td>';
                    if( (int)$k == 0 )
                    {                    
                        $consBludce = array(
                            'id' => 0,
                            'image' => ''
                        );
                        $consBowl = array(
                            'id' => 0,
                            'image' => ''
                        );
                        $consKolba = array(
                            'id' => 0,
                            'image' => ''
                        );
                        $consTrybka = array(
                            'id' => 0,
                            'image' => ''
                        );                       
                        $consShaxta = array(
                            'id' => 0,
                            'image' => ''
                        );
                        $consShipci = array(
                            'id' => 0,
                            'image' => ''
                        );
                        
                        foreach( $v['elements'] as $cid => $cv)
                        {
                            if( isset($cv['consShaxtaId']) )
                            {
                                $consShaxta = array(
                                    'id' => $cv['elementId'],
                                    'image' => 'images/'.$cv['imageDir'].'/'.$cv['elementId'].'/'.$cv['imageSmall']
                                );                                
                            }
                            elseif( isset($cv['consKolbaId']) )
                            {
                                $consKolba = array(
                                    'id' => $cv['elementId'],
                                    'image' => 'images/'.$cv['imageDir'].'/'.$cv['elementId'].'/'.$cv['imageSmall']
                                );                                  
                            }
                            elseif( isset($cv['consTrybkaId']) )
                            {
                                $consTrybka = array(
                                    'id' => $cv['elementId'],
                                    'image' => 'images/'.$cv['imageDir'].'/'.$cv['elementId'].'/'.$cv['imageSmall']
                                );                                  
                            }
                            elseif( isset($cv['consBowlId']) )
                            {
                                $consBowl = array(
                                    'id' => $cv['elementId'],
                                    'image' => 'images/'.$cv['imageDir'].'/'.$cv['elementId'].'/'.$cv['imageSmall']
                                );                                  
                            }
                            elseif( isset($cv['consBludceId']) )
                            {
                                $consBludce = array(
                                    'id' => $cv['elementId'],
                                    'image' => 'images/'.$cv['imageDir'].'/'.$cv['elementId'].'/'.$cv['imageSmall']
                                );                                  
                            }
                            elseif( isset($cv['consShipciId']) )
                            {
                                $consShipci = array(
                                    'id' => $cv['elementId'],
                                    'image' => 'images/'.$cv['imageDir'].'/'.$cv['elementId'].'/'.$cv['imageSmall']
                                );                                  
                            }                            
                        }
                        
                        $toOrderProduct = array(
                            'orderId' => $orderId,
                            'productId' => 0,
                            'price' => $v['details']['price'],
                            'totalPrice' => $v['allPrice'],
                            'amount' => $v['amount'],
                            'consBludceId' => $consBludce['id'],
                            'consBowlId' => $consBowl['id'],
                            'consKolbaId' => $consKolba['id'],
                            'consTrybkaId' => $consTrybka['id'],                            
                            'consShaxtaId' => $consShaxta['id'],
                            'consShipciId' => $consShipci['id']
                        );
                        $toConstructorBase = array(
                            'author' => $data['firstName'].' '.$data['lastName'],
                            'bludceId' => $consBludce['id'],
                            'bowlId' => $consBowl['id'],
                            'kolbaId' => $consKolba['id'],
                            'trybkaId' => $consTrybka['id'],                             
                            'shaxtaId' => $consShaxta['id'],
                            'shipciId' => $consShipci['id']
                        );        
                        
                        // ПРоверка на ижентичность
                        if($this->Constructor->checkParam($toConstructorBase))
                        {
                            $this->Constructor->add($toConstructorBase);
                        }
                        
                        $message .= '<td style="padding: 10px; border: 2px solid black; text-align: left;" width="40%">
                                        <div style="float: left; width: 83px; margin-right: 2px;">
                                            <div style="width: 79px; height: 138px;" class="conShaxta conElement">
                                                <img width="79px" src="http://ace-hookah.com/'.$consShaxta['image'].'">
                                            </div>
                                            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                            <div style="width: 79px; height: 79px; margin-top: 2px;" class="conKolba conElement">
                                                <img width="79px" src="http://ace-hookah.com/'.$consKolba['image'].'">
                                            </div>
                                            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>                                    
                                        </div>
                                        <div style="float: left; width: 113px;">
                                            <div style="width: 106px; height: 106px;">
                                                <img width="106px" src="http://ace-hookah.com/'.$consTrybka['image'].'">
                                            </div>
                                            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                            <div style="margin-top: 2px; width: 50px; height: 50px; float: left; margin-right: 2px;">
                                                <img width="50px" src="http://ace-hookah.com/'.$consBowl['image'].'">
                                            </div>
                                            <div style="width: 50px; height: 50px; margin-top: 2px; float: left;">
                                                <img width="50px" src="http://ace-hookah.com/'.$consBludce['image'].'">
                                            </div>
                                            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                            <div style="width: 50px; height: 50px; margin-top: 2px;">
                                                <img width="50px" src="http://ace-hookah.com/'.$consShipci['image'].'">
                                            </div>
                                            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>                                   
                                        </div>  
                                    </td>';                        
                    }
                    else
                    {
                        $toOrderProduct = array(
                            'orderId' => $orderId,
                            'productId' => $v['details']['productId'],
                            'price' => $v['details']['price'],
                            'totalPrice' => $v['allPrice'],
                            'amount' => $v['amount'],
                            'consBludceId' => 0,
                            'consBowlId' => 0,
                            'consKolbaId' => 0,
                            'consTrybkaId' => 0,                            
                            'consShaxtaId' => 0,
                            'consShipciId' => 0
                        );    
                        
                        $message .= '<td style="padding: 10px; border: 2px solid black; text-align: left;" width="40%">
                                        <a href="http://ace-hookah.com/product/'.$v['details']['url'].'.html" target="_blank" style="color: #EF9A20; text-decoration: underline; font-size: 14px;">'.$v['details']['title'].'</a>
                                    </td>';
                        
                    }
                        $message .= '<td style="padding: 10px; border: 2px solid black; text-align: center;" width="15%">
                                        '.$v['details']['price'].' рублей
                                    </td>
                                    <td style="padding: 10px; border: 2px solid black; text-align: center;" width="10%">
                                        '.$v['amount'].'
                                    </td>     
                                    <td style="padding: 10px; border: 2px solid black; text-align: center;" width="25%">
                                        '.$v['allPrice'].' рублей
                                    </td> 
                                </tr>';                    
                    $this->OrderProduct->add($toOrderProduct);
                    $this->Product->addProductCount($v['details']['productId'], 'buy');
                }

                $message .= '</tbody>
                        </table> 
                        <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                        <div style="width: 870px; padding: 10px 0; background-color: black; color: white; font-size: 14px;">';
                
                if( $_SESSION['cartPrice']['discount'] )
                {
                    $message .= '<div style="padding: 10px 0; float: right; width: 340px;">
                                     <div style="text-align: left; float: right; width: 105px; color: #ef9a20;">
                                         '.$_SESSION['cartPrice']['totalProductsPrice'].' рублей
                                     </div>                          
                                     <div style="text-align: right; float: right; width: 160px; margin-right: 10px; font-weight: bold;">
                                         Стоимость без скидки:
                                     </div>
                                     <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                 </div>
                                 <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                 <div style="padding: 10px 0; float: right; width: 340px;">
                                     <div style="text-align: left; float: right; width: 105px; color: #ef9a20;">
                                         '.$_SESSION['cartPrice']['discount'].' рублей
                                     </div>                                    
                                     <div style="text-align: right; float: right; width: 160px; margin-right: 10px; font-weight: bold;">
                                         Скидка:
                                     </div>
                                     <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                 </div>
                                 <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>';
                }
                
                $message .= ' <div style="padding: 10px 0; float: right; width: 340px;">
                                    <div style="text-align: left; float: right; width: 105px; color: #ef9a20;">
                                        '.$_SESSION['cartPrice']['orderPrice'].' рублей
                                    </div>                      
                                    <div style="text-align: right; float: right; width: 160px; margin-right: 10px; font-weight: bold;">
                                        Стоимость заказа:
                                    </div>
                                    <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                                </div>
                                <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                            </div>        
                            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div><br/>
                            <div style="padding: 10px 12px; font-size: 13px; width: 846px;">';
                
                $message .= $data['firstName'].' '.$data['lastName']; 
                
                $message .= ', Благодарим за покупку на сайте <a href="http://ace-hookah.com" target="_blank" style="color: #EF9A20; text-decoration: underline; font-size: 14px;">ace-hookah.com</a>. 
                    Номер вашего заказа <span style="color: #ef9a20;">B_'.$orderId.'</span>.
                    Наш менеджер свяжется с Вами в близжайшее время.
                    <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                    Просим Вас оценить работу сайта и нашей команды по ссылке: <a href="http://ace-hookah.com/testimonial" target="_blank" style="color: #EF9A20; text-decoration: underline; font-size: 14px;">оставить отзыв</a>.
                    </div>
                    <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                    <div style="padding: 10px 12px; font-size: 13px; width: 846px;">
                        Ваши данные при оформлении заказа:<br/>
                        <strong>Имя:</strong> '.$data['firstName'].'<br/>
                        <strong>Фамилия::</strong> '.$data['lastName'].'<br/>
                        <strong>Страна:</strong> '.$data['country'].'<br/>
                        <strong>Город:</strong> '.$data['city'].'<br/>
                        <strong>Телефон:</strong> '.$data['phone'].'<br/>
                        <strong>E-mail:</strong> '.$data['email'].'<br/>
                        <strong>Способ доставки:</strong> '; 

                if($data['deliveryType']=='samo')
                    $message .= 'Самовывоз';
                else
                    $message .= 'Траспортной компанией';

                $message .= '<br/><strong>Комментарий, адрес доставки:</strong>'.$data['comment'].'<br/>
                </div> 
                <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>';

//                if( $data['deliveryType']=='company' )
//                {
//                    $message .= '<div style="padding: 10px 12px; font-size: 13px; width: 846px;">
//                        При выборе доставки "Транспортной компанией" Вам необходимо проплатить заказ и сообщить о проплате 
//                        по номеру +7 978 739 04 99 или написать письмо по адрес manager@ace-hookah.com. Далее при получении
//                        оплаты мы упаковываем заказ и высылаем его Вам. Если возникли вопросы, то звоните по номеру +7 978 739 04 99.
//                        <br/><br/>
//                        <strong>Реквизиты для оплаты:</strong><br/>
//                        Банк получателя - РНКБ (ПАО)
//                        к/с 30101810335100000607 в отделении Банка России по Республике Крым
//                        БИК 043510607, ИНН 7701105460, КПП 910201001
//                        Счет получателя 30232810440002000004
//
//                        Если на карту, то Назначение платежа - пополнение карты 6054700051083654 Золкин Артем Юрьевич
//
//                        Если на счет, то счет получателя заменить на  40817810640070014554
//                    </div>    
//                    <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>';
//                }

                $messageToClient = $message.'<div style="padding: 10px 12px; font-size: 13px; width: 846px;">
                                С уважением, компания Ace Hookah.
                                <img src="http://ace-hookah.com/script/ckech_email.php?type=cart&id='.$orderId.'" />
                            </div>            
                            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                        </body>
                    </html>';

                $messageToAdmin = $message.'<div style="padding: 10px 12px; font-size: 13px; width: 846px;">
                                С уважением, компания Ace Hookah.
                            </div>            
                            <div style="clear: both; height: 0; padding: 0; margin: 0; overflow: hidden; font-size: 0;"></div>
                        </body>
                    </html>';            

                $letterSett = $this->Setting->getSetting('letter_count');
                $letterCount = (int)$letterSett['value'];
                
                if( $letterCount < 38 )
                {
                    $cnf = Zend_Registry::get('cnf');
                    $adminMail = $cnf->adminMail;     

                    parent::sendMail($data['email'], 'Ace Hookah<manager@ace-hookah.com>', 'Ваш заказ на сайте Ace Hookah', $messageToClient);
                    parent::sendMail($adminMail, 'Ace Hookah<manager@ace-hookah.com>', 'Новый заказ', $messageToAdmin);           

                    $newLetterCount = $letterCount + 3;
                    $this->Setting->setSetting('letter_count', $newLetterCount);
                }
                
                if (isset($_SESSION['cart']))
                {
                    unset($_SESSION['cart']);     
                }
                if (isset($_SESSION['cartPrice']))
                {
                    unset($_SESSION['cartPrice']);
                }                  
                exit('ok');
            }            
        }        
    }    
    
    public function changeconselementAction()
    {
        if ($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if(!isset($_SESSION['cart']) || empty($data) || !isset($_SESSION['cart'][$data['unikey']]))
            {
                exit('Ошибка данных.');
            }
            
            $findElement = '';
            switch($data['code'])
            {
                case 'shaxta':
                        $consElDet = $this->ConsShaxta->details($data['id']);                  
                        $consElDet['imageDir'] = 'consshaxta';
                        $findElement = 'consShaxtaId';
                    break;
                case 'kolba':
                        $consElDet = $this->ConsKolba->details($data['id']);
                        $consElDet['imageDir'] = 'conskolba';
                        $findElement = 'consKolbaId';
                    break;
                case 'trybka':
                        $consElDet = $this->ConsTrybka->details($data['id']);
                        $consElDet['imageDir'] = 'constrybka';
                        $findElement = 'consTrybkaId';
                    break;                
                case 'bowl':
                        $consElDet = $this->ConsBowl->details($data['id']);
                        $consElDet['imageDir'] = 'consbowl';
                        $findElement = 'consBowlId';
                    break;
                case 'bludce':
                        $consElDet = $this->ConsBludce->details($data['id']);
                        $consElDet['imageDir'] = 'consbludce';
                        $findElement = 'consBludceId';
                    break;
                case 'shipci':
                        $consElDet = $this->ConsShipci->details($data['id']);
                        $consElDet['imageDir'] = 'consshipci';
                        $findElement = 'consShipciId';
                    break;                        
            }
            
            $oldData = $_SESSION['cart'][$data['unikey']];

            $newData = array(
                'details' => array(
                    'title' => 'Из конструктора',
                    'price' => 0
                ),
                'amount' => $oldData['amount'],
                'elements' => array()
            );
            
            $oldId = 0;
            $issetSelectElement = false;
            $consElDet['elementId'] = $data['id'];
            foreach($oldData['elements'] as $k => $v)
            {
                if( isset($v[$findElement]))
                {
                    $newData['elements'][$k] = $consElDet;
                    $oldId = $oldData['elements'][$k]['elementId'];
                    $issetSelectElement = true;
                }
                else
                {
                    $newData['elements'][$k] = $oldData['elements'][$k];
                }
                $newData['details']['price'] += $newData['elements'][$k]['price'];
            }
            
            if( !$issetSelectElement )
            {
                $newData['elements'][] = $consElDet;
                $newData['details']['price'] += $consElDet['price'];
            }
            
            if( count($newData['elements']) == 6 )
            {
                foreach($newData['elements'] as $k => $v)
                {
                    if( isset($v['consShaxtaId']) )
                    {
                        $newData['elements'][$k]['price'] -= 270;
                        $newData['details']['price'] -= 270;
                    }                
                }        
            }            
            
            $uniKey = str_replace($data['code'].'-'.$oldId, $data['code'].'-'.$data['id'], $data['unikey']);
            $newData['uniKey'] = $uniKey;
            
            if( $uniKey == $data['unikey'] )
            {
                parent::recalculateCart();
                exit('ok');                
            }
            else
            {
                if(empty($_SESSION['cart'][$uniKey])) 
                {
                    $_SESSION['cart'][$uniKey] = $newData;
                    unset($_SESSION['cart'][$data['unikey']]);
                } 
                else 
                {
                    $_SESSION['cart'][$uniKey]['amount']++;
                    unset($_SESSION['cart'][$data['unikey']]);
                }
            }
            
            parent::recalculateCart();
            exit('ok');
        }        
    }    
}