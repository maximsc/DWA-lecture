<?php

// Debugging: Show the contents of the $_POST superglobal
echo "<br>";
print_r($_POST);
echo "<br>";

$winner = false;

foreach($_POST as $contestant_number => $name) {

	$coin_flip = rand(0,1);

	if($coin_flip == 0 || !$winner) {
		$contestants[$name] = 'Winner';
	}
	else {
		$contestants[$name] = 'Loser';
	}

}
