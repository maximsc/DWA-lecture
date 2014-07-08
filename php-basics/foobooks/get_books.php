<?php 

// Get all books from the database where category is = $_GET['category'];

?>



These are all the books on <?php echo $_GET['category']?>

<?php foreach($books as $book): ?>
	<?php echo $book; ?>
<?php endforeach; ?>