<?php
require_once("includes/class_database.php");
require_once("includes/class_user.php");

if(isset($database)){ echo "true"; } else { echo "false";}
echo "<br />";
	echo $database->escape_value("It's working?</br >");
	
	//$sql = "insert into users (id, username, password, first_name, last_name)";
	//$sql .= "values (3, 'ezev', 'pedo123', 'Noel', 'Villaman')";
	//$result = $database->query($sql);
	
	$sql = "SELECT * FROM users WHERE id=3";
	$result = $database->query($sql);
	$found_user = $database->fetch_array($result);
	echo $found_user['username'];
	
	
	
	$record = User::find_by_id(1);
	//$user = new user();
	/*$user->id = $record['id'];
	$user->username = $record['username'];
	$user->password = $record['password'];
	$user->first_name = $record['first_name'];
	$user->last_name = $record['last_name'];*/
	
	//echo $record['username'];
	///echo $user->username;
	
	
	
	/*$user_set = User::find_all();
	while($user = $database->fetch_array($user_set)){
		echo "User: " . $user['username'] . "<br />";
		echo "Name: " . $user['first_name'] . " " . $user['last_name']. "<br />";
	}*/
	
	echo "<hr />";
	
	echo __FILE__ . "<hr />";
	echo __LINE__ . "<hr />";
	echo __DIR__ . "<hr />";
	
	
?>