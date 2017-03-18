<?php

class IndexController extends BaseController
{    
    public function init()
    {
        parent::init();
        $this->_view->current = 'home';
    }
    
    public function indexAction()
    {
//        $this->_view->slider = $this->Slider->listing(0, 1, array('approved'=>1));
        $this->_view->mainProduct = $this->Product->listing(0, 1, array('approved'=>1, 'inMain'=>1));
//        if(count($this->_view->mainProduct['data'])>0)
//            $this->_view->pageTitle = 'лучшие предложения';
//        else
//            $this->_view->pageTitle = 'Главная страница';
//        $this->_view->scripts = array('index.js');
        
        $content = $this->Content->urlDetail('text_in_main');
        $this->_view->content = $content;
        $this->_view->styles = array('index.css');   
        parent:: setMetaTags($content);
        $this->_smarty->display('index/index.tpl');
    }
    
    public function loginAction()
    {
        if(!empty($_SESSION['user']))
            parent::redirect('admin');
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            if (empty($data['login']) || empty($data['password'])) {
                $_SESSION['error'] = 'Fill in the fields!';
                parent::redirect('index/login');
            }
//            $data['password'] = md5(md5($data['password']));
            $user = $this->User->getUser($data['login'], $data['password']);
            if (empty($user)) {
                $_SESSION['error'] = 'You enter incorrect data!';
                parent::redirect('index/login');
            }
            $_SESSION['user'] = $user;
            $_SESSION['user']['permission'] = parent::getUserPermission($_SESSION['user']['userId']);
            $_SESSION['user']['createTime'] = time();
            parent::redirect('admin');
        }
        $this->_smarty->display('loginform.tpl');
    }

    public function callorderAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            if (empty($data['email']) || empty($data['name']) || empty($data['phone'])) 
            {
                exit('Введите все данные!');
            }
            $data['dateAdded'] = date('Y-m-d H:i:s');
            $this->CallOrder->add($data);
            
            $cnf = Zend_Registry::get('cnf');
            $adminMail = $cnf->adminMail;
            
            $message = 'От: '.$data['name'].', '.$data['email'].', '.$data['phone'].', '.$data['dateAdded'];
            parent::sendMail($adminMail, $data['email'], 'Заказ звонка', $message, $headers='', FALSE);
            
            exit('ok');
        }
    }       

    public function logoutAction()
    {
        if (isset($_SESSION['user']))
            unset($_SESSION['user']);
        parent::redirect('#');
    }    
}