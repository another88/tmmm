<?php

class TestimonialController extends BaseController
{    
    public function indexAction()
    {
        $this->_view->testimonials = $this->Testimonial->listing(0, 1, array('approved' => 1, 'order' => 'ORDER by testimonialId DESC'));
        
        $this->_view->styles = array('testimonial.css');
        $this->_view->scripts = array('testimonial.js');
        $this->_view->current = 'testimonial';
        $testimonialAdded = false;
        if( isset($_SESSION['testimonialAdded']) )
        {
            unset($_SESSION['testimonialAdded']);
            $testimonialAdded = true;
        }
        $this->_view->testimonialAdded = $testimonialAdded;
        
        $meta = $this->Meta->getMeta('testimonial');
        $this->_view->pageTitle = $meta['metaTitle'];
        parent:: setRightBlock(array('mostViewedProduct', 'mostBuyedProduct'));
        parent:: setBread(array('Отзывы'));
        parent:: setMetaTags($meta);
        $this->_smarty->display('testimonial/index.tpl');
    }
    
    public function addtestimonialAction()
    {
        if($this->_request->isPost()) 
        {
            $data = $this->_request->getPost();
            $add = true;
            $comment = $data['comment'];
            
            if( !empty($comment) && trim($comment) != '' )
            {
                $pattern = '|(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?|isU';
                preg_match($pattern, $comment); 
                if( preg_match($pattern, $comment) )
                {
                    if( preg_match('|234532198|isU', $comment) || preg_match('|ace-hookah.com|isU', $comment) )
                    {
                        $add = true;
                    }     
                    else
                    {
                        $add = false;
                    }
                }
            }
            else
            {
                $add = false;
            }
            
            if( $add )
            {
                $data['dateAdded'] = date('Y-m-d H:i:s');
                $data['userId'] = 0;
                if(isset($_SESSION['user']))
                {
                    $data['userId'] = $_SESSION['user']['userId'];
                }       

                $data['imageOriginal'] = '';
                $data['imageMedium'] = '';
                $data['imageSmall'] = '';       
                
                $tId = $this->Testimonial->add($data);
                
                if (!isset($_FILES) && isset($HTTP_POST_FILES))
                    $_FILES = $HTTP_POST_FILES;

                if (!empty($_FILES['imageOriginal']['name'])) 
                {
                    $files = array(
                        "imageOriginal"=>array(
                            "title"=> "imageOriginal",
                            "imagesDir"=>"images/testimonial/". $tId . "/",
                            "sizes"=> array(
                                "imageOriginal"=>"1024x1024",
                                "imageMedium"=>"205x205",
                                "imageSmall"=> "60x60"
                            ),
                            "cropSmart"=>false,
                            "cropSkip"=>false            
                          )
                    );            
                    $imgData = $this->_uploadPhotoNew($files);
                    $this->Testimonial->save($imgData, $tId);
                }      
                
                $letterSett = $this->Setting->getSetting('letter_count');
                $letterCount = (int)$letterSett['value'];
            
                if( $letterCount < 40 )
                {
                    $message = 'От: '.$data['firstName'].', '.$data['email'].', '.$data['dateAdded'].' '.$data['comment'];
                    parent::sendMail('artem_zolkin@mail.ru', 'Ace Hookah<manager@ace-hookah.com>', 'Новый комментарий', $message, $headers='', FALSE);       

                    $newLetterCount = $letterCount + 1;
                    $this->Setting->setSetting('letter_count', $newLetterCount);
                }                 

                $_SESSION['testimonialAdded'] = 1;
                parent::redirect('testimonial');                
            }
        }
    }      
    
}