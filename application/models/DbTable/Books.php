<?php
class Model_DbTable_Books extends Zend_Db_Table_Abstract{
	protected $_name='books';
	
	public function callTest(){
		echo "test";		
	}
}