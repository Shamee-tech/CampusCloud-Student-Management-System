<?php
require_once __DIR__ . '/../includes/bootstrap.php';
if (!empty($_SESSION['admin_id'])) { header('Location: dashboard.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = trim((string)($_POST['email'] ?? ''));
    $password = (string)($_POST['password'] ?? '');
    $stmt = db()->prepare('SELECT id,email,password_hash FROM admins WHERE email=?');
    $stmt->execute([$email]); $admin = $stmt->fetch();
    if ($admin && password_verify($password, $admin['password_hash'])) {
        session_regenerate_id(true); $_SESSION['admin_id']=(int)$admin['id']; $_SESSION['admin_email']=$admin['email'];
        header('Location: dashboard.php'); exit;
    }
    $error = 'Email or password is incorrect.';
}
?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Admin Login · CampusCloud</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"><link href="assets/style.css" rel="stylesheet"></head><body><div class="auth-page"><div class="auth-visual"><span class="brand"><span class="brand-mark">C</span><span>CampusCloud</span></span><h1>Manage your campus with clarity.</h1><p>One organized workspace for student profiles, academic details, and important documents—powered by cloud infrastructure.</p><div class="mt-4 small">SECURE ADMINISTRATOR ACCESS</div></div><div class="auth-form-wrap"><form class="auth-card" method="post"><div class="brand text-dark mb-4"><span class="brand-mark">C</span><span>CampusCloud</span></div><h2>Welcome back</h2><p class="text-secondary mb-4">Sign in to your administrator account.</p><?php if($error): ?><div class="alert alert-danger"><?=e($error)?></div><?php endif; ?><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><label class="form-label">Email address</label><input class="form-control" type="email" name="email" required autocomplete="username" placeholder="admin@campus.edu"><label class="form-label">Password</label><input class="form-control" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password"><button class="btn btn-primary w-100 py-3 mt-2">Sign in to dashboard</button><p class="text-secondary small text-center mt-4 mb-0">Admin-only portal · Protected access</p></form></div></div></body></html>
