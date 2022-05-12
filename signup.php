<?php
//Nếu không phải sự kiện đăng ký thì ngưng xử lí
// if(!isset($_POST['username'])){
//     die();
// }

include "admincp/config/config.php";
header('Content-Type: text/html; charset=UTF-8');
session_start();

//kiểm tra conect database        
$err = [];

if (isset($_POST["username"])) {
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


    if (empty($username)) {
        $_SESSION['error']["username"] = 'Bạn chưa nhập tên đăng nhập';
        header('location:index.php?id=signup&trangthai=error');
    }
    if (mysqli_num_rows(mysqli_query($con, "SELECT user_name FROM tbl_user WHERE user_name='$username'")) > 0) {
?>
        <script>
            alert("Bạn vẫn cố tình đăng ký với tài khoản đã bị trùng khớp! Yêu cầu thực hiện đăng ký lại!");
            location.href = "signup.php";
        </script>
<?php
    }
    if (empty($hoten)) {
        $_SESSION['error']["hoten"] = 'Bạn chưa nhập họ và tên';
        header('location:index.php?id=signup');
    }
    if (empty($password)) {
        $_SESSION['error']["password"] = 'Bạn chưa nhập mật khẩu';
        header('location:index.php?id=signup');
    }
    if (empty($rpassword)) {
        $_SESSION['error']["rpassword"] = 'Bạn chưa nhập lại mật khẩu';
        header('location:index.php?id=signup');
    }
    if ($password != $rpassword) {
        $_SESSION['error']["rpassword"] = 'Mật khẩu nhập lại không đúng';
        header('location:index.php?id=signup');
    }
    if (empty($email)) {
        $_SESSION['error']["email"] = 'Bạn chưa nhập email';
        header('location:index.php?id=signup');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error']["email"] = 'Nhập sai email';
        header('location:index.php?id=signup');
    }
    if (mysqli_num_rows(mysqli_query($con, "SELECT email FROM tbl_user WHERE email='$email'")) > 0) {
        $_SESSION['error']["email"] = 'Email đã tồn tại';
        header('location:index.php?id=signup');
    }
    if (empty($sdt)) {
        $_SESSION['error']["sdt"] = 'Bạn chưa nhập số điện thoại';
        header('location:index.php?id=signup');
    }

    if (empty($_SESSION['error'])) {
        $pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = ("INSERT INTO tbl_user(hoten,sdt,email,user_name,password) VALUES ('{$hoten}','{$sdt}','{$email}','{$username}','{$pass}')");
        $query = mysqli_query($con, $sql);
        if ($query) {
            header('Location: index.php?id=signin&trangthai=dktk');
        }
    }
}
?>