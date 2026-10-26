<?php
require_once 'db.php';

$pageTitle = 'Login';
$errors = [];
$email = '';
$registered = isset($_GET['registered']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $remember = isset($_POST['remember']);

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email address.';
    }
    if ($password === '') $errors[] = 'The password field is required.';

    if (!$errors) {
        $stmt = $pdo->prepare('SELECT id, name, email, password FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($password, $user['password'])) {
            $errors[] = 'The email or password is incorrect.';
        } else {
            session_regenerate_id(true);
            $_SESSION['user_id'] = (int)$user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            // This demo keeps the session active until the browser/session ends.
            // A production "Remember me" feature should use secure persistent tokens.
            header('Location: dashboard.php');
            exit;
        }
    }
}

require 'header.php';
?>
<section class="panel form-panel">
    <h1>Login to Your Account</h1>
    <p class="subtitle">Sign in to access your dashboard.</p>

    <?php if ($registered): ?>
        <div class="alert success">Registration successful! Please login now.</div>
    <?php endif; ?>
    <?php if (isset($_GET['logged_out'])): ?>
        <div class="alert success">You have logged out successfully.</div>
    <?php endif; ?>
    <?php if ($errors): ?>
        <div class="alert error"><ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div>
    <?php endif; ?>

    <form method="post" action="login.php">
        <?= csrf_field() ?>
        <label for="email">Email Address <span>*</span></label>
        <input id="email" name="email" type="email" value="<?= e($email) ?>" required autocomplete="email">

        <label for="password">Password <span>*</span></label>
        <input id="password" name="password" type="password" required autocomplete="current-password">

        <label class="checkbox-label">
            <input type="checkbox" name="remember" value="1"> Remember me
        </label>
        <button type="submit" class="button full">Login</button>
    </form>
    <p class="below">Don't have an account? <a href="register.php">Register</a></p>
</section>
<?php require 'footer.php'; ?>
