<?
class Application_Model_AccessAcl extends Zend_Acl{
	
	public function __construct(){
		
		$this->add(new Zend_Acl_Resource('index'));		
		$this->add(new Zend_Acl_Resource('album'));
		$this->add(new Zend_Acl_Resource('authentication'));
		$this->add(new Zend_Acl_Resource('book'));
		$this->add(new Zend_Acl_Resource('books'));
		$this->add(new Zend_Acl_Resource('guestbook'));
		$this->add(new Zend_Acl_Resource('countdown'));
		
		
		$this->addRole(new Zend_Acl_Role('guest'));
		$this->addRole(new Zend_Acl_Role('user'),'guest');
		$this->addRole(new Zend_Acl_Role('admin'),'user');
		
		$this->allow('guest', 'index');
		$this->allow('guest', 'countdown');
		$this->allow('guest', 'album', 'index');
		$this->allow('guest', 'guestbook');
		$this->deny('guest', 'guestbook', 'sign');		
		$this->allow('guest', 'authentication');
		$this->allow('guest', 'book');
		$this->allow('guest', 'books');
		
		
		$this->allow('user', 'guestbook');
		
				
								
		$this->allow('admin', 'album');						
	}
}
