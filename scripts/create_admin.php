<?php
// Run from CLI only; never publish this script through the web server.
if(PHP_SAPI!=='cli'){http_response_code(404);exit;}
require_once __DIR__.'/../includes/bootstrap.php';
$email=$argv[1]??'';
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){fwrite(STDERR,"Usage: php scripts/create_admin.php admin@example.com\n");exit(1);}
echo "Enter admin password (minimum 12 characters): ";
$password=trim((string)fgets(STDIN));
if(strlen($password)<12){fwrite(STDERR,"Password must be at least 12 characters.\n");exit(1);}
$hash=password_hash($password,PASSWORD_DEFAULT);
$st=db()->prepare('INSERT INTO admins(email,password_hash) VALUES(?,?)');
try{$st->execute([$email,$hash]);echo "Admin account created.\n";}catch(PDOException $e){fwrite(STDERR,"Could not create admin. Email may already exist.\n");exit(1);}
