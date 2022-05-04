<?php 
    include "config/config.php";
    $action = (isset($_GET['action'])) ? $_GET['action'] : 'themtk';


    //them tk mới

    if($action == 'themtk'){
        $ten = $_POST['ten'];
        $username = $_POST['tendn'];
        $password = $_POST['password'];
        $pass = password_hash($password,PASSWORD_DEFAULT);
        $sql_themtk = "INSERT INTO tbl_admin(name,user_name,password) 
                        VALUE ('{$ten}','{$username}','{$pass}')";
        $sql_thempermiss = "INSERT INTO tbl_permission(name) 
         VALUE ('{$ten}')";
        $query_permiss = mysqli_query($con,$sql_thempermiss);
        $query = mysqli_query($con,$sql_themtk);
        if($query){
            header('location:index.php?id=quanlyadmin&&trangthai=themtk');        
        }
    }
    //Đặt lại mật khẩu

    if($action == 'repass'){
        $passwordneedrepass = $_POST['password'];
        $id_user = $_GET['id-user'];
        $repass = password_hash($passwordneedrepass,PASSWORD_DEFAULT); 
        $sql_repass = "UPDATE `tbl_admin` SET `password` = '$repass' WHERE `tbl_admin`.`id_admin` = $id_user";
        $query_repass = mysqli_query($con,$sql_repass); 
        if($query_repass){
            header('location:index.php?id=quanlyadmin&&trangthai=themtk');        
        }
    }

    //Xoa 

    if($action == 'xoa'){
        $id_user = $_GET['id-admin'];
        $sql_xoa = "DELETE FROM tbl_admin WHERE id_admin = $id_user";
        $query = mysqli_query($con,$sql_xoa);
        if($query){
            header('location:index.php?id=quanlyuser&&trangthai=themtk');  
        }
    }

    //Sua 

    if($action == 'sua'){
        $id_user2 = $_GET['id-user'];
        $hoten2 = $_POST['hoten'];
        $email2 = $_POST['email'];
        $tendn2 = $_POST['tendn'];
        $sdt2 = $_POST['sdt'];

        $sql_sua = "UPDATE `tbl_user` SET `hoten` = '$hoten2' ,`email` = '$email2',`user_name` = '$tendn2',`sdt` = '$sdt2' WHERE `tbl_user`.`id_user` = $id_user2;";
        $query_sua = mysqli_query($con,$sql_sua);
        if($query_sua){
            header('location:index.php?id=quanlyuser&&trangthai=themtk');  
        }
    }
    if($action == 'setquyen'){

        $name = $_POST['name'];
    
        $qladmin = "";
        $qluser = "";
        $qlsp = "";
        $qlhd = "";

        $qladx = (isset($_POST['qladx'])) ? $_POST['qladx'] : '';
        $qladt = (isset($_POST['qladt'])) ? $_POST['qladt'] : '';
        $qladrp = (isset($_POST['qladrp'])) ? $_POST['qladrp'] : '';
        $qladd = (isset($_POST['qladd'])) ? $_POST['qladd'] : '';
        $qladsq = (isset($_POST['qladsq'])) ? $_POST['qladsq'] : '';

        if($qladx != ''){
            $qladmin .="$qladx,";
        }
        if($qladt != ''){
            $qladmin .="$qladt,";
        }
        if($qladrp != ''){
            $qladmin .="$qladrp,";
        }
        if($qladd != ''){
            $qladmin .="$qladd,";
        }
        if($qladsq != ''){
            $qladmin .="$qladsq,";
        }

        $qlkhx = (isset($_POST['qlkhx'])) ? $_POST['qlkhx'] : '';
        $qlkhth = (isset($_POST['qlkht'])) ? $_POST['qlkht'] : '';
        $qlkhrp = (isset($_POST['qlkhrp'])) ? $_POST['qlkhrp'] : '';
        $qlkhs = (isset($_POST['qlkhs'])) ? $_POST['qlkhs'] : '';

        if($qlkhx != ''){
            $qluser .="$qlkhx,";
        }
        if($qlkhth != ''){
            $qluser .="$qlkhth,";
        }
        if($qlkhrp != ''){
            $qluser .="$qlkhrp,";
        }
        if($qlkhs != ''){
            $qluser .="$qlkhs,";
        }

        $qlspx = (isset($_POST['qlspx'])) ? $_POST['qlspx'] : '';
        $qlspt = (isset($_POST['qlspt'])) ? $_POST['qlspt'] : '';
        $qlspd = (isset($_POST['qlspd'])) ? $_POST['qlspd'] : '';
        $qlsps = (isset($_POST['qlsps'])) ? $_POST['qlsps'] : '';

        if($qlspx != ''){
            $qlsp .="$qlspx,";
        }
        if($qlspt != ''){
            $qlsp .="$qlspt,";
        }
        if($qlspd != ''){
            $qlsp .="$qlspd,";
        }
        if($qlsps != ''){
            $qlsp .="$qlsps,";
        }

        $qlhdx = (isset($_POST['qlhdx'])) ? $_POST['qlhdx'] : '';
        $qlhdxl = (isset($_POST['qlhdxl'])) ? $_POST['qlhdxl'] : '';
        
        if($qlhdx != ''){
            $qlhd .="$qlhdx,";
        }
        if($qlhdxl != ''){
            $qlhd .="$qlhdxl,";
        }
        
       $sql_check = "SELECT * FROM tbl_permission WHERE name = '$name'";
       $query_check = mysqli_query($con,$sql_check);
       if($query_check){
           $sql_setquyen = "UPDATE `tbl_permission` SET `qladmin`='$qladmin',`qluser`='$qluser',`qlhd`='$qlhd',`qlsp`='$qlsp' WHERE name = '$name'";
           $query_setquyen = mysqli_query($con,$sql_setquyen);
           header('location:index.php?id=quanlyadmin&&trangthai=themtk');  
       }else{
        $sql_setquyen = "INSERT INTO `tbl_permission`(`name`, `qladmin`, `qluser`, `qlhd`, `qlsp`) VALUES ('$name','$qladmin','$qluser','$qlhd','$qlsp')";
        $query_setquyen = mysqli_query($con,$sql_setquyen);
        header('location:index.php?id=quanlyadmin&&trangthai=themtk');  

       }

    }
?>
