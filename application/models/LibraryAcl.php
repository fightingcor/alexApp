<?php

class Model_LibraryAcl extends Zend_Acl {
	public function __construct()
	{
		$this->add(new Zend_Acl_Resource('book'));
		$this->add(new Zend_Acl_Resource('edit'),'book');
		$this->add(new Zend_Acl_Resource('add'),'book');
		
		
		$this->add(new Zend_Acl_Resource('books'));
		$this->add(new Zend_Acl_Resource('list'),'books');
		
		$this->add(new Zend_Acl_Role('user'));
		$this->add(new Zend_Acl_Role('admin'),'user');
		
		$this->allow('user','books','list');
		$this->allow('admin','book','edit');
		$this->allow('admin','book','add');
	}
}
