<?php

class Application_Model_AlbumMapper
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
			$this->setDbTable('Application_Model_DbTable_Albums');
		}
		return $this->_dbTable;
	}
	
	public function getList($page = 1){
		//$db=Zend_Db_Table::getDefaultAdapter();
		
		//$selectBooks=new Zend_Db_Select($db);
		//$selectBooks->from('book');
		//return $selectBooks;
		
		$rows = $this->getDbTable()->fetchAll();
		$paginator=Zend_Paginator::factory($rows);
		$paginator->setCurrentPageNumber($page)->setItemCountPerPage(5);
		return $paginator;
	}
	
	public function getAlbum($id)
    {
        $id = (int)$id;
        $row = $this->getDbTable()->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addAlbum($artist, $title)
    {
        $data = array(
            'artist' => $artist,
            'title' => $title,
        );
        $this->getDbTable()->insert($data);
    }

    public function updateAlbum($id, $artist, $title)
    {
        $data = array(
            'artist' => $artist,
            'title' => $title,
        );
        $this->getDbTable()->update($data, 'id = '. (int)$id);
    }

    public function deleteAlbum($id)
    {
        $this->getDbTable()->delete('id =' . (int)$id);
    }
}