<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{		
	protected function _initAutoload(){
				
		/*
		$modelLoader=new Zend_Application_Module_Autoloader(array(
							'namespace'=>'',
							'basePath'=>APPLICATION_PATH));
							*/
		
		$resourceLoader = new Zend_Loader_Autoloader_Resource(array(
		    'basePath'  => APPLICATION_PATH,
		    'namespace' => ''
		));
		$resourceLoader->addResourceType('model', 'models', 'Model_DbTable');
		$resourceLoader->addResourceType('form', 'forms', 'Form');
		$resourceLoader->addResourceType('model', 'models', 'Model');
		$resourceLoader->addResourceType('plugin', 'plugins', 'Plugin');
		
		//register plugin
		$acl=new Model_LibraryAcl;
		$auth=Zend_Auth::getInstance();
		
		$fc = Zend_Controller_Front::getInstance();
		$fc->registerPlugin(new Plugin_AccessCheck($acl, $auth));
		
		return $resourceLoader;
	}

}

