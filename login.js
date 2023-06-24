$(document).ready(function() {
    // 監聽登入表單的提交事件
    $('#loginForm').submit(function(e) {
      e.preventDefault(); // 阻止表單提交的預設行為
  
      var username = $('#username').val();
      var password = $('#password').val();
  
      // 讀取會員資料
      $.getJSON('members.json', function(members) {
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
      });
    });
  });