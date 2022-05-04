

<?php
        session_start();
        include "admincp/config/config.php"; 
        //kiểm tra conect database
        $err= [];
        if(isset($_POST["submit"])){
            $username = $_POST["username"];
            $password = $_POST["password"];

        //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
            $username = strip_tags($username);
		    $username = addslashes($username);
		    $password = strip_tags($password);
		    $password = addslashes($password);

            $sql = "SELECT * FROM tbl_user Where user_name = '$username'";

            $query = mysqli_query($con,$sql);
            $data = mysqli_fetch_assoc($query);
            $checkUsername = mysqli_num_rows($query);

            
            if($checkUsername == 1){
                $checkPass = password_verify($password, $data['password']);
                if($checkPass){
                    $_SESSION['user'] = $data;
                    header('location: index.php');
                }
                else{
                    $err['false'] = "Tài khoản hoặc mât khẩu sai.";
                }
            }
            else{
                $err["false"] = 'Tài khoản hoặc mât khẩu sai.';
                echo "<script><alert>User không tồn tại.</alert></script>";
            }
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>    <?php include "css/style.css"?></style>
    <!-- <link rel="stylesheet" href="css/style.css" type="text/css"> -->
    <!-- <link rel="stylesheet" href="css/bootstrap.css" type="text/css"> -->
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/myjs.js"></script>
    <title>Đăng nhập</title>
    </head>
<body>
    <?php   include "include/topbar.php"?>
    <?php include "./include/header.php" ?>
    <?php include "./include/menu.php" ?>
        <script>
                function ktdangnhap(){
                    var tk = document.getElementById("username").value;
                    var ps = document.getElementById("password").value;
                    if (tk=="" || ps == ""){
                        alert ("Xin nhập đầy đủ thông tin");
                        return false;
                    } 
                }
            </script>


<div class="dk-content">
<?php 
    if(isset($_GET['id'])){
        $result=$_GET['id'];

        if($result=='tk'){
        echo   '<script> alert("Bạn đã đăng ký thành công.")</script>';
        }
    }           
    ?>
    <div class="sign-in">
        <div class="title-dk">
                <h1>Đăng nhập</h1>
        </div>

        <div class="sign-form">
        <form action="signin.php" method="POST" onsubmit="return ktdangnhap()">
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label> <br>
            <input type="text" name="username" id="username" placeholder="Nhập tên đăng nhập"> 
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label><br>
            <input type="password" name="password" id="password" placeholder="Nhập mật khẩu"><br><br>
            <div class="err-mess"> <span> <?php echo (isset($err['false']))?$err['false']:'' ?></span> </div>
        </div>
        
        <div class="form-submit">
            <input type="submit" id="submit" value="Đăng nhập" name="submit">
        </div>
      
    </div>  
    </form>
    <div class="form-group">
            <a href="#">Quên mật khẩu?</a>
        </div>
        <div class="form-group">
            Bạn chưa có tài khoản?<a href="signup.php"> Đăng ký thành viên</a>
        </div>
    </div>
    
<div class="clear"></div>
            </div>


            <?php include "include/footer.php";?>
</body>
</html>