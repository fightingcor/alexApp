<?
class Application_Plugin_AccessCheck extends Zend_Controller_Plugin_Abstract {
	
	private $_acl=null;
	private $_auth=null;
	
	public function __construct(Zend_Acl $acl, Zend_Auth $auth){
		$this->_acl=$acl;
		$this->_auth=$auth;
	}
	
	//whitch controller called?
	public function preDispatch(Zend_Controller_Request_Abstract $request){
		$resource=$request->getControllerName();
		$action=$request->getActionName();
		
		$identity=$this->_auth->getStorage()->read();
		if($this->_auth->getStorage()->isEmpty()){
			$role="guest";
		}else{
			$role=$identity->role;
		}
		//echo "t~~~".$role.":".$resource.":".$action."<BR>";
		//echo $this->_acl->isAllowed($role, $resource, $action);
		if(1!=$this->_acl->isAllowed($role, $resource, $action)){
			$request->setControllerName('authentication')
					->setActionName('login');
		}
		
	}
	
}
