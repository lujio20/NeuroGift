<?php
require __DIR__ . '/config.php';
header('Content-Type: application/json; charset=utf-8');
if (!isset($_SESSION['uid'])) { http_response_code(401); echo json_encode(["ok"=>false,"error"=>"Not authenticated"]); exit; }
$uid = (int)$_SESSION['uid'];
$s = $pdo->prepare("SELECT id,full_name,email,has_analysis,last_result FROM users WHERE id=? LIMIT 1");
$s->execute([$uid]);
$u = $s->fetch(PDO::FETCH_ASSOC);
if (!$u) { http_response_code(404); echo json_encode(["ok"=>false,"error"=>"User not found"]); exit; }
$last = null;
if (!empty($u['last_result'])) { $d = json_decode($u['last_result'],true); if (json_last_error()===JSON_ERROR_NONE) $last=$d; }
echo json_encode(["ok"=>true,"user"=>["id"=>(int)$u["id"],"fullName"=>$u["full_name"],"email"=>$u["email"],"hasAnalysis"=>(int)$u["has_analysis"],"lastResult"=>$last]],JSON_UNESCAPED_UNICODE);
