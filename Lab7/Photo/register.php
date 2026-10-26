<?php
require_once 'db.php';

$pageTitle = 'Register';
$errors = [];
$name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim((string)($_POST['name'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $confirm = (string)($_POST['confirm_password'] ?? '');

    if ($name === '') $errors[] = 'The full name field is required.';
    if ($email === '') {
        $errors[] = 'The email field is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }
    if ($password === '') {
        $errors[] = 'The password field is required.';
    } elseif (strlen($password) < 8) {
        $errors[] = 'The password must contain at least 8 characters.';
    }
    if ($confirm === '') {
        $errors[] = 'The confirm password field is required.';
    } elseif ($password !== $confirm) {
        $errors[] = 'The passwords do not match.';
    }

    if (!$errors) {
        $check = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $check->execute([$email]);
        if ($check->fetch()) {
            $errors[] = 'An account with this email already exists.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $insert->execute([$name, $email, $hash]);
            header('Location: login.php?registered=1');
            exit;
        }
    }
}

require 'header.php';
?>
<section class="panel form-panel">
    <h1>Create an Account</h1>
    <p class="subtitle">Register to access the student portal.</p>

    <?php if ($errors): ?>
        <div class="alert error"><strong>Please fix the following:</strong>
            <ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>

    <form method="post" action="register.php" novalidate>
        <?= csrf_field() ?>
        <label for="name">Full Name <span>*</span></label>
        <input id="name" name="name" type="text" value="<?= e($name) ?>" required autocomplete="name">

        <label for="email">Email Address <span>*</span></label>
        <input id="email" name="email" type="email" value="<?= e($email) ?>" required autocomplete="email">

        <label for="password">Password <span>*</span></label>
        <input id="password" name="password" type="password" required minlength="8" autocomplete="new-password">

        <label for="confirm_password">Confirm Password <span>*</span></label>
        <input id="confirm_password" name="confirm_password" type="password" required minlength="8" autocomplete="new-password">

        <button type="submit" class="button full">Register</button>
    </form>
    <p class="below">Already registered? <a href="login.php">Login</a></p>
</section>
<?php require 'footer.php'; ?>
