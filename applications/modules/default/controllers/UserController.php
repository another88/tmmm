<?php
class UserController extends BaseController 
{
    public function loginAction() 
    {
        if ($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
            $validateEmail = $this->Validate->email($data['email']);
            if(!$validateEmail)
            {
                exit('Введите корректный e-mail.');
            }
            if (empty($data['password'])) 
            {
                exit ('Введите пароль.');    
            }
            
            $user = $this->User->getUser($data['email'], $data['password']);
            if (empty($user)) {
                exit('Ошибка ввода логина или пароля.');
            }
            parent::makeLogin($user);
            
            if( isset($data['rememberme']) )
            {
                $_SESSION['rememberme'] = 1;
            }
            
            exit('ok');
        }
    }

    public function logoutAction() 
    {
        if (isset($_SESSION['user']))
        {
            unset($_SESSION['user']);
        }
        if (isset($_SESSION['cart']))
        {
            unset($_SESSION['cart']);     
        }
        if (isset($_SESSION['userViewCount']))
        {
            unset($_SESSION['userViewCount']);
        }        
        if (isset($_SESSION['cartPrice']))
        {
            unset($_SESSION['cartPrice']);
        }                   
        setcookie ("ahuser", '', time()-60*60*24);
        parent::redirect('#');
    }
    
    public function registryAction()
    {
        if ($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            
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
            if($this->User->checkEmail($data['email']))
            {
                exit('Введенный e-mail уже зарегистрирован.');
            }
            
            if (empty($data['password'])) 
            {
                exit ('Введите Ваш Пароль.');    
            }    
            if (empty($data['passwordTwo'])) 
            {
                exit ('Введите Подвтерждение Вашего Пароль.');    
            }                
            if( $data['password'] != $data['passwordTwo'] )
            {
                exit ('Разные Пароли.'); 
            }
            $data['dateAdded'] = date('Y-m-d H:i:s');
            unset($data['passwordTwo']);
            $pas = $data['password'];
            $data['password'] = MD5(MD5($data['password']));
            $userId = $this->User->add($data);
            $user = $this->User->details($userId);
            unset($_SESSION['user']);
            $_SESSION['user'] = $user;
            $_SESSION['user']['permission'] = parent::getUserPermission($_SESSION['user']['userId']);
            $_SESSION['user']['createTime'] = time();
            
            $letterSett = $this->Setting->getSetting('letter_count');
            $letterCount = (int)$letterSett['value'];
            
            if( $letterCount < 39 )
            {
                $message = 'От: '.$data['firstName'].', '.$data['email'].', '.$data['dateAdded'];
                parent::sendMail('artem_zolkin@mail.ru', 'Ace Hookah<manager@ace-hookah.com>', 'Новая регистрация', $message, $headers='', FALSE);            

                $message2 = 'Здравствуйте, '.$data['firstName'].' '.$data['lastName'].'. Спасибо за регистрацию на сайте ace-hookah.com. '
                        . 'Ваши данные для входа на сайт: Логин: '.$data['email'].' Пароль: '.$pas.'.';
                parent::sendMail($data['email'], 'Ace Hookah<manager@ace-hookah.com>', 'Регистрация на сайте ace-hookah.com', $message2, $headers='', FALSE);     

                $newLetterCount = $letterCount + 2;
                $this->Setting->setSetting('letter_count', $newLetterCount);
            }  

            exit('ok');
        }        
        
        $meta = $this->Meta->getMeta('registry');
        $this->_view->pageTitle = $meta['metaTitle'];
        $this->_view->styles = array('registry.css');        
        $this->_view->scripts = array('registry.js');
        parent:: setMetaTags($meta);
        parent:: setBread(array('Регистрация'));
        parent:: setRightBlock(array('mostViewedProduct'));
        $this->_smarty->display('user/registry.tpl');
    }    
}