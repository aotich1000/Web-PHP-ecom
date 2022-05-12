
<?php

// Connect database 
include "admincp/config/config.php";
$limit = 12;

if (isset($_GET['page_no'])) {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 12;
}

$loaisp1 = $_GET['loaisp'];
$offset = ($page_no - 1) * $limit;
$query_loaisp = mysqli_query($con, "SELECT * FROM tbl_phanloaisp WHERE id_loaisp = $loaisp1");
$data = mysqli_fetch_assoc($query_loaisp);
$query = "SELECT * FROM tbl_sanpham WHERE loaisp = $loaisp1 ORDER BY id_sanpham DESC LIMIT $offset, $limit";

$result = mysqli_query($con, $query);

$output = "";
$output .= "<div class='title'>
<ul class='breadcrumb'>
    <li><a href='index.php'>Trang chủ</a></li>
    <li>Từ khóa tìm kiếm :  " . $data['ten_loaisp'] . "</li>
</ul>
</div>";
if (mysqli_num_rows($result) > 0) {
    $output .= '<div class="content-sp">';
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '<div class="card">
    <div class="card-container">
    <img src="upload/' . $row['images'] . ' " alt="Avatar" class="images">
        <div class="middle">
            <div><a href="cart.php?id=' . $row['id_sanpham'] . '">Thêm vào giỏ</a></div>
            <div><a href="index.php?id=chitiet-sp&sp=' . $row['id_sanpham'] . '">Chi tiết</a></div>
        </div>
    <h4><b>' . $row['ten_sanpham'] . '</b></h4>
    <p> ' . number_format($row['gia']) . ' đ</p>

    </div>
</div>';
    }
    $output .= '</div>';
    $sql = "SELECT * FROM tbl_sanpham WHERE loaisp = $loaisp1";

    $records = mysqli_query($con, $sql);

    $totalRecords = mysqli_num_rows($records);

    $totalPage = ceil($totalRecords / $limit);

    $output .= "<div class='pagi'><ul class='pagination justify-content-center' style='margin:20px 0'>";

    for ($i = 1; $i <= $totalPage; $i++) {
        if ($i == $page_no) {
            $active = "active";
        } else {
            $active = "";
        }
        $output .= "<li class='page-item $active'><a class='page-link' id='$i' href=''>$i</a></li>";
    }

    $output .= "</ul></div>";

    echo $output;
}

?>