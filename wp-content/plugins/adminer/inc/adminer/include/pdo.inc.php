<?php
// PDO can be used in several database drivers
if (extension_loaded('pdo')) {
	/*abstract*/ class Min_PDO extends PDO {
		var $_result, $server_info, $affected_rows, $error;
		
		function __construct() {
		}
		
		function dsn($dsn, $username, $password, $exception_handler = 'auth_error') {
			set_exception_handler($exception_handler); // try/catch is not compatible with PHP 4
			parent::__construct($dsn, $username, $password);
			restore_exception_handler();
			$this->setAttribute(13, array('Min_PDOStatement')); // 13 - PDO::ATTR_STATEMENT_CLASS
			$this->server_info = $this->getAttribute(4); // 4 - PDO::ATTR_SERVER_VERSION
		}
		
		/*abstract function select_db($database);*/
		
		function query($query, $unbuffered = false) {
			$result = parent::query($query);
			if (!$result) {
				$errorInfo = $this->errorInfo();
				$this->error = $errorInfo[2];
				return false;
			}
			$this->store_result($result);
			return $result;
		}
		
		function multi_query($query) {
			return $this->_result = $this->query($query);
		}
		
		function store_result($result = null) {
			if (!$result) {
				$result = $this->_result;
			}
			if ($result->columnCount()) {
				$result->num_rows = $result->rowCount(); // is not guaranteed to work with all drivers
				return $result;
			}
			$this->affected_rows = $result->rowCount();
			return true;
		}
		
		function next_result() {
			return $this->_result->nextRowset();
		}
		
		function result($query, $field = 0) {
			$result = $this->query($query);
			if (!$result) {
				return false;
			}
			$row = $result->fetch();
			return $row[$field];
		}
	}
	
	class Min_PDOStatement extends PDOStatement {
		var $_offset = 0, $num_rows;
		
		function fetch_assoc() {
			return $this->fetch(2); // PDO::FETCH_ASSOC
		}
		
		function fetch_row() {
			return $this->fetch(3); // PDO::FETCH_NUM
		}
		
		function fetch_field() {
			$row = (object) $this->getColumnMeta($this->_offset++);
			$row->orgtable = $row->table;
			$row->orgname = $row->name;
			$row->charsetnr = (in_array("blob", $row->flags) ? 63 : 0);
			return $row;
		}
	}
}

$drivers = array();
