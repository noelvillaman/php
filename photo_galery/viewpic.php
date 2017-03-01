<?php
	require_once('includes/initialize.php');
	require_once('includes/header.html');

	if(!$session->is_logged_in()) { redirect_to('login.php');}
	$photos = Photograph::find_all();
?>

<?php
	include_layout_template('amin_header.php');
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Show Pictures</title>
</head>

<body>
	<h2>Photographs</h2>
    <table class="border">
          <tbody>
            <tr>
              <th>Image</th>
              <th>Filename</th>
              <th>Caption</th>
              <th>Size</th>
              <th>Type</th>
            </tr>
            <?php foreach($photos as $photo): ?>
            <tr>
              <td><img src="../<?php echo $photos->image_path(); ?>" width="100" /></td>
              <td><?php echo $photo->filename; ?></td>
              <td><?php echo $photo->caption; ?></td>
              <td><?php echo $photo->size_as_text() ?></td>
              <td><?php echo $photo->type; ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
	</table>
    <br />
    <a href="public/admin/photo_upload.php">Upload a new photograph</a>

</body>
</html>