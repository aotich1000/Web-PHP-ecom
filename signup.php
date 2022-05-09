<?php   
        //Nếu không phải sự kiện đăng ký thì ngưng xử lí
        // if(!isset($_POST['username'])){
        //     die();
        // }

        include "admincp/config/config.php"; 
        header('Content-Type: text/html; charset=UTF-8');
        //kiểm tra conect database        
        $err = [];
        
        if(isset($_POST["username"])){
            $hoten = $_POST["hoten"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $rpassword = $_POST["rpassword"];
            $email = $_POST["email"];
            $sdt = $_POST["sdt"];

            
        //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
            $hoten = strip_tags($hoten);
		    $hoten = addslashes($hoten);
            $username = strip_tags($username);
		    $username = addslashes($username);
		    $password = strip_tags($password);
		    $password = addslashes($password);
            $rpassword = strip_tags($rpassword);
		    $rpassword = addslashes($rpassword);
            $email = strip_tags($email);
		    $email = addslashes($email);
            $sdt = strip_tags($sdt);
		    $sdt = addslashes($sdt);


            if(empty($username)){
                $err["username"]='Bạn chưa nhập tên đăng nhập';
            }
            if (mysqli_num_rows(mysqli_query($con,"SELECT user_name FROM tbl_user WHERE user_name='$username'")) > 0){
                ?>
                    <script>
                        alert("Bạn vẫn cố tình đăng ký với tài khoản đã bị trùng khớp! Yêu cầu thực hiện đăng ký lại!");
                        location.href = "signup.php";
                    </script>
                <?php 
            }
            if(empty($hoten)){
                $err["hoten"]='Bạn chưa nhập họ và tên';
            }
            if(empty($password)){
                $err["password"]='Bạn chưa nhập mật khẩu';
            }
            if(empty($rpassword)){
                $err["rpassword"]='Bạn chưa nhập lại mật khẩu';
            }
            if($password != $rpassword){
                $err["rpassword"]='Mật khẩu nhập lại không đúng';
            }
            if(empty($email)){
                $err["email"]='Bạn chưa nhập email';
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $err["email"]= 'Nhập sai email';
              }
              if (mysqli_num_rows(mysqli_query($con,"SELECT email FROM tbl_user WHERE email='$email'")) > 0)
              {
                  $err["email"]= 'Email đã tồn tại';
              }
            if(empty($sdt)){
                $err["sdt"]='Bạn chưa nhập số điện thoại';
            }
            
            if(empty($err)){
                $pass = password_hash($password,PASSWORD_DEFAULT);
                $sql = ("INSERT INTO tbl_user(hoten,sdt,email,user_name,password) VALUES ('{$hoten}','{$sdt}','{$email}','{$username}','{$pass}')");
                $query=mysqli_query($con,$sql); 
                if($query){
                    header('Location: signin.php?id=tk');
                }   
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>    <?php include "css/style.css"?></style>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    

    <script src="js/myjs.js"></script>
    <title>Đăng ký</title>
    </head>
<body>
    <div class="wrapper">
    <?php include "include/topbar.php"?>
    <?php include "./include/header.php" ?>
    <?php include "./include/menu.php" ?>

    <script>
        function checkdangnhap(){
            var tendn = document.getElementById("username").value;
            
            function check(tendn){
                $.ajax({
                    url: "checktendn.php",
                    type: "GET",
                    cache: false,
                    data:{tendn : tendn},
                    success: function(data){
                        $("#tendn").html(data);
                    }
                });   
            };
            check(tendn);
        }
    </script>
    <div class="sign-in">
        <div class="title-dk">
                <h1>Đăng ký</h1>
        </div>
        <div class="sign-form">
        <form action="signup.php" method="POST">
        <div class="form-group">
            <label for="hoten">Nhập họ và tên:</label> 
            <div class="popup" onmouseover="popup()">*
            <span class="popuptext" id="myPopup">Họ tên không chứa các ký tự đặc biệt, có thể có dấu.</span>
            </div>
            <br>
            <input type="hoten" name="hoten" id="hoten" placeholder="Nhập Họ và tên:"><br>
            <div class="err-mess"> <span> <?php echo (isset($err['hoten']))?$err['hoten']:'' ?></span> </div>
            
        </div> 
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <div class="popup" onmouseover="popup1()">*
            <span class="popuptext" id="myPopup1">Tên đăng nhập dài 3-16 ký tự, chỉ có thể chứa 1 dấu "_"</span>
            </div><br>
            <input type="text" name="username" id="username" placeholder="Nhập tên đăng nhập" onchange="checkdangnhap()"> 
            <div class="err-mess"> <span> <?php echo (isset($err['username']))?$err['username']:'' ?></span> </div>
            <div class="err-mess" id="tendn"></div>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <div class="popup" onmouseover="popup2()">*
            <span class="popuptext" id="myPopup2">Mật khẩu dài 3-18 ký tự, không chứa ký tự đặc biệt</span>
            </div><br>
            <input type="password" name="password" id="password" placeholder="Nhập mật khẩu"><br>
            <div class="err-mess"> <span> <?php echo (isset($err['password']))?$err['password']:'' ?></span> </div>
        </div>
        <div class="form-group">
            <label for="rpassword">Nhập lại mật khẩu:</label><br>
            <input type="password" name="rpassword" id="rpassword" placeholder="Nhập lại mật khẩu"><br>
            <div class="err-mess"> <span> <?php echo (isset($err['rpassword']))?$err['rpassword']:'' ?></span> </div>
        </div>
        
        <div class="form-group">
            <label for="sdt">Nhập số điện thoại:</label><br>
            <input type="text" name="sdt" id="sdt" placeholder="Nhập số điện thoại"><br>
            <div class="err-mess"> <span> <?php echo (isset($err['sdt']))?$err['sdt']:'' ?></span> </div>
        </div>

        <div class="form-group">
            <label for="email">Nhập Email:</label>
            <div class="popup" onmouseover="popup3()">*
            <span class="popuptext" id="myPopup3">Chỉ nhận Gmail</span>
            </div><br>
            <input type="email" name="email" id="email" placeholder="Nhập Email"><br>
            <div class="err-mess"> <span> <?php echo (isset($err['email']))?$err['email']:'' ?></span> </div>
        </div>
        <div class="form-submit">
            <input type="submit" id="submit" value="Đăng ký" name="submit">
        </div>
        </form>
    </div>

    <div class="form-group">
            Đã có tài khoản?<a href="signin.php"> Đăng nhập.</a>
        </div>
    </div>

    <?php include "include/footer.php" ?>
</div>
</body>
</html>