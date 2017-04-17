<?php
	require_once __DIR__ . '/../inc/bootstrap.php';

	//Synphony/http-foundation
	$bookTitle = request()->get('title');
	$bookDescription = request()->get('description');

	try {
		$newBook = addBook($bookTitle, $bookDescription);
		header('Location: /books.php');
	} catch (Exception $e) {
		header('Location: /add.php');
	}
 ?>
