<?php
$pageTitle = $pageTitle ?? 'Dashboard';
$appName = $config['app']['name'] ?? 'CampusCloud';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($pageTitle) ?> · <?= e($appName) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="assets/style.css" rel="stylesheet">
</head>
<body>
<div class="app-shell">
  <aside class="sidebar">
    <a class="brand" href="dashboard.php"><span class="brand-mark">C</span><span>CampusCloud</span></a>
    <div class="nav-caption">WORKSPACE</div>
    <a class="side-link <?= ($active ?? '')==='dashboard'?'active':'' ?>" href="dashboard.php">▦ <span>Dashboard</span></a>
    <a class="side-link <?= ($active ?? '')==='students'?'active':'' ?>" href="students.php">♙ <span>Students</span></a>
    <a class="side-link <?= ($active ?? '')==='add'?'active':'' ?>" href="student_form.php">＋ <span>Add Student</span></a>
    <a class="side-link <?= ($active ?? '')==='documents'?'active':'' ?>" href="documents.php">▤ <span>Documents</span></a>
    <div class="sidebar-bottom">
      <div class="admin-chip"><div class="avatar">A</div><div><strong>Administrator</strong><small>Portal manager</small></div></div>
      <a class="side-link" href="logout.php">↪ <span>Sign out</span></a>
    </div>
  </aside>
  <main class="main-area">
    <header class="topbar"><div><span class="eyebrow">STUDENT ADMINISTRATION</span><h1><?= e($pageTitle) ?></h1></div><div class="topbar-right"><span class="status-dot"></span> System online <div class="avatar">A</div></div></header>
    <div class="content">
      <?php if (!empty($_SESSION['flash'])): $f=$_SESSION['flash']; unset($_SESSION['flash']); ?>
        <div class="alert alert-<?= e($f['type']) ?>"><?= e($f['message']) ?></div>
      <?php endif; ?>
