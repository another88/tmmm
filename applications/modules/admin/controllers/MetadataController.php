<?php      
class Admin_MetadataController extends BaseController
{
    public function indexAction() 
    {
        $table = $this->_request->getParam('table');
        $fields = $this->MetaModelBase->createMetaData($table);
        echo($fields);exit;
    }

    public function actionsAction()
    {
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
        if(empty($selectId))
            $selectId = 0;
        $referer = $this->_request->getParam('referer');
        $referer = explode('_', $referer);
        //Чекаем типы полей
        $meta = $this->$_SESSION['modelName']->getMeta();
        $fieldImageExist = array();
        $fieldSelectExist = FALSE;
        $fieldFileExist = FALSE;
        $fieldActiveExist = FALSE;
        $isEdit = TRUE;
        if( empty($id) )
            $isEdit = FALSE;    
        
        foreach ($meta['fields'] as $v => $index) {
            if($index['type'] == 'image'){
                $fieldImageExist[$v]['title'] = $v;
            }
            if($index['type'] == 'file'){
                $fieldFileExist = $v;
            }            
            if(isset($index['mainSelect'])){
                $fieldMainSelectExist = $v;
            }            
            if($index['type'] == 'select'){
                $fieldSelectExist = $v;
            }
            if($index['type'] == 'active'){
                $fieldActiveExist = $v;
            }            
        }
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost(); 
            $selectId = $this->_request->getParam('selectid');
            if(isset($meta['parent'])){
                if(empty($data['parentId']))
                    $data['parentId'] = 0;
            }           
            //Если для поля установлен параметр "strto", то переводим
            //либо в верхний регистр либо в нижний
            foreach ($meta['fields'] as $v => $index) {
                if(isset($index['strto'])){
                    if($index['strto'] == 'lower'){
                        $data[$v] = mb_strtolower($data[$v]);
                    }  
                    if($index['strto'] == 'upper'){
                        $data[$v] = mb_strtoupper($data[$v]);
                    }   
                }
            }            
            //если есть поле с типом image формируем массив для uploadPhoto, без пути для фоток.
            if($fieldImageExist) {
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

            $validate = $this->$_SESSION['modelName']->metaValidate($data, $mas, $isEdit);
            if(!$validate)
                parent::redirect ('admin/metadata/actions/referer/'.implode('_',$referer).'/modelName/'.$_SESSION['modelName'].'/actionName/edit/id/'.$id);
               
            //если есть поле с типом file
            if($fieldFileExist) {
                $fileInfo = $this->$_SESSION['modelName']->upload($fieldFileExist);
                if($fileInfo['success'] == true)
                    $data[$fieldFileExist] = $fileInfo['fileName'];
            } 
            
            if(!empty ($id)) {
                $this->$_SESSION['modelName']->save($data, $id);
                $_SESSION['notice'] = 'Updated!';
            } else {
                if($fieldImageExist) {
                    foreach ($fieldImageExist as $v => $array) {
                        foreach ($meta['fields'][$fieldImageExist[$v]['title']]['size'] as $name => $size) {
                            $data[$name] = '';
                        }
                    }
                }              
                $id = $this->$_SESSION['modelName']->add($data);
                $_SESSION['notice'] = 'Added!';
            }            
            //если есть поле с типом image получаем пути для фоток
            if($fieldImageExist) {
                $sizes = array();
                foreach ($fieldImageExist as $v => $array) {
                    //Путь к папке с фотками
                    $fieldImageExist[$v]['imagesDir'] = $meta['fields'][$fieldImageExist[$v]['title']]['imagesDir'].$id.'/';
                }
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
            $this->$_SESSION['modelName']->unsetFormData();
            if(!empty($selectId))
               $this->redirect('admin/'.$referer[0].(isset($referer[1])?'/'.$referer[1].'/id/'.$selectId:''.'/index/id/'.$selectId)); 
            else
                $this->redirect('admin/'.$referer[0].(isset($referer[1])?'/'.$referer[1]:''));
        }
        if(!empty ($id)){
            $_SESSION['formData'] = $this->$_SESSION['modelName']->details($id);
        }
        if(isset($fieldMainSelectExist) && $selectId != 0){
            $_SESSION['formData'][$fieldMainSelectExist] = $selectId;
        }        
        if(!empty ($parent) && isset($fieldSelectExist))
            $_SESSION['formData'][$fieldSelectExist] = $parent;  
        //Если существует поле с типом селект и на него указана таблица
        $result = array();
        if($fieldSelectExist) {
            if(isset($meta['fields'][$fieldSelectExist]['table'])){
                //Вставляем массив с результатом в Эдит
                //Если есть иерархия
                if(isset($meta['parent'])){    
                    //Если есть поле типа active
                    if($fieldActiveExist) { 
                        $result = array(
                            $meta['fields'][$fieldSelectExist]['table'] => 
                                $this->$_SESSION['modelName']->listing(0, 1, array($fieldSelectExist=>0, 'deleted'=>0, $fieldActiveExist=>0)));                         
                    } else {                  
                        $result = array(
                            $meta['fields'][$fieldSelectExist]['table'] => 
                                $this->$_SESSION['modelName']->listing(0, 1, array($fieldSelectExist=>0, 'deleted'=>0))); 
                    }
                } else {         
                    $result = array(
                        $meta['fields'][$fieldSelectExist]['table'] => 
                            $this->$_SESSION['modelName']->listingFromName($meta['fields'][$fieldSelectExist]['table']));
                }
            }
        }
        if(isset($meta['googleMap'])){
            $this->_view->mapEdit = true;
            $sripts[] = 'admin/map_edit.js';
            $this->_view->scripts = $sripts;
        }    
        $this->_view->html = $this->$_SESSION['modelName']->createHTML('admin/metadata/actions/modelName/'.$_SESSION['modelName'].'/actionName/edit/referer/'.implode('_',$referer).'/id/'.$id, $result, 'admin', $selectId);
        $this->_smarty->display('default.tpl');
        $this->$_SESSION['modelName']->unsetFormData();
    }
    
    public function view($id)
    {
        if(!empty ($id))
            $_SESSION['formData'] = $this->$_SESSION['modelName']->details($id);
        $referer = $this->_request->getParam('referer');
        $referer = explode('_', $referer);
        if(isset($this->$_SESSION['modelName']->modelMetadata['googleMap'])){
            $sripts[] = 'http://maps.google.com/maps/api/js?sensor=true';
            $sripts[] = 'scripts/markerclusterer_packed.js';
            $sripts[] = 'scripts/admin/map_view.js';
            $this->_view->scripts = $sripts;
        }        
        $backLink = $_SERVER['HTTP_REFERER'];
        $this->_view->html = $this->$_SESSION['modelName']->viewHTML(NULL, $backLink);
        $this->_smarty->display('default.tpl');
        $this->$_SESSION['modelName']->unsetFormData();
    }    
    
    public function mapviewAction()
    {
        $id = $this->_request->getParam('id');
        $meta = $this->$_SESSION['modelName']->modelMetadata;
        $metaKeys = array_keys($meta['fields']);
        $marker = $this->$_SESSION['modelName']->listing(0,1,array('deleted' => 0, $metaKeys[0] => $id));
        for($i=0; $i < count($marker['data']); $i++){
            $data['result'] = 'ok';
            $data['data'][$i]= array('lat' => $marker['data'][$i]['latitude'], 
                                     'lng' => $marker['data'][$i]['longitude'],
                                     'id' => $marker['data'][$i][$metaKeys[0]],
                );
        }
        echo json_encode($data);
    }        
    
    public function filterAction()
    {
        if($this->_request->isPost()) {
            $data = $this->_request->getPost();
            $explode = explode('_', $data['id']);
            $on = $explode[0];
            $table = $explode[1];
            $sql='SELECT 
                        '.$on.'
                    FROM
                        '.$table.'
                    WHERE
                        '.$on.' like '.$this->_db->quote('%'.$data['key'].'%').'
                        AND deleted=0';
            if(!empty($_SESSION['filterParams'])){
                $filter = $_SESSION['filterParams'];
                foreach ($filter as $key => $value) {
                    if($key != 'order')
                        $sql .= (isset ($value) ? ' AND ' . $key . ' = ' . $this->_db->quote($value) . ' ' : ' ');
                }
            }
            $sql .='
                    ORDER BY '.$on.'
                    LIMIT 5
                    ';
            //exit($sql);
            $result =  $this->_db->fetchAll($sql);  
            for($i=0; $i < count($result); $i++){
                $result[$i]['on'] = $result[$i][$on];
            }
            $this->_view->result = $result;
            $this->_view->i = $data['i'];
            $this->_smarty->display('filter.tpl');
        }
    }    
}