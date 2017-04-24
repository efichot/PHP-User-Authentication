<?php
	require_once __DIR__ . '/../vendor/autoload.php';
	require_once __DIR__ . '/functions.php';
	require_once __DIR__ . '/connection.php';

	//Where find the .env file
	$doenv = new Dotenv\Dotenv(__DIR__);
	$doenv->load();
?>
