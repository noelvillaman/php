<?php
	require_once('../includes/initialize.php');
?>

<?php
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	
	//records per page
	$per_page = 3;
	
	//total record coutn ($total_count)
	
	$total_count = Photograph::count_all();
	
	// Find all photos
	// use pagination instead
	//$photos = Photograph::find_all();
	
	$pagination = new Pagination($page, $per_page, $total_count);
	
	// Instead of finding all records, just find the records 
	// for this page
	$sql = "SELECT * FROM photographs ";
	$sql .= "LIMIT {$per_page} ";
	$sql .= "OFFSET {$pagination->offset()}";
	
	$photos = Photograph::find_by_sql($sql);
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>List of Pictures and comments</title>
<link href="../css/main.css" media="all" rel="stylesheet" type="text/css" />
<link href="css/main.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="wrapper">
    <header id="header"><h1>Photo Gallery</h1></header>
    <main><h2>Menu</h2></main>
    <?php 
		echo output_message($message); 
	?>
    <p>
    <?php 
        foreach($photos as $photo): ?>
    	<div class="section1">
        	<a href="photo.php?id=<?php echo $photo->id; ?>">
        		<img src="<?php echo $photo->image_path(); ?>" width="200" />
            </a>
            <p><?php echo $photo->caption; ?></p> 
        </div>
    <?php endforeach; ?>
    </p>
    
    <div id="pagination">
	<?php
	echo "<h1>Pedo</h4> ";
        if($pagination->total_pages() > 1) {
            
            if($pagination->has_previous_page()) { 
            	echo "<a href=\"index.php?page=";
          		echo $pagination->previous_page();
          		echo "\">&laquo; Previous</a> "; 
        	}
    
            for($i=1; $i <= $pagination->total_pages(); $i++) {
                if($i == $page) {
                    echo " <span class=\"selected\">{$i}</span> ";
                } else {
                    echo " <a href=\"index.php?page={$i}\">{$i}</a> "; 
                }
            }
    
            if($pagination->has_next_page()) { 
                echo " <a href=\"index.php?page=";
                echo $pagination->next_page();
                echo "\">Next &raquo;</a> "; 
        }
            
        }

	?>
    <p>Welcome to the admin area of this website. We want you to know that all the material needed by you are here to help and if you have any other need just let us know calling 555-555-5555. Thank you and have a good day.</p>
    <footer>Copyright <?php echo date('Y', time()); ?>, Noel Villaman</footer>
 </div><!--id wrapper ends here -->
</body>
</html>