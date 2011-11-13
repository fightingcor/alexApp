<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
	
	protected function _initDoctype()
    {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('XHTML1_STRICT');	
		$view->headMeta()->appendHttpEquiv('Content-type', 'text/html;charset=utf-8')
						 ->appendName('description', 'Using zend');
		
		$view->headTitle()->setSeparator('-');
		$view->headTitle('My zend framework tutorial');
		
		$view->setHelperPath(APPLICATION_PATH.'/helper','');
		//Zend_Dojo::enableView($view);
		ZendX_JQuery::enableView($view);	
    }
	
	protected function _isnitZendAcl()
    {
    	//register plugin
		$acl=new Application_Model_AccessAcl;
		$auth=Zend_Auth::getInstance();
		
		$fc = Zend_Controller_Front::getInstance();
		$fc->registerPlugin(new Application_Plugin_AccessCheck($acl, $auth));
	}
			
	//protected function _initAutoload(){
				
		/*
		$modelLoader=new Zend_Application_Module_Autoloader(array(
							'namespace'=>'',
							'basePath'=>APPLICATION_PATH));
							*/
		
		// $resourceLoader = new Zend_Loader_Autoloader_Resource(array(
		    // 'namespace' => '',
		    // 'basePath'  => APPLICATION_PATH		    
		// ));
		// $resourceLoader->addResourceType('model', 'models', 'Model_DbTable');
		// $resourceLoader->addResourceType('form', 'forms', 'Form');
		// $resourceLoader->addResourceType('model', 'models', 'Model');
		// $resourceLoader->addResourceType('plugin', 'plugins', 'Plugin');
// 		
		//register plugin
		// $acl=new Model_LibraryAcl;
		// $auth=Zend_Auth::getInstance();
// 		
		// $fc = Zend_Controller_Front::getInstance();
		// $fc->registerPlugin(new Plugin_AccessCheck($acl, $auth));
		
		//return $resourceLoader;
	//}

}

