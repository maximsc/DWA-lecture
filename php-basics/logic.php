<?php
  
# Define 4 different variables, which will each represent how much a given coin is worth
$penny_value   = .01;  # Float
$nickle_value  = .05;
$dime_value    = .10;
$quarter_value = .25;

# Define 4 more variables, which will each represent how many of each coin is in the bank
$pennies  = 100;
$nickles  = 25;
$dimes    = 100;
$quarters = 134;

# Add up how much money is in the piggy bank
$total = ($pennies * $penny_value) + ($nickles * $nickle_value) + ($dimes * $dime_value) + ($quarters * $quarter_value);

$goal = 50;

if($total >= $goal) {
	$image = "php-goal-met.png";
	$alt = "Goal Met";
}
elseif($total > ($goal - 10)) {
	# Goal not met
	$image = "php-goal-almost-met.png";
	$alt = "Goal almost met";
}
else {
	$image = "php-goal-not-met.png";
	$alt = "Goal not met";
}

$current_time = date('G');







