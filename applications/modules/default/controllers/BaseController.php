<?php

/**
 * BaseController class
 *
 * @author a.poteryahin@gmail.com
 * updated: 12/15/09
 */
class BaseController extends Zend_Controller_Action
{

    public $_smarty;
    public $_db;
    public $_cnf;
    /**
     * Set of smarty template variables
     */
    public $_view;
    /**
     * Set of model objects
     */
    public $_objects;
    public $_itemsPerPage;

    public function init()
    {
        // Get config
        $cnf = Zend_Registry::get('cnf');
        
        $_SESSION['fckeditorUploadFilePath'] = $cnf->path->fckeditorUpload;
        $_SESSION['rootPath'] = $cnf->url->baseFull;
        $_SESSION['rootPathHttps'] = $cnf->url->baseFullHttps;
        $_SESSION['fckeditorUploadFilePathShort'] = $cnf->path->fckeditorUploadShort;

        $this->_itemsPerPage = 12;

        $moduleName = $this->getRequest()->getModuleName();

        //init smarty variable object
        $this->_view = new SmartyVariable($smarty);

        //Smarty Start
        if (!Zend_Registry::isRegistered('smarty')) {
            include 'Smarty/Smarty.class.php';
            $smarty = new Smarty();
            $smarty->debugging = false;
            $smarty->force_compile = true;
            $smarty->caching = false;
            $smarty->compile_check = true;
            $smarty->cache_lifetime = 0;
            $smarty->template_dir = $cnf->path->templates->$moduleName;
            $smarty->compile_dir = $cnf->path->templates_c;
            $smarty->plugins_dir = array(SMARTY_DIR . 'plugins');
            Zend_Registry::set('smarty', $smarty);
        }
        $smarty = Zend_Registry::get('smarty');
        //init smarty variable object
        $this->_view = new SmartyVariable($smarty);

        // Connect to main DB
        $mainDb = Zend_Db::factory($cnf->db);
        $mainDb->query("SET NAMES UTF8");

        Zend_Registry::set('mainDb', $mainDb);
        $this->_db = $mainDb;
        $this->_cnf = Zend_Registry::get('cnf');
        $smarty->template_dir = $cnf->path->templates->$moduleName;
        $smarty->compile_dir = $cnf->path->templates_c;
        $smarty->assign('rootPath', $cnf->url->baseFull);
        Zend_Registry::set('smarty', $smarty);
        $this->_smarty = $smarty;
        $this->_objects = array();
        //  Session default namespace init
        $this->_defaultSession = new Zend_Session_Namespace();

        ////////////////////////////////////////////////////////System messages
        if(isset($_SESSION['notice'])) {
            $this->_view->notice = $_SESSION['notice'];
            unset($_SESSION['notice']);
        }
        if(isset($_SESSION['error'])) {
            $this->_view->error = $_SESSION['error'];
            $this->errorMessage = $_SESSION['error'];
            unset($_SESSION['error']);
        }
        if(isset($_SESSION['message'])) {
            $this->_view->headerMessage = $_SESSION['message'];
            unset($_SESSION['message']);
        }
        if(isset($this->_defaultSession->notice)) {
            $this->_view->notice = $this->_defaultSession->notice;
            unset($this->_defaultSession->notice);
        }
        if(isset($this->_defaultSession->error)) {
            $this->_view->error = $this->_defaultSession->error;
            unset($this->_defaultSession->error);
        }
        ////////////////////////////////////////////////////////////////////////
     
        //Мета Данные
        $this->_view->meta = array(
            'title' => $cnf->defaultMeta->title,
            'description' => $cnf->defaultMeta->description,
            'keywords' => $cnf->defaultMeta->keywords
        );       
        /**
         * Update user session
         */
        date_default_timezone_set('Etc/GMT-3');

        if( isset($_SESSION['rememberme']) )
        {
            $unikey = $this->uniqueKey(15);
            $sercetKey = md5(md5($unikey));
            setcookie ("ahuser", $unikey, time()+60*60*24*30);
            $this->User->updateSecretKey($sercetKey, $_SESSION['user']['userId']);   
            unset($_SESSION['rememberme']);
        }
        
        if( !isset($_SESSION['user']) || empty($_SESSION['user']) )
        {
            if( isset($_COOKIE['ahuser']) )
            {
                $userAuto = $this->User->getUserOnHash($_COOKIE['ahuser']);
                if( !empty($userAuto) )
                {
                   $this->makeLogin($userAuto);
                }
            }
        }
        
        if(!empty($_SESSION['user']) && $_SESSION['user']['createTime'] + 600 > time()) 
        {
            $this->makeLogin($this->User->details($_SESSION['user']['userId']));
        }        
        /*
         *  Последний параметр указывает сколько жить сессии с параметрами для
         *  accessClass. Для снижения нагрузки.
         */
        $pizdecAccess = new AccessClass($this->_request->getParams(), $cnf->url->baseFull, 5);
        //подсчет времени работы скрипта
        //list($msec,$sec)=explode(chr(32),microtime()); 
        //var_dump(($msec+$sec)-$_SESSION['startTime']);exit;
        
        $this->_view->categoryMenu = $this->ProductCategory->listing(0, 1, array('approved'=>1, 'order'=>'Order by title ASC'));    
    }
    
    public function makeLogin($userData)
    {
        unset($_SESSION['user']);
        unset($_SESSION['userViewCount']);
        $_SESSION['user'] = $userData;
        $_SESSION['user']['permission'] = $this->getUserPermission($_SESSION['user']['userId']);
        $_SESSION['user']['createTime'] = time();         
    }
    
    function mime_header_encode($str, $data_charset, $send_charset){
        if($data_charset != $send_charset)
          $str=iconv($data_charset,$send_charset.'//IGNORE',$str);
        return ('=?'.$send_charset.'?B?'.base64_encode($str).'?=');
    } 
  
    public function sendMail($to, $form, $subject, $message, $headers='', $debug=FALSE)
    {
        if( $debug )
            $to = 'artem_zolkin@mail.ru';
        
        $dc='UTF-8';
        $sc='windows-1251';
//        $type='text/plain';
        $type='text/html';
                
        //Кодируем поля адресата, темы и отправителя
//        $enc_to=mime_header_encode($this->to_name,$dc,$sc).' <'.$this->to_email.'>';
        $enc_subject=$this->mime_header_encode($subject,$dc,$sc);
//        $enc_from=$this->mime_header_encode($form,$dc,$sc);
        //Кодируем тело письма
        $enc_body=$dc==$sc?$message:iconv($dc,$sc.'//IGNORE',$message);
        //Оформляем заголовки письма
        $headers='';
        $headers.="Mime-Version: 1.0\r\n";
        $headers.="Content-type: ".$type."; charset=".$sc."\r\n";
        $headers.="From: ".$form."\r\n";
        //Отправляем
        return mail($to,$enc_subject,$enc_body,$headers);      
    }
    
    public function sendMailFile($to, $form, $subject, $message, $headers='', $debug=FALSE, $filepath='', $filename='')
    {
        
//        var_dump($to, $form, $subject, $message, $headers, $debug, $filepath, $filename);exit;
        
    if( $debug )
        $to = 'artem_zolkin@mail.ru';
        
    $fp = fopen($filepath,"rb");   
    if (!$fp)   
    { print "Cannot open file";   
      exit();   
    }   
    $file = fread($fp, filesize($filepath));   
//    var_dump($filepath,filesize($filepath), $file, $fp);exit;
    fclose($fp);  
    
    
    
    $name = 'file.jpg'; // в этой переменной надо сформировать имя файла (без всякого пути)  
    $EOL = "\r\n"; // ограничитель строк, некоторые почтовые сервера требуют \n - подобрать опытным путём
    $boundary   = "--".md5(uniqid(time()));  // любая строка, которой не будет ниже в потоке данных.  
    $headers    = "MIME-Version: 1.0;$EOL";   
    $headers   .= "Content-Type: multipart/mixed; boundary=\"$boundary\"$EOL";  
    $headers   .= "From: ".$form;  
      
    $multipart  = "--$boundary$EOL";   
    $multipart .= "Content-Type: text/html; charset=windows-1251$EOL";   
    $multipart .= "Content-Transfer-Encoding: base64$EOL";   
    $multipart .= $EOL; // раздел между заголовками и телом html-части 
    $multipart .= chunk_split(base64_encode($message));   

    $multipart .=  "$EOL--$boundary$EOL";   
    $multipart .= "Content-Type: application/octet-stream; name=\"$name\"$EOL";   
    $multipart .= "Content-Transfer-Encoding: base64$EOL";   
    $multipart .= "Content-Disposition: attachment; filename=\"$name\"$EOL";   
    $multipart .= $EOL; // раздел между заголовками и телом прикрепленного файла 
    $multipart .= chunk_split(base64_encode($file));   

    $multipart .= "$EOL--$boundary--$EOL";   
      
    if(!mail($to, $subject, $multipart, $headers))   
    {
        return False;           //если не письмо не отправлено
    }  
    else { //// если письмо отправлено
        return True;  
    }        
        
        
//        $dc='UTF-8';
//        $sc='windows-1251';
//        $type='text/html';
//         
//        //письмо с вложением состоит из нескольких частей, которые разделяются разделителем
//        $boundary = "--".md5(uniqid(time())); 
//        
//        $mailheaders = "MIME-Version: 1.0;\r\n"; 
//        $mailheaders .="Content-Type: multipart/mixed; boundary=".$boundary."\r\n"; 
//        // разделитель указывается в заголовке в параметре boundary 
//        $mailheaders .= "From: ".$form."\r\n";       
//        
//        $multipart = "--".$boundary."\r\n"; 
//        $multipart .= "Content-Type: text/html; charset=windows-1251\r\n";
//        $multipart .= "Content-Transfer-Encoding: base64\r\n";    
//        $multipart .= "\r\n";
//        $multipart .= chunk_split(base64_encode(iconv("utf8", "windows-1251", $message)));      
//        
//        // Закачиваем файл 
//        $fp = fopen($filepath,"r"); 
//        if (!$fp) 
//        { 
//                print "Не удается открыть файл!"; 
//                exit(); 
//        } 
//        $file = fread($fp, filesize($filepath)); 
//        fclose($fp);         
//        
//        $message_part = "\r\n--".$boundary."\r\n"; 
//        $message_part .= "Content-Type: application/octet-stream; name=".$filename."\r\n";  
//        $message_part .= "Content-Transfer-Encoding: base64\r\n"; 
//        $message_part .= "Content-Disposition: attachment; filename=".$filename."\r\n"; 
//        $message_part .= "\r\n";
//        $message_part .= chunk_split(base64_encode($file));
//        $message_part .= "\r\n--".$boundary."--\r\n";
//        // второй частью прикрепляем файл, можно прикрепить два и более файла
//
//        $multipart .= $message_part;

        return mail($to,$subject,$multipart,$mailheaders);


//        $enc_subject=$this->mime_header_encode($subject,$dc,$sc);
////        $enc_from=$this->mime_header_encode($form,$dc,$sc);
//        //Кодируем тело письма
//        $enc_body=$dc==$sc?$message:iconv($dc,$sc.'//IGNORE',$message);
//        //Оформляем заголовки письма
//        //
//        //Отправляем
//        return mail($to,$enc_subject,$enc_body,$headers);      
    }    
    
    public function mandrillSend($subject, $from, $to, $html, $attachPath = NULL)
    {
        include_once $this->_cnf->path->public."swift/lib/swift_required.php";

        $madrilSetting = $this->_cnf->mandrilSetting;

        $transport = Swift_SmtpTransport::newInstance($madrilSetting->host, $madrilSetting->port);
        $transport->setUsername($madrilSetting->username);
        $transport->setPassword($madrilSetting->password);
        $swift = Swift_Mailer::newInstance($transport);

        $message = new Swift_Message($subject);
        $message->setFrom($from);
        $message->setBody($html, 'text/html');
        $message->setTo($to);
        if( $attachPath )
            $message->attach(Swift_Attachment::fromPath( $cnf->path->public.$attachPath ));

        return $swift->send($message, $failures);        
    }    
    
    /**
     * Property for class autoload
     * @return
     * @param $class Class name for autoload
     */
    public function __get($class)
    {
        if (!isset($this->_objects[$class])) {
            switch ($class) {
                case 'ImageMagick':
                    $cnf = Zend_Registry::get('cnf');
                    $this->_objects[$class] = new $class(array('convert' => $cnf->commandList->convert, 'identify' => $cnf->commandList->identify));
                    break;
                default:
                    $this->_objects[$class] = new $class($this->_db);
                    break;
            }
        }
        return $this->_objects[$class];
    }
    /* Function for adding metatags to header part of html page */
    public function setMetaTags($metaTags) 
    {
        $this->_view->meta = array(
            'title' => 
                isset($metaTags['metaTitle'])?
                $metaTags['metaTitle']:"",
            'description' => 
                isset($metaTags['metaDescription'])?
                $metaTags['metaDescription']:"",
            'keywords' => 
                isset($metaTags['metaKeywords'])?
                $metaTags['metaKeywords']:"",
            'cannonical' => 
                isset($metaTags['metaCannonical'])?
                $metaTags['metaCannonical']:"",
            
        );
    }
    
    public function redirect($url)
    {
        $cnf = Zend_Registry::get('cnf');
        header("Location: " . $cnf->url->baseFull . $url);
        exit ();
    }
    
    public function redirect301($url)
    {
        $cnf = Zend_Registry::get('cnf');
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . $cnf->url->baseFull . $url);
        exit ();
    }    

    public function getPage($name = 'page')
    {
        $page = $this->_request->getParam($name);
        if(empty($page))
            $page = 1;
        return $page;
    }

    public function paginator($data, $url)
    {
        $this->_view->paging = $this->ModelBase->pagingPrepare($data['total'],
                                                            $data['page'],
                                                            $data['pageLength'],
                                                            $url, TRUE);
    }

    /*
     *  Create variable paging as associative array.
     *  Example <div>Page {$paging.currentPage} from {$paging.totalPages} {$paging.back} {$paging.next}</div>
     *  For more information see pagingPrepareFront.
     */
    public function paginatorFront($data, $url)
    {
        $this->_view->paging = $this->ModelBase->pagingPrepareFront($data['total'],
                                                            $data['page'],
                                                            $data['pageLength'],
                                                            $url, TRUE);
    }
    
    public function paginatorJavascript($data)
    {
        $this->_view->paging = $this->ModelBase->pagingPrepareJavascript($data['total'],
                                                            $data['page'],
                                                            $data['pageLength'],
                                                            TRUE);
    }    

    public function getFckEditText($text, $fieldName = 'text',
        $param = array(
            'height' => '300',
            'toolbarset' => 'Default')
            )
    {
        $cnf = Zend_Registry::get('cnf');
        require_once($cnf->path->public . "ckeditor/ckeditor.php");
	 $CKEditor = new CKEditor();
         $CKEditor->config['height'] = $param['height'];
         $CKEditor->config['width'] = '99%';
         $CKEditor->returnOutput = true;
	 $config = array();
	 $config['toolbar'] = array(
	     array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
	     array( 'Image', 'Link', 'Unlink', 'Anchor' )
	 );
	 $code = $CKEditor->editor($fieldName, $text); 
         return $code;
    }
    /*
     *  Method used by MetaData
     */
    public function getFckEditTextMeta($text, $fieldName = 'text',
                $param = array(
            'height' => '300',
            'toolbarset' => 'Default')
            )
    {
        $cnf = Zend_Registry::get('cnf');
        require_once($cnf->path->public . "ckeditor/ckeditor.php");
	 $CKEditor = new CKEditor();
         $CKEditor->config['height'] = $param['height'];
         $CKEditor->config['width'] = '99%';
         $CKEditor->returnOutput = true;
	 $config = array();
	 $config['toolbar'] = array(
	     array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike' ),
	     array( 'Image', 'Link', 'Unlink', 'Anchor' )
	 );
//         print_r($CKEditor);exit;
	 $code = $CKEditor->editor($fieldName, $text);        
         return $code;
    }

    /**
     * Image Upload
     * @var <type>
     */
    public $_imgColumns = array(
        'imageOriginal' => 'o',
        'imageBig' => 'b',
        'imageMedium' => 'm',
        'imageSmall' => 's'
    );

    /**
     * generates random string with specified length
     * @return
     * @param $length int[optional]
     * @param $str string[optional]
     */
    public function uniqueKey($length = 7, $str = null)
    {
        $res = '';
        if (is_null($str)) {
            $str = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        }
        for ($i = 0; $i < $length; $i++) {
            $res .= substr(str_shuffle($str), 0, 1);
        }
        return $res;
    }
//     * public function uploadPhotoNew
//     * @param <type> $files
//     * Пример масссива $files
//     * $files = array(
//          ["imageOriginal"]=>
//          array(4) {
//            ["title"]=>
//            string(13) "imageOriginal"
//            ["imagesDir"]=>
//            string(15) "images/content/"
//            ["sizes"]=>
//            array(2) {
//              ["imageOriginal"]=>
//              string(7) "753x105"
//              ["imageSmall"]=>
//              string(5) "50x50"
//            }
//            ["cropSmart"]=>
//            bool(false)
//            ["cropSkip"]=>
//            bool(false)            
//          }
//          ["imageOriginal2"]=>
//          array(4) {
//            ["title"]=>
//            string(13) "imageOriginal2"
//            ["imagesDir"]=>
//            string(15) "images/content2/"
//            ["sizes"]=>
//            array(2) {
//              ["imageOriginal2"]=>
//              string(7) "700x500"
//              ["imageSmall2"]=>
//              string(5) "50x50"
//            }
//            ["cropSmart"]=>
//            bool(false)
//            ["cropSkip"]=>
//            bool(false)              
//          }
//      )
//                    $files = array(
//                "imageOriginal"=>array(
//                    "title"=> "imageOriginal",
//                    "imagesDir"=>"images/content/",
//                    "sizes"=> array(
//                      "imageOriginal"=>"753x105",
//                      "imageSmall"=> "50x50"
//                    ),
//                    "cropSmart"=>false,
//                    "cropSkip"=>false            
//                  )
//                );
    
    public function _uploadPhotoNew($files)
    {
        $upload = new Zend_File_Transfer_Adapter_Http();
        $upload->addValidator('Extension', false, explode(",", "JPG,JPEG,BMP,PNG,BMP,GIF"));
        //$uploadFiles = $upload->getFileInfo();
        //Делаем проверку на существование загружаемой картинки
        foreach ($_FILES as $name => $array) 
        {
            if(!empty($array['name']))
                $files[$name]['isset'] = TRUE;
        }
        
        foreach ($files as $name => $array) 
        {
            if(isset($array['isset']) && $array['isset'] == TRUE)
            {
                $nameExplode = explode('.', $_FILES[$array['title']]['name']);
                
                if($nameExplode[count($nameExplode)-1] != 'pdf')
                {
                    $fileName[$name] = Generator::generateName($upload->getFileName($array['title']));
                    if (!file_exists($array['imagesDir'])) {
                        umask(0);
                        mkdir($array['imagesDir'], 0777, true);
                    }
              //      $upload->addFilter('Rename', $dir . $fileName);
                    if (!$upload->isValid($array['title']))
                        return FALSE;
                    $nameExplode = explode('.', $_FILES[$array['title']]['name']);
                    if($nameExplode[count($nameExplode)-1] == 'gif'){
                        foreach ($array['sizes'] as $type => $column) {
                            $img[$type] = $_FILES[$array['title']]['name'];
                        }           
                        copy($_FILES[$array['title']]["tmp_name"], $cnf->path->public.$array['imagesDir'].$_FILES[$array['title']]['name']);                    
                    }
                    if ($upload->receive($array['title'])) {
                        $fileInfo = pathinfo($array['imagesDir'] . $fileName[$name]);
                        $extension = $fileInfo['extension'];
                        if($extension != 'gif'){
                            foreach ($array['sizes'] as $type => $column) {
                                $img[$type] = $this->uniqueKey(8) . '.' . $extension;
                            }                        
                            if (!$array['cropSmart']) {
                                //original
                                if (isset($array['sizes'][$array['title']])) {
                                    $thumbnailsError = (
                                                            0 != $this->ImageMagick->thumbnail($upload->getFileName($array['title']),
                                                            $array['imagesDir'] . $img[$array['title']],
                                                            $array['sizes'][$array['title']] . '">"')
                                                        );
                                }
                                //other
                                foreach ($array['sizes'] as $type => $column) {
                                    if($type != $array['title']){
                                        $thumbnailsError = 
                                                $thumbnailsError ||
                                                (
                                                    0 != $this->ImageMagick->thumbnail($upload->getFileName($array['title']),
                                                    $array['imagesDir'] . $img[$type],
                                                    $array['sizes'][$type] . '">"')
                                                );                   
                                    }
                                }
                            } else {
                                //original
                                if (isset($array['sizes'][$array['title']])) {
                                    if (!isset($array['cropSkip'][$array['title']]))//если не обрезать этот размер
                                        $thumbnailsError = (
                                                                0 != $this->ImageMagick->cropSmart($upload->getFileName($array['title']),
                                                                $array['imagesDir'] . $img[$array['title']],
                                                                $array['sizes'][$array['title']] . '">"')
                                                            );
                                    else
                                        $thumbnailsError = (
                                                                0 != $this->ImageMagick->thumbnail($upload->getFileName($array['title']),
                                                                $array['imagesDir'] . $img[$array['title']],
                                                                $array['sizes'][$array['title']] . '">"')
                                                            );                            

                                }
                                //other
                                foreach ($array['sizes'] as $type => $column) {
                                    if($type != $array['title']){
                                        if (!isset($array['cropSkip'][$type]))//если не обрезать этот размер
                                            $thumbnailsError = 
                                                    $thumbnailsError ||
                                                    (
                                                        0 != $this->ImageMagick->cropSmart($upload->getFileName($array['title']),
                                                        $array['imagesDir'] . $img[$type],
                                                        $array['sizes'][$type] . '">"')
                                                    );       
                                        else
                                            $thumbnailsError = 
                                                    $thumbnailsError ||
                                                    (
                                                        0 != $this->ImageMagick->thumbnail($upload->getFileName($array['title']),
                                                        $array['imagesDir'] . $img[$type],
                                                        $array['sizes'][$type] . '">"')
                                                    );                              
                                    }
                                }
                            }
                        } 
                        // remove original file
                        @unlink($upload->getFileName($array['title']));
    //                    if (isset($columns)){
    //                        foreach ($columns as $columnKey => $column)
    //                            $img[$column] = $img[$columnKey];
    //                    }            
                    }
                }
            }
        }
        return $img;
    }
    /**
     * public function uploadPhoto
     * @param <type> $file
     * @param <type> $dir
     * @param <type> $sizes
     * @param <type> $name
     * @param <type> $cropSmart
     * @param <type> $columns
     * @return <type>
     */
    public function _uploadPhoto($file, $dir, $sizes, $name = null, $cropSmart = false, $columns=null,
            $cropSkip = array())
    {
        $data = $this->getRequest()->getParams();
        $upload = new Zend_File_Transfer_Adapter_Http();
        $fileName = Generator::generateName($upload->getFileName($file));
        if (!file_exists($dir)) {
            umask(0);
            mkdir($dir, 0777, true);
        }

        $upload->addFilter('Rename', $dir . $fileName);
        $upload->addValidator('Extension', false, explode(",", "JPG,JPEG,BMP,PNG,BMP,GIF"));

        if (!$upload->isValid())
            return FALSE;
        
        $fileInfo = pathinfo($dir . $fileName);
        $extension = $fileInfo['extension'];
        
        if($extension == 'GIF'){
            copy($_FILES[$file]["tmp_name"], $dir.$_FILES[$file]['name']);
            $img = $_FILES[$file]['name'];
        } else {        
//        $upload->addValidator('IsImage', false);
        if ($upload->receive()) {
            $img = $this->_imgColumns;
            foreach ($this->_imgColumns as $type => $column) {
                $img[$type] = $this->uniqueKey(8) . '.' . $extension;
            }
                if (!$cropSmart) {

                    //original
                    if (isset($sizes['original'])) {
                        $thumbnailsError = (0 != $this->ImageMagick->thumbnail($upload->getFileName($file),
                                        $dir . $img['imageOriginal'],
                                        $sizes['original'] . '">"'));
                    }

                    // other images
                    if (isset($sizes)) {
                        //big
                        if (isset($sizes['big']))
                            $thumbnailsError = $thumbnailsError ||
                                    (0 != $this->ImageMagick->thumbnail($upload->getFileName($file),
                                            $dir . $img['imageBig'],
                                            $sizes['big'] . '">"'));

                        // medium
                        if (isset($sizes['medium']))
                            $thumbnailsError = $thumbnailsError || (0 != $this->ImageMagick->thumbnail($upload->getFileName($file),
                                            $dir . $img['imageMedium'],
                                            $sizes['medium'] . '">"'));

                        // small
                        if (isset($sizes['small']))
                            $thumbnailsError = (0 != $this->ImageMagick->thumbnail($upload->getFileName($file),
                                            $dir . $img['imageSmall'],
                                            $sizes['small'] . '">"'));
                    }
                } else {
                    if (isset($sizes['original'])) {
                        if (!isset($cropSkip['original']))
                            $thumbnailsError = $thumbnailsError ||
                                    (0 != $this->ImageMagick->cropSmart($upload->getFileName($file),
                                            $dir . $img['imageOriginal'],
                                            $sizes['original'] . '">"'));
                        else
                            $thumbnailsError = $thumbnailsError ||
                                    (0 != $this->ImageMagick->thumbnail($upload->getFileName($file),
                                            $dir . $img['imageOriginal'],
                                            $sizes['original'] . '">"'));
                    }                    
                    if (!$thumbnailsError && isset($sizes)) {
                        if (isset($sizes['big'])) {
                            if (!isset($cropSkip['big']))
                                $thumbnailsError = $thumbnailsError ||
                                        (0 != $this->ImageMagick->cropSmart($upload->getFileName($file),
                                                $dir . $img['imageBig'],
                                                $sizes['big'] . '">"'));
                            else
                                $thumbnailsError = $thumbnailsError ||
                                        (0 != $this->ImageMagick->thumbnail($upload->getFileName($file),
                                                $dir . $img['imageBig'],
                                                $sizes['big'] . '">"'));
                        }
                        // medium
                        if (isset($sizes['medium'])){
                            if (!isset($cropSkip['medium'])){
                                $thumbnailsError = $thumbnailsError ||
                                        (0 != $this->ImageMagick->cropSmart($upload->getFileName($file),
                                                $dir . $img['imageMedium'],
                                                $sizes['medium'] . '">"'));
                            } else {
                                $thumbnailsError = $thumbnailsError ||
                                        (0 != $this->ImageMagick->thumbnail($upload->getFileName($file),
                                                $dir . $img['imageMedium'],
                                                $sizes['medium'] . '">"'));
                            }
                        }
                        // small
                        if (isset($sizes['small'])){
                            if (!isset($cropSkip['small'])){
                                $thumbnailsError = $thumbnailsError ||
                                        (0 != $this->ImageMagick->cropSmart($upload->getFileName($file),
                                                $dir . $img['imageSmall'],
                                                $sizes['small'] . '">"'));
                            } else {
                                $thumbnailsError = $thumbnailsError ||
                                        (0 != $this->ImageMagick->thumbnail($upload->getFileName($file),
                                                $dir . $img['imageSmall'],
                                                $sizes['small'] . '">"'));  
                            }
                        }
                    }
                }
                if (isset($columns))
                    foreach ($columns as $columnKey => $column)
                        $img[$column] = $img[$columnKey];                
            }
        }
        // remove original file
        @unlink($upload->getFileName($file));
        return $img;
    }

    public function dirDel($file)
    {
        if (file_exists($file)) {
            chmod($file, 0777);
            if (is_dir($file)) {
                $handle = opendir($file);
                while ($filename = readdir($handle))
                    if ($filename != "." && $filename != "..")
                        $this->dirDel($file . "/" . $filename);
                closedir($handle);
                rmdir($file);
            } else {
                unlink($file);
            }
        }
    }

    /*
     * Create HTML based on MetaData
     * @param <string> $action - If null dont create form start tag
     * @param <array> $editMode - For edit actions. Show already exist images.
     * For more details see class MetaModelBase
     */
    public function createHTML($action = NULL, $editMode = array(), $meta= NULL, $metaFull= NULL, $fields= NULL, $mode = 'admin', $selectId=NULL, $addTr=NULL) 
    {
        $googleMapTitle = 'Google Map';
        $cancelButton = 'Отмена';
        $saveButton = 'Сохранить';
        //check super admin permission
        $superAdminPermission = FALSE;
        for($i=0; $i < count($_SESSION['user']['permission']); $i++){
           if($_SESSION['user']['permission'][$i] == 'admin.super')
               $superAdminPermission = TRUE;
        }       
        if ($action == NULL)
            $html = '';
        else{
            if(isset($selectId)){
              $explode = explode('/',$action); 
              $count = (int)count($explode);
              if($explode[$count-1] == '' && $explode[$count-2] == 'id'){
                 $explode[$count-2] = 'selectid';
                 $explode[$count-1] = $selectId;
                 $action = implode('/', $explode);  
              }
              else{
                  $action .= '/selectid/'.$selectId;
              }
            }
            $html = '<form id="quick-press" method="post" action="' . $action . '" enctype="multipart/form-data">
                     <table class="adminTable">';
        }
//        var_dump($action);exit;
        for ($i = 0; $i < count($meta); $i++) {
            if(isset($meta[$fields[$i]]['show'])){
                if($mode == $meta[$fields[$i]]['show'])
                    $modeFilter = TRUE;
                else
                    $modeFilter = FALSE;
            } else {
                $modeFilter = TRUE;
            }
            if ($modeFilter == TRUE && 
                        (
                        isset($meta[$fields[$i]]['showInListing']) && $meta[$fields[$i]]['showInListing'] == 2 ||
                        isset($meta[$fields[$i]]['showInListing']) && $meta[$fields[$i]]['showInListing'] == 3
                        )
                ) 
                {
                if (!empty($_SESSION['formData'][$fields[$i]])){
                    $formData = $_SESSION['formData'][$fields[$i]];
                    if(count($_SESSION['formData']) > 1 && isset($_SESSION['formData'][$fields[0]]))
                        $id = $_SESSION['formData'][$fields[0]];
                }
                else
                    $formData = '';
                $param = '';
                switch ($meta[$fields[$i]]['type']) {
                    case 'select':
                        if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                            break;
                        }
                        else{
                            if (isset($meta[$fields[$i]]['param']))
                                $param = $meta[$fields[$i]]['param'];
                            else
                                $param = '';
                            if (isset($meta[$fields[$i]]['table']) && !empty($editMode[$meta[$fields[$i]]['table']]['data'])) {
                                $html.='<tr>
                                    <td class="title">' . $meta[$fields[$i]]['title'] . ':' . (isset($meta[$fields[$i]]['validate']) ? '<sup>*</sup>' : '') . '</td>
                                    <td><select name="' . $fields[$i] . '">
                                        <option ' . (empty($formData) ? 'selected=""' : '') . '></option>';
                                for ($j = 0; $j < count($editMode[$meta[$fields[$i]]['table']]['data']); $j++) {
                                    $f = array_keys($editMode[$meta[$fields[$i]]['table']]['data'][$j]);
                                    if (!empty($formData) && $formData == $editMode[$meta[$fields[$i]]['table']]['data'][$j][$f[0]])
                                        $select = 'selected=""';
                                    else
                                        $select = '';
                                    $html.='<option value="' . $editMode[$meta[$fields[$i]]['table']]['data'][$j][$f[0]] . '" ' . $select . '>' . $editMode[$meta[$fields[$i]]['table']]['data'][$j][$f[1]] . '</option>';
                                }
                                $html.='</select></td>
                                    </tr>';
                                break;
                            } elseif (isset($meta[$fields[$i]]['table']) && empty($editMode[$meta[$fields[$i]]['table']]['data'])) {
                                $tableListing = ModelBase::listingMeta($meta[$fields[$i]]['table'], 0, 1);
                                $html.='<tr>
                                    <td class="title">' . $meta[$fields[$i]]['title'] . ':' . (isset($meta[$fields[$i]]['validate']) ? '<sup>*</sup>' : '') . '</td>
                                    <td><select name="' . $fields[$i] . '">
                                        <option ' . (empty($formData) ? 'selected=""' : '') . '></option>';
                                for ($j = 0; $j < count($tableListing['data']); $j++) {
                                    $f = array_keys($tableListing['data'][$j]);
                                    if (!empty($formData) && $formData == $tableListing['data'][$j][$f[0]])
                                        $select = 'selected=""';
                                    else
                                        $select = '';
                                    $html.='<option value="' . $tableListing['data'][$j][$f[0]] . '" ' . $select . '>' . $tableListing['data'][$j][$f[1]] . '</option>';
                                }
                                $html.='</select></td>
                                    </tr>';

                                break;
                            }                             
                            elseif (isset($meta[$fields[$i]]['values'])) {
                                if(isset($editMode[$fields[$i]])){
                                    $meta[$fields[$i]]['values'] = $editMode[$fields[$i]];
                                } 
                                $keys = array_keys($meta[$fields[$i]]['values']);

                                $html.='<tr>
                                    <td class="title">' . $meta[$fields[$i]]['title'] . ':' . (isset($meta[$fields[$i]]['validate']) ? '<sup>*</sup>' : '') . '</td>
                                    <td><select name="' . $fields[$i] . '" ' . $param . '>';
                                for ($j = 0; $j < count($meta[$fields[$i]]['values']); $j++) {
                                    if (isset($formData) && $formData == $keys[$j])
                                        $select = 'selected=""';
                                    else
                                        $select = '';
                                    $html.='<option value="' . $keys[$j] . '" ' . $select . '>' . $meta[$fields[$i]]['values'][$keys[$j]] . '</option>';
                                }
                                $html.='</select></td>
                                    </tr>';
                                break;
  
                            } else {
                                $html.='<tr><td colspan="2" style="color:red;">Check metadata configuration file! You have error in select section!</td></tr>';
                                break;
                            }   
                        }
                    case 'order':
                    case 'active':
                        break;
                    case 'date':
                        if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                            break;
                        }
                        else{
                            $html.='<script>
                                        $(document).ready(function(){
                                            $("#' . str_replace(' ', '', $meta[$fields[$i]]['title']) . '").datepicker({
                                                                                    showOn: "button",
                                                                                    dateFormat: "yy-mm-dd",
                                                                                    buttonImage: "styles/jqueryui/images/calendar_edit.png",
                                                                                    buttonImageOnly: true
                                                                                    });
                                        });
                                    </script>
                                <tr>
                                    <td class="title"><label for="' . str_replace(' ', '', $meta[$fields[$i]]['title']) . '">' . $meta[$fields[$i]]['title'] . ':' . (isset($meta[$fields[$i]]['validate']) ? '<sup>*</sup>' : '') . '</label></td>
                                    <td><input type="text" value="' . $formData . '" autocomplete="off" id="' . str_replace(' ', '', $meta[$fields[$i]]['title']) . '" name="' . $fields[$i] . '" style="width: 100px;" maxlength="10"></td>
                                </tr>';
                            break;
                        }
                    case 'color':
                        if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                            break;
                        }else{
                            $html.='<script>
                                        $(document).ready(function(){
                                            $("#' . str_replace(' ', '', $meta[$fields[$i]]['title']) . '").ColorPicker({
                                                                                    onSubmit: function(hsb, hex, rgb, el) {
                                                                                            $(el).val(hex);
                                                                                            $(el).ColorPickerHide();
                                                                                            $("#preview").css("backgroundColor", "#" + hex);
                                                                                    },
                                                                                    onBeforeShow: function () {
                                                                                            $(this).ColorPickerSetColor(this.value);
                                                                                    }
                                                                                    })
                                                                                    .bind("keyup", function(){
                                                                                            $(this).ColorPickerSetColor(this.value);
                                                                                    });
    });
                                    </script>
                                <tr>
                                    <td class="title"><label for="' . str_replace(' ', '', $meta[$fields[$i]]['title']) . '">' . $meta[$fields[$i]]['title'] . ':'.(isset ($meta[$fields[$i]]['validate'])?'<sup>*</sup>':'').'</label></td>
                                    <td><input type="text" value="' . $formData . '" autocomplete="off" id="' . str_replace(' ', '', $meta[$fields[$i]]['title']) . '" name="' . $fields[$i] . '" style="width: 100px;" maxlength="10"><div id="preview" style="background-color:#'.$formData.'"></td>
                                </tr>';
                            break;
                        }
                    case 'email':
                    case 'string':
                        if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                            break;
                        }else{
                            if (isset($meta[$fields[$i]]['param']))
                                $param = $meta[$fields[$i]]['param'];
                            else
                                $param = '';
                            $html.='<tr>
                                    <td class="title"><label for="' . $meta[$fields[$i]]['title'] . '">' . $meta[$fields[$i]]['title'] . ':' . (isset($meta[$fields[$i]]['validate']) ? '<sup>*</sup>' : '') . '</label></td>';
                            if (isset($meta[$fields[$i]]['string_type'])) {
                                switch ($meta[$fields[$i]]['string_type']) {
                                    case 'password':
                                        $html.='<td><input type="password" value="' . $formData . '" ' . $param . ' autocomplete="off" id="' . $meta[$fields[$i]]['title'] . '" name="' . $fields[$i] . '" style="width:100%" ' . (isset($meta[$fields[$i]]['maxLength']) ? 'maxlength="' . $meta[$fields[$i]]['maxLength'] . '"' : '') . '></td>';
                                        break;
                                }
                            } else
                                $html.='<td><input type="text" value="' . $formData . '" ' . $param . ' autocomplete="off" id="' . $meta[$fields[$i]]['title'] . '" name="' . $fields[$i] . '" style="width:100%" ' . (isset($meta[$fields[$i]]['maxLength']) ? 'maxlength="' . $meta[$fields[$i]]['maxLength'] . '"' : '') . '></td>';
                            $html.='</tr>';
                            break;
                        }
                    case 'textarea':
                        if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){                        
                            break;
                        }else{
                            $html.='<tr>
                                    <td class="title"><label for="' . $meta[$fields[$i]]['title'] . '">' . $meta[$fields[$i]]['title'] . ':' . (isset($meta[$fields[$i]]['validate']) ? '<sup>*</sup>' : '') . '</label></td>
                                    <td><textarea autocomplete="off" id="' . $meta[$fields[$i]]['title'] . '" name="' . $fields[$i] . '" style="width:100%; height:150px;" ';
                            if(isset($meta[$fields[$i]]['maxLength']))
                                $html.=' maxlength="'.$meta[$fields[$i]]['maxLength'].'" ';
                            $html.= '>' . $formData . '</textarea></td>
                                </tr>';                            
                            break;
                        }
                    case 'double':
                        if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                            break;
                        }else{
                            $html.='<tr>
                                    <td class="title"><label for="' . $meta[$fields[$i]]['title'] . '">' . $meta[$fields[$i]]['title'] . ':' . (isset($meta[$fields[$i]]['validate']) ? '<sup>*</sup>' : '') . '</label></td>
                                    <td><input type="text" value="' . $formData . '" ' . $param . ' autocomplete="off" id="' . $meta[$fields[$i]]['title'] . '" name="' . $fields[$i] . '" style="width:100%" ' . (isset($meta[$fields[$i]]['maxLength']) ? 'maxlength="' . $meta[$fields[$i]]['maxLength'] . '"' : '') . '></td>
                                </tr>';
                            break;
                        }
                    case 'int':
                        if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                            break;
                        }else{
                            $html.='<tr>
                                    <td class="title"><label for="' . $meta[$fields[$i]]['title'] . '">' . $meta[$fields[$i]]['title'] . ':' . (isset($meta[$fields[$i]]['validate']) ? '<sup>*</sup>' : '') . '</label></td>
                                    <td><input type="text" value="' . $formData . '" ' . $param . ' autocomplete="off" id="' . $meta[$fields[$i]]['title'] . '" name="' . $fields[$i] . '" style="width:100%" ' . (isset($meta[$fields[$i]]['maxLength']) ? 'maxlength="' . $meta[$fields[$i]]['maxLength'] . '"' : '') . '></td>
                                </tr>';
                            break;
                        }
                    case 'price':
                        if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){                        
                            break;
                        }else{
                            $html.='<tr>
                                    <td class="title"><label for="' . $meta[$fields[$i]]['title'] . '">' . $meta[$fields[$i]]['title'] . ':'.(isset ($meta[$fields[$i]]['validate'])?'<sup>*</sup>':'').'</label></td>
                                    <td><input type="text" value="' . $formData . '" '.$param.' autocomplete="off" id="' . $meta[$fields[$i]]['title'] . '" name="' . $fields[$i] . '" style="width:100%" '.(isset($meta[$fields[$i]]['maxLength'])?'maxlength="'.$meta[$fields[$i]]['maxLength'].'"':'').'></td>
                                </tr>';
                            break;    
                        }
                    case 'text':
                        if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                            break;
                        }else{
                            $fck = BaseController::getFckEditTextMeta($formData, $fields[$i], array('width' => '100%', 'height' => '300', 'toolbarset' => 'Default'));
                            $html.='<tr>
                                    <td class="title"><label for="' . $meta[$fields[$i]]['title'] . '">' . $meta[$fields[$i]]['title'] . ':' . (isset($meta[$fields[$i]]['validate']) ? '<sup>*</sup>' : '') . '</label></td>
                                    <td>' . $fck . '</td>
                                </tr>';
                            break;
                        }
                    case 'image':
                        if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                            break;
                        }else{
                            if (!empty($formData)) {
                                $html.='<tr>
                                        <input type="hidden" name="' . $fields[$i] . '" value="' . $formData . '" />
                                        <td class="title" ><label for="' . $meta[$fields[$i]]['title'] . '">' . $meta[$fields[$i]]['title'] . ':' . (isset($meta[$fields[$i]]['validate']) ? '<sup>*</sup>' : '') . '</label></td>
                                        <td><input type="file" class="file" name="' . $fields[$i] . '" id="' . $meta[$fields[$i]]['title'] . '" value="' . $formData . '" /></td>
                                    </tr>';                                  
                                if (!isset($meta[$fields[$i]]['imagesDir'])) {
                                    $html.='<tr><td colspan="2" style="color:red;">Check metadata configuration file! You have error in field "' . $meta[$fields[$i]]['title'] . '". Error: Set imagesDir path!</td></tr>';
                                    break;
                                }
                                $html.='
                                <tr>
                                    <td></td>
                                    <td>';
                                if(isset($meta[$fields[$i]]['additionalImagesDir']))
                                    $html.=' <img src="' . $meta[$fields[$i]]['imagesDir'].$_SESSION['formData'][$meta[$fields[$i]]['additionalImagesDir']]. '/' .$id. '/' . $formData . '" /> ';
                                else
                                    $html.=' <img src="' . $meta[$fields[$i]]['imagesDir'] .$id. '/' . $formData . '" /> ';                          
                                $html.='</td></tr>';                                
                            } else {
                                $html.='<tr>
                                        <input type="hidden" name="' . $fields[$i] . '" value="' . $formData . '" />
                                        <td class="title" ><label for="' . $meta[$fields[$i]]['title'] . '">' . $meta[$fields[$i]]['title'] . ':' . (isset($meta[$fields[$i]]['validate']) ? '<sup>*</sup>' : '') . '</label></td>
                                        <td><input type="file" class="file" name="' . $fields[$i] . '" id="' . $meta[$fields[$i]]['title'] . '" value="' . $formData . '" /></td>
                                    </tr>';                                
                            }
                            break;
                        }
                    case 'file':
                        if(isset($meta[$fields[$i]]['access']) && $meta[$fields[$i]]['access'] == 'superAdmin' && $superAdminPermission == FALSE){
                            break;
                        }else{
                            //Validate param: filePath
                            if (!isset($meta[$fields[$i]]['filePath'])) {
                                $html.='<tr><td colspan="2" style="color:red;">Check metadata configuration file! You have error in field "' . $meta[$fields[$i]]['title'] . '". Error: Set file path!</td></tr>';
                                break;
                            }
                            $html.='<tr>
                                        <td class="title" >
                                            <label for="' . $meta[$fields[$i]]['title'] . '">' . $meta[$fields[$i]]['title'] . ':' . (isset($meta[$fields[$i]]['validate']) ? '<sup>*</sup>' : '') . '</label>
                                        </td>
                                        <td>
                                            <input type="file" class="file" name="' . $fields[$i] . '" id="' . $meta[$fields[$i]]['title'] . '" value="' . $formData . '" />
                                        </td>
                                    </tr>';
                            $cnf = Zend_Registry::get('cnf');
                            if (!empty($formData)) {
                                $html.='
                                <tr>
                                    <td>File link:</td>
                                    <td>
                                        ' . $cnf->url->baseFull . $meta[$fields[$i]]['filePath'] . $formData . '
                                    </td>
                                </tr>';
                            }
                            break;
                        }
                    default:
                        if ($fields[$i] != 'deleted' && $fields[$i] != 'approved')
                        {
//                            var_dump($fields[$i]);exit;
                            $html.='<tr><td colspan="2" style="color:red;">Check metadata configuration file! You have error!</td></tr>';
                        }
                        break;
                }
            }
        }
        //Если есть гугл карта
        if(isset($metaFull['googleMap'])){
            if(!empty($_SESSION['formData'])){ //если edit
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
                                    Longitude: <input type="text" id="longitude" value="'.$formData['longitude'].'" name="longitude" style="width: 150px;"/>
                                    Latitude: <input type="text" id="latitude" value="'.$formData['latitude'].'" name="latitude" style="width: 150px;" />
                                    <div class="map" id="Map" 
                                         objectId="'.$formData[$keys[0]].'" 
                                         longitude="'.$formData['longitude'].'" 
                                         latitude="'.$formData['latitude'].'" >
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
            else {   //если add
                if(
                        isset($meta['longitude']) 
                        && !empty($meta['longitude']['default']) 
                        && isset($meta['latitude']) 
                        && !empty($meta['latitude']['default'])
                    )
                {                
                    $html.='<tr>
                                <td class="title">
                                    '.$googleMapTitle.'
                                </td>
                                <td class="content">
                                    Longitude: <input type="text" id="longitude" value="" name="longitude" style="width: 150px;"/>
                                    Latitude: <input type="text" id="latitude" value="" name="latitude" style="width: 150px;" />
                                    <div class="map" id="Map" 
                                         objectId="0" 
                                         longitude="'.$meta['longitude']['default'].'" 
                                         latitude="'.$meta['latitude']['default'].'">
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
        }       
        //Если есть добавочные tr
        if(isset($metaFull['addTr']) && !empty($addTr)){
            $this->_smarty = Zend_Registry::get('smarty');
            $this->_view = new SmartyVariable($this->_smarty); 
            if(!empty($addTr)){
                foreach($addTr as $key => $value){
                    $this->_view->$key = $value;
                }
            }
            $addTrTpl = $this->_smarty->fetch($metaFull['title'].'/addtr.tpl');
            $html .= $addTrTpl;
        }     
        if ($action == NULL)
            $html.= '';
        else
            $html.= '<tr><td colspan="2">
                    <p class="submit">
                        <input type="reset" class="button" value="'.$cancelButton.'">
                        <input type="submit" value="'.$saveButton.'" class="button-primary">
                        <br class="clear">
                    </p>
                    </td></tr>
                    </table></form>';
//        var_dump($html);exit;
        return $html;
    }
    
    public function getUserPermission($userId)
    {
        $mas = array();
        $permission = $this->PermissionGroupUser->listing(0, 1, array('userId'=>$userId));
        for ($i = 0; $i < count($permission['data']); $i++) {
            $objects = $this->PermissionGroupObject->listing(0, 1, array('permission_groupId'=>$permission['data'][$i]['permission_groupId']));
            if(count($objects['data'])>0) {
                foreach($objects['data'] as $v) {
                    $details = $this->PermissionObject->details($v['permission_objectId']);
                    $mas[]= $details['code'];
                }
            }
        }
        $mas = array_count_values($mas);
        $mas = array_keys($mas);
        return $mas;
    }    
    
    public function baseSecurity()
    {
        $return = TRUE;
        if(!isset($_SESSION['user']))
            $return = FALSE;
        
        if(empty($_SESSION['user']))
            $return = FALSE;
        
        if(empty($_SESSION['user']['userId']))
            $return = FALSE;    
        return $return;
    }

    public function checkAccess($userId)
    {
        $access = TRUE;
        if( !isset($_SESSION['user']) )
            $access = FALSE;
        
        if(empty($_SESSION['user']))
            $access = FALSE;
        
        if(empty($_SESSION['user']['userId']))
            $access = FALSE;    
        
        if( $_SESSION['user']['userId'] != $userId )
            $access = FALSE;
            
        return $access;
    }     
    
    public function setBread($data = array())
    {
        $bread = '<a href="#">Главная</a> -> ';
        for($i=0; $i<count($data); $i++)
        {
            if( $i == count($data)-1 )
                $bread .= '<span class="breadTitle">'.$data[$i].'</span>';
            else
                $bread .= $data[$i];
            
            if( $i < count($data)-1 )
                $bread .= ' -> ';
        }
        $this->_view->bread = $bread;
    }    
    
    public function recalculateCart()
    {
        if(isset($_SESSION['cart']))
        {
            $isUserSale = $this->Setting->getSetting('reg_user_sale');
            if(!isset($_SESSION['cartPrice']))
            {
                $_SESSION['cartPrice'] = array(
                        'totalProductsPrice' => 0,
                        'totalProductsCount' => 0,
                        'discount' => 0,
                        'orderPrice' => 0
                );
            }
            $totalProductsPrice = 0;
            $totalProductsCount = 0;
            foreach($_SESSION['cart'] as $k=>$v)
            {
                $_SESSION['cart'][$k]['allPrice'] = $v['details']['price']*$v['amount'];
                $totalProductsPrice += $_SESSION['cart'][$k]['allPrice'];
                $totalProductsCount += $v['amount'];
            }

            $_SESSION['cartPrice']['totalProductsPrice'] = $totalProductsPrice;
            $_SESSION['cartPrice']['totalProductsCount'] = $totalProductsCount;
            if( isset($_SESSION['user']) && $isUserSale )
            {
                $_SESSION['cartPrice']['discount'] = $totalProductsPrice*$isUserSale['value']/100;
                $_SESSION['cartPrice']['orderPrice'] = $totalProductsPrice-$_SESSION['cartPrice']['discount'];
            }
            else
            {
                $_SESSION['cartPrice']['orderPrice'] = $totalProductsPrice;
            }
        }
    }  
    
    public function recalculateAdminCart()
    {
        if(isset($_SESSION['adminCart']))
        {
            if(!isset($_SESSION['adminCartPrice']))
            {
                $_SESSION['adminCartPrice'] = array(
                        'totalProductsPrice' => 0,
                        'totalProductsCount' => 0,
                        'discount' => 0,
                        'orderPrice' => 0
                );
            }
            $totalProductsPrice = 0;
            $totalProductsCount = 0;
            foreach($_SESSION['adminCart'] as $k=>$v)
            {
                $_SESSION['adminCart'][$k]['allPrice'] = $v['details']['price']*$v['amount'];
                $totalProductsPrice += $_SESSION['adminCart'][$k]['allPrice'];
                $totalProductsCount += $v['amount'];
            }

            $_SESSION['adminCartPrice']['totalProductsPrice'] = $totalProductsPrice;
            $_SESSION['adminCartPrice']['totalProductsCount'] = $totalProductsCount;
            $_SESSION['adminCartPrice']['orderPrice'] = $totalProductsPrice;
        }
    }      
    
    public function setRightBlock($typesArray)
    {
//        $isUserSale = $this->Setting->getSetting('reg_user_sale');
        $isUserSale = false;
        foreach( $typesArray as $v => $k )
        {
            switch( $k )
            {
                case 'mostViewedProduct':
                        $mostViewedProduct = $this->Product->getMostViewed();
                        if($isUserSale)
                        {
                            for( $i=0; $i<count($mostViewedProduct); $i++ )
                            {
                                $mostViewedProduct[$i]['price'] = $mostViewedProduct[$i]['price']*(1-$isUserSale['value']/100);
                            }            
                        }      
                        $this->_view->mostViewedProduct = $mostViewedProduct;
                    break;
                case 'mostBuyedProduct':
                        $mostBuyedProduct = $this->Product->getMostBuyed();
                        if($isUserSale)
                        {
                            for( $i=0; $i<count($mostBuyedProduct); $i++ )
                            {
                                $mostBuyedProduct[$i]['price'] = $mostBuyedProduct[$i]['price']*(1-$isUserSale['value']/100);
                            }            
                        }  
                        $this->_view->mostBuyedProduct = $mostBuyedProduct;
                    break;
                case 'productLike':
                        $productLike = $this->Product->listing(0, 1, array('inLike' => 1, 'approved'=>1));
                        if($isUserSale)
                        {
                            for( $i=0; $i<count($productLike['data']); $i++ )
                            {
                                $productLike['data'][$i]['price'] = $productLike['data'][$i]['price']*(1-$isUserSale['value']/100);
                            }            
                        }   
                        $this->_view->productLike = $productLike;
                    break;  
                case 'viewedAndBuyed':
                        $mostBuyedAndViewed = $this->Product->getMostBuyedAndViewed();
                        if($isUserSale)
                        {
                            for( $i=0; $i<count($mostBuyedAndViewed); $i++ )
                            {
                                $mostBuyedAndViewed[$i]['price'] = $mostBuyedAndViewed[$i]['price']*(1-$isUserSale['value']/100);
                            }            
                        }  
                        $this->_view->mostBuyedAndViewed = $mostBuyedAndViewed;
                    break;                    
            }
        }
    }     
}