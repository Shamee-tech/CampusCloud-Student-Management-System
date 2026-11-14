<?php
require_once __DIR__ . '/../includes/bootstrap.php'; require_admin();
if($_SERVER['REQUEST_METHOD']!=='POST'){header('Location: students.php');exit;} verify_csrf();
$id=(int)($_POST['id']??0);
$data=[
 trim((string)($_POST['student_code']??'')),trim((string)($_POST['full_name']??'')),
 trim((string)($_POST['email']??'')),trim((string)($_POST['phone']??'')),
 ($_POST['date_of_birth']??'')?:null,($_POST['gender']??'')?:null,
 trim((string)($_POST['department']??'')),trim((string)($_POST['course']??'')),
 ($_POST['study_year']??'')!==''?(int)$_POST['study_year']:null,trim((string)($_POST['address']??''))
];
if(!$data[0]||!$data[1]||!filter_var($data[2],FILTER_VALIDATE_EMAIL)||!$data[6]||!$data[7]){flash('Please complete required fields with a valid email.','danger');header('Location: student_form.php'.($id?'?id='.$id:''));exit;}
try {
 if($id){$data[]=$id;$st=db()->prepare('UPDATE students SET student_code=?,full_name=?,email=?,phone=?,date_of_birth=?,gender=?,department=?,course=?,study_year=?,address=? WHERE id=?');$st->execute($data);flash('Student details updated.');}
 else{$st=db()->prepare('INSERT INTO students(student_code,full_name,email,phone,date_of_birth,gender,department,course,study_year,address) VALUES(?,?,?,?,?,?,?,?,?,?)');$st->execute($data);flash('Student added successfully.');}
 header('Location: students.php');exit;
}catch(PDOException $ex){flash('Could not save student. Student ID may already exist.','danger');header('Location: student_form.php'.($id?'?id='.$id:''));exit;}
