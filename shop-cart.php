<?php

    include "./admincp/config/config.php";
        session_start();
        if($_SESSION['user']){
        $cart = (isset($_SESSION['cart']))?$_SESSION['cart'] : [];
        $i = 1; 
        $endbill = 0;
        $user = $_SESSION['user']['user_name'];
    
        $sql = "SELECT sdt FROM tbl_user WHERE user_name = '$user'";
        $query = mysqli_query($con,$sql);
        $sdt = mysqli_fetch_assoc($query);

        
        }
        else{
            header('location: signin.php');
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
    <script>
        <?php include "js/myjs.js"?>
        </script>
    <title>Ai shop</title>
    <script>
        function capnhat(id){
            var soluong = document.getElementById.value();
            $.ajax({
                url: "cart.php",
                type: "GET",
                cache: false,
                data:{id:id,soluong:soluong},
                success: function(){

                }
            })
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <?php   include "include/topbar.php";?>
        <?php   include "include/header.php"; ?>
        <?php   include "include/menu.php";?>
        <div id="main">
            <?php if(isset($_GET['action'])=='tk'){?>
                <script>
                    if(alert("Bạn đã đặt hàng thành công!")){
                        header('location:index.php?id=quanlytaikhoan');
                    }
                </script>
            <?php 
            }
                ?>
        <div class="table-content">
            <table>
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Giá</th> 
                    <th>Thanh Tiền</th>
                    <th>Thao tác</th>
                </tr>
                <?php foreach ($cart as $key => $value): ?>
                <tr>
                    <th><img src="./images/<?php echo $value['images']?>" alt=""></th>
                    <th><?php echo $value['name']?></th>
                    <form action="cart.php" method="GET">
                    <th><input type="number" id="soluong" value="<?php echo $value['soluong']?>" onchange="return checksoluonggiohang(value,<?php echo $value['soluong-max']?>,<?php echo $value['soluong']?>)" name="soluong">
                    <input type="hidden" value="<?php echo $value['id']?>" name="id">
                    <input type="hidden" value="update" name="action">
                    </th>
                    <th><?php echo number_format($value['price'])?> đ</th>
                    <th><?php echo number_format($bill = $value['price'] * $value['soluong']);
                    $endbill = $endbill + $bill?> đ</th>
                    <th>
                    <button type="submit">Cập nhật</button> </form>
                        <div><a href="" id="xoa" onclick=" return Xoagiohang(<?php echo $value['id']?>)"><button type="submit" >Xóa</button></a></div>
                    </th>
                </tr>
                <?php endforeach ?>
                <tr>
                    <th></th>
                    <th></th>
                    <th><button type="submit"><a href="index.php">Trở lại trang chủ </a></button></th>
                    <th></th>
                    <th>Tổng tiền</th>
                    <th><?php echo number_format($endbill) ?> đ</th>
                </tr>
            </table>
        </div>
        <div>
            <div>
                    <h1>Thanh toán</h1>
            </div>
            <div style="width: 35%;">
                <form action="cart.php?action=thanhtoan" method="POST">
                    
                    <div class="form-group">
                        <strong>Tổng hóa đơn: <?php echo number_format($endbill) ?> đ</strong>
                        <input type="hidden" name = "tongtien" value="<?php echo $endbill ?>">
                    </div>
                    <div class="form-group"> 
                        <label for="diachi"> Địa chỉ:</label> <br>
                        <input type="text" name = "diachi" placeholder="Nhập địa chỉ.">
                    </div>
                    <div class="form-group">
                       <label for="sdt">Số điện thoại:</label> <br>
                   
                    <input type="text" name="sdt" value="<?php echo $sdt['sdt']?>">
                     </div>
                     <div class="form-group">
                      <label for="pttt">  Phương thức thanh toán:</label> <br>
                        <select name = "pttt" aria-placeholder="Chọn phương thức thanh toán">
                            <option value="Ví điện tử">Ví điện tử</option>
                            <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                            <option value="Chuyển khoản qua ngân hàng">Chuyển khoản qua ngân hàng</option>
                        </select>
                    </div>  
                    <div>
                        <button type="submit">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    
        <?php include "include/footer.php" ?>
       
</body>
</html>