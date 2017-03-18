<?php

class MetaModelBase extends ModelBase
{

    public $modelMetadata = array();
    public $metadata = array();

    public function __construct($database = null)
    {
        parent::__construct($database);
        global $metadata;
        $this->metadata = $metadata;
        if(!empty($this->tableName))
            $this->modelMetadata = $this->metadata[$this->tableName];
    }

    public function details($id)
    {
        $fields = array_keys($this->modelMetadata['fields']);
        if (!empty ($id)) {
            $sql = 'SELECT * FROM `' . $this->modelMetadata['name'] . '`
                        WHERE ' . $fields[0] . ' = ' . (int) $id
                        . ' AND deleted = 0';
            $row = $this->_db->fetchRow($sql);
            return $row;
        } else {
            throw new Exception('Undefined \'' . $fields[0] . '\'');
        }
    }

    public function save($data, $id = NULL)
    {
        $sql = 'UPDATE  `' . $this->modelMetadata['name'] . '`
                SET ';
        $fields = array_keys($data);
        for ($i = 0; $i < count($fields); $i++) {
            if (isset($this->modelMetadata['fields'][$fields[$i]])) {
                $sql .= '`'.$fields[$i] . '` = ';
                switch ($this->modelMetadata['fields'][$fields[$i]]['type']) {
                    case 'pk':
                    case 'int':
                        $sql .= (int) $data[$fields[$i]] . (($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                    case 'double':
                        $sql .= (double) $data[$fields[$i]] . (($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                    case 'string':
                    case 'text':
                        $data[$fields[$i]] = $this->clearInputText($data[$fields[$i]]);
                        $sql .= $this->_db->quote($data[$fields[$i]]) . (($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                    case 'enum':
                    case 'date':
                    default:
                        $sql .= $this->_db->quote($data[$fields[$i]]) . (($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                }
            } else {
                /*throw new Exception("Field '" . $fields[$i] . "' does not
                    exists in table " . $this->modelMetadata['name']);*/
            }
        }
        $fields = array_keys($this->modelMetadata['fields']);
        $sql .= ' WHERE ' . $fields[0] . ' = ' . (int) $id;
//        echo $sql; exit();
        $this->_db->query($sql);
        return $id;
    }

    public function add($data)
    {
        $fields = array_keys($this->modelMetadata['fields']);
        $fields = array_slice($fields, 1);
        
        $fields2 = array();
        for($i=0; $i < count($fields); $i++)
            $fields2[$i] = '`'.$fields[$i].'`';
        $columns = join(', ', $fields2);
        
        $sql = 'INSERT INTO `' . $this->modelMetadata['name']
                . '` (' . $columns . ') VALUES (';
        for ($i = 0; $i < count($fields); $i++) {
            if (array_key_exists($fields[$i], $data)) {
                switch ($this->modelMetadata['fields'][$fields[$i]]['type']) {
                    case 'text':
                    case 'string':
                        $data[$fields[$i]] = $this->clearInputText($data[$fields[$i]]);
                        $sql .= $this->_db->quote($data[$fields[$i]]) . (($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                    case 'int':
                        $sql .= (int) $data[$fields[$i]] . (($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                    case 'double':
                        $sql .= (double) $data[$fields[$i]] . (($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                    case 'enum':
                    case 'date':
                    default:
                        $sql .= $this->_db->quote($data[$fields[$i]]) . (($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                }
            } elseif (isset($this->modelMetadata['fields'][$fields[$i]]['default']) || $this->modelMetadata['fields'][$fields[$i]]['type'] == 'order') {
                switch ($this->modelMetadata['fields'][$fields[$i]]['type']) {
                    case 'string':
                    case 'text':
                        $sql .= $this->_db->quote($this->modelMetadata['fields'][$fields[$i]]['default'])
                                . (($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                    case 'int':
                        $sql .= (int) $this->modelMetadata['fields'][$fields[$i]]['default']
                                . (($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                    case 'double':
                        $sql .= (double) $this->modelMetadata['fields'][$fields[$i]]['default']
                                . (($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                    case 'order':
                        $innerSql='SELECT '.$fields[$i].' FROM '.$this->modelMetadata['name'].' ORDER BY '.$fields[$i].' DESC LIMIT 1';
                        $result = $this->_db->fetchRow($innerSql);
                        $sql .= ($result[$fields[$i]]+1).(($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                    case 'date':
                        $sql .= $this->_db->quote($this->modelMetadata['fields'][$fields[$i]]['default'])
                                . (($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                    case 'enum':
                    default:
                        $sql .= $this->_db->quote($this->modelMetadata['fields'][$fields[$i]]['default'])
                                . (($i + 1) == (count($fields)) ? ' ' : ', ' );
                        break;
                }
            } else {
                $sql .= NULL;
            }
        }

        $sql .= ')';
        if(isset($_GET['debug'])){echo $sql. "<br />";exit();}
//        echo $sql;exit;
        $this->_db->query($sql);
        $fields = array_keys($this->modelMetadata['fields']);

        return $this->_db->lastInsertId($fields[0], $this->modelMetadata['name']);
    }

    /**
     * Listing method gets items list from table
     *
     * @param int $pageLength
     * @param int $page
     * @param array $filter
     * @return array
     */
    public function listing($pageLength = 0, $page = 1, $filter = NULL)
    {
        $select = 'SELECT ';
        if(!empty($filter['fields'])) {
            $select.= ' '.$filter['fields'];
            unset($filter['fields']);
        } else
            $select.= '* ';
        $sql = 'FROM `' . $this->modelMetadata['name'] . '` WHERE deleted = 0';
        if (!empty($filter) && is_array($filter)) {
            foreach ($filter as $key => $value) {
                if($key != 'order'){
                    $keyExplode = explode('?&', $key);
                    if(isset($keyExplode[1]) && $keyExplode[1] == 'not')
                        $sql .= (isset ($value) ? ' AND ' . $keyExplode[0] . ' <> ' . $this->_db->quote($value) . ' ' : ' ');
                    else
                        $sql .= (isset ($value) ? ' AND ' . $key . ' = ' . $this->_db->quote($value) . ' ' : ' ');
                }
            }
        }
        
        if(isset($this->modelMetadata['fields']))$fields = array_keys($this->modelMetadata['fields']);

        if(!empty($filter['order']))
            $orderBy = ' '.$filter['order'];
        elseif(isset($fields[0]) && empty($filter['order']))
            $orderBy = 'ORDER BY ' . $fields[0] . ' DESC ';
        else
            $orderBy = '';
        
        $list = $this->_pagingQuery($sql, $select, $orderBy, $pageLength, $page);
        if ( isset($_REQUEST['debug']) ) {
            echo $select.$sql.$orderBy.'<br />';
        }
        return $list;
    }

    
    public function ishighLighted($id, $highlight = 1)
    {
        $fields = array_keys($this->modelMetadata['fields']);
        if (!empty ($id)) {
            if (in_array('highLighted', $fields)) {
                $sql = 'UPDATE '. $this->modelMetadata['name']
                        . ' SET highLighted = ' . (int) $highlight . ' WHERE '.$fields[0] . ' = ' . (int) $id;
                $this->_db->query($sql);

              //  echo($sql);exit;

                return TRUE;
            } else {
                throw new Exception('Table \'' . $this->modelMetadata['name'] . '\' has not \'highLighted\' field');
            }
        } else {
            throw new Exception('Undefined \'' . $fields[0] . '\'');
        }
    }    
    /**
     * Sets deleted field to 1.
     * Returns TRUE if succeeded
     * and FALSE if flag 'nodelete' is set to 1.
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id)
    {
        $fields = array_keys($this->modelMetadata['fields']);
        if (!empty($id)) {
            if (in_array('deleted', $fields)) {
                if (isset($this->modelMetadata['nodelete']) && $this->modelMetadata['nodelete'] == 1) {
                    return FALSE;
                } else {
                    $sql = 'UPDATE `' . $this->modelMetadata['name'] . '` SET deleted = 1 '
                            . 'WHERE ' . $fields[0] . ' = ' . (int) $id;
                    $this->_db->query($sql);
                    return TRUE;
                }
            } else {
                throw new Exception('Table \'' . $this->modelMetadata['name'] . '\' has not \'deleted\' field');
            }
        } else {    
            throw new Exception('Undefined \'' . $fields[0] . '\'');
        }
    }

    /**
     * Sets 'approved' field
     *
     * @param int $id
     * @param int $approved
     */
    public function approved($id, $approved = 1, $fieldActive = 'approved')
    {
        $fields = array_keys($this->modelMetadata['fields']);
        if (!empty ($id)) {
            if (in_array($fieldActive, $fields)) {
                $sql = 'UPDATE `'. $this->modelMetadata['name']
                        . '` SET '.$fieldActive.' = ' . (int) $approved . ' WHERE '.$fields[0] . ' = ' . (int) $id;
                $this->_db->query($sql);

              //  echo($sql);exit;

                return TRUE;
            } else {
                throw new Exception('Table \'' . $this->modelMetadata['name'] . '\' has not \'approved\' field');
            }
        } else {
            throw new Exception('Undefined \'' . $fields[0] . '\'');
        }
    }

    /*
     *  Create HTML from MetaData.
     * Example:
     *  $this->_view->html = $this->Model_Name->createHTML();
     *  
     */
    public function createHTML($action = NULL, $editMode = array(), $mode = 'admin',$selectId=NULL, $addTr = NULL)
    {
        $meta = $this->modelMetadata['fields'];
        $metaFull = $this->modelMetadata;
        $fields = array_keys($meta);
        return BaseController::createHTML($action, $editMode, $meta, $metaFull, $fields, $mode, $selectId, $addTr);
        
    }
    
    public function createHTMLFront($action = NULL, $editMode = array(), $mode = 'admin',$selectId=NULL, $addTr = NULL)
    {
        $meta = $this->modelMetadata['fields'];
        $metaFull = $this->modelMetadata;
        $fields = array_keys($meta);
        return BaseController::createHTMLFront($action, $editMode, $meta, $metaFull, $fields, $mode, $selectId, $addTr);
        
    }    

    /*
     *  Function for validating entered data compare with MetaData.
     */
    public function metaValidate($data, $editMode = FALSE, $isEdit = TRUE)
    {
        // Captions:
        $errorSelect='Select';
        $errorEmail='Enter correct email';
        $errorString='Enter text in field';
        $errorDate='Select date in field';
        $errorText='Enter text in field';
        $errorImage='Select File in field';
        $errorFile='Select File in field';
        $errorInt='Enter integer in field';
        $errorDouble='Enter number in field';
        $errorCustom='Enter value in field';

        $meta = $this->modelMetadata['fields'];
        $fields = array_keys($meta);
        
        $empty = new Zend_Validate_NotEmpty();
        $int = new Zend_Validate_Digits();
        $email = new Zend_Validate_EmailAddress();
        $_SESSION['formData'] = $data;
        //var_dump($data);exit;
        for ($i = 0; $i < count($meta); $i++) 
        {
            if (isset ($meta[$fields[$i]]['validate']) ) 
            {
                switch ($meta[$fields[$i]]['type']) 
                {
                    case 'select':
                        if(!$empty->isValid(parent::clearInputText($data[$fields[$i]]))){
                            $_SESSION['error'] = $errorSelect.' "'.$meta[$fields[$i]]['title'].'"';
                            return FALSE;
                        } break;
                    case 'email':
                        if(!$email->isValid($data[$fields[$i]])){
                            $_SESSION['error'] = $errorEmail.' "'.$meta[$fields[$i]]['title'].'"';
                            return FALSE;
                        } break;
                    case 'string':
                        if(!$empty->isValid(parent::clearInputText($data[$fields[$i]])))
                        {
                            $_SESSION['error'] = $errorString.' "'.$meta[$fields[$i]]['title'].'"';
                            return FALSE;
                        } break;
                    case 'date':
                        if(!$empty->isValid($data[$fields[$i]])){
                            $_SESSION['error'] = $errorDate.' "'.$meta[$fields[$i]]['title'].'"';
                            return FALSE;
                        } break;
                    case 'text':
                        if(!$empty->isValid(parent::clearInputText($data[$fields[$i]]))){
                            $_SESSION['error'] = $errorText.' "'.$meta[$fields[$i]]['title'].'"';
                            return FALSE;
                        } break;
                    case 'textarea':
                        if(!$empty->isValid(parent::clearInputText($data[$fields[$i]]))){
                            $_SESSION['error'] = $errorText.' "'.$meta[$fields[$i]]['title'].'"';
                            return FALSE;
                        } break;                        
                    case 'image':
                        if(!$empty->isValid($data[$fields[$i]])){
                            if (!isset($_FILES) && isset($HTTP_POST_FILES))
                                $_FILES = $HTTP_POST_FILES;
                            if(empty ($_FILES[$fields[$i]]['name']) && trim($_FILES[$fields[$i]]['name']) == '' ||  
                                    $editMode == FALSE){
                                $_SESSION['error'] = $errorImage.' "'.$meta[$fields[$i]]['title'].'"';
                                return FALSE;
                            } break;
                        } break;
                    case 'file':
                        if(!$empty->isValid($data[$fields[$i]])){
                            if (!isset($_FILES) && isset($HTTP_POST_FILES))
                                $_FILES = $HTTP_POST_FILES;
                            if(empty ($_FILES[$fields[$i]]['name']) && trim($_FILES[$fields[$i]]['name']) == '' || $editMode == FALSE){
                                $_SESSION['error'] = $errorFile.' "'.$meta[$fields[$i]]['title'].'"';
                                return FALSE;
                            }
                         }break;
                    case 'int':
                        if(!$int->isValid($data[$fields[$i]])){
                            $_SESSION['error'] = $errorInt.' "'.$meta[$fields[$i]]['title'].'"';
                            return FALSE;
                        } break;
                    case 'double':
                        $data[$fields[$i]] = (double)$data[$fields[$i]];
                        if( $meta[$fields[$i]]['subtype'] == 'price' )
                        {
                            if($data[$fields[$i]] !=0 && empty($data[$fields[$i]]))
                            {
                                $_SESSION['error'] = $errorDouble.' "'.$meta[$fields[$i]]['title'].'"';
                                return FALSE;
                            }                             
                        }
                        else
                        {
                            if(empty($data[$fields[$i]]))
                            {
                                $_SESSION['error'] = $errorDouble.' "'.$meta[$fields[$i]]['title'].'"';
                                return FALSE;
                            } 
                        }
                        break;                     
                     case 'custom':
                        if(!$int->isValid($data[$fields[$i]])){
                            $_SESSION['error'] = $errorCustom.' "'.$meta[$fields[$i]]['title'].'"';
                            return FALSE;
                        } break;
                }
            }
            // Проверка на уникальность
            if (isset ($meta[$fields[$i]]['validate']) &&  isset ($meta[$fields[$i]]['uniq']) && !$isEdit) 
            {
                if( $meta[$fields[$i]]['uniq'] == 1 )
                {
                    $sql = 'SELECT * FROM `' . $this->modelMetadata['name'] . '`
                                WHERE `' . $fields[$i] . '` = ' . $this->_db->quote($data[$fields[$i]])
                                . ' AND deleted = 0';
                    $check = $this->_db->fetchRow($sql);    
                    if( $check )
                    {
                        $_SESSION['error'] = 'Запись с таким "'.$fields[$i].'" уже существует!';
                        return FALSE;                        
                    }
                }
            }
        }
        return TRUE;
    }
    
    /*
     * Developer ShidtDel -> elisey.atp@gmail.com
     *  Unset $_SESSION['formData']
     */

    public function unsetFormData()
    {
        if (isset ($_SESSION['formData']))
            unset ($_SESSION['formData']);
    }

    /*
     * Assign $_SESSION['formData'] from Details
     */
    public function setFormData($data)
    {
        $_SESSION['formData'] = $data;
    }

    /*
     *  Create MetaData from table
     *  $tableName - name of table
     */
    public function createMetaData($tableName)
    {
        $getFields = 'SHOW FULL FIELDS FROM `'.$tableName.'`';
        $fields = $this->_db->fetchAll($getFields);
        $tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
        $html = "'".$tableName."' => array(<br />
                $tab'title' => '".$tableName."',<br />
                $tab'name' => '".$tableName."', <br />
                $tab'fields' => array(<br />";
        
        $html.="$tab$tab'".$fields[0]['Field']."' => array('title'=> 'Primary Key', 'type'=> 'pk'),<br />";
        
        for ($i = 1; $i < count($fields); $i++) {
            //Если поле называется deleted то добавим ему соответствующий тип
            if($fields[$i]['Field'] == 'deleted'){
                $html.="$tab$tab'".$fields[$i]['Field']."' => array('title'=> '".$fields[$i]['Field']."', 'type'=> 'delete','default'=>0, 'showInListing' => '3'),<br />";
                continue;
            }
            //Если поле называется active то добавим ему соответствующий тип
            if($fields[$i]['Field'] == 'active' || $fields[$i]['Field'] == 'approved'){
                $html.="$tab$tab'".$fields[$i]['Field']."' => array('title'=> '".$fields[$i]['Field']."', 'type'=> 'active','default'=>1, 'showInListing' => '3'),<br />";
                continue;
            }
            $explodeField = explode('(', $fields[$i]['Type']);
            //Пробегаемся по типам
            switch ($explodeField[0]){
                case 'tinyint':
                case 'int': $html.="$tab$tab'".$fields[$i]['Field']."' => array('title'=> '".$fields[$i]['Field']."', 'type'=> 'int'";
                    break;
                case 'double': $html.="$tab$tab'".$fields[$i]['Field']."' => array('title'=> '".$fields[$i]['Field']."', 'type'=> 'double'";
                    break;
                case 'double unsigned': $html.="$tab$tab'".$fields[$i]['Field']."' => array('title'=> '".$fields[$i]['Field']."', 'type'=> 'double'";
                    break;                
                case 'varchar': $html.="$tab$tab'".$fields[$i]['Field']."' => array('title'=> '".$fields[$i]['Field']."', 'type'=> 'string'";
                    break;
                case 'enum': $html.="$tab$tab'".$fields[$i]['Field']."' => array('title'=> '".$fields[$i]['Field']."', 'type'=> 'select',<br />
                    $tab$tab$tab$tab'values' => array<br />";
                    $html.="$tab$tab$tab$tab(<br />";
                    $values = explode("'", $fields[$i]['Type']);
                    foreach ($values as $index => $v) {
                        if(is_int(($index+1)/2))
                        $html.="$tab$tab$tab$tab$tab$tab'$v' => '$v',<br />";
                    }
                    $html.="$tab$tab$tab$tab)";
                    break;
                case 'text': $html.="$tab$tab'".$fields[$i]['Field']."' => array('title'=> '".$fields[$i]['Field']."', 'type'=> 'text'";
                    break;
                case 'date': $html.="$tab$tab'".$fields[$i]['Field']."' => array('title'=> '".$fields[$i]['Field']."', 'type'=> 'date'";
                    break;
                case 'datetime': $html.="$tab$tab'".$fields[$i]['Field']."' => array('title'=> '".$fields[$i]['Field']."', 'type'=> 'date'";
                    break;
            }
            //Добавляем дефолтные значения
            if(!empty($fields[$i]['Default']) || $fields[$i]['Default']==0) {
                switch ($fields[$i]['Default']) {
                    case 'NULL': break;
                    case '': break;
                    default: $html.=", 'default' => '".$fields[$i]['Default']."'"; break;
                }
            }
            if($fields[$i]['Null'] == 'NO'){
                $html.= ", 'validate' => 'require'";
            }
            //Добавляем showInListing
            $html.=", 'showInListing' => ''";
            $html.="),<br />";
            //Переходим в следующему полю
        }
        $html.="$tab),<br />";
        //Добавляем edit, add и view
        $html .= "
                $tab'edit' => '1',<br />
                $tab'add' => '1', <br />
                $tab'view' => '1' <br />";        
        $html.="),";        
        return $html;
    }
    /**
     * Upload files
     * @param type $fileName
     * @return array('fileName'=>'Name', 'success'=>true/false)
     * 
     * Example:
     *  $array = $this->Test->upload('fileName');
     */
    public function upload($fileName, $sizeLimit = NULL, $additionalDir = '')
    {
        if (!isset($_FILES) && isset($HTTP_POST_FILES))
            $_FILES = $HTTP_POST_FILES;
        
        $success = false;
        $returnArray = array('fileName'=>'', 'success'=>false);
        $meta = $this->modelMetadata['fields'][$fileName];
        $cnf = Zend_Registry::get('cnf');
        
        if (!file_exists($cnf->path->public.$meta['filePath'])) {
            mkdir($cnf->path->public.$meta['filePath'], 0777, TRUE);
            @chmod($cnf->path->public.$meta['filePath'], 0777);
        }
        
        $meta['filePath'] .= $additionalDir.'/';
        
        if (!file_exists($cnf->path->public.$meta['filePath'])) {
            mkdir($cnf->path->public.$meta['filePath'], 0777, TRUE);
            @chmod($cnf->path->public.$meta['filePath'], 0777);
        }        
        
        if(isset($_FILES[$fileName]) && !empty($_FILES[$fileName]['name'])) {
            if( 
                    empty($sizeLimit) || 
                    ( !empty($sizeLimit) && $_FILES[$fileName]['size'] < (int)$sizeLimit) 
            )
            {
                    if(file_exists($cnf->path->public.$meta['filePath'].$_FILES[$fileName]['name'])) {
                        $nameArray = explode('.', $_FILES[$fileName]['name']); // тут получишь 0 => Имя файл, 1=>расширение
                        if(count($nameArray)<2) {
                            $_SESSION['error'] = 'Invalid uploaded file!';
                            exit('Error: Incorrect file name!');
                        }

                        $extention = end($nameArray);
                        unset($nameArray[count($nameArray)-1]);
                        $name = implode('.', $nameArray);

                        $count = 1; //счетчик, начнем с 1 красивее будет чем с нуля :)
                        while(true){
                            if($count> 100)
                                break;
                            if(file_exists($cnf->path->public.$meta['filePath'].$name.'_'.$count.'.'.$extention))
                                $count++;      
                            else {
                                $newName = $name.'_'.$count.'.'.$extention;
        //                        $returnArray['fileName'] = $meta['filePath'].$newName;
                                $returnArray['fileName'] = $newName;
                                if(copy($_FILES[$fileName]["tmp_name"], $cnf->path->public.$meta['filePath'].$newName))
                                    $success = true;
                                else
                                    $success = false;
                                break;
                            }
                        }          
                    } else {
        //                $returnArray['fileName'] = $meta['filePath'].$_FILES[$fileName]['name'];
                        $returnArray['fileName'] = $_FILES[$fileName]['name'];
                        if(copy($_FILES[$fileName]["tmp_name"], $cnf->path->public.$meta['filePath'].$_FILES[$fileName]['name']))
                            $success = true;
                        else
                            $success = false;
                    }
            } else {
                $_SESSION['error'] = 'The file is too large';
            }
        }
        $returnArray['success'] = $success;
        return $returnArray; 
    }

    public function listingHTML($htmlParams = array(), $pageLength=10, $page=1, $filter=array(), $id = 0, $needPage = TRUE, $addEdit = TRUE)
    {
        $noRecordsMessage = 'Нет записей!';
        $deleteTitle = 'Удалить';
        $editTitle = 'Ред.';
        $parentAddTitle = 'Добавить';
        $viewTitle = 'Просм.';
        $addTitle = 'Добавить запись';
        if(empty($htmlParams['controller']))
            return '<table><thead><td style="color:red;">Error! You not set param "controller" in listingHTML settings</td></thead></table>';
        $meta = $this->modelMetadata['fields'];
        //Ищем существует ли поле с ордером
        $fieldOrderExist = FALSE;
        foreach ($meta as $v => $index) {
            if($index['type'] == 'order')
                $fieldOrderExist = $v;
        }
        //Если есть
        if($fieldOrderExist){
            $filter['order'] = 'ORDER BY '.$fieldOrderExist.' ASC';
        }

        $fields = array_keys($meta);
        $html='<table class="adminTable">';
        //Если можно добавлять
        if(isset($this->modelMetadata['add']) && $addEdit == TRUE) {
            //для автоматического подхватывания id вышестоящей таблицы
            if($id > 0 ){
                if( isset($this->modelMetadata['addUrl']) ) {
                    $html.='
                        <thead>
                            <td colspan="20">
                                <input type="button" value="'.$addTitle.'" onclick="location.href=rootPath+\''.$this->modelMetadata['addUrl'].'selectid/'.$id.'\';"/>
                            </td>
                        </thead>
                        ';                    
                } else {
                    $html.='
                        <thead>
                            <td colspan="20">
                                <input type="button" value="'.$addTitle.'" onclick="location.href=rootPath+\''.(isset($htmlParams['editActionName'])?'admin/'.$htmlParams['controller'].'/'.$htmlParams['editActionName']:'admin/metadata/actions/actionName/edit/referer/'.$htmlParams['controller'].(isset($htmlParams['indexActionName'])?'_'.$htmlParams['indexActionName']:'').'/modelName/'.$htmlParams['modelName']).'/selectid/'.$id.'\';"/>
                            </td>
                        </thead>
                        ';
                }
            } else {
                if( isset($this->modelMetadata['addUrl']) ) {
                    $html.='
                        <thead>
                            <td colspan="20">
                                <input type="button" value="'.$addTitle.'" onclick="location.href=rootPath+\''.$this->modelMetadata['addUrl'].'\';"/>
                            </td>
                        </thead>
                        ';               
                } else {                
                    $html.='
                        <thead>
                            <td colspan="20">
                                <input type="button" value="'.$addTitle.'" onclick="location.href=rootPath+\''.(isset($htmlParams['editActionName'])?'admin/'.$htmlParams['controller'].'/'.$htmlParams['editActionName']:'admin/metadata/actions/actionName/edit/referer/'.$htmlParams['controller'].(isset($htmlParams['indexActionName'])?'_'.$htmlParams['indexActionName']:'').'/modelName/'.$htmlParams['modelName']).'/\';"/>
                            </td>
                        </thead>
                        ';
                }
            }
        }
        
        //Если есть фильтр
        unset($_SESSION['htmlParams']);
        unset($_SESSION['filterParams']);
        if(isset($this->modelMetadata['filter'])) {
            $_SESSION['htmlParams'] = $htmlParams; 
            $_SESSION['filterParams'] = $filter;    
            $filterMeta = $this->modelMetadata['filter'];
            $value = array();
            if(isset($_SESSION['filterResult']) && isset($_SESSION['i'])){
                $filter[$filterMeta[$_SESSION['i']]['on']] = $_SESSION['filterResult'];
                $value[$_SESSION['i']] = $_SESSION['filterResult'];
            }         
            $html.='<thead><td colspan="20">';  
            for($i=0; $i < count($filterMeta); $i++){
                $html.='<div style="float: left; width: 200px; text-align: right;" id="filterLength_'.$i.'">'.$filterMeta[$i]['title'].' 
                    <input id="'.$filterMeta[$i]['on'].'_'.$filterMeta[$i]['table'].'"';
                if(isset($value[$i]))
                    $html.= ' value="'.$value[$i].'" '; 
                else      
                    $html.= ' value="" ';
                $html.= 'type="text" style="width: 125px;" onkeyup="filter(this.value, this.id, '.$i.');"/>
                    <div id="autocomplete_'.$i.'" style="display:none; padding: 5px; width:150px; left: 12px; top: 66px; position: absolute; z-index: 10000;background-color: #FFF;border: 1px solid #777; -moz-border-radius:3px;-webkit-border-radius:3px;">
                        <div id="contentVariant_'.$i.'"></div>
                    </div></div>                  
                    ';
            }
            $html.='</td></thead>';      
        }    
        //Если иерархическая структура
        if(isset($this->modelMetadata['parent'])) {
            $filter['parentId'] = 0;
            $listing = self::listing($pageLength, $page, $filter);
            for($count=0; $count < count($listing['data']); $count++){
                $filter['parentId'] = $listing['data'][$count][$fields[0]];
                $listing['data'][$count]['child'] = self::listing(0, 1, $filter);
            }
        } else {
            $listing = self::listing($pageLength, $page, $filter);
        }
        $html.='
                <thead>';
        foreach ($fields as $v) {
            if(isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==1 ||
                    isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==3) {
                if($this->modelMetadata['fields'][$v]['type'] != 'delete'){
                    switch ($this->modelMetadata['fields'][$v]['type']){
                        case 'active':
                        case 'order':
                        case 'image':
                            $html.='<td width="1%">'.$this->modelMetadata['fields'][$v]['title'].'</td>';
                            break;
                        default:
                            if($v == 'title')
                                $html.='<td>'.$this->modelMetadata['fields'][$v]['title'].'</td>';
                            else
                                $html.='<td>'.$this->modelMetadata['fields'][$v]['title'].'</td>';
                            break;
                    }
                }
            }
        }
        if(isset($this->modelMetadata['parent'])) {
            $html.='<td width="1%">'.$parentAddTitle.'</td>';
        }        
        if(isset($this->modelMetadata['additionalFields'])) {
            foreach ($this->modelMetadata['additionalFields'] as $v) {
                $html.='<td width="1%">'.$v['title'].'</td>';
            }
        }      
        //Если можно редактировать
        if(isset($this->modelMetadata['edit']) && $addEdit == TRUE) {
            $html.='<td width="1%">'.$editTitle.'</td>';
        }
        //Если можно просматривать
        if(isset($this->modelMetadata['view'])) {
            $html.='<td width="1%">'.$viewTitle.'</td>';
        }        
        foreach ($fields as $v) {
            if(isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==1 ||
                    isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==3) {
                if($this->modelMetadata['fields'][$v]['type'] == 'delete'){                    
                    $html.='<td width="1%">'.$this->modelMetadata['fields'][$v]['title'].'</td>';
                }
            }
        }        
        $html.='</thead><tbody>';
        
        if(count($listing['data'])>0) {
            for ($i = 0; $i < count($listing['data']); $i++) {
                $html.='<tr id="record'.$listing['data'][$i][$fields[0]].'">';
                foreach ($fields as $v) {
                    if(isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==1 ||
                            isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==3) {
                        switch ($this->modelMetadata['fields'][$v]['type']) {
                            case 'active':
                                $html.='<td align="center" id="approve'.$listing['data'][$i][$fields[0]].$v.'">';
                                if($listing['data'][$i][$v] == 1)
                                    $html.='<img style="cursor: pointer" src="icon/active.png" alt="delete" onclick="approveRecord(\'admin/metadata/actions/actionName/disactive/fieldActive/'.$v.'/modelName/'.$htmlParams['modelName'].'\', '.$listing['data'][$i][$fields[0]].', \''.$v.'\');" />';
                                else
                                    $html.='<img style="cursor: pointer" src="icon/inactive.png" alt="delete" onclick="approveRecord(\'admin/metadata/actions/actionName/active/fieldActive/'.$v.'/modelName/'.$htmlParams['modelName'].'\', '.$listing['data'][$i][$fields[0]].', \''.$v.'\');"/>';
                                $html.'</td>';
                                break;
                            case 'delete':
                                break;
                            case 'text':
                            case 'textarea':
                                $subStr = substr(strip_tags($listing['data'][$i][$v]),0,80);
                                $html.='<td>'.$subStr.'...</td>';
                                break;
                            case 'select':
                                if(isset($this->modelMetadata['fields'][$v]['table'])) {
                                    $fieldsInner = array_keys($this->metadata[$this->modelMetadata['fields'][$v]['table']]['fields']);
                                    $sql = 'SELECT * FROM ' . $this->modelMetadata['fields'][$v]['table'] . '
                                                WHERE ' . $fieldsInner[0] . ' = ' . (int) $listing['data'][$i][$v]
                                                . ' AND deleted = 0';
                                    $result = $this->_db->fetchRow($sql);
                                    //Для вывода иерархии категорий, типа "хлебных крошек". До 3 уровня
                                    if(isset($result['parentId']) && $result['parentId']!=0){
                                        $sql2 = 'SELECT * FROM ' . $this->modelMetadata['fields'][$v]['table'] . '
                                                    WHERE ' . $fieldsInner[0] . ' = ' . (int) $result['parentId']
                                                    . ' AND deleted = 0';
                                        $result2 = $this->_db->fetchRow($sql2); 
                                        if(isset($result2['parentId']) && $result2['parentId']!=0){
                                            $sql3 = 'SELECT * FROM ' . $this->modelMetadata['fields'][$v]['table'] . '
                                                        WHERE ' . $fieldsInner[0] . ' = ' . (int) $result2['parentId']
                                                        . ' AND deleted = 0';
                                            $result3 = $this->_db->fetchRow($sql3); 
                                            $result['title'] = $result3['title'].'-&rsaquo; <br />'.$result2['title'].'-&rsaquo; <br />'.$result['title'];
                                        } else {
                                           $result['title'] = $result2['title'].'-&rsaquo; <br />'.$result['title'];
                                        }
                                    }
                                    //Если можно изменять значение в листинге
                                    if(isset($this->modelMetadata['fields'][$v]['quickChange'])) 
                                    {
                                        $sql2 = 'SELECT * FROM ' . $this->modelMetadata['fields'][$v]['table'] . '
                                                    WHERE deleted = 0';
                                        $listingSelectTable = $this->_db->fetchAll($sql2);
                                        if(isset($this->modelMetadata['fields'][$v]['width']))
                                            $style = 'width: '.$this->modelMetadata['fields'][$v]['width'];
                                        else
                                            $style = '';
                                        $html.='<td><select name="' . $v . '" style="'.$style.'" onchange="changeSelect(\'admin/metadata/actions/actionName/select/modelName/'.$htmlParams['modelName'].'/id/'.$listing['data'][$i][$fields[0]].'\', $(this).val(), \''.$v.'\');">';
                                        if(!empty($result))
                                            $html.='<option value="' . $result[$v] . '">'.$result['title'].'</option>';
                                        else
                                            $html.='<option></option>';              
                                        for ($j = 0; $j < count($listingSelectTable); $j++) {
                                            $f = array_keys($listingSelectTable[$j]);
                                            if($listingSelectTable[$j][$v] != $result[$v]){
                                                $html.='<option value="' . $listingSelectTable[$j][$f[0]] . '" >' . $listingSelectTable[$j][$f[1]] . '</option>';
                                            }
                                        }
                                        $html.='</select></td>';
                                    } else {
                                        if(isset($result['title']))
                                            $for_echo = $result['title'];
                                        else {
                                            if ( is_array($result)) {
                                                $keys = array_keys($result);
                                                $for_echo = $result[$keys[1]];
                                            } else {
                                                $for_echo ="";
                                            }
                                        }
                                        $html.='<td>'.$for_echo.'</td>';
                                    }
                                } 
                                elseif(isset($this->modelMetadata['fields'][$v]['values']))
                                {
                                    //Если можно изменять значение в листинге
                                    if(isset($this->modelMetadata['fields'][$v]['quickChange'])) {
                                        $values = $this->modelMetadata['fields'][$v]['values'];
                                        if(isset($this->modelMetadata['fields'][$v]['width']))
                                            $style = 'width: '.$this->modelMetadata['fields'][$v]['width'];
                                        else
                                            $style = '';
                                        $html.='<td><select name="' . $v . '" style="'.$style.'" onchange="changeSelect(\'admin/metadata/actions/actionName/select/modelName/'.$htmlParams['modelName'].'/id/'.$listing['data'][$i][$fields[0]].'\', $(this).val(), \''.$v.'\');">';
                                        if(!empty($listing['data'][$i][$v]))
                                            $html.='<option value="' . $listing['data'][$i][$v] . '">'.$this->modelMetadata['fields'][$v]['values'][$listing['data'][$i][$v]].'</option>';
                                        else
                                            $html.='<option></option>';      
                                        foreach ($values as $name => $title) {
                                            if($name != $listing['data'][$i][$v]){
                                                $html.='<option value="' . $name . '" >' . $title . '</option>';
                                            }                                            
                                        }                                        
                                        $html.='</select></td>';
                                    } else {                                    
                                        $html.='<td>'.$this->modelMetadata['fields'][$v]['values'][$listing['data'][$i][$v]].'</td>';
                                    }
                                }
                                break;
                            case 'audio':
                                if(!empty($listing['data'][$i][$v])){
                                    $html.= '<td><embed id="mymovie" 
                                                width="73" 
                                                height="30" 
                                                flashvars="autoPlay=no&overColor=FF6633&playerSkin=1&soundPath=song/'.$listing['data'][$i][$v].'" 
                                                quality="high" 
                                                bgcolor="#FFFFFF" 
                                                name="mymovie" 
                                                style="" 
                                                src="media/flash/player.swf" 
                                                type="application/x-shockwave-flash"/></td>';
                                }else{
                                    $html.= '<td></td>';                                    
                                }
                                break;                                     
                            case 'order':
                                $html.='
                                    <td align="center">
                                        <nobr>
                                            <a href="admin/metadata/actions/actionName/up/modelName/'.$htmlParams['modelName'].'/fieldName/'.$fieldOrderExist.'/order/'.$listing['data'][$i][$fieldOrderExist].'"><img src="icon/arrow-up.png" height="15"/></a>&nbsp;&nbsp;
                                            <a href="admin/metadata/actions/actionName/down/modelName/'.$htmlParams['modelName'].'/fieldName/'.$fieldOrderExist.'/order/'.$listing['data'][$i][$fieldOrderExist].'"><img src="icon/arrow-down.png" height="15"/></a>
                                        </nobr>
                                    </td>
                                ';
                                break;
                            case 'image':
                                $html.='<td>';                                
                                if(isset($this->modelMetadata['fields'][$v]['additionalImagesDir']))
                                    $html.=' <img src="' . $this->modelMetadata['fields'][$v]['imagesDir'].$listing['data'][$i][$this->modelMetadata['fields'][$v]['additionalImagesDir']]. '/' .$listing['data'][$i][$fields[0]]. '/' . $listing['data'][$i][$v] . '" /> ';
                                else
                                    $html.='<img src="'.$this->modelMetadata['fields'][$v]['imagesDir'].$listing['data'][$i][$fields[0]].'/'.$listing['data'][$i][$v].'" style="max-width:75px; max-height: 75px;"/>';                             
                                $html.='</td>';
                                break;
                            case 'file':
                                $html.='<td>';                                
                                if(isset($this->modelMetadata['fields']['fileName']) && !isset($this->modelMetadata['fields'][$v]['fileLink']))
                                    $html.=' <a href="'.$listing['data'][$i][$v].'">'.$listing['data'][$i]['fileName'].'</a>';
                                elseif(isset($this->modelMetadata['fields'][$v]['fileLink']))
                                    $html.=' <a href="'.$this->modelMetadata['fields'][$v]['fileLink'].$listing['data'][$i]['unikey'].'" target="_blank">'.$listing['data'][$i]['fileName'].'</a>';
                                else
                                    $html.='<td>'.$listing['data'][$i][$v].'</td>';                            
                                $html.='</td>';
                                break;                                
                            case 'price':
                                $html.='<td> $'.$listing['data'][$i][$v].'</td>';
                                break;  
                            case 'color':
                                $html.='
                                    <td align="center">
                                        <div id="previewListing" style="background-color:#'.$listing['data'][$i][$v].'"></div>
                                    </td>
                                ';
                                break;   
                            default:
                                if(isset($this->modelMetadata['fields'][$v]['quickChange']))
                                {
                                    $html.='<td>'
                                            . '<input type="text" value="'.$listing['data'][$i][$v].'" style="width: 40px;"  onblur="quickChangeInput(\'admin/metadata/actions/actionName/inputchange/modelName/'.$htmlParams['modelName'].'/id/'.$listing['data'][$i][$fields[0]].'\', $(this).val(), \''.$v.'\');" />'
                                            . '</td>';
                                }
                                else
                                {
                                    $html.='<td>'.$listing['data'][$i][$v].'</td>';
                                }
                                break;
                        }
                    }
                }
                
                if(isset($this->modelMetadata['parent'])) {  
                    $html.='<td width="1%" class="icon">
                                <a href="'.(isset($htmlParams['editActionName'])?'admin/'.$htmlParams['controller'].'/'.$htmlParams['editActionName']:'admin/metadata/actions/actionName/edit/referer/'.$htmlParams['controller'].'/modelName/'.$htmlParams['modelName']).'/parent/'.$listing['data'][$i][$fields[0]].'" title="'.$parentAddTitle.'">
                                    <img src="icon/add.png" alt="Add" />
                                </a>
                            </td>';                    
                }              
                // отрисовываем дополнительные поля
                // Пример создания своего Action для approved
                //'additionalFields'=>array(
                //      array('title'=>'Подтверждение', 'action'=>'admin/post/approve', 'inner'=>'active', 'field'=>'isHead'),
                //)   
                // action - экшен, выполняемый по клику
                // inner - ставить active
                // field - поле типа active для которого заменяется экшен аппрува и дизапрува
                if(isset($this->modelMetadata['additionalFields'])) {
                    foreach ($this->modelMetadata['additionalFields'] as $v) {
                        if($v['inner'] == 'active'){
                            $html.='<td width="1%" class="icon" id="approve_'.$listing['data'][$i][$fields[0]].'">
                                        <a href="javascript:;" onclick="approveAdditionalFields('.$listing['data'][$i][$fields[0]].' , \''.$v['action'].'\');">';     
                            if($listing["data"][$i][$v['field']] == 1)
                                $html.='<img src="styles/src/admin/active.png" />';
                            else
                                $html.='<img src="styles/src/admin/inactive.png" />';
                            $html.='</a></td>'; 
                        }
                        else{
                            if(isset($v['onclick'])){
                                $html.='<td width="1%" class="icon">
                                            <a href="javascript:void(0);" onclick="'.str_replace("param", $listing['data'][$i][$fields[0]], $v['onclick']).'">'.$v['inner'].'</a>
                                        </td>';                                
                            } else {
                                $html.='<td width="1%" class="icon">
                                            <a href="'.$v['link'].$listing['data'][$i][$fields[0]].'">'.$v['inner'].'</a>
                                        </td>';                                
                            }
                        }
                    }
                }
                if(isset($this->modelMetadata['edit']) && $addEdit == TRUE) {
                    if($id > 0 ){
                        $html.='
                            <td class="icon">
                                <a href="'.(isset($htmlParams['editActionName'])?'admin/'.$htmlParams['controller'].'/'.$htmlParams['editActionName']:'admin/metadata/actions/actionName/edit/referer/'.$htmlParams['controller'].(isset($htmlParams['indexActionName'])?'_'.$htmlParams['indexActionName']:'').'/modelName/'.$htmlParams['modelName']).'/id/'.$listing['data'][$i][$fields[0]].'/selectid/'.$id.'" title="'.$editTitle.'">
                                    <img src="icon/edit.png" alt="'.$editTitle.'" />
                                </a>
                            </td>
                            ';                        
                    } else {                    
                        $html.='
                            <td class="icon">
                                <a href="'.(isset($htmlParams['editActionName'])?'admin/'.$htmlParams['controller'].'/'.$htmlParams['editActionName']:'admin/metadata/actions/actionName/edit/referer/'.$htmlParams['controller'].(isset($htmlParams['indexActionName'])?'_'.$htmlParams['indexActionName']:'').'/modelName/'.$htmlParams['modelName']).'/id/'.$listing['data'][$i][$fields[0]].'" title="'.$editTitle.'">
                                    <img src="icon/edit.png" alt="'.$editTitle.'" />
                                </a>
                            </td>
                            ';
                    }
                }
                if(isset($this->modelMetadata['view'])) {
                    $html.='
                        <td class="icon">
                            <a href="'.(isset($htmlParams['viewActionName'])?'admin/'.$htmlParams['controller'].'/'.$htmlParams['viewActionName']:'admin/metadata/actions/actionName/view/referer/'.$htmlParams['controller'].(isset($htmlParams['indexActionName'])?'_'.$htmlParams['indexActionName']:'').'/modelName/'.$htmlParams['modelName']).'/id/'.$listing['data'][$i][$fields[0]].'" title="'.$viewTitle.'">
                                <img src="icon/view.png" alt="'.$editTitle.'" />
                            </a>
                        </td>
                        ';
                }
                foreach ($fields as $v) {
                    if(isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==1 ||
                            isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==3) {
                        if($this->modelMetadata['fields'][$v]['type'] == 'delete'){
                            if(isset($listing['data'][$i]['undeleteble']) && $listing['data'][$i]['undeleteble'] == 1){
                                $html.='
                                    <td class="icon"></td>
                                ';                                    
                            }
                            else{
                                $html.='
                                    <td class="icon">
                                        <img style="cursor: pointer" src="icon/101.png" width="15" title="'.$deleteTitle.'" alt="'.$deleteTitle.'" onclick="metaDeleteRecord(\''.(isset($htmlParams['deleteAction'])?$htmlParams['deleteAction']:'admin/metadata/actions/actionName/delete/modelName/'.$htmlParams['modelName']).'\', '.$listing['data'][$i][$fields[0]].');"/>
                                    </td>
                                ';
                            }
                        }
                    }
                }                
                $html.='</tr>';
                if(isset($this->modelMetadata['parent'])) {
                    if($listing['data'][$i]['parentId'] == 0){
                        if(count($listing['data'][$i]['child']['data']) > 0){
                            for ($j = 0; $j < count($listing['data'][$i]['child']['data']); $j++) {
                                $html.='<tr id="record'.$listing['data'][$i]['child']['data'][$j][$fields[0]].'">';
                                foreach ($fields as $v) {
                                    if(isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==1 ||
                                            isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==3) {
                                        switch ($this->modelMetadata['fields'][$v]['type']) {
                                            case 'active':
                                                $html.='<td align="center" id="approve'.$listing['data'][$i]['child']['data'][$j][$fields[0]].$v.'">';
                                                if($listing['data'][$i]['child']['data'][$j][$v] == 1)
                                                    $html.='<img style="cursor: pointer" src="icon/active.png" alt="delete" onclick="approveRecord(\'admin/metadata/actions/actionName/disactive/fieldActive/'.$v.'/modelName/'.$htmlParams['modelName'].'\', '.$listing['data'][$i]['child']['data'][$j][$fields[0]].', \''.$v.'\');" />';
                                                else
                                                    $html.='<img style="cursor: pointer" src="icon/inactive.png" alt="delete" onclick="approveRecord(\'admin/metadata/actions/actionName/active/fieldActive/'.$v.'/modelName/'.$htmlParams['modelName'].'\', '.$listing['data'][$i]['child']['data'][$j][$fields[0]].', \''.$v.'\');"/>';
                                                $html.'</td>';
                                                break;
                                            case 'delete':
                                                break;
                                            case 'text':
                                            case 'textarea':
                                                $subStr = substr(strip_tags($listing['data'][$i]['child']['data'][$j][$v]),0,80);
                                                $html.='<td>'.$subStr.'...</td>';
                                                break;
                                            case 'select':
                                                if(isset($this->modelMetadata['fields'][$v]['table'])) {
                                                    $fieldsInner = array_keys($this->metadata[$this->modelMetadata['fields'][$v]['table']]['fields']);
                                                    $sql = 'SELECT * FROM ' . $this->modelMetadata['fields'][$v]['table'] . '
                                                                WHERE ' . $fieldsInner[0] . ' = ' . (int) $listing['data'][$i]['child']['data'][$j][$v]
                                                                . ' AND deleted = 0';
                                                    $result = $this->_db->fetchRow($sql);
                                                    //Если можно изменять значение в листинге
                                                    if(isset($this->modelMetadata['fields'][$v]['quickChange'])) {
                                                        $sql2 = 'SELECT * FROM ' . $this->modelMetadata['fields'][$v]['table'] . '
                                                                    WHERE deleted = 0';
                                                        $listingSelectTable = $this->_db->fetchAll($sql2);
                                                        if(isset($this->modelMetadata['fields'][$v]['width']))
                                                            $style = 'width: '.$this->modelMetadata['fields'][$v]['width'];
                                                        else
                                                            $style = '';
                                                        $html.='<td><select name="' . $v . '" style="'.$style.'" onchange="changeSelect(\'admin/metadata/actions/actionName/select/modelName/'.$htmlParams['modelName'].'/id/'.$listing['data'][$i]['child']['data'][$j][$fields[0]].'\', $(this).val(), \''.$v.'\');">';
                                                        if(!empty($result))
                                                            $html.='<option value="' . $result[$v] . '">'.$result['title'].'</option>';
                                                        else
                                                            $html.='<option></option>';              
                                                        for ($j = 0; $j < count($listingSelectTable); $j++) {
                                                            $f = array_keys($listingSelectTable[$j]);
                                                            if($listingSelectTable[$j][$v] != $result[$v]){
                                                                $html.='<option value="' . $listingSelectTable[$j][$f[0]] . '" >' . $listingSelectTable[$j][$f[1]] . '</option>';
                                                            }
                                                        }
                                                        $html.='</select></td>';
                                                    } else {
                                                        if(isset($result['title']))
                                                            $for_echo = $result['title'];
                                                        else {
                                                            if ( is_array($result)) {
                                                                $keys = array_keys($result);
                                                                $for_echo = $result[$keys[1]];
                                                            } else {
                                                                $for_echo ="";
                                                            }
                                                        }
                                                        $html.='<td>'.$for_echo.'</td>';
                                                    }
                                                } elseif(isset($this->modelMetadata['fields'][$v]['values'])){
                                                    //Если можно изменять значение в листинге
                                                    if(isset($this->modelMetadata['fields'][$v]['quickChange'])) {
                                                        $values = $this->modelMetadata['fields'][$v]['values'];
                                                        if(isset($this->modelMetadata['fields'][$v]['width']))
                                                            $style = 'width: '.$this->modelMetadata['fields'][$v]['width'];
                                                        else
                                                            $style = '';
                                                        $html.='<td><select name="' . $v . '" style="'.$style.'" onchange="changeSelect(\'admin/metadata/actions/actionName/select/modelName/'.$htmlParams['modelName'].'/id/'.$listing['data'][$i]['child']['data'][$j][$fields[0]].'\', $(this).val(), \''.$v.'\');">';
                                                        if(!empty($listing['data'][$i]['child']['data'][$j][$v]))
                                                            $html.='<option value="' . $listing['data'][$i]['child']['data'][$j][$v] . '">'.$this->modelMetadata['fields'][$v]['values'][$listing['data'][$i]['child']['data'][$j][$v]].'</option>';
                                                        else
                                                            $html.='<option></option>';      
                                                        foreach ($values as $name => $title) {
                                                            if($name != $listing['data'][$i]['child']['data'][$j][$v]){
                                                                $html.='<option value="' . $name . '" >' . $title . '</option>';
                                                            }                                            
                                                        }                                        
                                                        $html.='</select></td>';
                                                    } else {                                    
                                                        $html.='<td>'.$this->modelMetadata['fields'][$v]['values'][$listing['data'][$i]['child']['data'][$j][$v]].'</td>';
                                                    }
                                                }
                                                break;                                            
                                            case 'audio':
                                                if(!empty($listing['data'][$i]['child']['data'][$j][$v])){
                                                    $html.= '<td><embed id="mymovie" 
                                                                width="73" 
                                                                height="30" 
                                                                flashvars="autoPlay=no&overColor=FF6633&playerSkin=1&soundPath=song/'.$listing['data'][$i]['child']['data'][$j][$v].'" 
                                                                quality="high" 
                                                                bgcolor="#FFFFFF" 
                                                                name="mymovie" 
                                                                style="" 
                                                                src="media/flash/player.swf" 
                                                                type="application/x-shockwave-flash"/></td>';
                                                }else{
                                                    $html.= '<td></td>';                                    
                                                }
                                                break;                                     
                                            case 'order':
                                                $html.='
                                                    <td align="center">
                                                        <nobr>
                                                            <a href="admin/metadata/actions/actionName/up/modelName/'.$htmlParams['modelName'].'/fieldName/'.$fieldOrderExist.'/order/'.$listing['data'][$i]['child']['data'][$j][$fieldOrderExist].'"><img src="icon/arrow-up.png" height="15"/></a>&nbsp;&nbsp;
                                                            <a href="admin/metadata/actions/actionName/down/modelName/'.$htmlParams['modelName'].'/fieldName/'.$fieldOrderExist.'/order/'.$listing['data'][$i]['child']['data'][$j][$fieldOrderExist].'"><img src="icon/arrow-down.png" height="15"/></a>
                                                        </nobr>
                                                    </td>
                                                ';
                                                break;
                                            case 'image':
                                                $html.='
                                                        <td>
                                                            <img src="'.$this->modelMetadata['fields'][$v]['imagesDir'].$listing['data'][$i]['child']['data'][$j][$fields[0]].'/'.$listing['data'][$i]['child']['data'][$j][$v].'" style="max-width:75px; max-height: 75px;"/>
                                                        </td>
                                                        ';
                                                break;                                        
                                            case 'price':
                                                $html.='<td> $'.$listing['data'][$i]['child']['data'][$j][$v].'</td>';
                                                break;  
                                            case 'color':
                                                $html.='
                                                    <td align="center">
                                                        <div id="previewListing" style="background-color:#'.$listing['data'][$i]['child']['data'][$j][$v].'"></div>
                                                    </td>
                                                ';
                                                break;   
                                            default:
                                                if($v == 'title'){
                                                    $html.='<td colspan="1" width="2%"></td>';
                                                    $html.='<td colspan="1">'.$listing['data'][$i]['child']['data'][$j][$v].'</td>';
                                                } else {
                                                    $html.='<td>'.$listing['data'][$i]['child']['data'][$j][$v].'</td>';
                                                }
                                                break;
                                        }
                                    }
                                }
                                if(isset($this->modelMetadata['parent'])) {  
                                    $html.='<td width="1%" class="icon"></td>';                    
                                }                                   
                                // отрисовываем дополнительные поля
                                // Пример создания своего Action для approved
                                //'additionalFields'=>array(
                                //      array('title'=>'Подтверждение', 'action'=>'admin/post/approve', 'inner'=>'active'),
                                //)   
                                // action - экшен, выполняемый по клику
                                // inner - ставить active
                                if(isset($this->modelMetadata['additionalFields'])) {
                                    foreach ($this->modelMetadata['additionalFields'] as $v) {
                                        if($v['inner'] == 'active'){
                                            $html.='<td width="1%" class="icon" id="approve_'.$listing['data'][$i]['child']['data'][$j][$fields[0]].'">
                                                        <a href="javascript:;" onclick="approveAdditionalFields('.$listing['data'][$i]['child']['data'][$j][$fields[0]].' , \''.$v['action'].'\');">';     
                                            if($listing["data"][$i]['child']['data'][$j]['approved'] == 1)
                                                $html.='<img src="styles/src/admin/active.png" />';
                                            else
                                                $html.='<img src="styles/src/admin/inactive.png" />';
                                            $html.='</a></td>'; 
                                        }
                                        else{
                                            $html.='<td width="1%" class="icon">
                                                        <a href="'.$v['link'].$listing['data'][$i]['child']['data'][$j][$fields[0]].'">'.$v['inner'].'</a>
                                                    </td>';
                                        }
                                    }
                                }
                                if(isset($this->modelMetadata['edit']) && $addEdit == TRUE) {
                                    if($id > 0 ){
                                        $html.='
                                            <td class="icon">
                                                <a href="'.(isset($htmlParams['editActionName'])?'admin/'.$htmlParams['controller'].'/'.$htmlParams['editActionName']:'admin/metadata/actions/actionName/edit/referer/'.$htmlParams['controller'].(isset($htmlParams['indexActionName'])?'_'.$htmlParams['indexActionName']:'').'/modelName/'.$htmlParams['modelName']).'/id/'.$listing['data'][$i]['child']['data'][$j][$fields[0]].'/selectid/'.$id.'" title="'.$editTitle.'">
                                                    <img src="icon/edit.png" alt="'.$editTitle.'" />
                                                </a>
                                            </td>
                                            ';                                        
                                    } else {                                       
                                        $html.='
                                            <td class="icon">
                                                <a href="'.(isset($htmlParams['editActionName'])?'admin/'.$htmlParams['controller'].'/'.$htmlParams['editActionName']:'admin/metadata/actions/actionName/edit/referer/'.$htmlParams['controller'].(isset($htmlParams['indexActionName'])?'_'.$htmlParams['indexActionName']:'').'/modelName/'.$htmlParams['modelName']).'/id/'.$listing['data'][$i]['child']['data'][$j][$fields[0]].'" title="'.$editTitle.'">
                                                    <img src="icon/edit.png" alt="'.$editTitle.'" />
                                                </a>
                                            </td>
                                            ';
                                    }
                                }
                                if(isset($this->modelMetadata['view'])) {
                                    $html.='
                                        <td class="icon">
                                            <a href="'.(isset($htmlParams['viewActionName'])?'admin/'.$htmlParams['controller'].'/'.$htmlParams['viewActionName']:'admin/metadata/actions/actionName/view/referer/'.$htmlParams['controller'].(isset($htmlParams['indexActionName'])?'_'.$htmlParams['indexActionName']:'').'/modelName/'.$htmlParams['modelName']).'/id/'.$listing['data'][$i]['child']['data'][$j][$fields[0]].'" title="'.$viewTitle.'">
                                                <img src="icon/view.png" alt="'.$editTitle.'" />
                                            </a>
                                        </td>
                                        ';
                                }
                                foreach ($fields as $v) {
                                    if(isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==1 ||
                                            isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==3) {
                                        if($this->modelMetadata['fields'][$v]['type'] == 'delete'){
                                            if(isset($listing['data'][$i]['child']['data'][$j]['undeleteble']) && $listing['data'][$i]['child']['data'][$j]['undeleteble'] == 1){
                                                $html.='
                                                    <td class="icon"></td>
                                                ';                                    
                                            }
                                            else{
                                                $html.='
                                                    <td class="icon">
                                                        <img style="cursor: pointer" src="icon/101.png" width="15" title="'.$deleteTitle.'" alt="'.$deleteTitle.'" onclick="metaDeleteRecord(\''.(isset($htmlParams['deleteAction'])?$htmlParams['deleteAction']:'admin/metadata/actions/actionName/delete/modelName/'.$htmlParams['modelName']).'\', '.$listing['data'][$i]['child']['data'][$j][$fields[0]].');"/>
                                                    </td>
                                                ';
                                            }
                                        }
                                    }
                                }                                
                                $html.='</tr>'; 
                            }
                        }
                    }
                }
            }
            // Если нужно - отрисовываем paging
            if($needPage){
                //для автоматического подхватывания id вышестоящей таблицы
                if($id > 0 )
                {
                    $html.='<tr><td colspan="20">'.parent::pagingPrepare($listing['total'], $listing['page'], $listing['pageLength'], 'admin/'.$htmlParams['controller'].'/'.(empty($htmlParams['indexActionName'])?'index':$htmlParams['indexActionName']).'/id/'.$id.'/page/{page}').'</td></tr>';
                } else {
                    $html.='<tr><td colspan="20">'.parent::pagingPrepare($listing['total'], $listing['page'], $listing['pageLength'], 'admin/'.$htmlParams['controller'].'/'.(empty($htmlParams['indexActionName'])?'index':$htmlParams['indexActionName']).'/page/{page}').'</td></tr>';
                }                
                
            }
        } else
            $html.='<td colspan="20">'.$noRecordsMessage.'</td>';
        $html.='</tbody></table>';
        return $html;
    }

    public function viewHTML($action = NULL, $backLink = NULL) 
    {
        //check super admin permission
        $superAdminPermission = FALSE;
        for($i=0; $i < count($_SESSION['user']['permission']); $i++){
           if($_SESSION['user']['permission'][$i] == 'admin.super')
               $superAdminPermission = TRUE;
        }
        $meta = $this->modelMetadata['fields'];
        $googleMapTitle = 'Google Map';
        $fields = array_keys($meta);        
        $html = '<table class="adminTable">';
        for ($i = 0; $i < count($meta); $i++) {
            if (!empty($_SESSION['formData'][$fields[$i]])){
                $formData = $_SESSION['formData'][$fields[$i]];
                $id = $_SESSION['formData'][$fields[0]];
            }
            else
                $formData = '';
            if (isset($meta[$fields[$i]]['param']))
                $param = $meta[$fields[$i]]['param'];
            else
                $param = '';
            switch ($meta[$fields[$i]]['type']) {
                case 'pk':
                    break;
                case 'select':
                    if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                        break;
                    }
                    else{                    
                        if(isset($meta[$fields[$i]]['table'])) {
                            $html.='<tr>
                                        <td class="title">
                                            '.$meta[$fields[$i]]['title'].'
                                        </td>';                     
                            $fieldsInner = array_keys($this->metadata[$meta[$fields[$i]]['table']]['fields']);
                            $sql = 'SELECT * FROM `' . $meta[$fields[$i]]['table'] . '`
                                        WHERE ' . $fieldsInner[0] . ' = ' . (int)$formData
                                        . ' AND deleted = 0';
                            $result = $this->_db->fetchRow($sql);
                            if(isset($result['title']))
                                $for_echo = $result['title'];
                            else {
                                if ( is_array($result)) {
                                    $keys = array_keys($result);
                                    $for_echo = $result[$keys[1]];
                                } else {
                                    $for_echo ="";
                                }
                            }
                            $html.='<td>'.$for_echo.'</td></tr>';
                        } elseif(isset($meta[$fields[$i]]['values'])){
                            $html.='<tr>
                                        <td class="title">
                                            '.$meta[$fields[$i]]['title'].'
                                        </td>';                          
                            $html.='<td>'.$meta[$fields[$i]]['values'][$formData].'</td></tr>';
                        }
                        break;
                    }
                case 'order':
                    break;
                case 'active':
                    break;                
                case 'date':
                    if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                        break;
                    }
                    else{                      
                        $html.='<tr>
                                    <td class="title">
                                        '.$meta[$fields[$i]]['title'].'
                                    </td>
                                    <td class="content">' . $formData . '</td>
                                </tr>';
                        break;
                    }                  
                case 'color':
                    if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                        break;
                    }
                    else{                      
                        $html.='
                                <tr>
                                    <td class="title"><label for="' . str_replace(' ', '', $meta[$fields[$i]]['title']) . '">' . $meta[$fields[$i]]['title'] . ':'.(isset ($meta[$fields[$i]]['validate'])?'<sup>*</sup>':'').'</label></td>
                                    <td class="content"><div id="preview" style="background-color:#'.$formData.'; width: 20px; height: 20px; float: left;"></td>
                                </tr>'
                                ;
                        break;
                    }
                case 'email':
                    if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                        break;
                    }
                    else{                      
                        $html.='<tr>
                                    <td class="title">
                                        '.$meta[$fields[$i]]['title'].'
                                    </td>
                                    <td class="content">' . $formData . '</td>
                                </tr>';
                        break;
                    }
                case 'string':
                    if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                        break;
                    }
                    else{                      
                        if($meta[$fields[$i]]['title'] == 'imageMedium' || $meta[$fields[$i]]['title'] == 'imageSmall' || $meta[$fields[$i]]['title'] == 'imageBig')
                            break;
                        else{
                            if(isset($this->modelMetadata['googleMap']) && ($meta[$fields[$i]]['title'] == 'longitude' || $meta[$fields[$i]]['title'] == 'latitude')) {
                               break;
                            } else {                            
                                $html.='<tr>
                                            <td class="title">
                                                '.$meta[$fields[$i]]['title'].'
                                            </td>
                                            <td class="content">' . $formData . '</td>
                                        </tr>';
                                break;
                            }
                        }
                    }
                case 'double':
                    if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                        break;
                    }
                    else{                      
                        $html.='<tr>
                                    <td class="title">
                                        '.$meta[$fields[$i]]['title'].'
                                    </td>
                                    <td class="content">' . $formData . '</td>
                                </tr>';
                        break;
                    }                    
                case 'textarea':
                    if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                        break;
                    }
                    else{                      
                        $html.='<tr>
                                    <td class="title">
                                        '.$meta[$fields[$i]]['title'].'
                                    </td>
                                    <td class="content">' . $formData . '</td>
                                </tr>';
                        break;
                    }
                case 'int':
                    if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                        break;
                    }
                    else{                      
                        $html.='<tr>
                                    <td class="title">
                                        '.$meta[$fields[$i]]['title'].'
                                    </td>
                                    <td class="content">' . $formData . '</td>
                                </tr>';
                        break; 
                    }
                case 'text':
                    if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                        break;
                    }
                    else{                      
                        $html.='<tr>
                                    <td class="title">
                                        '.$meta[$fields[$i]]['title'].'
                                    </td>
                                    <td class="content">' . $formData . '</td>
                                </tr>';
                        break;
                    }
                case 'audio':
                    if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                        break;
                    }
                    else{                      
                        $html.= '<tr>
                                    <td class="title">
                                        '.$meta[$fields[$i]]['title'].'
                                    </td>';
                        if(!empty($formData)){
                         $html.= ' <td>
                                        <embed id="mymovie" 
                                                width="73" 
                                                height="30" 
                                                flashvars="autoPlay=no&overColor=FF6633&playerSkin=1&soundPath=song/'.$formData.'" 
                                                quality="high" 
                                                bgcolor="#FFFFFF" 
                                                name="mymovie" 
                                                style="" 
                                                src="media/flash/player.swf" 
                                                type="application/x-shockwave-flash"/>
                                    </td>
                                </tr>';
                        }else{
                         $html.= ' <td></td></tr>';                        
                        }
                        break;   
                    }
                case 'image':
                    if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                        break;
                    }
                    else{                      
                        if (!empty($formData)) {
                            if (!isset($meta[$fields[$i]]['imagesDir'])) {
                                $html.='<tr><td colspan="2" style="color:red;">Check metadata configuration file! You have error in field "' . $meta[$fields[$i]]['title'] . '". Error: Set imagesDir path!</td></tr>';
                                break;
                            }
                            $html.='
                            <tr>
                                <td class="title">
                                    '.$meta[$fields[$i]]['title'].'
                                </td>
                                <td>';
                            if(isset($meta[$fields[$i]]['additionalImagesDir']))
                                $html.=' <img src="' . $meta[$fields[$i]]['imagesDir'].$_SESSION['formData'][$meta[$fields[$i]]['additionalImagesDir']]. '/' .$id. '/' . $formData . '" /> ';
                            else
                                $html.=' <img src="' . $meta[$fields[$i]]['imagesDir'] .$id. '/' . $formData . '" /> ';
                            $html.=' </td></tr>';
                        }
                        break;
                    }
                case 'file':
                    if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                        break;
                    }
                    else{                      
                        //Validate param: filePath
                        if (!isset($meta[$fields[$i]]['filePath'])) {
                            $html.='<tr><td colspan="2" style="color:red;">Check metadata configuration file! You have error in field "' . $meta[$fields[$i]]['title'] . '". Error: Set file path!</td></tr>';
                            break;
                        }
                        $cnf = Zend_Registry::get('cnf');
                        if (!empty($formData)) {
                        $html.='<tr>
                                    <td class="title" >
                                        <label for="' . $meta[$fields[$i]]['title'] . '">' . $meta[$fields[$i]]['title'] . ':' . (isset($meta[$fields[$i]]['validate']) ? '<sup>*</sup>' : '') . '</label>
                                    </td>
                                    <td>
                                        <a href="'.$cnf->url->baseFull.$meta[$fields[$i]]['filePath'].$formData.'">'.$formData.'</a>
                                    </td>
                                </tr>';
                        }
                        break;
                    }
                default:
                    if ($fields[$i] != 'deleted' && $fields[$i] != 'approved')
                        $html.='<tr>
                                    <td colspan="2" style="color:red;">Check metadata configuration file! You have error!</td>
                                </tr>';
                    break;
            }
        }
        //Если есть гугл карта
        if(isset($this->modelMetadata['googleMap'])){
            $formData = $_SESSION['formData'];
            $keys = array_keys($formData);            
            if(isset($formData['longitude']) 
                    && !empty($formData['longitude']) 
                    && isset($formData['latitude']) 
                    && !empty($formData['latitude']))
            {
                $html.='<tr>
                            <td class="title">
                                '.$googleMapTitle.'
                            </td>
                            <td class="content">
                                <div class="map" id="Map" 
                                     objectId="'.$formData[$keys[0]].'" 
                                     longitude="'.$formData['longitude'].'" 
                                     latitude="'.$formData['latitude'].'"
                                     objectName = '.$keys[0].'>
                                </div>
                            </td>
                        </tr>';      
            } else {
                $html.= '<tr>
                            <td colspan="2">Google Map Error! Check longitude and latitude field!</td>
                        </tr>
                    </table>';                
            }
        }
        if(!empty($backLink)){
            $html.= '<tr>
                        <td colspan="2">
                            <a href="'.$backLink.'">
                               <button> 
                                    Back
                                </button>
                            </a>
                        </td>
                    </tr>';     
        }
        $html.= '</table>';
        return $html;
    }            
    
    public function checkUp($order, $fieldName, $upDown)
    {
        $meta = $this->modelMetadata['fields'];
        $keys = array_keys($meta);
        $details = $this->_db->fetchRow('SELECT * FROM '.$this->modelMetadata['name'].' WHERE '.$fieldName.' = '.(int)$order);
        //Ищем есть ли поле Parent
        $fieldParentExist = FALSE;
        foreach ($meta as $key => $v) {
            if($v['type'] == 'parent') {
                $fieldParentExist = $key;
                break;
            }
        }
        
        $sql = '
                SELECT
                    *
                FROM
                    '.$this->modelMetadata['name'].'
                WHERE
                    deleted = 0';
        if($fieldParentExist) {
            $sql.=' AND '.$fieldParentExist.' = '.$details[$fieldParentExist];
        }
        if($upDown == '<')
            $sql.=' AND '.$fieldName.' < '.(int)$order.' ORDER BY '.$fieldName.' DESC LIMIT 1';
        else
            $sql.=' AND '.$fieldName.' > '.(int)$order.' ORDER BY '.$fieldName.' ASC LIMIT 1';
        $result = $this->_db->fetchRow($sql);
        if(count($result)==0)
            return FALSE;
        //Меняем ордер индексы местами
        // 1. Перемещаемой записи устанавливаем новый индекс
        $this->_db->query('
            UPDATE
                '.$this->modelMetadata['name'].'
            SET
                '.$fieldName.' = '.$result[$fieldName]. '
            WHERE
                deleted=0 AND
                '.$keys[0].' = '.$details[$keys[0]]
        );
        //2. "Подавленой" :) записи ставим индекс перемещаемой записи

        $this->_db->query('
            UPDATE
                '.$this->modelMetadata['name'].'
            SET
                '.$fieldName.' = '.$order. '
            WHERE
                deleted=0 AND
                '.$keys[0].' = '.$result[$keys[0]]
        );
    }

    public function getMeta()
    {
        return $this->modelMetadata;
    }

    public function listingFromName($tableName)
    {
        $pageLength = 0;
        $page = 1;
        $meta = $this->metadata[$tableName];
        $fields = array_keys($meta['fields']);
        $select = 'SELECT ';
        //Ищем поле с Title
        $isTitle = FALSE;
        foreach ($meta['fields'] as $v => $index) {
            if($v == 'title' || $v == 'Title'){
                $isTitle = TRUE;
                $select.=' '.$fields[0].', '.$v;
            }
        }
        if(!$isTitle)
            $select.=' * ';
        $sql = 'FROM ' . $meta['name'] . ' WHERE deleted = 0';
        //Ищем существует ли поле с approved
        $fieldExist = FALSE;
//        foreach ($meta['fields'] as $v => $index) {
//            if($index['type'] == 'active'){
//                $sql.=' AND '.$v.'=1';
//            }
//        }
        $orderBy = ' ORDER BY '.$fields[0].' DESC';
        $list = $this->_pagingQuery($sql, $select, $orderBy, $pageLength, $page);
        //echo $select.$sql.$orderBy.'<br />';
        return $list;
    }
    
    public function listingWithParent()
    {
        $pageLength = 0;
        $page = 1;        
        $meta = $this->metadata[$this->modelMetadata['name']];
        $fileds_key = array_keys($meta['fields']);
        $pkTitle = $fileds_key[0];
        $select = 'SELECT t1.title, t1.productCategoryId, t1.url, t2.title as childTitle, t2.productCategoryId as childProductCategoryId, t2.url as childURL ';
        $sql = 'FROM ' . $this->modelMetadata['name'] . ' t1 ';
        $sql .= ' LEFT JOIN ' . $this->modelMetadata['name'] . ' t2 ';
        $sql .= ' ON ( t1.' . $pkTitle . ' = t2.parentId ) ';
        $sql .= ' WHERE t1.deleted = 0 AND t2.deleted = 0 ';
        //Ищем существует ли поле approved
        foreach ($meta['fields'] as $v => $index) {
            if($v == 'approved'){
                $sql.=' AND t1.'.$v.' = 1 AND t2.'.$v.' = 1';
            }
        }
        $orderBy = ' ORDER BY '.$pkTitle.' DESC';
//        echo $select.$sql.$orderBy.'<br />'; exit;
        $list = $this->_pagingQuery($sql, $select, $orderBy, $pageLength, $page);
        return $list;
    }
    
    //Для корректного определения количества записей, делаем запрос по primary key
    protected function _pagingQuery($sql, $select = "SELECT *", $orderBy = "", $pageLength = 0, $page = 1, $pk="") 
    {
        $meta = $this->metadata[$this->modelMetadata['name']];
        foreach( $meta['fields'] as $key => $value){
            if($meta['fields'][$key]['type'] == 'pk')
                $pk = $key;
        }
        return parent::_pagingQuery($sql, $select, $orderBy, $pageLength, $page, $pk);
    }
    
    /* Умный поиск. Выделяет искомое жирным
     * $searchFields - поля, в которых искать
     * $searchFields = 'title, description';
     * $key - ключ поиска
     * $order - сортировка
     * $resultLenght - длина результата в символах
     * $pageLength - сколько записей на страницу
     * $page - какая страница
     */
    public function searchClever($searchFields, $key, $orderBy, $pageLength = 12, $page = 1, $resultLenght = 300) 
    {
//        $this->modelMetadata;
        $select = ' SELECT * ';
        
        $sql = '
                FROM '.$this->modelMetadata['title'].'
                    WHERE deleted=0 AND ';
        $sql .= 'MATCH( '.$searchFields.' ) AGAINST( '.$this->_db->quote($key).' )';
        $searchResult =  $this->_pagingQuery($sql, $select, $orderBy, $pageLength, $page); 
        //Обрабатываем результат
        $searchFieldsExplode = explode(',', $searchFields);
        $keyExplode = explode(' ', $key);
        //ПРобегаемся по полученному массиву ключей поиска
        for($i=0; $i < count($keyExplode); $i++){
            //ПРобегаемся по полученному массиву полей поиска
            for($j=0; $j < count($searchFieldsExplode); $j++){
                $fields = trim($searchFieldsExplode[$j]);
                //ПРобегаемся по полученному результату
                for($k=0; $k < count($searchResult['data']); $k++){
                    //Определяем позицию ключа
                    $position = strpos($searchResult['data'][$k][$fields], $keyExplode[$i]);
                    //Если такой ключ найден в строке, то
                    if($position !== false ){
                        //Создаем ещё одно поле с меткой search с добавлением выделения ключа поиска
                        $searchResult['data'][$k]['search'] = str_replace($keyExplode[$i], '<b>'.$keyExplode[$i].'</b>', $searchResult['data'][$k][$fields]);
                        //Если проверяемая запись больше, чем максимальная длина результат
                        if(strlen($searchResult['data'][$k][$fields]) > $resultLenght){
                            //Если позиция ключа раньше половина макс длины
                            $halfResultLength = (int)($resultLenght / 2);
                            if($position < $halfResultLength){
                                $searchResult['data'][$k]['search'] = substr($searchResult['data'][$k]['search'], 0, $position + $halfResultLength).'...';
                            } else {
                                $searchResult['data'][$k]['search'] = '...'.substr($searchResult['data'][$k]['search'], $position - $halfResultLength, $resultLenght).'...';
                            }
                        }
                    }
                }
            }
        }
        return $searchResult;
    }        
    
   public function listingHTMLGuest($htmlParams = array(), $pageLength=10, $page=1, $filter=array(), $needPage = TRUE, $addEdit = TRUE)
    {
        $noRecordsMessage = 'Нет записей!';
        $deleteTitle = 'Удалить';
        $editTitle = 'Ред.';
        $parentAddTitle = 'Добавить';
        $viewTitle = 'Просм.';
        $addTitle = 'Добавить запись';
        if(empty($htmlParams['controller']))
            return '<table><thead><td style="color:red;">Error! You not set param "controller" in listingHTML settings</td></thead></table>';
        $meta = $this->modelMetadata['fields'];
        //Ищем существует ли поле с ордером
        $fieldOrderExist = FALSE;
        foreach ($meta as $v => $index) {
            if($index['type'] == 'order')
                $fieldOrderExist = $v;
        }
        //Если есть
        if($fieldOrderExist){
            $filter['order'] = 'ORDER BY '.$fieldOrderExist.' ASC';
        }

        $fields = array_keys($meta);
        $html='<table class="adminTable">';
        //Если можно добавлять
        if(isset($this->modelMetadata['add']) && $addEdit == TRUE) 
        {
            $html.='
                <thead>
                    <td colspan="20">
                        <input type="button" value="'.$addTitle.'" onclick="location.href=rootPath+\''.(isset($htmlParams['editActionName'])?''.$htmlParams['controller'].'/'.$htmlParams['editActionName']:'guest/actions/actionName/edit/referer/'.$htmlParams['controller'].(isset($htmlParams['indexActionName'])?'_'.$htmlParams['indexActionName']:'').'/modelName/'.$htmlParams['modelName']).'/\';"/>
                    </td>
                </thead>';
        }
        
        //Если есть фильтр
        unset($_SESSION['htmlParams']);
        unset($_SESSION['filterParams']);
        if(isset($this->modelMetadata['filter'])) {
            $_SESSION['htmlParams'] = $htmlParams; 
            $_SESSION['filterParams'] = $filter;    
            $filterMeta = $this->modelMetadata['filter'];
            $value = array();
            if(isset($_SESSION['filterResult']) && isset($_SESSION['i'])){
                $filter[$filterMeta[$_SESSION['i']]['on']] = $_SESSION['filterResult'];
                $value[$_SESSION['i']] = $_SESSION['filterResult'];
            }         
            $html.='<thead><td colspan="20">';  
            for($i=0; $i < count($filterMeta); $i++){
                $html.='<div style="float: left; width: 200px; text-align: right;" id="filterLength_'.$i.'">'.$filterMeta[$i]['title'].' 
                    <input id="'.$filterMeta[$i]['on'].'_'.$filterMeta[$i]['table'].'"';
                if(isset($value[$i]))
                    $html.= ' value="'.$value[$i].'" '; 
                else      
                    $html.= ' value="" ';
                $html.= 'type="text" style="width: 125px;" onkeyup="filter(this.value, this.id, '.$i.');"/>
                    <div id="autocomplete_'.$i.'" style="display:none; padding: 5px; width:150px; left: 12px; top: 66px; position: absolute; z-index: 10000;background-color: #FFF;border: 1px solid #777; -moz-border-radius:3px;-webkit-border-radius:3px;">
                        <div id="contentVariant_'.$i.'"></div>
                    </div></div>                  
                    ';
            }
            $html.='</td></thead>';      
        }    
        //Если иерархическая структура
        if(isset($this->modelMetadata['parent'])) {
            $filter['parentId'] = 0;
            $listing = self::listing($pageLength, $page, $filter);
            for($count=0; $count < count($listing['data']); $count++){
                $filter['parentId'] = $listing['data'][$count][$fields[0]];
                $listing['data'][$count]['child'] = self::listing(0, 1, $filter);
            }
        } else {
            $listing = self::listing($pageLength, $page, $filter);
        }
        $html.='
                <thead>';
        foreach ($fields as $v) {
            if(isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==1 ||
                    isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==3) {
                if($this->modelMetadata['fields'][$v]['type'] != 'delete'){
                    switch ($this->modelMetadata['fields'][$v]['type']){
                        case 'active':
                        case 'order':
                        case 'image':
                            $html.='<td width="1%">'.$this->modelMetadata['fields'][$v]['title'].'</td>';
                            break;
                        default:
                            if($v == 'title')
                                $html.='<td>'.$this->modelMetadata['fields'][$v]['title'].'</td>';
                            else
                                $html.='<td>'.$this->modelMetadata['fields'][$v]['title'].'</td>';
                            break;
                    }
                }
            }
        }
        if(isset($this->modelMetadata['parent'])) {
            $html.='<td width="1%">'.$parentAddTitle.'</td>';
        }        
        if(isset($this->modelMetadata['additionalFields'])) {
            foreach ($this->modelMetadata['additionalFields'] as $v) {
                $html.='<td width="1%">'.$v['title'].'</td>';
            }
        }      
        //Если можно редактировать
        if(isset($this->modelMetadata['edit']) && $addEdit == TRUE) {
            $html.='<td width="1%">'.$editTitle.'</td>';
        }
        //Если можно просматривать
        if(isset($this->modelMetadata['view'])) {
            $html.='<td width="1%">'.$viewTitle.'</td>';
        }        
        foreach ($fields as $v) {
            if(isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==1 ||
                    isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==3) {
                if($this->modelMetadata['fields'][$v]['type'] == 'delete'){                    
                    $html.='<td width="1%">'.$this->modelMetadata['fields'][$v]['title'].'</td>';
                }
            }
        }        
        $html.='</thead><tbody>';
        
        if(count($listing['data'])>0) {
            for ($i = 0; $i < count($listing['data']); $i++) {
                $html.='<tr id="record'.$listing['data'][$i][$fields[0]].'">';
                foreach ($fields as $v) {
                    if(isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==1 ||
                            isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==3) {
                        switch ($this->modelMetadata['fields'][$v]['type']) {
                            case 'active':
                                $html.='<td align="center" id="approve'.$listing['data'][$i][$fields[0]].$v.'">';
                                if($listing['data'][$i][$v] == 1)
                                    $html.='<img style="cursor: pointer" src="icon/active.png" alt="delete" onclick="approveRecord(\'guest/actions/actionName/disactive/fieldActive/'.$v.'/modelName/'.$htmlParams['modelName'].'\', '.$listing['data'][$i][$fields[0]].', \''.$v.'\');" />';
                                else
                                    $html.='<img style="cursor: pointer" src="icon/inactive.png" alt="delete" onclick="approveRecord(\'guest/actions/actionName/active/fieldActive/'.$v.'/modelName/'.$htmlParams['modelName'].'\', '.$listing['data'][$i][$fields[0]].', \''.$v.'\');"/>';
                                $html.'</td>';
                                break;
                            case 'delete':
                                break;
                            case 'text':
                            case 'textarea':
                                $subStr = substr(strip_tags($listing['data'][$i][$v]),0,80);
                                $html.='<td>'.$subStr.'...</td>';
                                break;
                            case 'select':
                                if(isset($this->modelMetadata['fields'][$v]['table'])) {
                                    $fieldsInner = array_keys($this->metadata[$this->modelMetadata['fields'][$v]['table']]['fields']);
                                    $sql = 'SELECT * FROM ' . $this->modelMetadata['fields'][$v]['table'] . '
                                                WHERE ' . $fieldsInner[0] . ' = ' . (int) $listing['data'][$i][$v]
                                                . ' AND deleted = 0';
                                    $result = $this->_db->fetchRow($sql);
                                    //Для вывода иерархии категорий, типа "хлебных крошек". До 3 уровня
                                    if(isset($result['parentId']) && $result['parentId']!=0){
                                        $sql2 = 'SELECT * FROM ' . $this->modelMetadata['fields'][$v]['table'] . '
                                                    WHERE ' . $fieldsInner[0] . ' = ' . (int) $result['parentId']
                                                    . ' AND deleted = 0';
                                        $result2 = $this->_db->fetchRow($sql2); 
                                        if(isset($result2['parentId']) && $result2['parentId']!=0){
                                            $sql3 = 'SELECT * FROM ' . $this->modelMetadata['fields'][$v]['table'] . '
                                                        WHERE ' . $fieldsInner[0] . ' = ' . (int) $result2['parentId']
                                                        . ' AND deleted = 0';
                                            $result3 = $this->_db->fetchRow($sql3); 
                                            $result['title'] = $result3['title'].'-&rsaquo; <br />'.$result2['title'].'-&rsaquo; <br />'.$result['title'];
                                        } else {
                                           $result['title'] = $result2['title'].'-&rsaquo; <br />'.$result['title'];
                                        }
                                    }
                                    //Если можно изменять значение в листинге
                                    if(isset($this->modelMetadata['fields'][$v]['quickChange'])) 
                                    {
                                        $sql2 = 'SELECT * FROM ' . $this->modelMetadata['fields'][$v]['table'] . '
                                                    WHERE deleted = 0';
                                        $listingSelectTable = $this->_db->fetchAll($sql2);
                                        if(isset($this->modelMetadata['fields'][$v]['width']))
                                            $style = 'width: '.$this->modelMetadata['fields'][$v]['width'];
                                        else
                                            $style = '';
                                        $html.='<td><select name="' . $v . '" style="'.$style.'" onchange="changeSelect(\'guest/actions/actionName/select/modelName/'.$htmlParams['modelName'].'/id/'.$listing['data'][$i][$fields[0]].'\', $(this).val(), \''.$v.'\');">';
                                        if(!empty($result))
                                            $html.='<option value="' . $result[$v] . '">'.$result['title'].'</option>';
                                        else
                                            $html.='<option></option>';              
                                        for ($j = 0; $j < count($listingSelectTable); $j++) {
                                            $f = array_keys($listingSelectTable[$j]);
                                            if($listingSelectTable[$j][$v] != $result[$v]){
                                                $html.='<option value="' . $listingSelectTable[$j][$f[0]] . '" >' . $listingSelectTable[$j][$f[1]] . '</option>';
                                            }
                                        }
                                        $html.='</select></td>';
                                    } else {
                                        if(isset($result['title']))
                                            $for_echo = $result['title'];
                                        else {
                                            if ( is_array($result)) {
                                                $keys = array_keys($result);
                                                $for_echo = $result[$keys[1]];
                                            } else {
                                                $for_echo ="";
                                            }
                                        }
                                        $html.='<td>'.$for_echo.'</td>';
                                    }
                                } 
                                elseif(isset($this->modelMetadata['fields'][$v]['values']))
                                {
                                    //Если можно изменять значение в листинге
                                    if(isset($this->modelMetadata['fields'][$v]['quickChange'])) {
                                        $values = $this->modelMetadata['fields'][$v]['values'];
                                        if(isset($this->modelMetadata['fields'][$v]['width']))
                                            $style = 'width: '.$this->modelMetadata['fields'][$v]['width'];
                                        else
                                            $style = '';
                                        $html.='<td><select name="' . $v . '" style="'.$style.'" onchange="changeSelect(\'guest/actions/actionName/select/modelName/'.$htmlParams['modelName'].'/id/'.$listing['data'][$i][$fields[0]].'\', $(this).val(), \''.$v.'\');">';
                                        if(!empty($listing['data'][$i][$v]))
                                            $html.='<option value="' . $listing['data'][$i][$v] . '">'.$this->modelMetadata['fields'][$v]['values'][$listing['data'][$i][$v]].'</option>';
                                        else
                                            $html.='<option></option>';      
                                        foreach ($values as $name => $title) {
                                            if($name != $listing['data'][$i][$v]){
                                                $html.='<option value="' . $name . '" >' . $title . '</option>';
                                            }                                            
                                        }                                        
                                        $html.='</select></td>';
                                    } else {                                    
                                        $html.='<td>'.$this->modelMetadata['fields'][$v]['values'][$listing['data'][$i][$v]].'</td>';
                                    }
                                }
                                break;
                            case 'audio':
                                if(!empty($listing['data'][$i][$v])){
                                    $html.= '<td><embed id="mymovie" 
                                                width="73" 
                                                height="30" 
                                                flashvars="autoPlay=no&overColor=FF6633&playerSkin=1&soundPath=song/'.$listing['data'][$i][$v].'" 
                                                quality="high" 
                                                bgcolor="#FFFFFF" 
                                                name="mymovie" 
                                                style="" 
                                                src="media/flash/player.swf" 
                                                type="application/x-shockwave-flash"/></td>';
                                }else{
                                    $html.= '<td></td>';                                    
                                }
                                break;                                     
                            case 'order':
                                $html.='
                                    <td align="center">
                                        <nobr>
                                            <a href="guest/actions/actionName/up/modelName/'.$htmlParams['modelName'].'/fieldName/'.$fieldOrderExist.'/order/'.$listing['data'][$i][$fieldOrderExist].'"><img src="icon/arrow-up.png" height="15"/></a>&nbsp;&nbsp;
                                            <a href="guest/actions/actionName/down/modelName/'.$htmlParams['modelName'].'/fieldName/'.$fieldOrderExist.'/order/'.$listing['data'][$i][$fieldOrderExist].'"><img src="icon/arrow-down.png" height="15"/></a>
                                        </nobr>
                                    </td>
                                ';
                                break;
                            case 'image':
                                $html.='<td>';                                
                                if(isset($this->modelMetadata['fields'][$v]['additionalImagesDir']))
                                    $html.=' <img src="' . $this->modelMetadata['fields'][$v]['imagesDir'].$listing['data'][$i][$this->modelMetadata['fields'][$v]['additionalImagesDir']]. '/' .$listing['data'][$i][$fields[0]]. '/' . $listing['data'][$i][$v] . '" /> ';
                                else
                                    $html.='<img src="'.$this->modelMetadata['fields'][$v]['imagesDir'].$listing['data'][$i][$fields[0]].'/'.$listing['data'][$i][$v].'" style="max-width:75px; max-height: 75px;"/>';                             
                                $html.='</td>';
                                break;
                            case 'file':
                                $html.='<td>';                                
                                if(isset($this->modelMetadata['fields']['fileName']) && !isset($this->modelMetadata['fields'][$v]['fileLink']))
                                    $html.=' <a href="'.$listing['data'][$i][$v].'">'.$listing['data'][$i]['fileName'].'</a>';
                                elseif(isset($this->modelMetadata['fields'][$v]['fileLink']))
                                    $html.=' <a href="'.$this->modelMetadata['fields'][$v]['fileLink'].$listing['data'][$i]['unikey'].'" target="_blank">'.$listing['data'][$i]['fileName'].'</a>';
                                else
                                    $html.='<td>'.$listing['data'][$i][$v].'</td>';                            
                                $html.='</td>';
                                break;                                
                            case 'price':
                                $html.='<td> $'.$listing['data'][$i][$v].'</td>';
                                break;  
                            case 'color':
                                $html.='
                                    <td align="center">
                                        <div id="previewListing" style="background-color:#'.$listing['data'][$i][$v].'"></div>
                                    </td>
                                ';
                                break;   
                            default:
                                if(isset($this->modelMetadata['fields'][$v]['quickChange']))
                                {
                                    $html.='<td>'
                                            . '<input type="text" value="'.$listing['data'][$i][$v].'" style="width: 40px;"  onblur="quickChangeInput(\'guest/actions/actionName/inputchange/modelName/'.$htmlParams['modelName'].'/id/'.$listing['data'][$i][$fields[0]].'\', $(this).val(), \''.$v.'\');" />'
                                            . '</td>';
                                }
                                else
                                {
                                    $html.='<td>'.$listing['data'][$i][$v].'</td>';
                                }
                                break;
                        }
                    }
                }
                
                if(isset($this->modelMetadata['parent'])) {  
                    $html.='<td width="1%" class="icon">
                                <a href="'.(isset($htmlParams['editActionName'])?'admin/'.$htmlParams['controller'].'/'.$htmlParams['editActionName']:'guest/actions/actionName/edit/referer/'.$htmlParams['controller'].'/modelName/'.$htmlParams['modelName']).'/parent/'.$listing['data'][$i][$fields[0]].'" title="'.$parentAddTitle.'">
                                    <img src="icon/add.png" alt="Add" />
                                </a>
                            </td>';                    
                }              
                // отрисовываем дополнительные поля
                // Пример создания своего Action для approved
                //'additionalFields'=>array(
                //      array('title'=>'Подтверждение', 'action'=>'admin/post/approve', 'inner'=>'active', 'field'=>'isHead'),
                //)   
                // action - экшен, выполняемый по клику
                // inner - ставить active
                // field - поле типа active для которого заменяется экшен аппрува и дизапрува
                if(isset($this->modelMetadata['additionalFields'])) {
                    foreach ($this->modelMetadata['additionalFields'] as $v) {
                        if($v['inner'] == 'active'){
                            $html.='<td width="1%" class="icon" id="approve_'.$listing['data'][$i][$fields[0]].'">
                                        <a href="javascript:;" onclick="approveAdditionalFields('.$listing['data'][$i][$fields[0]].' , \''.$v['action'].'\');">';     
                            if($listing["data"][$i][$v['field']] == 1)
                                $html.='<img src="styles/src/admin/active.png" />';
                            else
                                $html.='<img src="styles/src/admin/inactive.png" />';
                            $html.='</a></td>'; 
                        }
                        else{
                            if(isset($v['onclick'])){
                                $html.='<td width="1%" class="icon">
                                            <a href="javascript:void(0);" onclick="'.str_replace("param", $listing['data'][$i][$fields[0]], $v['onclick']).'">'.$v['inner'].'</a>
                                        </td>';                                
                            } else {
                                $html.='<td width="1%" class="icon">
                                            <a href="'.$v['link'].$listing['data'][$i][$fields[0]].'">'.$v['inner'].'</a>
                                        </td>';                                
                            }
                        }
                    }
                }
                if(isset($this->modelMetadata['edit']) && $addEdit == TRUE) {
                    if($id > 0 ){
                        $html.='
                            <td class="icon">
                                <a href="'.(isset($htmlParams['editActionName'])?'admin/'.$htmlParams['controller'].'/'.$htmlParams['editActionName']:'guest/actions/actionName/edit/referer/'.$htmlParams['controller'].(isset($htmlParams['indexActionName'])?'_'.$htmlParams['indexActionName']:'').'/modelName/'.$htmlParams['modelName']).'/id/'.$listing['data'][$i][$fields[0]].'/selectid/'.$id.'" title="'.$editTitle.'">
                                    <img src="icon/edit.png" alt="'.$editTitle.'" />
                                </a>
                            </td>
                            ';                        
                    } else {                    
                        $html.='
                            <td class="icon">
                                <a href="'.(isset($htmlParams['editActionName'])?'admin/'.$htmlParams['controller'].'/'.$htmlParams['editActionName']:'guest/actions/actionName/edit/referer/'.$htmlParams['controller'].(isset($htmlParams['indexActionName'])?'_'.$htmlParams['indexActionName']:'').'/modelName/'.$htmlParams['modelName']).'/id/'.$listing['data'][$i][$fields[0]].'" title="'.$editTitle.'">
                                    <img src="icon/edit.png" alt="'.$editTitle.'" />
                                </a>
                            </td>
                            ';
                    }
                }
                if(isset($this->modelMetadata['view'])) {
                    $html.='
                        <td class="icon">
                            <a href="'.(isset($htmlParams['viewActionName'])?'admin/'.$htmlParams['controller'].'/'.$htmlParams['viewActionName']:'guest/actions/actionName/view/referer/'.$htmlParams['controller'].(isset($htmlParams['indexActionName'])?'_'.$htmlParams['indexActionName']:'').'/modelName/'.$htmlParams['modelName']).'/id/'.$listing['data'][$i][$fields[0]].'" title="'.$viewTitle.'">
                                <img src="icon/view.png" alt="'.$editTitle.'" />
                            </a>
                        </td>
                        ';
                }
                foreach ($fields as $v) {
                    if(isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==1 ||
                            isset($this->modelMetadata['fields'][$v]['showInListing']) && $this->modelMetadata['fields'][$v]['showInListing']==3) {
                        if($this->modelMetadata['fields'][$v]['type'] == 'delete'){
                            if(isset($listing['data'][$i]['undeleteble']) && $listing['data'][$i]['undeleteble'] == 1){
                                $html.='
                                    <td class="icon"></td>
                                ';                                    
                            }
                            else{
                                $html.='
                                    <td class="icon">
                                        <img style="cursor: pointer" src="icon/101.png" width="15" title="'.$deleteTitle.'" alt="'.$deleteTitle.'" onclick="metaDeleteRecord(\''.(isset($htmlParams['deleteAction'])?$htmlParams['deleteAction']:'admin/metadata/actions/actionName/delete/modelName/'.$htmlParams['modelName']).'\', '.$listing['data'][$i][$fields[0]].');"/>
                                    </td>
                                ';
                            }
                        }
                    }
                }                
                $html.='</tr>';
            }
            // Если нужно - отрисовываем paging
            if($needPage){
                //для автоматического подхватывания id вышестоящей таблицы
                if($id > 0 )
                {
                    $html.='<tr><td colspan="20">'.parent::pagingPrepare($listing['total'], $listing['page'], $listing['pageLength'], $htmlParams['controller'].'/'.(empty($htmlParams['indexActionName'])?'index':$htmlParams['indexActionName']).'/id/'.$id.'/page/{page}').'</td></tr>';
                } else {
                    $html.='<tr><td colspan="20">'.parent::pagingPrepare($listing['total'], $listing['page'], $listing['pageLength'], $htmlParams['controller'].'/'.(empty($htmlParams['indexActionName'])?'index':$htmlParams['indexActionName']).'/page/{page}').'</td></tr>';
                }                
                
            }
        } else
            $html.='<td colspan="20">'.$noRecordsMessage.'</td>';
        $html.='</tbody></table>';
        return $html;
    }        
}