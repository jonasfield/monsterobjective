<?php

class Default_Form_login extends Zend_Form
{
    public function init()
    {
        // initialize form
        $this->setAction($this->getView()->baseUrl() . '/default/login/login')
            ->setMethod('post');

        // create text input for title
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email:')
              ->setRequired()
              ->setFilters(array(
                      new Zend_Filter_StringToLower(),
                      new Zend_Filter_StringTrim()
               ))
               ->setValidators(array(
                   new Zend_Validate_EmailAddress()
               ))
                
               ->setErrorMessages(array(
                  Zend_Validate_NotEmpty::IS_EMPTY => 'Este campo es requerido',
                  Zend_Validate_EmailAddress::INVALID_FORMAT => 'Debe introducir el email'
               ));
        
        // create text input for title
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password:')
              ->setRequired()
              ->setValidators(array(
                  new Zend_Validate_Alnum(),
                  new Zend_Validate_StringLength(array('min' => 4, 'max' => 8))
              ))
              ->setErrorMessages(array(
                 Zend_Validate_NotEmpty::IS_EMPTY => 'Este campo es requerido',
                 Zend_Validate_StringLength::INVALID => 'La longitud debe estar entre 4 y 8'
              ));

        // create submit button
        $submit = new Zend_Form_Element_Submit('submit', array(
        'label' => 'Submit',
        'class' => 'submit'
        ));

        // attach elements to form
        $this->addElements(array($email, $password, $submit));
    }
}

?>
