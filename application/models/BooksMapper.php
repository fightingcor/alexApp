<?php

class Application_Model_BooksMapper
{
	protected $_dbTable;
	
	public function setDbTable($dbTable)
	{
		if(is_string($dbTable)){
			$dbTable=new $dbTable();
		}
		if(!$dbTable instanceof Zend_Db_Table_Abstract){
			throw new Exception("Invalid table data gateway provided");			
		}
		$this->_dbTable=$dbTable;
		return $this;
	}
	
	public function getDbTable(){
		if($this->_dbTable===null){
			$this->setDbTable('Application_Model_DbTable_Books');
		}
		return $this->_dbTable;
	}
	
	public function fetchAll(){
		$row = $this->getDbTable()->fetchAll();
		return $row;
	}	
}