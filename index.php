<?php 
include 'lib/bones.php';

define('ADMIN_USER', 'serveradmin');
define('ADMIN_PASSWORD', 'pass');

get('/signup', function($app) {
	// echo curl_version();
	// var_dump(function_exists("curl_init"));
	$app->render('user/signup');
	
});

post('/signup', function($app) {
	$user = new User();
	$user->full_name = $app->form('full_name');
	$user->email = $app->form('email');
	$user->signup($app->form('username'), $app->form('password'));

	$app->set('success', 'Thanks for Signing Up ' . $user->full_name . '!');
	$app->render('home');
});

get('/login', function($app) {

	$app->render('user/login');
});

post('/login', function($app) {
	$user = new User();
	$user->name = $app->form('username');
	$user->login($app->form('password'));

	$app->set('success', 'You are now logged in!');
	$app->render('home');
});

get('/logout', function($app) {
	User::logout();
	$app->redirect('/');
});

get('/user/:username', function($app) {
	$app->set('user', User::get_by_username($app->request('username')));
	$app->set('is_current_user', ($app->request('username')== User::current_user() ? true: false));
	$app->render('user/profile');
});

get('/', function($app) {
	$app->set('message', 'Welcome Back!');
	$app->render('home');
});

resolve();