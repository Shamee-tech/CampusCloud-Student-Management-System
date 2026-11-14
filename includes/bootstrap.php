<?php
declare(strict_types=1);

session_start();
$config = require __DIR__ . '/../config/config.php';

require_once __DIR__ . '/../vendor/autoload.php';

function db(): PDO {
    global $config;
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;
    $d = $config['db'];
    $dsn = sprintf('mysql:host=%s;port=%d;dbname=%s;charset=%s',
        $d['host'], $d['port'], $d['name'], $d['charset']);
    $pdo = new PDO($dsn, $d['user'], $d['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $pdo;
}

function e(?string $value): string {
    return htmlspecialchars($value ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}
function csrf_token(): string {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return $_SESSION['csrf'];
}
function verify_csrf(): void {
    $posted = $_POST['csrf'] ?? '';
    if (!is_string($posted) || !hash_equals(csrf_token(), $posted)) {
        http_response_code(403); exit('Invalid CSRF token.');
    }
}
function require_admin(): void {
    if (empty($_SESSION['admin_id'])) {
        header('Location: login.php'); exit;
    }
}
function s3_client(): Aws\S3\S3Client {
    global $config;
    return new Aws\S3\S3Client([
        'version' => 'latest',
        'region' => $config['aws']['region'],
        // Credentials supplied securely by environment or EC2 instance role.
    ]);
}
function flash(string $message, string $type = 'success'): void {
    $_SESSION['flash'] = ['message' => $message, 'type' => $type];
}
