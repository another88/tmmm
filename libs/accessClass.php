<?php
/*
 * Developer Verbovsky Elisey -> elisey.atp@gmail.com
 * Description: Set users permission
 * @params:
 * 		$_request - array - ModuleName, ControllerName, ActionName. (REQUESTED_URL)
 *		$baseUrl - string - Site base url
 *		$lifeTime - int - Life time for session with $access_config array
 */
class AccessClass
{
    public $defaultMessage = 'You haven`t permissions!';
    public $baseUrl = '';
    public $defaultRedirectUrl = '';
    public $access_config_file_path = '../settings/access_config.php';

    function __construct($_request = array(), $baseUrl = '', $lifeTime = 0)
    {
        $this->baseUrl = $baseUrl;
        $this->createSession($lifeTime);
        if(empty($_SESSION['accessParams'])) exit('SESSION ERROR IN ACCESS CLASS');
        
        $access_config = $_SESSION['accessParams']['data'];//Get config
        $module = $_request['module'];
        $controller = $_request['controller'];
        $action = $_request['action'];
        $up = array();
        if(!empty($_SESSION['user']))
            $up = $_SESSION['user']['permission'];
        //--If user has super admin rights
        if(in_array('admin.super', $up))
            return;
        //var_dump($up);exit;
        //--end
        if(!empty($access_config[$module]['defaultAccess']))
            $this->checkDefaults($access_config[$module]['defaultAccess'], $up); //Check module defaults
        if(!empty($access_config[$module][$controller]['defaultAccess']))
            $this->checkDefaults($access_config[$module][$controller]['defaultAccess'], $up); //Check controller default
        if(!empty($access_config[$module][$controller][$action]['defaultAccess']))
            $this->checkDefaults($access_config[$module][$controller][$action]['defaultAccess'], $up); //Check action defaults
        if(!empty($access_config[$module][$controller][$action]))
            $this->checkActionDetails($access_config[$module][$controller][$action], $up);
    }

    /*
     * Create session with $access_config
     * @param $lifeTime - int - Life time of session Default 0
     */
    public function createSession($lifeTime)
    {
        if(!empty($_SESSION['accessParams']) && $lifeTime == 0)
            unset($_SESSION['accessParams']);
        if(!empty($_SESSION['accessParams']) && $_SESSION['accessParams']['time']< time())
            unset($_SESSION['accessParams']);
        if(empty($_SESSION['accessParams'])) {
            require_once $this->access_config_file_path;
            $_SESSION['accessParams'] = array(
                'data' => $GLOBALS['access_config'],
                'time' => (time()+60*$lifeTime)
            );
        }
    }

    /*
     * Check default permission of Module, Controller, Action
     */
    public function checkDefaults($params = array(), $up = array())
    {
        if(empty($up)) 
        {
            $_SESSION['message'] = $this->defaultMessage;
            $this->redirect('index/login');
        }
        $rule = $this->createRule($params);
        $access = $this->checkRule($up, $rule);
        if(!$access)
            $this->ifNotAccess($params);
    }

    /*
     * Check action access
     */
    public function checkActionDetails($params = array(), $up = array())
    {
        if(!empty($params)) {
            if(!empty($params['defaultAccess']))
                unset($params['defaultAccess']);

            if(!empty($params)) {
                if(empty($up)) {
                    $_SESSION['message'] = $this->defaultMessage;
                    $this->redirect($this->defaultRedirectUrl);
                }
                $rule = $this->createRule($params);
                $access = $this->checkRule($up, $rule);
                if(!$access)
                    $this->ifNotAccess($params);
            }
        }
    }
    
   /*
    * Redirect and Message function
    */
    public function ifNotAccess($params)
    {
        $message = $this->defaultMessage;
        $redirectUrl = $this->defaultRedirectUrl; //redirect to base url

        if(!empty($params['message']))
            $message = $params['message'];
        if(!empty($params['url']))
            $redirectUrl = $params['url'];

        $_SESSION['message'] = $message;
        $this->redirect($redirectUrl);
    }
    
    /*
     * Create rule for requested url.
     */
    public function createRule($ruleArray)
    {
        if(!empty($ruleArray['message'])) //unset default values if exist
            unset($ruleArray['message']);
        if(!empty($ruleArray['url'])) //unset default values if exist
            unset($ruleArray['url']);
        return $ruleArray;
    }

    /*
     * Check user permissions and rules for requested url.
     */
    public function checkRule($up = array(), $rule = array())
    {
        $access = FALSE;
        if(count($up) > count($rule) || count($up) == count($rule)) {
            foreach ($up as $v) {
                if(in_array($v, $rule)){
                    $access = TRUE; break;
                }
            }
        } else {
            foreach ($rule as $v) {
                if(in_array($v, $up)){
                    $access = TRUE; break;
                }
            }
        }
        return $access;
    }
	/*
	 * Redirect, it and in the Africa redirect.
	 */
    public function redirect($url)
    {
        header("Location: " . $this->baseUrl . $url);
        exit ();
    }
}
