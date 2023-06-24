<?php
// 設定正確的檔案路徑
$filePath = 'data/members.json';

// 檢查檔案是否存在
if (file_exists($filePath)) {
  // 讀取檔案內容
  $json = file_get_contents($filePath);

  // 將 JSON 資料回傳
  header('Content-Type: application/json');
  echo $json;
} else {
  // 若檔案不存在，回傳錯誤訊息
  header('HTTP/1.1 404 Not Found');
  echo 'File not found.';
}
?>