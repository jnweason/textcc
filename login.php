<?php
session_start();

// 檢查使用者是否已經登入，若已登入則直接導向專屬網頁
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  header("Location: $username.html");
  exit();
}

// 檢查使用者是否提交了登入表單
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 讀取表單提交的帳號密碼
  $username = $_POST['username'];
  $password = $_POST['password'];

  // 讀取 members.json 檔案
  $membersData = file_get_contents('members.json');
  $members = json_decode($membersData, true);

  // 搜尋會員資料，檢查帳號密碼是否匹配
  foreach ($members as $member) {
    if ($member['username'] === $username && $member['password'] === $password) {
      // 設定使用者的 session，表示已登入
      $_SESSION['username'] = $username;

      // 導向對應的專屬網頁
      header("Location: $username.html");
      exit();
    }
  }

  // 若帳號密碼不匹配，顯示登入失敗的訊息
  $loginError = "登入失敗，請檢查帳號密碼。";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>會員登入</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h1>會員登入</h1>

    <?php if (isset($loginError)) { ?>
      <div class="alert alert-danger mt-3"><?php echo $loginError; ?></div>
    <?php } ?>

    <form method="POST" class="mt-3">
      <div class="mb-3">
        <label for="username" class="form-label">帳號：</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">密碼：</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <button type="submit" class="btn btn-primary">登入</button>
    </form>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
