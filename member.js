$(document).ready(function() {
    // 檢查登入狀態
    var loginTime = localStorage.getItem('loginTime');
    var currentTime = new Date().getTime();
    var elapsedTime = currentTime - loginTime;
    var twentyFourHours = 24 * 60 * 60 * 1000; // 24 小時的毫秒數
  
    if (elapsedTime > twentyFourHours) {
      // 登入驗證逾時，轉回登入頁面
      window.location.href = 'login.html';
    } else {
      // 顯示會員資訊
      var name = getParameterByName('name');
      $('#memberInfo').html('<h3>歡迎，' + name + '！</h3>');
    }
  
    // 取得 URL 參數的值
    function getParameterByName(name) {
      name = name.replace(/[\[\]]/g, '\\$&');
      var url = window.location.href;
      var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)');
      var results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }
  });