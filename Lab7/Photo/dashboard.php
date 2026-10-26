<?php
require_once 'db.php';
require_login();

$pageTitle = 'Dashboard';
$errors = [];
$title = '';
$author = '';
$pages = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $action = (string)($_POST['action'] ?? '');

    if ($action === 'add_book') {
        $title = trim((string)($_POST['title'] ?? ''));
        $author = trim((string)($_POST['author'] ?? ''));
        $pages = trim((string)($_POST['pages'] ?? ''));

        if ($title === '') $errors[] = 'The title field is required.';
        if ($author === '') $errors[] = 'The author field is required.';
        if ($pages === '') {
            $errors[] = 'The pages field is required.';
        } elseif (filter_var($pages, FILTER_VALIDATE_INT) === false || (int)$pages < 1) {
            $errors[] = 'Pages must be a positive whole number.';
        }

        if (!$errors) {
            $stmt = $pdo->prepare('INSERT INTO books (user_id, title, author, pages) VALUES (?, ?, ?, ?)');
            $stmt->execute([(int)$_SESSION['user_id'], $title, $author, (int)$pages]);
            header('Location: dashboard.php?added=1');
            exit;
        }
    } elseif ($action === 'delete_book') {
        $bookId = filter_var($_POST['book_id'] ?? null, FILTER_VALIDATE_INT);
        if ($bookId) {
            // Restrict deletion to the logged-in user's own books.
            $stmt = $pdo->prepare('DELETE FROM books WHERE id = ? AND user_id = ?');
            $stmt->execute([$bookId, (int)$_SESSION['user_id']]);
        }
        header('Location: dashboard.php?deleted=1');
        exit;
    }
}

$stmt = $pdo->prepare('SELECT id, title, author, pages FROM books WHERE user_id = ? ORDER BY id ASC');
$stmt->execute([(int)$_SESSION['user_id']]);
$books = $stmt->fetchAll();

require 'header.php';
?>
<div class="dashboard-grid">
    <section class="panel">
        <h2>Add a New Book</h2>
        <?php if (isset($_GET['added'])): ?>
            <div class="alert success">Book added successfully!</div>
        <?php endif; ?>
        <?php if (isset($_GET['deleted'])): ?>
            <div class="alert success">Book deleted successfully.</div>
        <?php endif; ?>
        <?php if ($errors): ?>
            <div class="alert error"><strong>Please correct the errors:</strong>
                <ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul>
            </div>
        <?php endif; ?>

        <form method="post" action="dashboard.php">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="add_book">
            <label for="title">Title <span>*</span></label>
            <input id="title" name="title" type="text" value="<?= e($title) ?>" required>

            <label for="author">Author <span>*</span></label>
            <input id="author" name="author" type="text" value="<?= e($author) ?>" required>

            <label for="pages">Pages <span>*</span></label>
            <input id="pages" name="pages" type="number" min="1" step="1" value="<?= e($pages) ?>" required>

            <button type="submit" class="button full">Save Book</button>
        </form>
    </section>

    <section class="panel books-panel">
        <h2>My Books</h2>
        <?php if (!$books): ?>
            <p class="muted">You have not added any books yet.</p>
        <?php else: ?>
            <div class="table-wrap">
                <table>
                    <thead><tr><th>No.</th><th>Title</th><th>Author</th><th>Pages</th><th>Action</th></tr></thead>
                    <tbody>
                    <?php foreach ($books as $index => $book): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= e($book['title']) ?></td>
                            <td><?= e($book['author']) ?></td>
                            <td><?= (int)$book['pages'] ?></td>
                            <td>
                                <form method="post" action="dashboard.php" class="inline-form" onsubmit="return confirm('Delete this book?');">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="action" value="delete_book">
                                    <input type="hidden" name="book_id" value="<?= (int)$book['id'] ?>">
                                    <button type="submit" class="button danger small">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
</div>
<?php require 'footer.php'; ?>
