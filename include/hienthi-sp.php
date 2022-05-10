<?php 
    if(isset($_GET['search'])){
       $key = $_GET['search'];
       if($key == ""){
           $key = 'tatca';    
       }
       $key = strip_tags($key);
       $key = addslashes($key);
    }

   $limit_pg = 12;
    
    if($key == 'tatca'){
        $sql = "SELECT * FROM tbl_sanpham ORDER BY id_sanpham DESC";
        $key = 'Tất cả sản phẩm';
        $query = mysqli_query($con,$sql);
        $row = mysqli_num_rows($query);
        $page = ceil($row / $limit_pg);
        if(isset($_GET['page'])){
            $pg = $_GET['page'];
        }else{
           $pg = 1;
        }
        $start = ($pg - 1)*$limit_pg;
        $new_sql = "SELECT * FROM tbl_sanpham LIMIT $start,$limit_pg";
        $new_query = mysqli_query($con,$new_sql);
        ?>
            <div class="title">
                <ul class="breadcrumb">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li>Từ khóa tìm kiếm : <?php echo $key?></li>
                </ul>
                </div>
        <?php 
    }else{
        if(isset($_GET['loaisp'])){
            $loaisp1 = $_GET['loaisp'];
            $sql = "SELECT * FROM tbl_sanpham WHERE ten_sanpham LIKE '%$key%' OR mota LIKE '%$key%' OR loaisp LIKE '%$loaisp1%'";
            $query = mysqli_query($con,$sql);
            $row = mysqli_num_rows($query);
            $page = ceil($row / $limit_pg);
            if(isset($_GET['page'])){
                $pg = $_GET['page'];
            }else{
                $pg = 1;
             }
            $start = ($pg - 1)*$limit_pg;
            $new_sql = "SELECT * FROM tbl_sanpham WHERE ten_sanpham LIKE '%$key%' OR mota LIKE '%$key%' OR loaisp LIKE '%$loaisp1%' LIMIT $start,$limit_pg";
            $new_query = mysqli_query($con,$new_sql);
        }else if($key){
            $sql = "SELECT * FROM tbl_sanpham WHERE ten_sanpham LIKE '%$key%' OR mota LIKE '%$key%' ";
            $query = mysqli_query($con,$sql);
            $row = mysqli_num_rows($query);
            $page = ceil($row / $limit_pg);
            if(isset($_GET['page'])){
                $pg = $_GET['page'];
            }else{
                $pg = 1;
             }
            $start = ($pg - 1)*$limit_pg;
            $new_sql = "SELECT * FROM tbl_sanpham WHERE ten_sanpham LIKE '%$key%' OR mota LIKE '%$key%' LIMIT $start,$limit_pg";
            $new_query = mysqli_query($con,$new_sql);
        }
        
        if(empty(mysqli_num_rows($query))){
            ?>
           <div class="title">
                <ul class="breadcrumb">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li>Từ khóa tìm kiếm : <?php echo $key?></li>
                </ul>
                </div>
                <div>
                    <h3>Không tồn tại kết quả tìm kiếm!</h3>
                </div>
            <?php
        }
        else{
            ?>
                <div class="title">
                <ul class="breadcrumb">
                    <li><a href="index.php">Trang chủ</a></li>
                    <li>Từ khóa tìm kiếm : <?php echo $key?></li>
                </ul>
                </div>
            <?php 
        }
    }   

    // var_dump($start);
    // echo "<pre>";
    // var_dump($query);
    // print_r($query);
?>

<div class="hot_deal">
<div class="conteiner">
<div class="content-sp">
        <?php while($data = mysqli_fetch_assoc($new_query)){?>
        <div class="card">
        <div class="card-container">
        <img src="images/<?php echo $data['images']?> " alt="Avatar" class="images">
            <div class="middle">
                <div><a href="cart.php?id=<?php echo $data['id_sanpham']?>">Thêm vào giỏ</a></div>
                <div><a href="index.php?id=chitiet-sp&sp=<?php echo $data['id_sanpham']?>">Chi tiết</a></div>
            </div>
        <h4><b><?php echo $data['ten_sanpham']?></b></h4>
        <p><?php echo number_format($data['gia'])?> đ</p>
        </div>
    </div>
    
        <?php } ?>
    
          
</div>
      <div class="pagi">
        <ul class="pagination justify-content-center">
            <!-- <li class="page-item"><a class="page-link" href="#">Trang trước</a></li> -->
            
            <?php
            if($key == 'Tất cả sản phẩm'){                
            for ($i=1; $i <= $page; $i++) { if($pg == $i){
                ?>
                <li class="page-item active"><a href="index.php?search=&page=<?php echo $i?>" class="page-link"> <?php echo $i ?></a></li>
            <?php }else{
                ?>
                <li class="page-item"><a href="index.php?search=&page=<?php echo $i?>" class="page-link"> <?php echo $i ?></a></li>
                <?php
            }} }
            else
            for ($i=1; $i <= $page; $i++) { if($pg == $i){
                ?>
                <li class="page-item active"><a href="index.php?search=<?php echo $key?>&page=<?php echo $i?>" class="page-link"> <?php echo $i ?></a></li>
            <?php }else{
                ?>
                <li class="page-item"><a href="index.php?search=<?php echo $key?>&page=<?php echo $i?>" class="page-link"> <?php echo $i ?></a></li>
            <?php
            }
            
        }
            ?>

            <!-- <li class="page-item"><a class="page-link" href="#">Trang kế</a></li> -->
        </ul>
    </div> 
    </div>
</div>
