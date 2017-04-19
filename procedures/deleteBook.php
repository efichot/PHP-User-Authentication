<?php
	require_once __DIR__ . '/../inc/bootstrap.php';

	deleteBook(request()->get('bookId'));

	header('Location: ../books.php');
 ?>
