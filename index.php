<?php 
include 'lib/bones.php';


get('/signup', function($app) {
	// echo curl_version();
	// var_dump(function_exists("curl_init"));
	$app->render('signup');
	
});

post('/signup', function($app) {
	// echo 'mario';
	$user = new User();
	$user->name = $app->form('name');
	$user->email = $app->form('email');

	// echo var_dump($user->to_json());
	$app->couch->post($user->to_json());

	$app->set('message', 'Thanks for Signing Up ' . $app->form('name') . '!');
	$app->render('home');
});

get('/say/:message', function($app) {
	$app->set('message', $app->request('message'));
	$app->render('home');
});

get('/', function($app) {
	$app->set('message', 'Welcome Back!');
	$app->render('home');
});




