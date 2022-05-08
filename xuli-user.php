<?php 
    include "admincp/config/config.php";
    session_start();
   
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    if($action == 'suattk'){
        $id_user2 = $_GET['id-user'];
        $hoten2 = $_POST['hoten'];
        $email2 = $_POST['email'];
        $sdt2 = $_POST['sdt'];
        $sql_sua = "UPDATE `tbl_user` SET `hoten` = '$hoten2' ,`email` = '$email2',`sdt` = '$sdt2' WHERE `tbl_user`.`id_user` = $id_user2";
        $query_sua = mysqli_query($con,$sql_sua);
        if($query_sua){
            header('location:index.php?id=quanlytaikhoan&&trangthai=themtk');  
        }
    }
    if($action == 'repass'){
        $id_user3 = $_GET['id-user'];
        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];
        $renewpassword = $_POST['renewpassword'];
        $hashop = password_hash($oldpassword,PASSWORD_DEFAULT);
        if($hashop == $_SESSION['user']['password']){
            if($newpassword == $renewpassword){
                $hashnp = password_hash($newpassword,PASSWORD_DEFAULT);
                $sql_repass = "UPDATE `tbl_user` SET `password` = '$hashnp' WHERE `tbl_user`.`id_user` = $id_user3";
                $query_repass = mysqli_query($con,$sql_repass); 
                if($query_repass){
                    header('location:index.php?id=quanlytaikhoan&&trangthai=themtk');  
                }
            }else{
            header('location:index.php?id=quanlytaikhoan&&trangthai=sairepass');
        }
        }else{
            header('location:index.php?id=quanlytaikhoan&&trangthai=saipass');
        }
    }
    if($action == 'huydonhang'){
        $idhd2 = $_GET['idhd'];
        echo $idhd2;
        $trangthai_moi = "Đã hủy";
        $sql_hhd1 = "UPDATE tbl_hoadon SET trangthai = '$trangthai_moi' WHERE id_hoadon = $idhd2";    
        $queryhhd1 = mysqli_query($con,$sql_hhd1);
        header("location:index.php?id=quanlytaikhoan&trangthai=huythanhcong");
    }
    }
?>