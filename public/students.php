<?php
require_once __DIR__ . '/../includes/bootstrap.php'; require_admin();
$pageTitle='Students'; $active='students';
$q=trim((string)($_GET['q']??'')); $sql='SELECT * FROM students'; $params=[];
if($q!==''){ $sql.=' WHERE full_name LIKE ? OR student_code LIKE ? OR course LIKE ?'; $like='%'.$q.'%'; $params=[$like,$like,$like]; }
$sql.=' ORDER BY created_at DESC'; $stmt=db()->prepare($sql); $stmt->execute($params); $rows=$stmt->fetchAll();
require __DIR__.'/../includes/header.php';
?>
<div class="page-intro"><div><h2>Student directory</h2><p class="muted mb-0 mt-1">Manage student profiles and academic information.</p></div><a class="btn btn-primary" href="student_form.php">＋ Add new student</a></div>
<div class="panel"><form class="d-flex gap-2 mb-3" method="get"><input class="form-control" name="q" value="<?=e($q)?>" placeholder="Search by name, ID, or course…"><button class="btn btn-outline-secondary">Search</button></form><div class="table-responsive"><table class="table"><thead><tr><th>STUDENT</th><th>ID</th><th>EMAIL</th><th>DEPARTMENT</th><th>COURSE</th><th>YEAR</th><th>ACTIONS</th></tr></thead><tbody><?php if(!$rows): ?><tr><td colspan="7"><div class="empty-state">No matching students found.</div></td></tr><?php else: foreach($rows as $s): ?><tr><td class="fw-semibold"><?=e($s['full_name'])?></td><td><?=e($s['student_code'])?></td><td><?=e($s['email'])?></td><td><?=e($s['department'])?></td><td><span class="badge-soft"><?=e($s['course'])?></span></td><td><?=e((string)$s['study_year'])?></td><td><a class="btn btn-sm btn-outline-primary" href="student_form.php?id=<?=(int)$s['id']?>">Edit</a> <form class="d-inline" method="post" action="delete_student.php" onsubmit="return confirm('Delete this student and their document records?')"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><input type="hidden" name="id" value="<?=(int)$s['id']?>"><button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr><?php endforeach; endif; ?></tbody></table></div><div class="small text-secondary"><?=count($rows)?> record(s)</div></div>
<?php require __DIR__.'/../includes/footer.php'; ?>
