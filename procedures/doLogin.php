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
	
 ?>
