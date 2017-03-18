<?php

class Admin_OrderController extends BaseController
{

    public function init() {
        parent::init();
        $this->_view->menuOpen = 'order';
    }

    public function indexAction()
    {
        $this->_view->html = $this->Order->listingHTML(
            array(
                'controller'=>'order',
                'modelName'=>'Order',
                'indexActionName'=>'index'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Заказы';
        $this->_smarty->display('default.tpl');
    }
    
    public function detailsAction()
    {
        $id = $this->_request->getParam('id');
        $order = $this->Order->details($id);
        $order['products'] = $this->OrderProduct->listing(0, 1, array('orderId'=>$id));
        for( $i=0; $i<count($order['products']['data']); $i++ )
        {
            if( $order['products']['data'][$i]['productId'] != 0 )
            {
                $order['products']['data'][$i]['productDetails'] = $this->Product->details($order['products']['data'][$i]['productId']);
            }
            else
            {
                $order['products']['data'][$i]['elements'] = array();
                if( $order['products']['data'][$i]['consBludceId'] != 0 )
                {
                   $order['products']['data'][$i]['elements']['bludce'] = $this->ConsBludce->details($order['products']['data'][$i]['consBludceId']); 
                }
                if( $order['products']['data'][$i]['consBowlId'] != 0 )
                {
                   $order['products']['data'][$i]['elements']['bowl'] = $this->ConsBowl->details($order['products']['data'][$i]['consBowlId']); 
                }
                if( $order['products']['data'][$i]['consKolbaId'] != 0 )
                {
                   $order['products']['data'][$i]['elements']['kolba'] = $this->ConsKolba->details($order['products']['data'][$i]['consKolbaId']); 
                }
                if( $order['products']['data'][$i]['consShaxtaId'] != 0 )
                {
                   $order['products']['data'][$i]['elements']['shaxta'] = $this->ConsShaxta->details($order['products']['data'][$i]['consShaxtaId']); 
                }
                if( $order['products']['data'][$i]['consShipciId'] != 0 )
                {
                   $order['products']['data'][$i]['elements']['shipci'] = $this->ConsShipci->details($order['products']['data'][$i]['consShipciId']); 
                }   
                if( $order['products']['data'][$i]['consTrybkaId'] != 0 )
                {
                   $order['products']['data'][$i]['elements']['trybka'] = $this->ConsTrybka->details($order['products']['data'][$i]['consTrybkaId']); 
                }                   
                $order['products']['data'][$i]['elementsId'] = $order['products']['data'][$i]['consShaxtaId'].'-'.$order['products']['data'][$i]['consKolbaId'].'-'.$order['products']['data'][$i]['consTrybkaId'].'-'.$order['products']['data'][$i]['consBowlId'].'-'.$order['products']['data'][$i]['consBludceId'].'-'.$order['products']['data'][$i]['consShipciId'];
            }
        }
        $this->_view->order = $order;
        $this->_view->title = 'Детали заказа';
        $this->_smarty->display('order/detail.tpl');
    }    
    
    public function admincommentAction() 
    {
        if ($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            $id = $this->_request->getParam('id');
            $this->Order->save($data, $id);
            parent::redirect('admin/order');
        }
    }    
    
    public function addorderAction()
    {
        if( isset($_SESSION['adminCart']) )
        {
            $this->_view->adminCart = $_SESSION['adminCart'];
        }
        $this->_view->products = $this->Product->listing(0, 1, array('approved'=>1, 'order'=>'ORDER by title ASC'));
        $this->_view->currentDate = date('Y-m-d H:i:s');
        $this->_view->title = 'Добавление заказа';
        $this->_smarty->display('order/addorder.tpl');
    }       
    
    public function addproductAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            if(!isset($_SESSION['adminCart']))
            {
                $_SESSION['adminCart'] = array();
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
            
            if(empty($_SESSION['adminCart'][$uniKey])) 
            {
                $_SESSION['adminCart'][$uniKey] = array();
                $_SESSION['adminCart'][$uniKey]['details'] = $productDetails;
                $_SESSION['adminCart'][$uniKey]['uniKey'] = $uniKey;
                $_SESSION['adminCart'][$uniKey]['amount'] = $data['amount'];
            } 
            else 
            {
                $_SESSION['adminCart'][$uniKey]['amount'] += $data['amount'];
            }
            parent::recalculateAdminCart();
            exit('ok');
        }
    }  

    public function saveproductAction()
    {
        if ($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if(isset($_SESSION['adminCart']))
            {
                if (empty($data['firstName'])) 
                {
                    exit ('Введите Ваше Имя.');    
                }
                if (empty($data['lastName'])) 
                {
                    exit ('Введите Вашу Фамилию.');    
                }
                if (empty($data['country'])) 
                {
                    exit ('Введите Вашу Страну.');    
                }
                if (empty($data['city'])) 
                {
                    exit ('Введите Ваш Город.');    
                }
                if (empty($data['phone'])) 
                {
                    exit ('Введите Ваш Телефон.');    
                }            
                if( empty($data['email']) )
                {
                    $data['email'] = '';
                }
                else
                {
                    $validateEmail = $this->Validate->email($data['email']);
                    if(!$validateEmail)
                    {
                        exit('Введите корректный e-mail.');
                    }    
                }
                $data['userId'] = 0;
                $data['price'] = $_SESSION['adminCartPrice']['orderPrice'];
                $data['discount'] = $_SESSION['adminCartPrice']['discount'];
                $data['comment'] = '';
                $data['isHaveConstructor'] = 0; 
                $data['deliveryType'] = 'samo'; 
                
                $orderId = $this->Order->add($data);

                foreach( $_SESSION['adminCart'] as $k => $v )
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
                        
                    $this->OrderProduct->add($toOrderProduct);
                    $this->Product->addProductCount($v['details']['productId'], 'buy');
                }
                
                if (isset($_SESSION['adminCart']))
                {
                    unset($_SESSION['adminCart']);     
                }
                if (isset($_SESSION['adminCartPrice']))
                {
                    unset($_SESSION['adminCartPrice']);
                }                  
                exit('ok');
            }            
        }        
    }            
}