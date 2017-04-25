<?php
	require_once __DIR__ . '/../inc/bootstrap.php';

	$email = request()->get('email');
	$user = retUser($email);
	// var_dump($user);
	// die();
	if (empty($user)) {
		$session->getFlashBag()->add('error', 'Username was not found');
		header('Location: ../login.php');
		die();
	}
	if (!password_verify(request()->get('password'), $user['password'])) {
		header('Location: ../login.php');
		die();
	}

	$expTime = time()+ 3600;

	//create the JWT with encode static function. three paramaters 1/ an array the claims 2/ secret_key 3/algo
	$jwt = \Firebase\JWT\JWT::encode([
		'iss' => request()->getBaseUrl(), // issuer
		'sub' => "{$user['id']}", //subject
		'exp' => $expTime, //expiration time
		'iat' =>time(), //issued time
		'nbf' => time(), //Not before
		'is_admin' => $user['role_id'] == 1 //return true or false
	], getenv(SECRET_KEY), 'HS256');

	//create cookie
	//$accessToken = new Symfony\Component\HttpFoundation\Cookie('access_token'/*name of cookie*/, $jwt, $expTime, '/', getenv('COOKIE_DOMAIN'));
	setcookie('access_token', $jwt, time() + 3600, '/');
	// once we have the access token we want to redirect the user back with the cookie.
	//redirect('/'/*, ['cookies' => [$accessToken]]*/);
	$session->getFlashBag()->add('connected', 'You are now connected');
	header('Location: ../index.php');
?>
