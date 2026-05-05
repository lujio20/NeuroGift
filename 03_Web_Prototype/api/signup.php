<?php
header("Content-Type: application/json; charset=utf-8");
session_start();
if($_SERVER["REQUEST_METHOD"]!=="POST"){ http_response_code(405); echo json_encode(["ok"=>false,"error"=>"Method not allowed"]); exit; }
require __DIR__."/db.php";
$n = trim((string)($_POST["full_name"]??""));
$e = strtolower(trim((string)($_POST["email"]??"")));
$p = (string)($_POST["password"]??"");
if($n===""||$e===""||$p===""){ http_response_code(400); echo json_encode(["ok"=>false,"error"=>"Missing fields"]); exit; }
if(!filter_var($e,FILTER_VALIDATE_EMAIL)){ http_response_code(400); echo json_encode(["ok"=>false,"error"=>"Invalid email"]); exit; }
if(strlen($p)<6){ http_response_code(400); echo json_encode(["ok"=>false,"error"=>"Password too short"]); exit; }
try{ $s = $pdo->prepare("SELECT id FROM users WHERE email=? LIMIT 1"); $s->execute([$e]); if($s->fetch()){ http_response_code(409); echo json_encode(["ok"=>false,"error"=>"Email exists"]); exit; } $h = password_hash($p,PASSWORD_DEFAULT); $s=$pdo->prepare("INSERT INTO users(full_name,email,password_hash,has_analysis,last_result)VALUES(?,?,?,0,NULL)"); $s->execute([$n,$e,$h]); $id=(int)$pdo->lastInsertId(); $_SESSION['uid']=$id; echo json_encode(["ok"=>true,"isNewUser"=>true,"user"=>["id"=>$id,"fullName"=>$n,"email"=>$e,"hasAnalysis"=>0]]); exit; }catch(Exception $ex){ http_response_code(500); echo json_encode(["ok"=>false,"error"=>"Server error"]); exit; }
