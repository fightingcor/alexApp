<?php

class AlbumController extends Zend_Controller_Action
{

    public function init()
    {
       $contextSwitch=$this->_helper->getHelper('contextSwitch');
	   $contextSwitch->addActionContext('index','json')
	   				 ->initContext();
    }

   public function indexAction()
    {
    	//paginator should be instance of db_select
    	
    	/*
		 * create instance
		 * $booklist->listBook()
		 * $paginator=new Zend_Paginator(new Zend_Paginator_Adapter($bookList));
		 * $paginator->setItemCountPerPage(3)
		 * 			 ->setCurrentPageNumber($this->_getParam('page', 1))
		 * $this->view->paginator=$paginator;
		 * foreach($his->paginator as $book)
		 * $book['title']
		 */    	
    	$albumsMapper = new Application_Model_AlbumMapper();
    	Zend_View_Helper_PaginationControl::setDefaultViewPartial('album/index.phtml');

		$page=$this->_getParam('page', 1);
		
		$albumList=$albumsMapper->getList($page);
		
		$album_array=array();		
		foreach($albumList as $album) {
			$id=$album['id'];
			$title=$album['title'];
			$artist=$album['artist'];	
							
			$album_array[]=array('id'=>$id, 'title'=>$title, 'artist'=>$artist);	
		}
		
		$this->view->albums=$album_array;
		
		if(!$this->_request->isXmlHttpRequest()){
        	$this->view->paginator = $albumList;
		}else{
			$this->view->currentPage=$albumList->getCurrentPageNumber();
		}
    }

	public function addAction()
    {
        $form = new Application_Form_Album();
        $form->submit->setLabel('Add');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_AlbumMapper();
                $albums->addAlbum($artist, $title);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }
            
    }

    public function editAction()
    {
        $form = new Application_Form_Album();
        $form->submit->setLabel('Save');
        $this->view->form = $form;
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $artist = $form->getValue('artist');
                $title = $form->getValue('title');
                $albums = new Application_Model_AlbumMapper();
                $albums->updateAlbum($id, $artist, $title);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        } else {
            $id = $this->_getParam('id', 0);
            if ($id > 0) {
                $albums = new Application_Model_AlbumMapper();
                $form->populate($albums->getAlbum($id));
            }
        }
        
    }

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Yes') {
                $id = $this->getRequest()->getPost('id');
                $albums = new Application_Model_AlbumMapper();
                $albums->deleteAlbum($id);
            }
            $this->_helper->redirector('index');
        } else {
            $id = $this->_getParam('id', 0);
            $albums = new Application_Model_AlbumMapper();
            $this->view->album = $albums->getAlbum($id);
        }
    }


}



