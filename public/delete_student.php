<?php
require_once __DIR__ . '/../includes/bootstrap.php'; require_admin();
if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location: students.php');exit;}verify_csrf();
$id=(int)($_POST['id']??0);$st=db()->prepare('DELETE FROM students WHERE id=?');$st->execute([$id]);flash('Student record deleted.');header('Location: students.php');exit;
