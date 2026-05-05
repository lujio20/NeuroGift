<?php
require __DIR__ . '/config.php';
header('Content-Type: application/json; charset=utf-8');
if (!isset($_SESSION['uid'])) { http_response_code(401); echo json_encode(["ok"=>false,"error"=>"Not authenticated"]); exit; }
$data = json_input();
$result = $data['result'] ?? null;
if (!$result || !is_array($result)) { http_response_code(400); echo json_encode(["ok"=>false,"error"=>"Invalid result"]); exit; }
$uid = (int)$_SESSION['uid'];
$j = json_encode($result,JSON_UNESCAPED_UNICODE);
try {
  $pdo->beginTransaction();
  $s1 = $pdo->prepare("UPDATE users SET has_analysis=1,last_result=? WHERE id=?");
  $s1->execute([$j,"uid]);
  if($s1->rowCount()===0){ $pdo->rollBack(); http_response_code(404); echo json_encode(["ok"=>false,"error"=>"User not found"]); exit; }
  $s2 = $pdo->prepare("INSERT INTO analyses(user_id,result) VALUES(?,?)");
  $s2->execute([$uid,$j]);
  $id = (int)$pdo->lastInsertId();
  $pdo->commit();
  echo json_encode(["ok"=>true,"analysisId"=>$id]); exit;
} catch(Throwable $e){ if($pdo->inTransaction()) $pdo->rollBack(); http_response_code(500); echo json_encode(["ok"=>false,"error"=>"Server error"]); exit; }
