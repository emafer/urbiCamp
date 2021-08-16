<?php
   ini_set('error_reporting', E_ALL);
    ini_set('display_errors','On');
 session_start(); require_once 'image_manipulation.php'; ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Image cropping with jQuery and PHP GD</title>
	    <link rel="stylesheet" type="text/css" href="css.css" />
	</head>
	<body>
		<h1>Image uploader and manipulator</h1>
		<?php if (isset($error)) echo "<p id='error'>".$error."</p>"; ?>
		<?php if (!isset($_SESSION['newPath']) || isset($_GET['new'])) { ?>
		<form method='POST' action='index.php' id='imgForm' enctype='multipart/form-data'>
			<label for='img_upload'>Image on your PC to upload</label>
			<input type='file' name='img_upload' id='img_upload'>

			<label for='img_name'>Give this image a name</label>
			<input type='text' name='img_name' id='img_name'>

			<input type='submit' name='upload_form_submitted'>

		</form>
		<?php } else { ?>
			<img id='uploaded_image' src='<?php echo $_SESSION['newPath'].'?'.rand(0, 100000); ?>' />
			<p><a href="index.php?new=true">start over with new image</a></p>
			<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js'></script>
			<script src='js.js'></script>
		<?php } ?>
	</body>
</html>
