<?php 
include 'lib/bones.php';


get('/signup', function($app) {
	// echo curl_version();
	var_dump(function_exists("curl_init"));
	$app->render('signup');
	
});

post('/signup', function($app) {
	// echo 'mario';
	$user = new stdClass();
	$user->type = 'user';
	$user->name = $app->form('name');
	$user->email = $app->form('email');

	echo json_encode($user);

	$curl = curl_init();

	$options = array(
		CURLOPT_URL => 'localhost:5984/verge',
		CURLOPT_POSTFIELDS => json_encode($user),
		CURLOPT_HTTPHEADER => array("Content-Type: application/json"),
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "utf-8",
		CURLOPT_HEADER => false,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_AUTOREFERER => true
	);

	curl_setopt_array($curl, $options);

	curl_exec($curl);
	curl_close($curl);

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




