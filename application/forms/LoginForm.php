<?php
class Application_Form_LoginForm extends Zend_Form {
	public function __construct($option=null)
	{
		parent::__construct($option);
		//create a form
		$this->setName('login');
		
		$username = new Zend_Form_Element_Text('username');
		$username->setLabel('Use Name:')		
				 ->setRequired();
				 
		$password = new Zend_Form_Element_Password('password');
		$password->setLabel('Password: ')
				->setRequired();
				
		$login=new Zend_Form_Element_Submit('login');
		$login->setLabel('Login');
		
		$this->addElement($username)->addElement($password)->addElement($login);
		$this->setMethod('post');
		$this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/authentication/login');
		
	}	
} 