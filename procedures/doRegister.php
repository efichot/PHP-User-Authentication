<?php
	require_once __DIR__ . '/../inc/bootstrap.php';

	$password = request()->get('password');
	$confirmPassword = request()->get('confirm_password');
	$email = request()->get('email');

	if ($password != $confirmPassword) {
		header('Location: ../register.php');
	}
	if (!empty(retUser($email))) {
		header('Location: ../register.php');
	}

	$hashPass = password_hash($password, PASSWORD_DEFAULT);

	$user = createUser($email, $hashPass);
	header('Location: ../index.php');
 ?>
