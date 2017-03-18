<?php

class GuestController extends BaseController
{    
    public function init()
    {
        parent::init();
        $this->_view->isWork = $this->Setting->getSetting('lounge_work');
    }
    
    public function checkPerm()
    {
        if(!empty($_SESSION['user']))
        {
            $user = $_SESSION['user'];
            if( $user['isAdmin'] == 0 )
            {
                $_SESSION['error'] = 'У Вас нет доступа к этому разделу. Обратитесь к администрации.';
                parent::redirect('guest/login');                
            }
            elseif( $user['isAdmin'] == 1 && !$this->checkIPPerm() )
            {
                $_SESSION['error'] = 'Доступ к этому разделу возможен только в Ace Hookah.';
                parent::redirect('guest/login');                  
            }
        }
        else 
        {
            parent::redirect('guest/login');
        }          
    }
    
    public function checkIPPerm()
    {
        $result = TRUE;
        $set = $this->Setting->getSetting('ipcheck');
        if( !empty($set) )
        {
            if( $_SERVER['REMOTE_ADDR'] != '78.30.239.226' )
            {
                $result = FALSE;
            }
        }
        return $result;
    }    
    
    public function checkSuperAdminPerm()
    {
        if(!empty($_SESSION['user']))
        {
            $user = $_SESSION['user'];
            if( $user['isAdmin'] == 2 )
            {
                return TRUE;             
            }
            else
            {
                return FALSE;
            }
        }
        else 
        {
            parent::redirect('guest/login');
        }          
    }    

    public function guestproductcategoryAction()
    {
        if( !$this->checkSuperAdminPerm() )
        {
            var_dump('Нет доступа!');exit;
        }
        
        $this->_view->html = $this->GuestProductCategory->listingHTMLGuest(
            array(
                'controller'=>'guest',
                'modelName'=>'GuestProductCategory',
                'indexActionName'=>'guestproductcategory'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Категории меню';
        $this->_smarty->display('guest/default.tpl');
    } 
    
    public function guestproductAction()
    {
        if( !$this->checkSuperAdminPerm() )
        {
            var_dump('Нет доступа!');exit;
        }
        
        $this->_view->html = $this->GuestProduct->listingHTMLGuest(
            array(
                'controller'=>'guest',
                'modelName'=>'GuestProduct',
                'indexActionName'=>'guestproduct'
            ),
            15,
            parent::getPage(),
            array('order'=>'ORDER by price ASC')
        );
        $this->_view->title = 'Продукты в меню';
        $this->_smarty->display('guest/default.tpl');
    }    
    
    public function guestsaleAction()
    {
        if( !$this->checkSuperAdminPerm() )
        {
            var_dump('Нет доступа!');exit;
        }
        
        $this->_view->html = $this->GuestSale->listingHTMLGuest(
            array(
                'controller'=>'guest',
                'modelName'=>'GuestSale',
                'indexActionName'=>'guestsale'
            ),
            15,
            parent::getPage()
        );
        $this->_view->title = 'Скидки';
        $this->_smarty->display('guest/default.tpl');
    }        

    public function indexAction()
    {
        $this->checkPerm();

        $this->_view->title = 'Поле столов'; 
        
        $guestInsideList['data'] = $this->Guest->getInsideGuests();
        $this->_view->guestInsideList = $guestInsideList;
        
        $guestBdayList = $this->Guest->getBdayGuest();
        $this->_view->guestBdayList = $guestBdayList;        
        
        $openTableList = $this->GuestTable->listing(0, 1, array('isOpen' => '1', 'order'=>'ORDER BY title ASC'));
        if( count($openTableList['data'])>0 )
        {
            $this->_view->openTableCheck = true;
            $this->_view->productHookah = $this->GuestProduct->listing(0, 1, array('guestProductCategoryId'=>1, 'approved'=>1, 'order'=>'ORDER BY price ASC'));
            $this->_view->productBar = $this->GuestProduct->listing(0, 1, array('guestProductCategoryId'=>2, 'approved'=>1, 'order'=>'ORDER BY price ASC'));
            $sales = $this->GuestSale->listing(0, 1, array('approved'=>1, 'order'=>'ORDER BY salePercent ASC'));
            
            for( $i=0; $i<count($openTableList['data']); $i++ )
            {
                $newGuestCheck = $this->Guest->checkForNew($openTableList['data'][$i]['guestTableId']);
//                $openTableList['data'][$i]['bdayGuest'] = $this->Guest->checkBdayGuests($openTableList['data'][$i]['guestTableId']);
                $openTableList['data'][$i]['guests'] = $this->Guest->listing(0, 1, array('inTable' => $openTableList['data'][$i]['guestTableId'], 'inside'=>1));

                $openTableList['data'][$i]['products'] = $this->GuestTable->getTableProducts($openTableList['data'][$i]['guestTableId']);
                $openTableList['data'][$i]['forFriends'] = $this->GuestTable->checkTableHookah($openTableList['data'][$i]['guestTableId']);                

                if( !empty($openTableList['data'][$i]['pointSale']) )
                {
                    $openTableList['data'][$i]['pointSaleGuest'] = $this->GuestTable->getPointSaleGuest($openTableList['data'][$i]['guestTableId']);
                }
                
                for( $j=0; $j < count($sales['data']); $j++ )
                {
                    $check = true;
                    switch ($sales['data'][$j]['code']) 
                    {
                        case 'for_friend':
                                if( !$newGuestCheck ) 
                                {
                                    $check = false;                                   
                                }
                            break;
                        case 'students':
                                if( date('H:i', strtotime($openTableList['data'][$i]['dateAdded'])) > '20:00' ||
                                        date('H:i', strtotime($openTableList['data'][$i]['dateAdded'])) < '12:00')
                                {
                                    $check = false;
                                }
                            break;                   
                        default:                             
                            break;
                    }         
                    $sales['data'][$j]['check'] = $check;
                }             
                $openTableList['data'][$i]['sales'] = $sales['data'];
                
                if( !empty($openTableList['data'][$i]['saleCode']) )
                {
                    $openTableList['data'][$i]['salesDet'] = $this->GuestSale->getSaleDet($openTableList['data'][$i]['saleCode']);
                }
            }
        }        
        else
        {
            $this->_view->openTableCheck = false;
        }
//        var_dump($openTableList);exit;
        $this->_view->openTableList = $openTableList;
        
        $this->_smarty->display('guest/index.tpl');
    }
    
    public function listAction()
    {
//        var_dump($_SESSION);exit;
        $this->checkPerm();
        
        $sort = $this->_request->getParam('sort');
        if( $sort )
        {
            if( $sort == 'id' )
            {
                $guestList = $this->Guest->listing(20, parent::getPage(), array('order'=>'ORDER BY guestId DESC'));
                parent::paginatorFront($guestList, 'guest/list/page/{page}/sort/id');
            }
            elseif ( $sort == 'empty') 
            {
                $guestList = $this->Guest->listing(20, parent::getPage(), array('name'=>''));
                parent::paginatorFront($guestList, 'guest/list/page/{page}/sort/empty');                
            }
        }
        else {
            $guestList = $this->Guest->listing(20, parent::getPage(), array('order'=>'ORDER BY thirdName ASC'));
            parent::paginatorFront($guestList, 'guest/list/page/{page}');
        }          
        $this->_view->guestList = $guestList;

        $this->_view->sort = $sort;

        $this->_view->title = 'Члены клуба Ace Hookah shop & lounge';    

        $this->_smarty->display('guest/list.tpl');
    }    
    
    public function loginAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            if (empty($data['login']) || empty($data['password'])) {
                $_SESSION['error'] = 'Заполните все поля!';
                parent::redirect('guest/login');
            }
            $user = $this->User->getUser($data['login'], $data['password']);
            if (empty($user)) {
                $_SESSION['error'] = 'Ошибка ввода логина или пароля.';
                parent::redirect('guest/login');
            }
            $_SESSION['error'] = '';
            $_SESSION['user'] = $user;
            $_SESSION['user']['permission'] = parent::getUserPermission($_SESSION['user']['userId']);
            $_SESSION['user']['createTime'] = time();
            parent::redirect('guest');
        }
        $this->_smarty->display('guest/loginform.tpl');
    } 
    
    public function actionsAction()
    {
        $this->checkPerm();
        
        $disActiveTitle = 'Disactive';
        $activeTitle = 'Active';

        $_SESSION['modelName'] = $this->_request->getParam('modelName');
        $actionName = $this->_request->getParam('actionName');
        $controller = $this->_request->getParam('controllerName');
        $fieldActive = $this->_request->getParam('fieldActive');
        $id = $this->_request->getParam('id');
        $selectId = $this->_request->getParam('selectid');
        $parent = $this->_request->getParam('parent');
        $data = $this->_request->getPost();
        
        switch($actionName){
            case 'delete':
                $this->$_SESSION['modelName']->delete($id);
                echo 'Complete';
                break;
            case 'active':
                $this->$_SESSION['modelName']->approved($id, 1, $fieldActive);
                $address = 'admin/metadata/actions/actionName/disactive/fieldActive/'.$fieldActive.'/modelName/'.$_SESSION['modelName'];
                $this->_view->address = $address;
                $this->_view->id = $id;
                $this->_view->status = 1;
                $this->_view->fieldActive = $fieldActive;  
                $this->_smarty->display('active.tpl');
                break;
            case 'disactive':
                $this->$_SESSION['modelName']->approved($id, 0, $fieldActive);
                $address = 'admin/metadata/actions/actionName/active/fieldActive/'.$fieldActive.'/modelName/'.$_SESSION['modelName'];
                $this->_view->address = $address;
                $this->_view->id = $id;
                $this->_view->status = 0;     
                $this->_view->fieldActive = $fieldActive;  
                $this->_smarty->display('active.tpl');
                break;
            case 'up':
                $order = $this->_request->getParam('order');
                $fieldName = $this->_request->getParam('fieldName');
                $check = $this->$_SESSION['modelName']->checkUp($order, $fieldName, '<');
                $url = explode($this->_cnf->url->baseFull,$_SERVER['HTTP_REFERER']);
                parent::redirect($url[1]);
                break;
            case 'down':
                $order = $this->_request->getParam('order');
                $fieldName = $this->_request->getParam('fieldName');
                $check = $this->$_SESSION['modelName']->checkUp($order, $fieldName, '>');
                $url = explode($this->_cnf->url->baseFull,$_SERVER['HTTP_REFERER']);
                parent::redirect($url[1]);
                break;
            case 'edit':
                self::edit($id, $actionName, $parent, $selectId);
                break;
            case 'view':
                self::view($id);
                break;        
            case 'select':
                $toUpdate[$data['field']] = $data['value'];
                $this->$_SESSION['modelName']->save($toUpdate, $id);
                break;               
            case 'inputchange':
                $toUpdate[$data['field']] = $data['value'];
                $this->$_SESSION['modelName']->save($toUpdate, $id);
                break;                 
            default:
                break;
        }
    }

    public function edit($id, $actionName, $parent, $selectId)
    {
        $this->checkPerm();
        
        if(empty($selectId))
            $selectId = 0;
        $referer = $this->_request->getParam('referer');
        $referer = explode('_', $referer);
        //Чекаем типы полей
        $meta = $this->$_SESSION['modelName']->getMeta();
        $fieldImageExist = array();
        $fieldActiveExist = FALSE;
        $isEdit = TRUE;
        if( empty($id) )
            $isEdit = FALSE;    
        
        foreach ($meta['fields'] as $v => $index) {
            if($index['type'] == 'image'){
                $fieldImageExist[$v]['title'] = $v;
            }
            if($index['type'] == 'active'){
                $fieldActiveExist = $v;
            }            
            if( isset($index['default']) )
            {
                $_SESSION['formData'][$v] = $index['default'];
            }            
        }
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost(); 

            if( $_SESSION['modelName'] == 'Guest' )
            {
                if( $this->Guest->checkUniq($data['cardNumber'], $id) )
                {
                    $_SESSION['formData'] = $data;
                    $_SESSION['error'] = 'Такой номер карты уже существует!';
                    parent::redirect ('guest/actions/referer/'.implode('_',$referer).'/modelName/'.$_SESSION['modelName'].'/actionName/edit/id/'.$id); 
                }
                if(empty ($id)) {
                    $data['dateAdded'] = date('Y-m-d H:i:s');
                }
//                else{
//                    
//                }
            }
            
            $validate = $this->$_SESSION['modelName']->metaValidate($data, $mas, $isEdit);
            if(!$validate)
                parent::redirect ('guest/actions/referer/'.implode('_',$referer).'/modelName/'.$_SESSION['modelName'].'/actionName/edit/id/'.$id);
               
            //если есть поле с типом image формируем массив для uploadPhoto, без пути для фоток.
            if($fieldImageExist) 
            {
                $imagesDir = array();
                $sizes = array();
                $cropSmart = array();
                foreach ($fieldImageExist as $v => $array) {
                    //Получаем размеры для фоток
                    $fieldImageExist[$v]['sizes'] = $meta['fields'][$fieldImageExist[$v]['title']]['size'];
                    //Проверяем установлен ли кроп смарт если нет то делаем FALSE
                    if(isset($meta['fields'][$fieldImageExist[$v]['title']]['cropSmart']))
                        $fieldImageExist[$v]['cropSmart'] = $meta['fields'][$fieldImageExist[$v]['title']]['cropSmart'];
                    else
                        $cropSmart[] = FALSE;
                    //Проверяем установлен ли кроп скип если нет то делаем FALSE
                    if(isset($meta['fields'][$fieldImageExist[$v]['title']]['cropSkip']))
                        $fieldImageExist[$v]['cropSkip'] = $meta['fields'][$fieldImageExist[$v]['title']]['cropSkip'];
                    else
                        $cropSkip[] = FALSE;                
                    $mas[$v] = TRUE;//Метка для валидатора                
                }
            } else {
                $mas = FALSE;
            }              
            
            if(!empty ($id)) {
                $this->$_SESSION['modelName']->save($data, $id);
                $_SESSION['notice'] = 'Запись отредактирована!';
            } else {
                if($fieldImageExist) {
                    foreach ($fieldImageExist as $v => $array) {
                        foreach ($meta['fields'][$fieldImageExist[$v]['title']]['size'] as $name => $size) {
                            $data[$name] = '';
                        }
                    }
                }         
                if( $_SESSION['modelName'] == 'Guest' )
                {            
                    $data['idHush'] = '';
                }                
                $id = $this->$_SESSION['modelName']->add($data);
                $_SESSION['notice'] = 'Запись добавлена!';
                
                if( $_SESSION['modelName'] == 'Guest' )
                {            
                    $data['idHush'] = MD5(MD5($id.$data['cardNumber']));
                    $this->$_SESSION['modelName']->save($data, $id);  
                }
            }            
            //если есть поле с типом image получаем пути для фоток
            if($fieldImageExist) {
                $sizes = array();
                foreach ($fieldImageExist as $v => $array) {
                    //Путь к папке с фотками
                    $fieldImageExist[$v]['imagesDir'] = $meta['fields'][$fieldImageExist[$v]['title']]['imagesDir'].$id.'/';
                }
                
                if (!isset($_FILES) && isset($HTTP_POST_FILES))
                    $_FILES = $HTTP_POST_FILES;
                $imageData = $this->_uploadPhotoNew($fieldImageExist);    
                foreach ($imageData as $name => $value) {
                    $data[$name] = $value;
                }     
                //удаляем старые фотки
                if(!empty ($id)) {
                    $recordDetails = $this->$_SESSION['modelName']->details($id);
                    foreach ($imageData as $name => $value) {
                        if(isset($fieldImageExist[$name])){
                            foreach ($fieldImageExist[$name]['sizes'] as $sizeName => $sizeValue) {
                                @unlink($fieldImageExist[$name]['imagesDir'] . $recordDetails[$sizeName]);
                            }
                        }
                    }
                }

                $this->$_SESSION['modelName']->save($data, $id);                
            }          

            $this->$_SESSION['modelName']->unsetFormData();
            
//            $changesFileDir = $this->_cnf->path->root.'changes.txt';
//            $changesFile = fopen($changesFileDir, "a");
//            fwrite($changesFile, $id.',');
//            fclose($changesFile);            
            
            $this->redirect($referer[0].(isset($referer[1])?'/'.$referer[1]:''));
        }
        if(!empty ($id)){
            $_SESSION['formData'] = $this->$_SESSION['modelName']->details($id);
        }

        $this->_view->html = $this->$_SESSION['modelName']->createHTML('guest/actions/modelName/'.$_SESSION['modelName'].'/actionName/edit/referer/'.implode('_',$referer).'/id/'.$id, $result, 'admin', $selectId);
        $this->_smarty->display('guest/default.tpl');
        $this->$_SESSION['modelName']->unsetFormData();
    }
    
    public function view($id)
    {
        $this->checkPerm();
                
        if(!empty ($id))
            $_SESSION['formData'] = $this->$_SESSION['modelName']->details($id);
        $referer = $this->_request->getParam('referer');
        $referer = explode('_', $referer);      
        $backLink = $_SERVER['HTTP_REFERER'];
        $this->_view->html = $this->$_SESSION['modelName']->viewHTML(NULL, $backLink);
        $this->_smarty->display('guest/default.tpl');
        $this->$_SESSION['modelName']->unsetFormData();
    }    
    
    public function findguestAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            $res = $this->Guest->findGuest($data);
            if( count($res) > 0 )
                $this->_view->res = $res;
            else
                $this->_view->serror = 'Не найденного совпадений!';
            $this->_smarty->display('guest/result.tpl');
        }
    }   
    
    public function guestenterAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( isset($data['guestId']) )
            {
                if( !empty($data['guestId']) )
                {
                    $this->Guest->addGuestEnter($data['guestId']);
                    $this->_view->gi = $this->Guest->details($data['guestId']);
                    $this->_view->openTableCheck = $this->GuestTable->checkOpensTable();
                    $this->_smarty->display('guest/inside.tpl');
                }
                else{
                    exit('Пришел пустой ID');
                }
            }
            else{
                exit('Ошибка отправки');
            }            
        }
    }  
    
    public function guestoutAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( isset($data['guestId']) )
            {
                if( !empty($data['guestId']) )
                {
                    $this->Guest->guestOut($data['guestId']);
                }
                else{
                    exit('Пришел пустой ID');
                }
            }
            else{
                exit('Ошибка отправки');
            }            
        }
    }      
    
    public function findguestactiveAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            $res = $this->Guest->findGuestActive($data);
            if( count($res) > 0 )
                $this->_view->res = $res;
            else
                $this->_view->serror = 'Не найденного совпадений!';
            $this->_smarty->display('guest/resultactive.tpl');
        }
    } 
    
    public function savechangesAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !$this->Guest->checkUniq($data['cardNumber'], $data['guestId']) )
            {
                $nameExp = explode(' ', $data['name']);
                if( count($nameExp) == 3 )
                {
                    $newData = array(
                        'cardNumber' => (int)$data['cardNumber'],
                        'name' => $nameExp[1],
                        'secondName' => $nameExp[2],
                        'thirdName' => $nameExp[0],
                        'email' => $data['email'],
                        'phone' => $data['phone'],
                        'birthday' => $data['birthday'],
                        'country' => $data['country'],
                        'city' => $data['city'],
                        'remark' => $data['remark']
                    );
                    $this->Guest->save($newData, $data['guestId']);
                    
                    exit('ok');
                }
                else 
                {
                    exit('В имени не 3 составляющих!');
                }
            }
            else 
            {
                exit('Такой номер карты уже существует');
            }
        }
    }    
    
    public function createtableAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !empty($data['table']))
            {
                if( $this->GuestTable->checkUniq($data['table']) )
                {
                    $tableData = array(
                        'title' => $data['table'],
                        'dateAdded' => date('Y-m-d H:i:s'),
                        'dateClosed' => '',
                        'guestDayId' => $this->GuestDay->getCurrentDay(),
                        'price' => 0,
                        'sale' => 0,
                        'saleCode' => '',
                        'totalPrice' => 0,
                        'remark' => '',
                        'pointSale' => 0,
                        'isOpen' => 1
                    );
                    $this->GuestTable->add($tableData);
                    exit('ok');
                }
            }
        }
    }
    
    public function loungeclear($curDay)
    {
        $this->GuestTable->clearTable($curDay);
        $this->GuestDay->clearDay($curDay);
        $this->Guest->clearGuest();
    }     
    
    public function loungeopenAction()
    {
        $this->checkPerm();
        
        $this->loungeclear(0);
        
        $dayData = array(
            'currentDate' => date('Y-m-d'),
            'totalSum' => 0,
            'hookahSum' => 0,
            'barSum' => 0,
            'pointSale' => 0,
            'whoWork' => '',
            'openDate' => date('H:i:s'),
            'closeDate' => '',
            'hookahCount' => 0,
        );
        $this->GuestDay->add($dayData);      
        $this->Setting->setSetting('lounge_work', 1);
        
        $tableData = array(
            'title' => 'Админский',
            'dateAdded' => date('Y-m-d H:i:s'),
            'dateClosed' => '',
            'guestDayId' => $this->GuestDay->getCurrentDay(),
            'price' => 0,
            'sale' => 0,
            'saleCode' => '',
            'totalPrice' => 0,
            'remark' => '',
            'pointSale' => 0,
            'isOpen' => 1,
            'isAdmin' => 1
        );
        $this->GuestTable->add($tableData);
                    
        $letterSett = $this->Setting->getSetting('letter_count');
        $letterCount = (int)$letterSett['value'];        
        
        if( $letterCount < 39 )
        {
            $cnf = Zend_Registry::get('cnf');
            $adminMail = $cnf->adminMail;                
            $messageToAdmin = date('Y-m-d').' в '.date('H:i:s').' смена открылась!';
            parent::sendMail($adminMail, 'Ace Hookah<manager@ace-hookah.com>', 'Смена открыта', $messageToAdmin);          

            $newLetterCount = $letterCount + 2;
            $this->Setting->setSetting('letter_count', $newLetterCount);
        }         
 
            
        parent::redirect('guest');
    }   
    
    public function loungecloseAction()
    {
        $this->checkPerm();
        
        $curDay = $this->GuestDay->getCurrentDay();
        $this->loungeclear($curDay);
        
        $tableList = $this->GuestTable->listing(0, 1, array('isOpen' => '0', 'guestDayId'=>$curDay,'order'=>'ORDER BY guestTableId DESC'));
        $tableCount = 0;
        $hookahCashTotal = 0;
        $barCashTotal = 0;
        $hookahCount = 0;        
        $pointSale = 0;
        for( $i=0; $i<count($tableList['data']); $i++ )
        {
            if( $tableList['data'][$i]['isAdmin'] == 0 )
            {
                $tableList['data'][$i]['guests'] = $this->GuestTable->getTableGuests($tableList['data'][$i]['guestTableId']);
                $tableList['data'][$i]['products'] = $this->GuestTable->getTableProducts($tableList['data'][$i]['guestTableId']);
                $tableCount++;
                $salePercent = 0;
                $pointSale += $tableList['data'][$i]['pointSale'];
                if( !empty($tableList['data'][$i]['saleCode']) )
                {
                    $salePercent = $this->GuestSale->getPercent($tableList['data'][$i]['saleCode']);
                }            

                for( $j=0; $j<count($tableList['data'][$i]['products']); $j++ )
                {
                    $curProduct = $tableList['data'][$i]['products'][$j];

                    $posPrice = $curProduct['price']*$curProduct['amount'];
                    $sale = 0;
                    if( $curProduct['doSale'] == 1) // если продукт подвержен скидке
                    {
                        if( !empty($tableList['data'][$i]['saleCode']) && $salePercent['salePercent'] != 0 )
                        {
                            switch ($tableList['data'][$i]['saleCode']) 
                            {
                                case 'for_friend':
                                        if( $curProduct['guestProductCategoryId'] == 1 ) // есль кальян
                                        {
                                            $curSale = ($posPrice*(int)$salePercent['salePercent'])/100;
                                            $sale += $curSale;                                     
                                        }
                                    break;
                                case 'students':
                                        if( $curProduct['guestProductCategoryId'] == 1 ) // есль кальян
                                        {
                                            $curSale = ($posPrice*(int)$salePercent['salePercent'])/100;
                                            $sale += $curSale;                                     
                                        }
                                    break;                           
                                default:
                                        $curSale = ($posPrice*(int)$salePercent['salePercent'])/100;
                                        $sale += $curSale;                                  
                                    break;
                            }
                        }
                    }

                    if( $curProduct['guestProductCategoryId'] == 1 )
                    {
                        $hookahCashTotal += $posPrice - $sale;
                        if( $curProduct['title'] != 'D-mini' && $curProduct['title'] != 'Nirvana Dokha' )
                        {
                            $hookahCount += $curProduct['amount'];
                        }
                    }
                    else 
                    {
                        $barCashTotal += $posPrice - $sale;
                    }

                }  
            }
            else {
                $newData['isOpen'] = 0;
                $newData['isCheck'] = 1;
                $newData['dateClosed'] = date('Y-m-d H:i:s');
                $this->GuestTable->save($newData, $tableList['data'][$i]['guestTableId']);
            }
        }
        
        $dayData = array(
            'totalSum' => $hookahCashTotal + $barCashTotal - $pointSale,
            'hookahSum' => $hookahCashTotal,
            'barSum' => $barCashTotal,
            'whoWork' => '',
            'hookahCount' => $hookahCount,
            'tableCount' => $tableCount,
            'pointSale' => $pointSale,
            'closeDate' => date('H:i:s'),
        );
        $this->GuestDay->save($dayData, $curDay);      
        $this->Setting->setSetting('lounge_work', 0);
        
        $letterSett = $this->Setting->getSetting('letter_count');
        $letterCount = (int)$letterSett['value'];        
        
        if( $letterCount < 39 )
        {
            $cnf = Zend_Registry::get('cnf');
            $adminMail = $cnf->adminMail;                
            $messageToAdmin = date('Y-m-d').' в '.date('H:i:s').' смена закрылась!<br/>';
            $messageToAdmin .= 'Касса: '.$dayData['totalSum'].' руб. Бар: '.$dayData['barSum'].' руб. Кальяны: '.$dayData['hookahSum'].' руб. Оплаченно баллами: '.$dayData['pointSale'].' руб.<br/>, 
                                Кол-ство кальянов: '.$dayData['hookahCount'].' шт. Всего столов: '.$dayData['tableCount'].' шт.<br/>';
            parent::sendMail($adminMail, 'Ace Hookah<manager@ace-hookah.com>', 'Смена закрыта', $messageToAdmin);            

            $newLetterCount = $letterCount + 2;
            $this->Setting->setSetting('letter_count', $newLetterCount);
        }           
            
//        parent::redirect('guest');
        $this->_view->dayDet = $this->GuestDay->details($curDay);   
        $this->_smarty->display('guest/loungeclose.tpl'); 
    }       
    
    public function gettableAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !empty($data['gId']))
            {
                $this->_view->tableList = $this->GuestTable->listing(0, 1, array('isOpen'=>1, 'isCheck'=>0, 'isAdmin'=>0, 'order'=>'ORDER BY title ASC'));
                $this->_view->guestId = $data['gId'];
                $this->_smarty->display('guest/tablelist.tpl');                    
            }
        }
    }  
    
    public function gettableallAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $this->_view->tableList = $this->GuestTable->listing(0, 1, array('isOpen'=>1, 'isCheck'=>0, 'isAdmin'=>0, 'order'=>'ORDER BY title ASC'));
            $this->_smarty->display('guest/tablelistall.tpl');                    
        }
    }      
    
    public function guesttotableAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !empty($data['gId']) && !empty($data['tId']))
            {
                $this->Guest->toTable($data['gId'], $data['tId']);
                exit('ok');
            }
            else {
                exit('Ошибка данных');
            }
        }
    }    
    
    public function getproductAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !empty($data['type']))
            {
                if( $data['type'] == 'hookah' )
                {
                    $this->_view->productList = $this->GuestProduct->listing(0, 1, array('guestProductCategoryId'=>1, 'approved'=>1, 'order'=>'ORDER BY price ASC'));
                }
                else
                {
                    $this->_view->productList = $this->GuestProduct->listing(0, 1, array('guestProductCategoryId'=>2, 'approved'=>1, 'order'=>'ORDER BY price ASC'));
                }
                $this->_view->tableId = $data['tId'];
                $this->_smarty->display('guest/productlist.tpl');                    
            }
        }
    }  
    
//    public function producttotableAction()
//    {
//        $this->checkPerm();
//        
//        if($this->_request->isPost()) 
//        {
//            $data = $this->_request->getPost();
//            
//            if( !empty($data['tableId']) && !empty($data['productId']))
//            {
//                $this->GuestTable->addProduct($data['tableId'], $data['productId']);
//                $this->recalcTable($data['tableId']);
//                exit('ok');
//            }
//            else
//            {
//                exit('ошибка данных');
//            }
//        }
//    }    
    
    public function productstotableAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $json = $this->_request->getPost();
            
            $data = json_decode($json['data']);
            
            $tableId = $data->guestTableId;
            if( !empty($tableId) )
            {
                foreach($data->products as $key => $value) 
                {
                    $curId = (int)$key;
                    $curAmount = (float)$value;

                    if( !empty($tableId) && !empty($curId) && !empty($curAmount))
                    {
                        $this->GuestTable->addProduct($tableId, $curId, $curAmount);
                    }
                    else
                    {
                        exit('ошибка данных');
                    }                
                }      
                $this->recalcTable($tableId);
                exit('ok');
            }
            else
            {
                exit('Ошибка определения стола');
            }
        }
    }        
    
    public function changeamountAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !empty($data['tableId']) && !empty($data['productId']) && !empty($data['amount']) && !empty($data['currentAmount']))
            {
                $this->GuestTable->changeAmount($data['tableId'], $data['productId'], $data['amount']);
                $this->recalcTable($data['tableId']);
                exit('ok');                  
                
//                $data['amount'] = str_replace(',', '.', $data['amount']);
//                $data['amount'] = (float)$data['amount'];
//                
////                var_dump($data, (int)$data['currentAmount'], (float)$data['currentAmount']);exit;
//                
//                if( $data['amount'] < 0.5 )
//                {
//                    exit('Нельзя меньше 0.5');
//                }
//                elseif( ($data['amount'] + 0.5) < (float)$data['currentAmount'] )
//                {
//                    exit('Нельзя уменьшить кол-ство больше, чем на 0.5');
//                }
//                elseif( (int)$data['currentAmount'] != (float)$data['currentAmount'] && $data['amount'] < (float)$data['currentAmount'] )
//                {
//                    exit('Нельзя уменьшить кол-ство с не целого количества до целого');
//                }                
//                else
//                {
//                    $this->GuestTable->changeAmount($data['tableId'], $data['productId'], $data['amount']);
//                    $this->recalcTable($data['tableId']);
//                    exit('ok');                    
//                }
            }
            else
            {
                exit('ошибка данных');
            }
        }
    }        
    
    function recalcTable($tableId)
    {
        $tableProduct = $this->GuestTable->getTableProducts($tableId);
        $tablePrice = 0;
        $sale = 0;
        $salePercent = 0;
        
        $tableDetails = $this->GuestTable->details($tableId);
        if( !empty($tableDetails['saleCode']) )
        {
            $salePercent = $this->GuestSale->getPercent($tableDetails['saleCode']);
        }
        
        for( $i=0; $i<count($tableProduct); $i++ )
        {
            $posPrice = $tableProduct[$i]['price']*$tableProduct[$i]['amount'];
            $tablePrice += $posPrice;
            $this->GuestTable->updatePrice($tableId, $tableProduct[$i]['guestProductId'], $posPrice);
            
            if( $tableProduct[$i]['doSale'] == 1) // если продукт подвержен скидке
            {
                if( !empty($tableDetails['saleCode']) && $salePercent['salePercent'] != 0 )
                {
                    switch ($tableDetails['saleCode']) {
                        case 'for_friend':
                                if( $tableProduct[$i]['guestProductCategoryId'] == 1 ) // есль кальян
                                {
                                    $curSale = ($posPrice*(int)$salePercent['salePercent'])/100;
                                    $sale += $curSale;                                     
                                }
                            break;
                        case 'students':
                                if( $tableProduct[$i]['guestProductCategoryId'] == 1 ) // есль кальян
                                {
                                    $curSale = ($posPrice*(int)$salePercent['salePercent'])/100;
                                    $sale += $curSale;                                     
                                }
                            break;                       
                        default:
                                $curSale = ($posPrice*(int)$salePercent['salePercent'])/100;
                                $sale += $curSale;                              
                            break;
                    }
                }
            }
        }
        
        if( !empty($tableDetails['pointSale']) )
        {
            $tablePriceWithSale = $tablePrice - $sale - $tableDetails['pointSale'];
        }        
        else
        {
            $tablePriceWithSale = $tablePrice - $sale;
        }
        
        $tableData = array(
            'price' => $tablePrice,
            'sale' => $sale,
            'totalPrice' => $tablePriceWithSale
        );
        $this->GuestTable->save($tableData, $tableId);
//        var_dump($tableProduct);exit;
    }
    
    public function dotablesaleAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !empty($data['tableId']))
            {
                $newData['saleCode'] = $data['code'];
                $this->GuestTable->save($newData, $data['tableId']);
                $this->recalcTable($data['tableId']);
                exit('ok');
            }
            else
            {
                exit('ошибка данных');
            }
        }
    } 
    
    public function closetableAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !empty($data['tableId']))
            {
                $newData['isOpen'] = 0;
                $newData['dateClosed'] = date('Y-m-d H:i:s');
                $this->GuestTable->save($newData, $data['tableId']);
                
                $this->Guest->deleteFromTable($data['tableId']);
                exit('ok');
            }
            else
            {
                exit('ошибка данных');
            }
        }
    }     
    
    public function dayreportAction()
    {
        $this->checkPerm();

        $id = $this->_request->getParam('id');
        if( $id == 0 )
        {
            $this->_view->title = 'Отчет за сегодня';    
            $curDay = $this->GuestDay->getCurrentDay();            
        }
        else
        {
            if( !$this->checkSuperAdminPerm() )
            {
                var_dump('Нет доступа!');exit;
            }            
            $this->_view->title = 'Отчет за день';    
            $curDay = $id;              
        }
        
        if( !empty($curDay) )
        {
            $this->_view->dayDet = $this->GuestDay->details($curDay);  

            $tableList = $this->GuestTable->listing(0, 1, array('isOpen' => '0', 'guestDayId'=>$curDay,'order'=>'ORDER BY guestTableId DESC'));
    //        var_dump($openTableList);exit;

            $tableCount = 0;
            $hookahCashTotal = 0;
            $barCashTotal = 0;
            $hookahCount = 0;     
            $pointSale = 0;
            $productsArr = array(
                'hookah' => array(),
                'bar' => array()
            );
            for( $i=0; $i<count($tableList['data']); $i++ )
            {
                if( $tableList['data'][$i]['isAdmin'] == 0 )
                {
                    $tableList['data'][$i]['guests'] = $this->GuestTable->getTableGuests($tableList['data'][$i]['guestTableId']);
                    $tableList['data'][$i]['products'] = $this->GuestTable->getTableProducts($tableList['data'][$i]['guestTableId']);
                    if( !empty($tableList['data'][$i]['pointSale']) )
                    {
                        $tableList['data'][$i]['pointSaleGuest'] = $this->GuestTable->getPointSaleGuest($tableList['data'][$i]['guestTableId']);
                    }
        //            var_dump($tableList['data'][$i]);exit;
                    $tableCount++;
                    $salePercent = 0;
                    $pointSale += $tableList['data'][$i]['pointSale'];
                    if( !empty($tableList['data'][$i]['saleCode']) )
                    {
                        $salePercent = $this->GuestSale->getPercent($tableList['data'][$i]['saleCode']);
                        $tableList['data'][$i]['salesDet'] = $this->GuestSale->getSaleDet($tableList['data'][$i]['saleCode']);
                    }            

                    for( $j=0; $j<count($tableList['data'][$i]['products']); $j++ )
                    {
                        $curProduct = $tableList['data'][$i]['products'][$j];

                        if( $curProduct['guestProductCategoryId'] == 1 ) // есль кальян
                        {                    
                            if( isset($productsArr['hookah'][$curProduct['guestProductId']]) )
                            {
                                $productsArr['hookah'][$curProduct['guestProductId']]['amount'] += $curProduct['amount'];
                            }
                            else
                            {
                                $productsArr['hookah'][$curProduct['guestProductId']] = array(
                                    'title' => $curProduct['title'],
                                    'amount' => $curProduct['amount']
                                );
                            }
                        }
                        else
                        {
                            if( isset($productsArr['bar'][$curProduct['guestProductId']]) )
                            {
                                $productsArr['bar'][$curProduct['guestProductId']]['amount'] += $curProduct['amount'];
                            }
                            else
                            {
                                $productsArr['bar'][$curProduct['guestProductId']] = array(
                                    'title' => $curProduct['title'],
                                    'amount' => $curProduct['amount']
                                );
                            }                        
                        }

                        $posPrice = $curProduct['price']*$curProduct['amount'];
                        $sale = 0;
                        if( $curProduct['doSale'] == 1) // если продукт подвержен скидке
                        {
                            if( !empty($tableList['data'][$i]['saleCode']) && $salePercent['salePercent'] != 0 )
                            {
                                switch ($tableList['data'][$i]['saleCode']) 
                                {
                                    case 'for_friend':
                                            if( $curProduct['guestProductCategoryId'] == 1 ) // есль кальян
                                            {
                                                $curSale = ($posPrice*(int)$salePercent['salePercent'])/100;
                                                $sale += $curSale;                                     
                                            }
                                        break;
                                    case 'students':
                                            if( $curProduct['guestProductCategoryId'] == 1 ) // есль кальян
                                            {
                                                $curSale = ($posPrice*(int)$salePercent['salePercent'])/100;
                                                $sale += $curSale;                                     
                                            }
                                        break;                    
                                    default:
                                            $curSale = ($posPrice*(int)$salePercent['salePercent'])/100;
                                            $sale += $curSale;                                      
                                        break;
                                }
                            }
                        }

                        if( $curProduct['guestProductCategoryId'] == 1 )
                        {
                            $hookahCashTotal += $posPrice - $sale;
                            if( $curProduct['title'] != 'D-mini' && $curProduct['title'] != 'Nirvana Dokha' )
                            {
                                $hookahCount += $curProduct['amount'];
                            }
                        }
                        else 
                        {
                            $barCashTotal += $posPrice - $sale;
                        }

                    } 
                }
                else {
                    $tableList['data'][$i]['products'] = $this->GuestTable->getTableProducts($tableList['data'][$i]['guestTableId']);
                }
            }
            $this->_view->tableList = $tableList;
            $this->_view->productsArr = $productsArr;

            $report = array(
                'cashTotal' => $hookahCashTotal + $barCashTotal - $pointSale,
                'hookahCashTotal' => $hookahCashTotal,
                'barCashTotal' => $barCashTotal,
                'hookahCount' => $hookahCount,
                'pointSale' => $pointSale,
                'tableCount' => $tableCount
            );        
            $this->_view->report = $report;

            $this->_smarty->display('guest/todaytable.tpl');
        }
        else
        {
            parent::redirect('guest/');
        }
    }
    
    public function deletetableproductAction()
    {
        if( !$this->checkSuperAdminPerm() )
        {
            var_dump('Нет доступа!');exit;
        }
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !empty($data['tableId']) && !empty($data['productId']))
            {
                $det = $this->GuestTable->details($data['tableId']);
                if( $det['isCheck'] == 1 )
                {
                    exit('нельзя удалять когда выбит пречек');
                }
                else
                {
                    $this->GuestTable->deleteProduct($data['tableId'], $data['productId']);
                    $this->recalcTable($data['tableId']);
                    exit('ok');
                }
            }
            else
            {
                exit('ошибка данных');
            }
        }
    }    
    
    public function gettableforreplaceAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !empty($data['type']))
            {
                if( $data['type'] == 'product' )
                {
                    $this->_view->productId = $data['productId'];
                    $this->_view->amount = $data['amount'];
                    $this->_view->tableList = $this->GuestTable->getOpenTableRepalce($data['tableId'], $data['type']);
                }
                else
                {
                    $this->_view->guestId = $data['guestId'];
                    $this->_view->tableList = $this->GuestTable->getOpenTableRepalce($data['tableId'], $data['type']);
                }
                $this->_view->oldTableId = $data['tableId'];
                $this->_view->type = $data['type'];
                $this->_smarty->display('guest/tablelistforreplace.tpl'); 
            }
        }
    }     
    
    public function replaceproductAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !empty($data['tableId']) && !empty($data['productId']) && !empty($data['oldTableId']))
            {
                if( empty($data['amount']) )
                {
                    $data['amount'] = 1;
                }
                $this->GuestTable->replaceProduct($data['tableId'], $data['oldTableId'], $data['productId'], $data['amount']);
                $this->recalcTable($data['tableId']);
                $this->recalcTable($data['oldTableId']);
                exit('ok');
            }
            else
            {
                exit('ошибка данных');
            }
        }
    }  
    
    public function replaceguestAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !empty($data['tableId']) && !empty($data['guestId']) && !empty($data['oldTableId']))
            {
                $this->GuestTable->replaceGuest($data['tableId'], $data['oldTableId'], $data['guestId']);
                exit('ok');
            }
            else
            {
                exit('ошибка данных');
            }
        }
    } 
    
    public function quickaddAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost(); 

            $addData = array(
                'cardNumber' => $data['cardNumber'],
                'idHush' => '',
                'name' => '',
                'secondName' => '',
                'thirdName' => '',
                'email' => '',
                'phone' => '',
                'city' => '',
                'country' => '',
                'birthday' => '',
                'imageOriginal' => '',
                'imageBig' => '',
                'imageSmall' => '',
                'dateAdded' => date('Y-m-d H:i:s'),
                'points' => 0,
                'inside' => 1
            );
            $id = $this->Guest->add($addData);
            $this->Guest->addGuestEnter($id);
            
            $editData = array(
                'idHush' => MD5(MD5($id.$addData['cardNumber']))
            );
 
            if (!isset($_FILES) && isset($HTTP_POST_FILES))
                $_FILES = $HTTP_POST_FILES;
            
            $files = array(
                "imageOriginal"=>array(
                    "title"=> "imageOriginal",
                    "imagesDir"=>"images/guest/".$id."/",
                    "sizes"=> array(
                        'imageOriginal'=>'1024x1024',
                        'imageBig'=>'480x480',
                        'imageSmall'=>'60x60'
                    ),
                    "cropSmart"=>false,
                    "cropSkip"=>false            
                  )
            );            
            
            $imageData = $this->_uploadPhotoNew($files);   
            
            foreach ($imageData as $name => $value) {
                $editData[$name] = $value;
            }          

            $this->Guest->save($editData, $id);  
        }
        
        parent::redirect('guest/');
    }    
    
    public function cardcheckAction() 
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost(); 
            
            if( !empty($data['cardNumber']) )
            {
                if( $this->Guest->checkUniq($data['cardNumber'], 0) )
                {
                    exit('Такой номер карточки уже существует!');
                }
                else
                {
                    exit('ok');
                }
            }
            else
            {
                exit('Ошибка передачи данных!');
            }
        }
        else
        {
            exit('Ошибка передачи данных!');
        }
    }
    
    public function checkemptyguestAction() // проверка закрытых столов и заполненных анкет
    {
        $closePerm = true;
        
        if( $this->Guest->checkEmpty() )
        {
            $closePerm = false;
            exit('guest');
        }
        
        if( $this->GuestTable->checkOpensTable() )
        {
            $closePerm = false;
            exit('table');
        }        
        
        if( $closePerm )
        {
            exit('ok');
        }
    }    
    
    public function printcheckAction()
    {
        $this->checkPerm();
        
        $id = $this->_request->getParam('id');
        $tableDet = $this->GuestTable->details($id);
        if( !empty($tableDet['saleCode']) )
        {
            $tableDet['salesDet'] = $this->GuestSale->getSaleDet($tableDet['saleCode']);
        }
        $this->_view->details = $tableDet;
        
        $products = $this->GuestTable->getTableProducts($id);
        $this->_view->products = $products;

        $pointsPercent = $this->Setting->getSetting('guest_points_percent');
        if( !empty($pointsPercent) )
        {
            $gl = $this->Guest->listing(0, 1, array('inTable'=>$id, 'inside'=>1));

            $priceForPoints = $tableDet['price'];
            
            for( $i=0; $i<count($products); $i++ )
            {
                if( $products[$i]['doSale'] == 0 )
                {
                    $priceForPoints -= $products[$i]['totalPrice'];
                }
            }

            $addGuestPoints = ($priceForPoints*(int)$pointsPercent['value'])/(100*$gl['total']);
            $addGuestPoints = (int)$addGuestPoints;
            
            $this->Guest->addPoints($addGuestPoints, $id);
            $this->Guest->addPointsLog($addGuestPoints, $id, $gl);
        }
        $this->_view->addGuestPoints = $addGuestPoints;        
        $this->GuestTable->setCheck($id);
        $this->_smarty->display('guest/check.tpl'); 
    }   
    
    public function cancelcheckAction()
    {
        if( !$this->checkSuperAdminPerm() )
        {
            var_dump('Нет доступа!');exit;
        }
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();    
            
            if( !empty($data['tableId']) )
            {
                $this->Guest->deleteTablePoints($data['tableId']);
                $this->Guest->cancelCheck($data['tableId']);
                
                exit('ok');
            }
        }
    }       
    
    public function gettableguestpointsAction() 
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost(); 
            
            if( !empty($data['tableId']) && !empty($data['totalPrice']) )
            {
                $gg = $this->Guest->listing(0, 1, array('inTable' => $data['tableId'], 'inside'=>1));
                $to['guestTableId'] = $data['tableId'];
                $to['totalPrice'] = $data['totalPrice'];
                $to['pointSaleGuest'] = $gg['data'];
                $to['pointSale'] = 0;
                $this->_view->to = $to;
                $this->_smarty->display('guest/tableguestpoints.tpl'); 
            }
            else
            {
                exit('Ошибка передачи данных!');
            }
        }
        else
        {
            exit('Ошибка передачи данных!');
        }
    } 
    
    public function doguestpointsAction() 
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost(); 
            
            $guestTableId = $data['guestTableId'];
//            $this->GuestTable->deletePointsSale($guestTableId);
            
            $pointSale = 0;
            foreach ($data as $key => $value) 
            {
                $keyExp = explode('_', $key);
                if( count($keyExp) == 2 )
                {
                    $curGuestId = (int)$keyExp[1];
                    $curPoints = (int)$value;
                    $pointSale += $curPoints;
                    
                    if( $curPoints != 0 )
                    {
                        $this->Guest->removeGuestPoints($curPoints, $curGuestId);
                        $this->Guest->addGuestPointsLog($curPoints, $guestTableId, $curGuestId, 'fortable');
                    }
                }
            }
            $this->GuestTable->addPointsSale($guestTableId, $pointSale);
            $this->recalcTable($guestTableId);
            exit('ok');            
        }
        else
        {
            exit('Ошибка передачи данных!');
        }
    }  
    
    public function gettablebdguestAction() 
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost(); 
            
            if( !empty($data['tableId']) )
            {
                $bdayGuests = $this->Guest->getBdayGuests($data['tableId']);
                $this->_view->bdayGuests = $bdayGuests;
                $this->_view->bdTableId = $data['tableId'];
                $this->_smarty->display('guest/tablebdguest.tpl'); 
            }
            else
            {
                exit('Ошибка передачи данных!');
            }
        }
        else
        {
            exit('Ошибка передачи данных!');
        }
    }    
    
    public function dobdhookahAction() 
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost(); 
            
            if( !empty($data['tableId']) && !empty($data['guestId']) )
            {
                $this->GuestTable->addProduct($data['tableId'], 39, 1);
                $this->recalcTable($data['tableId']);
                $this->Guest->setUsedBDHookah($data['guestId']);
                exit('ok');   
            }
            else
            {
                exit('Ошибка передачи данных!');
            }
        }
        else
        {
            exit('Ошибка передачи данных!');
        }
    }        

    public function deleteremarkAction() 
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost(); 
            
            if( !empty($data['guestId']) )
            {
                $this->Guest->removeRemark($data['guestId']);
                exit('ok');     
            }
            else 
            {
                exit('Ошибка передачи данных!');
            }
        }
        else
        {
            exit('Ошибка передачи данных!');
        }
    }      
    
    public function addtableremarkAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            if( !empty($data['tableId']) && !empty($data['remark']))
            {
                $this->GuestTable->saveRemark($data['tableId'], $data['remark']);
                exit('ok');                  
            }
            else
            {
                exit('Ошибка передачи данных!');
            }
        }
    }      
    
    // ОТЧЕТ
    public function reportAction()
    {
        if( !$this->checkSuperAdminPerm() )
        {
            var_dump('Нет доступа!');exit;
        }
        
        $date = $this->_request->getParam('date');
        if( empty($date) )
        {
            $date = date('Y-m');
        }
        $this->_view->scripts = 'scripts/jquery-ui-month-picker/src/MonthPicker.js';  

        $this->_view->title = 'Отчет за '.$date;    
        $daysList = $this->GuestDay->getMonthDay($date);  
        $report = array(
            'totalCash' => 0,
            'hookahCash' => 0,
            'barCash' => 0,
            'pointSale' => 0,
            'hookahCount' => 0,
            'tableCount' => 0,
            'hookahPerDay' => 0,
            'cashPerDay' => 0,
            'cashPerTable' => 0
            
        );
        for( $i=0; $i<count($daysList); $i++ )
        {
            $report['totalCash'] += $daysList[$i]['totalSum'];
            $report['hookahCash'] += $daysList[$i]['hookahSum'];
            $report['barCash'] += $daysList[$i]['barSum'];
            $report['pointSale'] += $daysList[$i]['pointSale'];
            $report['hookahCount'] += $daysList[$i]['hookahCount'];
            $report['tableCount'] += $daysList[$i]['tableCount'];
        }
        $report['hookahPerDay'] = ROUND($report['hookahCount']/count($daysList), 1);
        $report['cashPerDay'] = ROUND($report['totalCash']/count($daysList), 1);
        $report['cashPerTable'] = ROUND($report['totalCash']/$report['tableCount'], 1);      
        $this->_view->daysList = $daysList;
        $this->_view->report = $report;
        
        $this->_smarty->display('guest/report.tpl');
    }    
    
    public function changetabletitleAction()
    {
        $this->checkPerm();
        
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            $data['title'] = trim($data['title']);
            if( !empty($data['tableId']) && !empty($data['title']))
            {
                if( $this->GuestTable->checkTableTitle($data['tableId'], $data['title']) )
                {
                    exit('Стол с таким именем уже есть');  
                }
                else
                {
                    $this->GuestTable->changeTableTitle($data['tableId'], $data['title']);
                    exit('ok');                 
                }
            }
            else
            {
                exit('Ошибка передачи данных!');
            }
        }
    }      
}