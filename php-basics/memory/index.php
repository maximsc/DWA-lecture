<?php
error_reporting(-1);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html>
<head>

	<title>Memory</title>
	<meta charset="utf-8">

	<link rel='stylesheet' href='' type='text/css'>

	<?php require 'logic.php'; ?>
	
	<style>
	
	.box {
		width:100px;
		height:100px;
		background-color:Gold;
		float:left;
		margin:5px;
	}

	</style>

</head>
<body>

	<?php echo $boxes; ?>
		
</body>
</html>