<?php 

# Codeception tests are built around the idea of narrative "Scenarios" - little stories about your application.
# A Scenario always starts with Actor class initialization
$I = new AcceptanceTester($scenario);

# After that, you can use write out your scenario...

# Start by definining your goal of this test...
$I->wantTo('Ensure that the home page works');

# Specify where you are...
$I->amOnPage('/'); 

# Make some assertions...
$I->see('Log In');
$I->see('Sign Up');
