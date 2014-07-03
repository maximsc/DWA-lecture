<?php

//phpinfo();

date_default_timezone_set('America/New_York');

$now = date('g:ia');

$hour = date('G');

/*
$hour = 8; // Test: Morning
$hour = 13; // Test: Afternoon
$hour = 18; // Test: Evening
$hour = 23; // Test: Night
*/

$image = '';


/*
If the time was between 5 and 11 
	Do this
	Other

*/


if($hour >= 5 && $hour < 11) {
	$time_of_day = 'morning';
}
elseif($hour >= 11 && $hour < 16) {
	$time_of_day = "afternoon";
}
elseif($hour >= 16 && $hour < 20) {
	$time_of_day = "evening";
}
else {
	$time_of_day = "night";
}