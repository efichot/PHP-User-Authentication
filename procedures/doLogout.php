<?php
	require_once __DIR__ . '/../inc/bootstrap.php';

	setcookie('access_token', 'Expired', time() - 3600, '/');
	header('Location: ../login.php');

	
 ?>
