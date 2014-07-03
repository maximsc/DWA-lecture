<!DOCTYPE html>
<html>
<head>

	<title>Clock</title>
	<meta charset="utf-8">

	<?php require 'logic.php'; ?>

	<link rel='stylesheet' href='styles.css' type='text/css'>
	
</head>
<body class='<?php echo $time_of_day; ?>'>

	<h1>Clock</h1>

	The time is <?php echo $now; ?>

	<img src='http://making-the-internet.s3.amazonaws.com/php-<?php echo $time_of_day; ?>.png'>
	
	<style>

	body {
		background-color:<?php echo $color?>;
	}

	</style>
	
</body>
</html>