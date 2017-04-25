<?php
require_once __DIR__ . '/inc/bootstrap.php';
requireAuth();
require_once __DIR__ . '/inc/head.php';
require_once __DIR__ . '/inc/nav.php';

$book = getBook(request()->get('bookId'));
$bookTitle = $book['name'];
$bookDescription = $book['description'];
$buttonText = 'Update Book';
deleteBook($book['id']);
?>
<div class="container">
    <div class="well">
        <h2>Edit book</h2>
		<form class="form-horizontal" method='POST' action='procedures/addBook.php'>
			<input type='hidden' name='bookId' value='<?php echo $book['id']; ?>' />
        	<?php include __DIR__ . '/inc/bookForm.php'; ?>
		</form>
    </div>
</div>
<?php
require_once __DIR__ . '/inc/footer.php';
