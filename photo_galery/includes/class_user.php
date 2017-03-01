<?php
	require_once("initialize.php");
	require_once(LIB_PATH.DS."class_database.php");
	require_once(LIB_PATH.DS."class_dbObject.php");
	
	class user extends DatabaseObject {
		
		protected static $table_name = "users";
		protected static $db_fields = array('id', 'username', 'password', 'first_name', 'last_name');
		public $id;
		public $username;
		public $password;
		public $first_name;
		public $last_name;
		
		public function full_name(){
			if(isset($this->first_name) && isset($this->last_name)){
				return $this->first_name . " " . $this->last_name;
				
				} else {
				  return "";
			}
					
		}
		public static function find_all(){
			return self::find_by_sql("SELECT * FROM " . self::$table_name);
		}
		public static function authenticate($username="", $password=""){
			global $database;
			$username = $database->escape_value($username);
			$password = $database->escape_value($password);
			
			$sql = "SELECT * from users ";
			$sql .= "WHERE username = '{$username}' ";
			$sql .= "AND password = '{$password}' ";
			$sql .= "LIMIT 1";
			$result_array = self::find_by_sql($sql);
			
			return !empty($result_array) ? array_shift($result_array) : false;
		}
		
		public static function find_by_id($id=0){
			global $database;
			$result_array = self::find_by_sql("SELECT * FROM ". self::$table_name ." WHERE id={$id} limit 1");
			return !empty($result_array) ? array_shift($result_array) : false;
		}
		
		public static function find_by_sql($sql=""){
			global $database;
			$result_set = $database->query($sql);
			$object_array = array();
			while($row = $database->fetch_array($result_set)){
				$object_array[] = self::instantiate($row);
			}
			return $object_array;
		
		}
		
		private static function instantiate($record){
			$object = new self;
			foreach($record as $attribute=>$value){
				if($object->has_attibute($attribute)){
					$object->$attribute = $value;
				}
			}
			return $object;
		}
		
		private function has_attibute($attribute){
			$object_vars = get_object_vars($this);
			return array_key_exists($attribute, $object_vars);
		}
		
		protected function attributes(){
			$attributes = array();
			foreach(self::$db_fields as $field){
				if(property_exists($this, $field)){
					$attributes[$field] = $this->field;
				}
			}
			return $attributes;
		}
		
		protected function sanitized_attributes(){
			global $database;
			$clean_attibutes = array();
			foreach($this->attributes() as $key => $value){
				$clean_attibutes[$key] = $database->escape_value($value);
			}
			return $clean_attibutes;
		}
		public function save(){
			// A new record won't have an id yet.
			return isset($this->id) ? $this->update() : $this->create();
		}
		
		public function create(){
			global $database;
			
			//get all the attributes
			$attributes = $this->sanitized_attributes();
			
			$sql = "INSERT INTO ".self::$table_name. "(";
			$sql .= join(", ", array_keys($attributes));
			$sql .= ") VALUES ('";
			$sql .= join("', '", array_values($attributes));
			$sql .= "')";
			
			if($database->query($sql)){
				$this->id = $database->insert_id();
				return true;
			} else {
				return false;
			}
		}
		
		public function update(){
			global $database;
			$attributes = $this->sanitized_attributes();
			$attribute_pairs = array();
			foreach($attributes as $key => $value){
				$attribute_pairs[] = "{$key}='{$value}'";
			}
			
			$sql = "UPDATE ".self::$table_name. " SET ";
			$sql .= join(", ", $attribute_pairs);
			$sql .= " WHERE id=".$database->escape_value($this->id);
			
			$database->query($sql);
			return ($database->affected_rows() ==1) ? true : false;
		}
		
		public function delete(){
			global $database;
			
			$sql = "DELETE FROM ".self::$table_name;
			$sql .= " WHERE id=". $database->escape_value($this->id);
			$sql .= " LIMIT 1";
			
			$database->query($sql);
			return ($database->affected_rows() == 1) ? true : false;
		}
		
		private static function count_all(){
			global $database;
			$sql ="SELECT COUNT(*) FROM ".self::$table_name;
			$result_set = $database->query($sql);
			$row = $database->fetch_array($result_set);
			return array_shift($row);
		}
		
		
	}
	
?>