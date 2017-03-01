<?php
	
	$updload_errors = array(
		UPLOAD_ERR_OK			=> "No errors found",
		UPLOAD_ERR_INI_SIZE 	=> "Larger than upload maximum fielsize.",
		UPLOAD_ERR_FORM_SIZE	=> "Partial upload.",
		UPLOAD_ERR_NO_FILE		=> "No file.",
		UPLOAD_ERR_NO_TMP_DIR	=> "No temporary directory.",
		UPLOAD_ERR_CANT_WRITE	=> "Can't write to disk.",
		UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
	);
	
	if(isset($_POST['submit'])){
		$tmp_file = $_FILES['file_upload']['tmp_name'];
		$target_file = basename($_FILES['file_upload']['name']);
		$upload_dir = "uploads";
		
		if(move_uploaded_file($tmp_file, $upload_dir."/".$target_file)){
			$message = "File uploaded successfully.";
		} else {
			$error = $_FILES['file_upload']['error'];
		global $message;
		$message = $updload_errors[$error];
		}		
		//echo "<pre>";
//		print_r($_FILES['file_upload']);
//		echo "</pre>";
//		echo "<hr />";
	} 

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Upload Files</title>
</head>

<body>
	<?php if(!empty($message)) { echo "<p class=\"error\">{$message}</p>"; } ?>
	<form action="uploads.php" enctype="multipart/form-data" method="post">
    	<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
    	<input type="file" name="file_upload" />
        <input type="submit" name="submit" value="Upload" />
    </form>
</body>
</html>