<?php

/**
 * @return \Symfony\Component\HttpFoundation\Request
 */
function request() {
    return \Symfony\Component\HttpFoundation\Request::createFromGlobals();
}

function addBook($title, $description) {
	global $db;
	$ownerId = 0;

	try {
		$query = 'INSERT INTO books (name, description, owner_id) VALUES (:name, :description, :ownerId)';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':name', $title);
		$stmt->bindParam(':description', $description);
		$stmt->bindParam(':ownerId', $ownerId);
		return $stmt->execute();
	} catch (Exception $e) {
		throw $e;
	}
}

function getAllBook() {
	global $db;

	try {
		$query = 'SELECT books.*, sum(votes.value) AS score FROM books LEFT JOIN votes ON books.id = votes.book_id GROUP BY books.id ORDER BY score DESC';
		$stmt = $db->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	} catch (Exception $e) {
		throw $e;
	}
}

function getBook($bookId) {
	global $db;

	try {
		$query = 'SELECT * FROM books WHERE id = ?';
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $bookId);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (Exception $e) {
		throw $e;
	}
}

function deleteBook($bookId) {
	global $db;

	try {
		$query = 'DELETE FROM books WHERE id = ?';
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $bookId);
		$stmt->execute();
	}	catch(Exception $e) {
		echo $e->getMessage();
	}
}

function vote($bookId, $score) {
	global $db;
	$userId = 0;
	$score = "$score";

	try {
		$query = 'INSERT INTO votes (book_id, user_id, value) VALUES (:bookId, :userId, :score)';
		$stmt = $db->prepare($query);
		$stmt->bindParam(':bookId', $bookId);
		$stmt->bindParam(':userId', $userId);
		$stmt->bindParam(':score', $score);
		$stmt->execute();
	} catch (Exception $e) {
		die('Something happened with voting, Please try again.');
	}
}

function retUser($email) {
	global $db;

	try {
		$query = 'SELECT * FROM users WHERE email = ?';
		$stmt = $db->prepare($query);
		$stmt->bindParam(1, $email);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	} catch (Exception $e) {
		throw $e;
	}
}

function createUser($email, $password) {
	global $db;

	try {
		$query = 'INSERT INTO users (email, password, role_id) VALUES (:email, :password, 2)'; //roleId=2 -> user // roleId=1 -> admin
		$stmt = $db->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', $password);
		$stmt->execute();
		return retUser($email);
	} catch (Exception $e) {
		throw $e;
	}
}
