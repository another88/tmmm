<?php

require 'Zend/Loader.php';
require_once '../settings/metadata.php';
require_once 'accessClass.php';
/**
 * Kernel
 * 
 * Main system class
 * 
 * @param array $config - Configuration
 */
class Kernel 
{

    /**
     * Run application
     *
     */
    public static function run($config) 
    {
        try {
			// autoload
	        Zend_Loader::registerAutoload();

            //  Session start (do not use session_start() && Do not enable PHP's»session.auto_start setting)
            Zend_Session::start();
	        
	        // Config object
	        $cnf = new Zend_Config($config);   
	        
	        // Save config in registry
	        Zend_Registry::set('cnf', $cnf);

                // Load routes configuration
                $routesCnf = new Zend_Config_Ini($cnf->path->settings.'routes.ini', 'production');
                $router = new Zend_Controller_Router_Rewrite();
                $router->addConfig($routesCnf, 'routes');
			
	        // Create front controller object 
	        $front = Zend_Controller_Front::getInstance();

	        // front controller config 
	        $front->setBaseUrl($cnf->url->base)
				  ->setRouter($router);

                $front->addModuleDirectory($cnf->path->modules);
                
                // disable standard zend_view template engine
                $front->setParam('noViewRenderer', true);
                $front->registerPlugin(new Zend_Controller_Plugin_ErrorHandler());

	        // run contoller
	        $front->dispatch();
		}	
        catch (Exception $e) {
            // Перехват исключений 
            Error::catchException($e);
        }
			
    }
    	
}
