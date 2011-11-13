<?php

class Application_Model_GuestbookMapper
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
			$this->setDbTable('Application_Model_DbTable_Guestbook');
		}
		return $this->_dbTable;
	}
	
	public function save(Application_Model_GuestbookDTO $guestbookDTO){
		$data=array(
				'email'=>$guestbookDTO->getEmail(), 
				'comment'=>$guestbookDTO->getComment(), 
				'created'=>date('Y-m-d H:i:s'),
			);
		if($id=$guestbookDTO->getId()===null){
			unset($data['id']);
			$this->getDbTable()->insert($data);
		}else{
			$this->getDbTable()->update($data, array('id = ?'=>$id));
		}
	}
	
	public function find($id, Application_Model_GuestbookDTO $guestbookDTO){
		$result=$this->getDbTable()->find($id);
		if(count($result)==0){
			return;
		}
		$row=$result->current();
		$guestbookDTO   ->setId($row->id)
						->setEmail($row->email)
						->setComment($row->comment)
						->setCreated($row-created);		
	}
	
	public function fetchAll(){
		$resultSet=$this->getDbTable()->fetchAll();
		$entries=array();
		
		foreach ($resultSet as $row) {
			$entry=new Application_Model_GuestbookDTO();
			$entry  ->setId($row->id)
					->setEmail($row->email)
					->setComment($row->comment)
					->setCreated($row->created);
			$entries[]=$entry;
		}
		return $entries;
	}

}

