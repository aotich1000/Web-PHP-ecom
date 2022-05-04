
<div>
    <ul>
        <li>
            <a href="index.php?id=quanlytaikhoan&action=showtttk">
            Thông tin tài khoản
                </a>
        </li>
        <li>
        <a href="index.php?id=quanlytaikhoan&action=showhoadon">
            Hóa đơn đã mua
        </a>
        </li>
    </ul>
</div>

<?php 
        if(isset($_GET['trangthai'])){
            $trangthai = $_GET['trangthai'];
            if($trangthai == 'themtk'){
                session_destroy();
                ?> <script type="text/javascript">
                alert("Thao tác thành công! Mời bạn đăng nhập lại.");
                location.href = 'signin.php';</script> <?php 
            }
            if($trangthai == 'saipass'){
                ?> 
                <script type="text/javascript"> 
                    alert("Sai mật khẩu cũ! Mời thao tác lại");
                    location.href = 'index.php?id=quanlytaikhoan&action=repass';
                </script>
                <?php
            }if($trangthai =='sairepass'){
                ?> 
                <script type="text/javascript"> 
                    alert("Mật khẩu nhập lại sai! Mời thao tác lại");
                    location.href = 'index.php?id=quanlytaikhoan&action=repass';
                </script>
                <?php
            }if($trangthai == 'huythanhcong'){
                ?>
                <script type="text/javascript"> 
                    alert("Bạn đã hủy đơn hàng thành công!");
                    location.href = 'index.php?id=quanlytaikhoan&action=showhoadon';
                </script>
                <?php 
            }
        }
        $actionql = (isset($_GET['action'])) ? $_GET['action'] : 'showtttk';
        if($actionql == 'showtttk'){
?>


<div>
    <div class="title"><h3>Thông tin tài khoản</h3></div>
    <div>
    <ul>
        <label for="#">Họ và tên:</label> <?php echo $_SESSION['user']['hoten']?><br>
        <label for="#">Tên tài khoản:</label> <?php echo $_SESSION['user']['user_name']?><br>
        <label for="#">Email:</label> <?php echo $_SESSION['user']['email']?><br>
        <label for="#">SDT:</label><?php echo $_SESSION['user']['sdt']?><br>
        </ul>
        <button><a href="index.php?id=quanlytaikhoan&action=suatttk">Chỉnh sửa thông tin</a></button>
        <button><a href="index.php?id=quanlytaikhoan&action=repass">Đặt lại mật khẩu</a></button>
    </div>    
</div>

<?php } if($actionql == 'showhoadon'){?>
<?php 
    $idkh = $_SESSION['user']['id_user'];
    $sql_hd_o = "SELECT * FROM tbl_hoadon WHERE id_user = $idkh ORDER BY id_hoadon DESC";
    $queryhd_o = mysqli_query($con,$sql_hd_o);
    $i = 1;
    $limit_pg = 1;
    $row = mysqli_num_rows($queryhd_o);
    $page = ceil($row / $limit_pg);
    if(isset($_GET['page'])){
        $pg = $_GET['page'];
    }else{
       $pg = 1;
    }
    $start = ($pg - 1)*$limit_pg;
    $sql_hd = "SELECT * FROM tbl_hoadon WHERE id_user = $idkh ORDER BY id_hoadon DESC LIMIT $start,$limit_pg";
    $queryhd = mysqli_query($con,$sql_hd);
?>
<div>
    <div class="title"><h3>Hóa đơn đã mua</h3></div>
    <?php while($hd = mysqli_fetch_assoc($queryhd)){ 
        if($hd['trangthai'] != "Đã hủy"){ ?>
    <div>
        <h4>Thông tin hóa đơn ngày <?php echo $hd['date']?></h4>
        <ul>
            <li>Địa chỉ: <?php echo $hd['diachi']?></li>
            <li>Số điện thoại: <?php echo $hd['sdt']?></li>
            <li>Phương thức thanh toán: <?php echo $hd['pptt']?></li>
            <li>Trạng thái hóa đơn: <?php echo $hd['trangthai']?></li>
            <li>Tổng hóa đơn: <?php echo number_format($hd['tong_tien'])?>đ</li>
        </ul>
        <?php   $idhd = $hd['id_hoadon'];
                $sql_chd = "SELECT * FROM tbl_chitiethoadon,tbl_sanpham WHERE tbl_chitiethoadon.id_sanpham = tbl_sanpham.id_sanpham AND tbl_chitiethoadon.id_hoadon = $idhd";
                $querychd = mysqli_query($con,$sql_chd);
        ?>
        <div class="table-content">
            <table>
                <tr>
                    <th>STT</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Số Lượng</th>
                    <th>Giá</th>
                    <th>Thanh Tiền</th>
                </tr>
                <?php 
                 while($abc = mysqli_fetch_assoc($querychd)){ 
                ?>
                    <tr>
                        <th><?php echo $i?></th>
                    <th><img src="./images/<?php echo $abc['images']?>" alt=""></th>
                    <th><?php echo $abc['ten_sanpham']?></th>
                    <form action="cart.php" method="GET">
                    <th><?php echo $abc['soluongsp']?>
                    </th>
                    <th><?php echo number_format($abc['gia'])?> đ</th>
                    <th><?php echo number_format($bill = $abc['gia'] * $abc['soluongsp']);?> đ</th>
                </tr>
                <?php $i++;}?>
            </table>
                    <?php if($hd['trangthai'] == 'Chưa xử lí'){?>
                    <div><a href="" id="xoahd" onclick="XoaHD(<?php echo $hd['id_hoadon']?>)">Hủy đơn hàng</a></div>
        </div>
    </div>
    <?php }?>
</div>
<?php }}
?>
         <div class="pagi">
        <ul class="pagination justify-content-center">
        <?php
        for ($i=1; $i <= $page; $i++) { if($pg == $i){
                ?>
                <a href="index.php?id=quanlytaikhoan&action=showhoadon&page=<?php echo $i?>" class="page-link"> <li class="page-item active"><?php echo $i ?></li></a>
            <?php }else{
                ?>
                <a href="index.php?id=quanlytaikhoan&action=showhoadon&page=<?php echo $i?>" class="page-link"> <li class="page-item"><?php echo $i ?></li></a>
                <?php
            }}
            ?>
        </ul>
         </div>
<?php 
}?>

<?php 
if($actionql =='suatttk'){
                        ?>
                    <div>
                    <h3>Sửa</h3>
                    <form action="xuli-user.php?action=suatttk&id-user=<?php echo $_SESSION['user']['id_user']?>" method="POST">
                            <label for="hoten">Họ và tên:</label><br>
                            <input type="text" name="hoten" id="hoten" value="<?php echo $_SESSION['user']['hoten']?>"> <br>
                            <label for="email">Email:</label><br>
                            <input type="text" name="email" id="email" value="<?php echo $_SESSION['user']['email']?>"><br>
                            <label for="sdt"> SDT:</label><br>
                            <input type="text" name="sdt" id="sdt" value="<?php echo $_SESSION['user']['sdt']?>"><br>
                            <button type="submit">Thực hiện</button>
                    </form>
                        <button type="submit" onclick="window.history.back(-1)">Trở lại</button>
                    </div>
                    <?php }

                    if ($actionql == 'repass'){ ?>
                    <div>
                    <h3>Đặt lại mật khẩu</h3>
                    <form action="xuli-user.php?action=repass&id-user=<?php echo $_SESSION['user']['id_user']?>" method="POST">
                            <label for="oldlpassword">Mật khẩu cũ:</label><br>
                            <input type="password" name="oldlpassword" id="oldlpassword"><br>
                            <label for="newpassword">Mật khẩu mới</label><br>
                            <input type="password" name="newpassword" id="newpassword"><br>
                            <label for="renewpasswor">Nhập lại mật khẩu</label><br>
                            <input type="password" name="renewpasswor" id="renewpasswor"><br><br>
                            <button type="submit">Thực hiện</button>
                    </form>
                    <button type="submit" onclick="window.history.back(-1)">Trở lại</button>
                    </div>
                </div>
                <?php }?>
