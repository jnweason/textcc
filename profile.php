<?php
session_start();

// 檢查是否已登入
if (!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit;
}

// 檢查是否超過 24 小時，需要重新登入
if (isset($_SESSION["login_time"])) {
  $login_time = $_SESSION["login_time"];
  $logout_time = strtotime("+24 hours", $login_time);

  if (time() > $logout_time) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
  }
}

// 取得當前登入的會員帳號
$username = $_SESSION["username"];

// 這裡可根據會員資料的不同進行個別處理，例如顯示專屬資訊等等

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <title><?php echo $username; ?>的專屬頁面</title>
</head>

<body>
  <div class="container">
    <h1><?php echo $username; ?>的專屬頁面</h1>
    <p>歡迎進入您的個人頁面！</p>
  </div>
</body>

</html>
