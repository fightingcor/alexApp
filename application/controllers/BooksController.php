<?php

class BooksController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
       
       $contextSwitch=$this->_helper->getHelper('contextSwitch');
	   $contextSwitch->addActionContext('index','json')
	   				 ->initContext();
    } 

    public function indexAction()
    {
       $booksTBL = new Application_Model_BooksMapper();
        
		
		$this->view->books=$booksTBL->fetchAll();
		
    }

  
}



