<?php

class GuestbookController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $guestbook=new Application_Model_GuestbookMapper();
		$this->view->entries=$guestbook->fetchAll();
    }

    public function signAction()
    {
        // action body
        $request=$this->getRequest();
        $form=new Application_Form_Guestbook();
		
		if($request->isPost()){
			if($form->isValid($request->getPost())){
				$data=new Application_Model_GuestbookDTO($form->getValues());
				$mapper=new Application_Model_GuestbookMapper();
				$mapper->save($data);
				
				return $this->_helper->redirector('index');
			}
		}
		$this->view->form=$form;
    }


}





