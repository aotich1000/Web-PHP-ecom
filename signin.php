

<?php
session_start();
include "admincp/config/config.php";
//kiểm tra conect database
$err = [];
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
    //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
    $username = strip_tags($username);
    $username = addslashes($username);
    $password = strip_tags($password);
    $password = addslashes($password);

    $sql = "SELECT * FROM tbl_user Where user_name = '$username'";

    $query = mysqli_query($con, $sql);
    $data = mysqli_fetch_assoc($query);
    $checkUsername = mysqli_num_rows($query);


    if ($checkUsername == 1) {
        $checkPass = password_verify($password, $data['password']);
        if ($checkPass) {
            $_SESSION['user'] = $data;
            header('location: index.php');
        } else {
            // $err['false'] = "Tài khoản hoặc mât khẩu sai.";
            header('location:index.php?id=signin&trangthai=sai-tk-mk');
        }
    } else {
        // $err["false"] = 'Tài khoản hoặc mât khẩu sai.';
        header('location:index.php?id=signin&trangthai=sai-tk-mk');
    }
}

?>