<?php

class ConstructorController extends BaseController
{    
    public function init()
    {
        parent::init();
        $this->_view->current = 'constructor';
    }    
    
    public function indexAction()
    {
        $content = $this->Content->details(4);
        $this->_view->content = $content;
        
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
//            'portv' => array(
//                'title' => 'Порт верхний',
//                'code' => 'portv',
//                'data' =>  $this->ConsPortV->getData()
//            ),     
//            'shlang' => array(
//                'title' => 'Шланг',
//                'code' => 'shlang',
//                'data' =>  $this->ConsShlang->getData()
//            ),
//            'portn' => array(
//                'title' => 'Порт нижний',
//                'code' => 'portn',
//                'data' =>  $this->ConsPortN->getData()
//            ),   
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
        
//        $constructorBase = $this->Constructor->listing(5, 1, array('approved'=>1));
//        for( $i=0; $i<count($constructorBase['data']); $i++ )
//        {
//            $constructorBase['data'][$i]['elements'] = array();
//            if( $constructorBase['data'][$i]['bludceId'] != 0 )
//            {
//               $constructorBase['data'][$i]['elements']['bludce'] = $this->ConsBludce->details($constructorBase['data'][$i]['bludceId']); 
//               $constructorBase['data'][$i]['elements']['bludce']['elementId'] = $constructorBase['data'][$i]['bludceId'];
//               $constructorBase['data'][$i]['elements']['bludce']['imageDir'] = 'consbludce';
//            }
//            if( $constructorBase['data'][$i]['bowlId'] != 0 )
//            {
//               $constructorBase['data'][$i]['elements']['bowl'] = $this->ConsBowl->details($constructorBase['data'][$i]['bowlId']); 
//               $constructorBase['data'][$i]['elements']['bowl']['elementId'] = $constructorBase['data'][$i]['bowlId'];
//               $constructorBase['data'][$i]['elements']['bowl']['imageDir'] = 'consbowl';               
//            }
//            if( $constructorBase['data'][$i]['kolbaId'] != 0 )
//            {
//               $constructorBase['data'][$i]['elements']['kolba'] = $this->ConsKolba->details($constructorBase['data'][$i]['kolbaId']); 
//               $constructorBase['data'][$i]['elements']['kolba']['elementId'] = $constructorBase['data'][$i]['kolbaId'];
//               $constructorBase['data'][$i]['elements']['kolba']['imageDir'] = 'conskolba';                    
//            }
//            if( $constructorBase['data'][$i]['trybkaId'] != 0 )
//            {
//               $constructorBase['data'][$i]['elements']['trybka'] = $this->ConsTrybka->details($constructorBase['data'][$i]['trybkaId']); 
//               $constructorBase['data'][$i]['elements']['trybka']['elementId'] = $constructorBase['data'][$i]['trybkaId'];
//               $constructorBase['data'][$i]['elements']['trybka']['imageDir'] = 'constrybka';                    
//            }            
////            if( $constructorBase['data'][$i]['portNId'] != 0 )
////            {
////               $constructorBase['data'][$i]['elements']['portn'] = $this->ConsPortN->details($constructorBase['data'][$i]['portNId']); 
////               $constructorBase['data'][$i]['elements']['portn']['elementId'] = $constructorBase['data'][$i]['portNId'];
////               $constructorBase['data'][$i]['elements']['portn']['imageDir'] = 'consportn';                  
////            }
////            if( $constructorBase['data'][$i]['portVId'] != 0 )
////            {
////               $constructorBase['data'][$i]['elements']['portv'] = $this->ConsPortV->details($constructorBase['data'][$i]['portVId']); 
////               $constructorBase['data'][$i]['elements']['portv']['elementId'] = $constructorBase['data'][$i]['portVId'];
////               $constructorBase['data'][$i]['elements']['portv']['imageDir'] = 'consportv';                     
////            }
//            if( $constructorBase['data'][$i]['shaxtaId'] != 0 )
//            {
//               $constructorBase['data'][$i]['elements']['shaxta'] = $this->ConsShaxta->details($constructorBase['data'][$i]['shaxtaId']); 
//               $constructorBase['data'][$i]['elements']['shaxta']['elementId'] = $constructorBase['data'][$i]['shaxtaId'];
//               $constructorBase['data'][$i]['elements']['shaxta']['imageDir'] = 'consshaxta';                       
//            }
//            if( $constructorBase['data'][$i]['shipciId'] != 0 )
//            {
//               $constructorBase['data'][$i]['elements']['shipci'] = $this->ConsShipci->details($constructorBase['data'][$i]['shipciId']); 
//               $constructorBase['data'][$i]['elements']['shipci']['elementId'] = $constructorBase['data'][$i]['shipciId'];
//               $constructorBase['data'][$i]['elements']['shipci']['imageDir'] = 'consshipci';                  
//            }
////            if( $constructorBase['data'][$i]['shlangId'] != 0 )
////            {
////               $constructorBase['data'][$i]['elements']['shlang'] = $this->ConsShlang->details($constructorBase['data'][$i]['shlangId']); 
////               $constructorBase['data'][$i]['elements']['shlang']['elementId'] = $constructorBase['data'][$i]['shlangId'];
////               $constructorBase['data'][$i]['elements']['shlang']['imageDir'] = 'consshlang';                   
////            }                  
//        }
////        var_dump($constructorBase);exit;
//        
//        if( $constructorBase['total'] > $constructorBase['pageLength'] )
//        {
//            parent::paginatorJavascript($constructorBase);
//        }
//        $this->_view->constructorBase = $constructorBase;
//        $this->_view->constructorBaseJson = json_encode($constructorBase);
        
        $this->_view->scripts = array('constructor.js');
        $this->_view->styles = array('constructor.css');
        $this->_view->pageTitle = $content['title'];
        
        parent:: setBread(array('Конструктор'));
        parent:: setMetaTags($content);
        $this->_smarty->display('constructor/index.tpl');
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
            $uniKey = '';
            $addArray = array(
                'details' => array(
                    'title' => 'Из конструктора',
                    'price' => 0
                ),
                'amount' => 1,
                'elements' => array()
            );
            $noEmptyElementCount = 0;
            foreach($data as $k => $v)
            {
                if( $v != 0 )
                {
                    $noEmptyElementCount++;
                }                
            }
            foreach($data as $k => $v)
            {
                $uniKey .= $k.'-'.$v;
                if( $k != 'shipci' )
                    $uniKey .= '-';
                if( $v != 0 )
                {
                    switch($k)
                    {
                        case 'shaxta':
                                $consElDet = $this->ConsShaxta->details($v);
                                $consElDet['imageDir'] = 'consshaxta';
                                if( $noEmptyElementCount == 6 )
                                {
                                    $consElDet['price'] -= 270; 
                                }
//                                $consElDet['elementId'] = 'consShaxtaId';
                            break;
                        case 'kolba':
                                $consElDet = $this->ConsKolba->details($v);
                                $consElDet['imageDir'] = 'conskolba';
//                                $consElDet['elementId'] = 'consKolbaId';
                            break;
                        case 'trybka':
                                $consElDet = $this->ConsTrybka->details($v);
                                $consElDet['imageDir'] = 'constrybka';
//                                $consElDet['elementId'] = 'consKolbaId';
                            break;                        
//                        case 'portv':
//                                $consElDet = $this->ConsPortV->details($v);
//                                $consElDet['imageDir'] = 'consportv';
////                                $consElDet['elementId'] = 'consPortVId';
//                            break;
//                        case 'shlang':
//                                $consElDet = $this->ConsShlang->details($v);
//                                $consElDet['imageDir'] = 'consshlang';
////                                $consElDet['elementId'] = 'consShlangId';
//                            break;
//                        case 'portn':
//                                $consElDet = $this->ConsPortN->details($v);
//                                $consElDet['imageDir'] = 'consportn';
////                                $consElDet['elementId'] = 'consPortNId';
//                            break;
                        case 'bowl':
                                $consElDet = $this->ConsBowl->details($v);
                                $consElDet['imageDir'] = 'consbowl';
//                                $consElDet['elementId'] = 'consBowlId';
                            break;
                        case 'bludce':
                                $consElDet = $this->ConsBludce->details($v);
                                $consElDet['imageDir'] = 'consbludce';
//                                $consElDet['elementId'] = 'consBludceId';
                            break;
                        case 'shipci':
                                $consElDet = $this->ConsShipci->details($v);
                                $consElDet['imageDir'] = 'consshipci';
//                                $consElDet['elementId'] = 'consShipciId';
                            break;                        
                    }
                    $consElDet['elementId'] = $v;
                    $addArray['details']['price'] += $consElDet['price'];
                    $addArray['elements'][] = $consElDet;
                }
            }
            $addArray['uniKey'] = $uniKey;
            if(empty($_SESSION['cart'][$uniKey])) 
            {
                $_SESSION['cart'][$uniKey] = $addArray;
            } 
            else 
            {
                $_SESSION['cart'][$uniKey]['amount']++;
            }
            parent::recalculateCart();
            $this->_smarty->display('cart.tpl');
        }
    }        
    
    public function pagingAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            $constructorBase = $this->Constructor->listing(5, $data['page'], array('approved'=>1));
            for( $i=0; $i<count($constructorBase['data']); $i++ )
            {
                $constructorBase['data'][$i]['elements'] = array();
                if( $constructorBase['data'][$i]['bludceId'] != 0 )
                {
                   $constructorBase['data'][$i]['elements']['bludce'] = $this->ConsBludce->details($constructorBase['data'][$i]['bludceId']); 
                   $constructorBase['data'][$i]['elements']['bludce']['elementId'] = $constructorBase['data'][$i]['bludceId'];
                   $constructorBase['data'][$i]['elements']['bludce']['imageDir'] = 'consbludce';
                }
                if( $constructorBase['data'][$i]['bowlId'] != 0 )
                {
                   $constructorBase['data'][$i]['elements']['bowl'] = $this->ConsBowl->details($constructorBase['data'][$i]['bowlId']); 
                   $constructorBase['data'][$i]['elements']['bowl']['elementId'] = $constructorBase['data'][$i]['bowlId'];
                   $constructorBase['data'][$i]['elements']['bowl']['imageDir'] = 'consbowl';               
                }
                if( $constructorBase['data'][$i]['kolbaId'] != 0 )
                {
                   $constructorBase['data'][$i]['elements']['kolba'] = $this->ConsKolba->details($constructorBase['data'][$i]['kolbaId']); 
                   $constructorBase['data'][$i]['elements']['kolba']['elementId'] = $constructorBase['data'][$i]['kolbaId'];
                   $constructorBase['data'][$i]['elements']['kolba']['imageDir'] = 'conskolba';                    
                }
                if( $constructorBase['data'][$i]['trybkaId'] != 0 )
                {
                   $constructorBase['data'][$i]['elements']['trybka'] = $this->ConsTrybka->details($constructorBase['data'][$i]['trybkaId']); 
                   $constructorBase['data'][$i]['elements']['trybka']['elementId'] = $constructorBase['data'][$i]['trybkaId'];
                   $constructorBase['data'][$i]['elements']['trybka']['imageDir'] = 'constrybka';                    
                }                
//                if( $constructorBase['data'][$i]['portNId'] != 0 )
//                {
//                   $constructorBase['data'][$i]['elements']['portn'] = $this->ConsPortN->details($constructorBase['data'][$i]['portNId']); 
//                   $constructorBase['data'][$i]['elements']['portn']['elementId'] = $constructorBase['data'][$i]['portNId'];
//                   $constructorBase['data'][$i]['elements']['portn']['imageDir'] = 'consportn';                  
//                }
//                if( $constructorBase['data'][$i]['portVId'] != 0 )
//                {
//                   $constructorBase['data'][$i]['elements']['portv'] = $this->ConsPortV->details($constructorBase['data'][$i]['portVId']); 
//                   $constructorBase['data'][$i]['elements']['portv']['elementId'] = $constructorBase['data'][$i]['portVId'];
//                   $constructorBase['data'][$i]['elements']['portv']['imageDir'] = 'consportv';                     
//                }
                if( $constructorBase['data'][$i]['shaxtaId'] != 0 )
                {
                   $constructorBase['data'][$i]['elements']['shaxta'] = $this->ConsShaxta->details($constructorBase['data'][$i]['shaxtaId']); 
                   $constructorBase['data'][$i]['elements']['shaxta']['elementId'] = $constructorBase['data'][$i]['shaxtaId'];
                   $constructorBase['data'][$i]['elements']['shaxta']['imageDir'] = 'consshaxta';                       
                }
                if( $constructorBase['data'][$i]['shipciId'] != 0 )
                {
                   $constructorBase['data'][$i]['elements']['shipci'] = $this->ConsShipci->details($constructorBase['data'][$i]['shipciId']); 
                   $constructorBase['data'][$i]['elements']['shipci']['elementId'] = $constructorBase['data'][$i]['shipciId'];
                   $constructorBase['data'][$i]['elements']['shipci']['imageDir'] = 'consshipci';                  
                }
//                if( $constructorBase['data'][$i]['shlangId'] != 0 )
//                {
//                   $constructorBase['data'][$i]['elements']['shlang'] = $this->ConsShlang->details($constructorBase['data'][$i]['shlangId']); 
//                   $constructorBase['data'][$i]['elements']['shlang']['elementId'] = $constructorBase['data'][$i]['shlangId'];
//                   $constructorBase['data'][$i]['elements']['shlang']['imageDir'] = 'consshlang';                   
//                }                  
            }
            parent::paginatorJavascript($constructorBase);
            $this->_view->constructorBase = $constructorBase;
            $this->_view->constructorBaseJson = json_encode($constructorBase); 
            $this->_smarty->display('constructor/page.tpl');
        }
    }            
}