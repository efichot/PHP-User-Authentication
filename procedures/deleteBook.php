<?php
	require_once __DIR__ . '/../inc/bootstrap.php';
	requireAuth();
	

	deleteBook(request()->get('bookId'));

	header('Location: ../books.php');
 ?>
