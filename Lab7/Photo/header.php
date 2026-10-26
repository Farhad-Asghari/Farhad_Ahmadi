<?php
$pageTitle = $pageTitle ?? 'IT Student Portal';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?> | IT Student Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="navbar">
    <a class="brand" href="index.php">IT Student Portal</a>
    <nav>
        <a href="index.php">Home</a>
        <?php if (!empty($_SESSION['user_id'])): ?>
            <span class="welcome">Welcome, <?= e((string)($_SESSION['user_name'] ?? 'Student')) ?></span>
            <a class="nav-button" href="logout.php">Logout</a>
        <?php else: ?>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </nav>
</header>
<main class="container">
