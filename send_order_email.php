<?php
// 取得訂單詳細內容
$orderDetails = $_POST['orderDetails'];

// 寄件者和收件者的電子郵件地址
$from = 'andy830506n@gmail.com';
$to = 'jnweason@gmail.com';

// 主題和內容
$subject = '訂單通知';
$message = '您有一個新的訂單，詳細內容如下：<br><br>' . $orderDetails;

// 進行郵件頭的設定
$headers = "From: $from\r\n";
$headers .= "Reply-To: $from\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";

// 發送郵件
$mailSent = mail($to, $subject, $message, $headers);

// 檢查是否成功發送郵件
if ($mailSent) {
    echo 'success';
} else {
    echo 'error';
}
?>
