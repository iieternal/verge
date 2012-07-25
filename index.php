<?php 
include 'lib/bones.php';

get('/', function($app) {
	echo "Home";
	var_dump($app);
});


get('/signup', function($app) {
	echo "Signup!";
});