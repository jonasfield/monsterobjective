<?php

class Default_LoginController extends Zend_Controller_Action
{

    private $_userDao;
    private $_config;
    private $_login;

    public function init()
    {
        $this->_login = new Default_Model_Login();
        $this->_config = Zend_Registry::get('config');
        $this->_userDao = new Usuarios_Model_UsuarioDao();
    }

    
    private function _getform()
    {
        return new Default_Form_login();
    }

    public function indexAction()
    {

        $this->view->headTitle('Login - Monster Objective');
        $this->view->formulario = $this->_getform();
        return $this->render();
    }

    public function loginAction()
    {
            if (!$this->getRequest()->isPost()) {
                return $this->_forward('index');
            }

            $postParams = $this->_request->getPost();
            $form = $this->_getform();

            if (!$form->isValid($postParams)) {
                $form->populate($postParams);
                $this->view->formulario = $form;
                return $this->render('index');
            }

            $email = $form->email->getValue();
            $clave = $form->password->getValue();

            try {
                $this->_login->setMessage('El nombre de Usuario y Password no coinciden.', Default_Model_Login::NOT_IDENTITY);
                $this->_login->setMessage('La contraseña ingresada es incorrecta. Inténtelo de nuevo.', Default_Model_Login::INVALID_CREDENTIAL);
                $this->_login->setMessage('Los campos de Usuario y Password no pueden dejarse en blanco.', Default_Model_Login::INVALID_LOGIN);
                $this->_login->login($email, $clave);
                $this->_helper->layout->assign("mensaje", "Login Correcto!!!");
                $this->_helper->layout->assign("colorMensaje", "green");
                return $this->_redirect('retos/index/seguidos');
            } catch (Exception $e) {
                $this->_helper->layout->assign("mensaje", $e->getMessage());
                return $this->_forward('index');
            }
    }

    public function menuAction()
    {
        if (Default_Model_Login::isLoggedIn()) {
            $this->view->loggedIn = true;
            $this->view->user = Default_Model_Login::getIdentity();
        } else {
            $this->forward('index','login','default');
        }
    }

    public function listarAction()
    {
        if (Default_Model_Login::isLoggedIn()) {
            $this->view->loggedIn = true;
            $this->view->user = Default_Model_Login::getIdentity();
            
            $this->view->usuarioDao = $this->_userDao->obtenerTodos();
            $this->view->headTitle('Listar');
        } else {
            $this->forward('index','login','default');
        }
    }

    public function logoutAction()
    {
        $this->_login->logout();
        $this->_redirect("/index/");
    }

}

