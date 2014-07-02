<!DOCTYPE html>
<html>
<head>

    <title>PHPiggy Bank</title>


    <?php require 'logic.php' ?>
   

</head>

<body>
	 
    <img alt='PHPiggy Bank Logo' src='http://making-the-internet.s3.amazonaws.com/php-phpiggy-bank.png'>
    
    The time is <?php echo date('g:ia'); ?>
	
    <p>
     You have $<?php echo $total; ?> in your piggy bank.
    </p>
    
    <img src='http://making-the-internet.s3.amazonaws.com/<?echo $image?>'>

</body>
</html>