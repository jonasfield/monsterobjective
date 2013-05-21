<?php

class Default_Model_Acl extends Zend_Acl
{

    public function __construct()
    {
        $this->addRole(new Zend_Acl_Role('guests'));
        $this->addRole(new Zend_Acl_Role('users'), 'guests'); // inherits from guests
        $this->addRole(new Zend_Acl_Role('admins'), 'users'); // inherits from users

        $this->add(new Zend_Acl_Resource('default'))
                ->add(new Zend_Acl_Resource('default:index'), 'default')
                ->add(new Zend_Acl_Resource('default:error'), 'default')
                ->add(new Zend_Acl_Resource('default:login'), 'default');
        
        $this->add(new Zend_Acl_Resource('usuarios'))
                ->add(new Zend_Acl_Resource('usuarios:index'), 'usuarios');
        
        $this->add(new Zend_Acl_Resource('retos'))
                ->add(new Zend_Acl_Resource('retos:index'), 'retos');

        $this->add(new Zend_Acl_Resource('admin'))
                ->add(new Zend_Acl_Resource('admin:index'), 'admin');
        
        



        $this->allow('guests', 'default');
        $this->allow('guests', 'default:index', 'index');
        $this->allow('guests', 'default:login', array('index', 'autenticar'));
        $this->allow('guests', 'default:error', 'error');
        $this->allow('guests', 'usuarios');
        $this->allow('guests', 'admin');
        $this->allow('guests', 'retos:index', 'index');


        $this->allow('users', 'default:login', 'logout');
        $this->allow('users', 'usuarios:index');
        //$this->allow('users', 'retos');


        $this->allow('admins', 'admin');

    }

}
