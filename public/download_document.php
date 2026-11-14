<?php
require_once __DIR__ . '/../includes/bootstrap.php';require_admin();global $config;
$id=(int)($_GET['id']??0);$st=db()->prepare('SELECT original_name,s3_key,mime_type FROM documents WHERE id=?');$st->execute([$id]);$doc=$st->fetch();if(!$doc){http_response_code(404);exit('Document not found');}
try{$result=s3_client()->getObject(['Bucket'=>$config['aws']['bucket'],'Key'=>$doc['s3_key']]);header('Content-Type: '.$doc['mime_type']);header('Content-Disposition: attachment; filename="'.str_replace('"','',basename($doc['original_name'])).'"');echo $result['Body'];}
catch(Throwable $e){error_log('S3 download error: '.$e->getMessage());http_response_code(500);exit('Unable to retrieve file from S3.');}
