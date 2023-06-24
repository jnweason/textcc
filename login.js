$(document).ready(function() {
    // 監聽登入表單的提交事件
    $('#loginForm').submit(function(e) {
      e.preventDefault(); // 阻止表單提交的預設行為
  
      var username = $('#username').val();
      var password = $('#password').val();
  
      // 發送 AJAX 請求，向伺服器端取得會員資料
      $.ajax({
        url: 'get_members.php',
        type: 'GET',
        dataType: 'json',
        success: function(members) {
          var authenticatedMember = members.find(function(member) {
            return member.name === username && member.phone === password;
          });
  
          if (authenticatedMember) {
            // 儲存登入時間
            localStorage.setItem('loginTime', new Date().getTime());
  
            // 導向專屬頁面
            window.location.href = 'member.html?name=' + authenticatedMember.name;
          } else {
            // 顯示錯誤彈跳視窗
            alert('登入失敗，請檢查帳號和密碼');
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
          // 處理錯誤訊息
          alert('無法讀取會員資料');
        }
      });
    });
  });