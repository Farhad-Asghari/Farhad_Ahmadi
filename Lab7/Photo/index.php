<?php
require_once 'db.php';
$pageTitle = 'Home';
require 'header.php';
?>
<section class="panel hero">
    <h1>Welcome to IT Student Portal</h1>
    <p>Create an account, sign in, and manage your book list.</p>
    <div class="actions">
        <?php if (!empty($_SESSION['user_id'])): ?>
            <a class="button" href="dashboard.php">Open Dashboard</a>
        <?php else: ?>
            <a class="button" href="register.php">Create an Account</a>
            <a class="button secondary" href="login.php">Login</a>
        <?php endif; ?>
    </div>
</section>
<?php require 'footer.php'; ?>
