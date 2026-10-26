<?php
// Database connection and common security helpers.
declare(strict_types=1);
session_start();

$host = '127.0.0.1';
$dbname = 'it_student_portal';
$dbuser = 'root';
$dbpass = ''; // Change this if your MySQL password is not empty.

try {
    $pdo = new PDO(
        "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
        $dbuser,
        $dbpass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    exit('Database connection failed. Check db.php settings and import database.sql.');
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="' .
        e((string)($_SESSION['csrf_token'] ?? '')) . '">';
}

function verify_csrf(): void {
    $sent = $_POST['csrf_token'] ?? '';
    $saved = $_SESSION['csrf_token'] ?? '';
    if (!is_string($sent) || !is_string($saved) || !hash_equals($saved, $sent)) {
        http_response_code(419);
        exit('Invalid request token. Please go back and try again.');
    }
}

function require_login(): void {
    if (empty($_SESSION['user_id'])) {
        header('Location: login.php?next=dashboard');
        exit;
    }
}
