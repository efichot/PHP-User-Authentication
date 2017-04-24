<?php
	require_once __DIR__ . '/../inc/bootstrap.php';

	$email = request()->get('email');
	$user = retUser($email);
	if (!empty($user)) {
		header('Location: ../login.php');
	}
	if (!password_verify(request()->get('password'), $user['password'])) {
		header('Location: ../login.php');
	}

	$expTime = time()+ 3600;

	//create the JWT with encode static function. three paramaters 1/ an array the claims 2/ secret_key 3/algo
	$jwt = \Firebase\JWT\JWT::encode([
		'iss' => request()->getBaseUrl(), // issuer
		'sub' => "{$user['id']}", //subject
		'exp' => $expTime, //expiration time
		'iat' =>time(), //issued time
		'nbf' => time(), //Not before
		'is_admin' => $user['role_id'] == 1 //return ture or false
	], getenv(SECRET_KEY), 'HS256');
 ?>
