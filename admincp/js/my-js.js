
    function checkDuplicate() {
      var username = document.getElementById('username').value;

      // Gửi yêu cầu AJAX đến máy chủ PHP
      $.ajax({
        url: 'check_duplicate.php',
        type: 'POST',
        data: {username: username},
        success: function(response) {
          // Xử lý phản hồi từ máy chủ
          if (response === 'duplicate') {
            document.getElementById('result').innerHTML = 'Tên người dùng đã tồn tại.';
          } else {
            document.getElementById('result').innerHTML = 'Tên người dùng có thể sử dụng.';
          }
        }
      });
    }


    document.addEventListener('onChange')