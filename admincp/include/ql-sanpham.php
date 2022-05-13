<?php
$action = (isset($_GET['action'])) ? $_GET['action'] : 'show';
// $sql_loaisp ="SELECT * FROM tbl_phanloaisp WHERE "
if (isset($_GET['trangthai'])) {
    $trangthai = $_GET['trangthai'];
    if ($trangthai = 'themtk') {
?> <script>
            alert("Thao tác thành công");
            location.href = "index.php?id=quanlysanpham";
        </script> <?php
                }
            }
            $limit_pg = 5;
            $sql = "SELECT * FROM tbl_sanpham";
            $query = mysqli_query($con, $sql);
            $row = mysqli_num_rows($query);
            $page = ceil($row / $limit_pg);
            if (isset($_GET['page'])) {
                $pg = $_GET['page'];
            } else {
                $pg = 1;
            }
            $start = ($pg - 1) * $limit_pg;

            $sql_select_sp = mysqli_query($con, "SELECT * FROM tbl_sanpham,tbl_phanloaisp WHERE tbl_sanpham.loaisp=tbl_phanloaisp.id_loaisp LIMIT $start,$limit_pg");
            $sql_lp = "SELECT * FROM tbl_phanloaisp";
            $query_lp = mysqli_query($con, $sql_lp);

                    ?>
<script>
    function Xoasp(id) {
        if (confirm("Bạn có muốn xóa không?")) {
            var duongdan = "xuli-qlsp.php?action=xoa&id_sanpham=" + id;
            document.getElementById("xoasp").href = duongdan;
        }
    }

    function boanh(id) {
        if (confirm("Bạn có muốn bỏ ảnh của sản phẩm này không?")) {
            var duongdan = "xuli-qlsp.php?action=boanh&id_sanpham=" + id;
            document.getElementById("boanh").href = duongdan;
        }
    }
</script>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý sản phẩm</h1>
    <?php if ($action == 'show') { ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?php for ($i = 0; $i < count($quyenquanlysanpham); $i++) {
                    if ($quyenquanlysanpham[$i] == 'them') {
                ?>
                        <a href="index.php?id=quanlysanpham&action=themsp" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-flag"></i>
                            </span>
                            <span class="text">Thêm mới sản phẩm mới</span>
                        </a>
                <?php }
                } ?>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Loại sản phẩm</th>
                                <th>Mô tả</th>
                                <th>Giá </th>
                                <th>Trạng thái</th>
                                <th>Số lượng</th>
                                <th>Ảnh</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($data = mysqli_fetch_assoc($sql_select_sp)) {
                            ?>
                                <tr>
                                    <td><?php echo $data['id_sanpham'] ?></td>
                                    <td><?php echo $data['ten_sanpham'] ?></td>
                                    <td><?php echo $data['ten_loaisp'] ?></td>
                                    <td><?php echo $data['mota'] ?></td>
                                    <td><?php echo $data['gia'] ?></td>
                                    <td>
                                        <?php if ($data['trangthai'] == 1) {
                                            echo "Còn hàng";
                                        } else {
                                            echo "Hết hàng";
                                        } ?></td>
                                    <td><?php echo $data['soluong'] ?></td>
                                    <td><img src="/project/upload/<?php echo $data['images'] ?>" alt="111"></td>
                                    <td>
                                        <?php for ($i = 0; $i < count($quyenquanlysanpham); $i++) {
                                            if ($quyenquanlysanpham[$i] == 'xoa') {
                                        ?>
                                                <a href="" id="xoasp" onclick="Xoasp(<?php echo $data['id_sanpham'] ?>)" class="btn btn-danger" style="margin-right:5px"> Xóa</a> <?php }
                                                                                                                                                                            } ?>
                                        <?php for ($i = 0; $i < count($quyenquanlysanpham); $i++) {
                                            if ($quyenquanlysanpham[$i] == 'sua') {
                                        ?>
                                                <a href="index.php?id=quanlysanpham&action=sua&id_sanpham=<?php echo $data['id_sanpham'] ?>" class="btn btn-secondary" style="margin-right:5px">Sửa</a>
                                    </td> <?php }
                                        } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                            <ul class="pagination">
                                <?php for ($i = 1; $i <= $page; $i++) {

                                    if ($i == $pg) {
                                        $active = "active";
                                ?>

                                        <li class="paginate_button page-item <?php echo $active ?> "><a href="index.php?id=quanlysanpham&page=<?php echo $i ?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $i ?></a></li>
                                    <?php } else {
                                    ?>
                                        <li class="paginate_button page-item"><a href="index.php?id=quanlysanpham&page=<?php echo $i ?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $i ?></a></li>
                                <?php }
                                }
                                ?>
                        </div>
                    </div>
                </div>
            <?php } else if ($action == "themsp") { ?>
                <div>
                    <h3>Thêm sản phẩm mới</h3>
                    <form action="xuli-qlsp.php?action=themsp" method="POST" enctype="multipart/form-data">
                        <label for="tensp">Tên sản phẩm:</label><br>
                        <input type="text" name="tensp" id="tensp"><br>
                        <label for="loaisp">Loại sản phẩm:</label><br>

                        <select name="loaisp" id="loaisp">
                            <?php while ($data2 = mysqli_fetch_assoc($query_lp)) { ?>
                                <option value="<?php echo $data2['id_loaisp'] ?>"><?php echo $data2['ten_loaisp'] ?></option>
                            <?php } ?>
                        </select><br>
                        <label for="mota">Mô tả sản phẩm:</label><br>
                        <textarea name="mota" id="mota" cols="40" rows="5"></textarea><br>
                        <label for="gia">Giá tiền:</label><br>
                        <input type="text" name="gia" id="gia"><br>
                        <label for="trangthai">Trạng thái:</label><br>
                        <select name="trangthai" id="trangthai">
                            <option value="1">Còn hàng</option>
                            <option value="0">Hết hàng</option>
                        </select><br>
                        <label for="soluong">Số lượng</label><br>
                        <input type="text" name="soluong" id="soluong"><br>
                        <label for="images">Ảnh sản phẩm:</label><br>
                        <input type="file" name="images" id="images"><br><br>
                        <button type="submit" name="submit">Thực hiện</button>
                    </form>
                    <br>
                    <button type="submit" onclick="window.history.back(-1)">Trở lại</button>
                </div>
            <?php } else if ($action == 'sua') {
            $id_sanpham1 = $_GET['id_sanpham'];
            $sql_sua = "SELECT * FROM tbl_sanpham,tbl_phanloaisp WHERE tbl_sanpham.id_sanpham = $id_sanpham1";
            $query_sua = mysqli_query($con, $sql_sua);

            $data1 = mysqli_fetch_assoc($query_sua);

            ?>
                <div>
                    <h3>Sửa</h3>
                    <form action="xuli-qlsp.php?action=sua&id_sanpham=<?php echo $id_sanpham1 ?>" method="POST" enctype="multipart/form-data">
                        <label for="tensp">Tên sản phẩm:</label><br>
                        <input type="text" name="tensp" id="tensp" value="<?php echo $data1['ten_sanpham'] ?>"><br>
                        <label for="loaisp">Loại sản phẩm:</label><br>
                        <select name="loaisp" id="loaisp">
                            <?php while ($data2 = mysqli_fetch_assoc($query_lp)) {
                                if ($data1['loaisp'] == $data2['id_loaisp']) {
                            ?>
                                    <option value="<?php echo $data2['id_loaisp'] ?>" selected><?php echo $data2['ten_loaisp'] ?></option>
                                <?php }
                                if ($data1['loaisp'] != $data2['id_loaisp']) { ?>
                                    <option value="<?php echo $data2['id_loaisp'] ?>"><?php echo $data2['ten_loaisp'] ?></option>
                            <?php ;
                                }
                            } ?>
                        </select><br>
                        <label for="mota">Mô tả sản phẩm:</label><br>
                        <textarea type="text" name="mota" id="mota" cols="40" rows="5"><?php echo $data1['mota'] ?> </textarea><br>
                        <label for="gia">Giá tiền:</label><br>
                        <input type="text" name="gia" id="gia" value="<?php echo $data1['gia'] ?>"><br>
                        <label for="trangthai">Trạng thái:</label><br>
                        <select name="trangthai" id="trangthai">
                            <?php
                            if ($data1['trangthai'] == 1) { ?>
                                <option value="1" selected>Còn hàng</option>
                                <option value="0">Hết hàng</option>
                            <?php
                            } else if ($data1['trangthai'] == 0) { ?>
                                <option value="1">Còn hàng</option>
                                <option value="0" selected>Hết hàng</option>
                            <?php }; ?>
                        </select><br>
                        <label for="soluong">Số lượng</label><br>
                        <input type="text" name="soluong" id="soluong" value="<?php echo $data1['soluong'] ?>"><br>
                        <label for="images">Ảnh sản phẩm:</label><br>
                        <input type="file" name="images" name="images" id="images"><br>
                        <?php echo $data1['images'] ?>
                        <img src="/project/upload/<?php echo $data1['images'] ?>" alt="">
                        <br>
                        <button><a href="" id="boanh" onclick="boanh(<?php echo $id_sanpham1 ?>)">Bỏ ảnh</a></button>
                        <br> <br>
                        <button type="submit" name="submit">Thực hiện</button>
                    </form>
                    <button type="submit" onclick="window.history.back(-1)">Trở lại</button>
                </div>
            <?php } else if ($action == 'repass') {
            $id_user = $_GET['id-user']; ?>
                <div>
                    <h3>Đặt lại mật khẩu</h3>
                    <form action="xuli-qltk.php?action=repass&id-user=<?php echo $id_user ?>" method="POST">
                        <label for="">Password mới</label>
                        <input type="text" name="password" id="password">
                        <button type="submit">Thực hiện</button>
                    </form>
                    <button type="submit" onclick="window.history.back(-1)">Trở lại</button>
                </div>
            </div>

        <?php } ?>