<?php
require_once __DIR__ . '/../includes/bootstrap.php'; require_admin();
$pageTitle='Dashboard'; $active='dashboard';
$total=(int)db()->query('SELECT COUNT(*) FROM students')->fetchColumn();
$docs=(int)db()->query('SELECT COUNT(*) FROM documents')->fetchColumn();
$courses=(int)db()->query('SELECT COUNT(DISTINCT course) FROM students')->fetchColumn();
$recent=db()->query('SELECT id,student_code,full_name,department,course,created_at FROM students ORDER BY created_at DESC LIMIT 6')->fetchAll();
require __DIR__.'/../includes/header.php';
?>
<div class="page-intro"><div><h2>Good day, Administrator 👋</h2><p class="muted mb-0 mt-1">Here's what's happening with your student records.</p></div><a href="student_form.php" class="btn btn-primary px-3">＋ Add student</a></div>
<div class="row g-3 mb-4"><div class="col-md-4"><div class="stat-card"><span class="stat-icon">♙</span><div class="stat-label">TOTAL STUDENTS</div><div class="stat-value"><?=number_format($total)?></div><div class="stat-foot">Student records in database</div></div></div><div class="col-md-4"><div class="stat-card"><span class="stat-icon">▤</span><div class="stat-label">UPLOADED DOCUMENTS</div><div class="stat-value"><?=number_format($docs)?></div><div class="stat-foot">Files managed in Amazon S3</div></div></div><div class="col-md-4"><div class="stat-card"><span class="stat-icon">⌘</span><div class="stat-label">COURSES</div><div class="stat-value"><?=number_format($courses)?></div><div class="stat-foot">Distinct courses represented</div></div></div></div>
<div class="panel"><div class="d-flex justify-content-between align-items-center mb-3"><div class="panel-title mb-0">Recently added students</div><a href="students.php" class="small text-decoration-none">View all →</a></div><div class="table-responsive"><table class="table"><thead><tr><th>STUDENT</th><th>STUDENT ID</th><th>DEPARTMENT</th><th>COURSE</th><th>ADDED</th></tr></thead><tbody><?php if(!$recent): ?><tr><td colspan="5"><div class="empty-state">No student records yet. Add your first student to get started.</div></td></tr><?php else: foreach($recent as $r): ?><tr><td class="fw-semibold"><?=e($r['full_name'])?></td><td><?=e($r['student_code'])?></td><td><?=e($r['department'])?></td><td><span class="badge-soft"><?=e($r['course'])?></span></td><td><?=e(date('d M Y',strtotime($r['created_at'])))?></td></tr><?php endforeach; endif; ?></tbody></table></div></div>
<?php require __DIR__.'/../includes/footer.php'; ?>
