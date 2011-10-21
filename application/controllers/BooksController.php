<?php

class BooksController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {    	
        $booksTBL = new Model_DbTable_Books();
        $this->view->books=$booksTBL->fetchAll();
		
		
    }


}



