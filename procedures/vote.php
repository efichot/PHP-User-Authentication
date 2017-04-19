<?php
	require_once __DIR__ . '/../inc/bootstrap.php';

	$bookId = request()->get('bookId');
	$vote = request()->get('vote');
	$book = getAllBook();
	$score = $book['score'];
	if (!isset($score)) {
		$score = 0;
	}
	if ($vote === 'up') {
		$score += 1;
	} else if ($vote === 'down') {
		$score -= 1;
	}
	vote($bookId, $score);
	header('Location: /../books.php');
 ?>
