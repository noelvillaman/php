<?php
	defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
	
	defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'wamp64'.DS.'www'.DS.'photo_gallery');
	
	defined('LIB_PATH') ? null : define('LIB_PATH', SITE_ROOT.DS.'includes');
	
	require_once(LIB_PATH.DS."config.php");
	require_once(LIB_PATH.DS."functions.php");
	require_once(LIB_PATH.DS."class_session.php");
	require_once(LIB_PATH.DS."class_database.php");
	require_once(LIB_PATH.DS."pagination.php");
	
	// load database-related classes
	require_once(LIB_PATH.DS."class_user.php");
	require_once(LIB_PATH.DS."class_photograph.php");
	require_once(LIB_PATH.DS."class_photograph2.php");	
	require_once(LIB_PATH.DS."class_comments.php");
	require_once(LIB_PATH.DS."delete_comments.php");
?>