<?php
require __DIR__ . '/config.php';

$data = json_input();
$email = strtolower(trim((string)($data['email'] ?? '')));
$password = (string)($data['password'] ?? '');

if($email === '' || $password === ''){
  http_response_code(400);
  echo json_encode(["ok"=>false,"error"=>"Missing fields"]);
  exit;
}

$stmt = $pdo->prepare("SELECT id, full_name, email, password_hash, has_analysis FROM users WHERE email=? LIMIT 1");
$stmt->execute([$email]);
$user = $stmt->fetch();

if(!$user || !password_verify($password, $user['password_hash'])){
  http_response_code(401);
  echo json_encode(["ok"=>false,"error"=>"Invalid credentials"]);
  exit;
}

$_SESSION['uid'] = (int)$user['id'];
echo json_encode(["ok"=>true,"user"=>["id"=>(int)$user['id'],"fullName"=>$user['full_name'],"email"=>$user['email'],"hasAnalysis"=>(int)$user['has_analysis']]]);
exit;
