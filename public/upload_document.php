<?php
require_once __DIR__ . '/../includes/bootstrap.php';require_admin();
if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location: documents.php');exit;}verify_csrf();
global $config;
$studentId=(int)($_POST['student_id']??0);$f=$_FILES['file']??null;
if(!$f||$f['error']!==UPLOAD_ERR_OK){flash('File upload failed. Please choose a file and retry.','danger');header('Location: documents.php');exit;}
if($f['size']>$config['app']['max_upload_bytes']){flash('File exceeds the 10 MB limit.','danger');header('Location: documents.php');exit;}
$allowed=['pdf'=>'application/pdf','png'=>'image/png','jpg'=>'image/jpeg','jpeg'=>'image/jpeg','doc'=>'application/msword','docx'=>'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
$ext=strtolower(pathinfo($f['name'],PATHINFO_EXTENSION));$mime=(new finfo(FILEINFO_MIME_TYPE))->file($f['tmp_name']);
if(!isset($allowed[$ext])||$mime!==$allowed[$ext]){flash('File type not permitted.','danger');header('Location: documents.php');exit;}
$st=db()->prepare('SELECT id FROM students WHERE id=?');$st->execute([$studentId]);if(!$st->fetch()){flash('Student not found.','danger');header('Location: documents.php');exit;}
$key='student-documents/'.$studentId.'/'.bin2hex(random_bytes(16)).'.'.$ext;
try{
 $s3=s3_client();$s3->putObject(['Bucket'=>$config['aws']['bucket'],'Key'=>$key,'SourceFile'=>$f['tmp_name'],'ContentType'=>$mime,'ServerSideEncryption'=>'AES256']);
 $st=db()->prepare('INSERT INTO documents(student_id,original_name,s3_key,mime_type,file_size) VALUES(?,?,?,?,?)');$st->execute([$studentId,basename($f['name']),$key,$mime,(int)$f['size']]);
 flash('Document uploaded to Amazon S3 successfully.');
}catch(Throwable $e){error_log('S3 upload error: '.$e->getMessage());flash('Upload to S3 failed. Check bucket, region, IAM role, and PHP dependencies.','danger');}
header('Location: documents.php');exit;
