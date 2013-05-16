<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
   

    protected function _initConfig()
    {
        $config = new Zend_Config_Ini('config.ini', 'development');
        Zend_Registry::set('config', $config);
        return $config;
    }
    
    protected function _initBaseUrl()
    {
        $this->bootstrap("frontController");
        $front = $this->getResource("frontController");
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
    }

    protected function __initSession()
    {
        Zend_Session::start();
    }
    
    protected function _initDefaultAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
                    'namespace' => 'Default_',
                    'basePath' => APPLICATION_PATH . '/modules/default',
                    'resourceTypes' => array(
                        'form' => array(
                            'path' => 'forms',
                            'namespace' => 'Form',
                        ),
                        'model' => array(
                            'path' => 'models',
                            'namespace' => 'Model',
                        )
                    )
                ));
        return $autoloader;
    }

    protected function _initEnvironment()
    {
        if ($this->getEnvironment() == "development") {
            error_reporting(E_ALL | E_STRICT);
        }
        $timeZone = (string) Zend_Registry::get('config')->parameters->timezone;
        if (empty($timeZone)) {
            $timeZone = "Europe/Madrid";
        }
        date_default_timezone_set($timeZone);
        return null;
    }


    protected function _initAcl()
    {
        if (Default_Model_Login::isLoggedIn()) {
            Zend_Registry::set('role', Default_Model_Login::getIdentity()->role);
        } else {
            Zend_Registry::set('role', 'guests');
        }

        $acl = new Default_Model_Acl();
        $this->bootstrap('FrontController');
        $fc = $this->getResource('FrontController');
        $fc->registerPlugin(new My_Controller_Plugin_Acl($acl));

        return $acl;
    }
    

    protected function _initView()
    {

        $view = new Zend_View();
        $view->doctype('XHTML1_STRICT');
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=' . Zend_Registry::get('config')->parameters->charset);
        $view->headLink()->appendStylesheet($view->baseUrl('/bootstrap/css/bootstrap.css'));
        $view->headLink()->appendStylesheet($view->baseUrl('/bootstrap/css/estilos.css'));
        $view->headLink()->headLink(array('rel' => 'icon','href' => $view->baseUrl('/imagenes/favicon.ico')),'PREPEND');
        $view->headScript()->appendFile($view->baseUrl('/bootstrap/js/jquery.js'));
        $view->headScript()->appendFile($view->baseUrl('/bootstrap/js/bootstrap.js'));
        $view->headScript()->appendFile($view->baseUrl('/bootstrap/js/funciones.js'));

        $view->baseurl = $view->baseUrl();
        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer');
        $viewRenderer->setView($view);
        
        $view->role = Zend_Registry::get('role');

        return $view;
    }

}

