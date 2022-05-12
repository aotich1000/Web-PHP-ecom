<?php
$sql = "SELECT * FROM tbl_admin";
$query = mysqli_query($con, $sql);

$action = (isset($_GET['action'])) ? $_GET['action'] : 'show';

$limit_pg = 12;
$row = mysqli_num_rows($query);
$page = ceil($row / $limit_pg);
if (isset($_GET['page'])) {
    $pg = $_GET['page'];
} else {
    $pg = 1;
}
$start = ($pg - 1) * $limit_pg;
$new_sql = "SELECT * FROM tbl_admin LIMIT $start,$limit_pg";
$newquery = mysqli_query($con, $new_sql);
if (isset($_GET['trangthai'])) {
    $trangthai = $_GET['trangthai'];
    if ($trangthai = 'themtk') {
?> <script>
            alert("Thao tác thành công");
            location.href = "index.php?id=quanlyadmin";
        </script> <?php
                }
            }

                    ?>

<script>
    function checkqladmin(quyen) {
        if (quyen == 'xem') {
            document.getElementById("qladx").checked = true;
        }
        if (quyen == 'them') {
            document.getElementById("qladt").checked = true;
        }
        if (quyen == 'repass') {
            document.getElementById("qladrp").checked = true;
        }
        if (quyen == 'xoa') {
            document.getElementById("qladd").checked = true;
        }
        if (quyen == 'setquyen') {
            document.getElementById("qladsq").checked = true;
        }
    }

    function checkqluser(quyen) {
        if (quyen == 'xem') {
            document.getElementById("qlkhx").checked = true;
        }
        if (quyen == 'them') {
            document.getElementById("qlkht").checked = true;
        }
        if (quyen == 'repass') {
            document.getElementById("qlkhrp").checked = true;
        }
        if (quyen == 'sua') {
            document.getElementById("qlkhs").checked = true;
        }
    }

    function checkqlsp(quyen) {
        if (quyen == 'xem') {
            document.getElementById("qlspx").checked = true;
        }
        if (quyen == 'them') {
            document.getElementById("qlspt").checked = true;
        }
        if (quyen == 'xoa') {
            document.getElementById("qlspd").checked = true;
        }
        if (quyen == 'sua') {
            document.getElementById("qlsps").checked = true;
        }
    }

    function checkqlhd(quyen) {
        if (quyen == 'xem') {
            document.getElementById("qlhdx").checked = true;
        }
        if (quyen == 'xuli') {
            document.getElementById("qlhdxl").checked = true;
        }
    }

    function checkthemtk() {
        var ten = document.getElementById("ten").value;
        var tendn = document.getElementById("tendn").value;
        var password = document.getElementById("password").value;
        if (ten == '' || tendn == '' || password == '') {
            alert("Yêu cầu nhập đủ thông tin vào text box");
        } else {
            var duongdan = "xuli-qladmin.php?action=themtk";
            document.getElementById("themtk").action = duongdan;
        }
    }

    function checkrepass(id) {
        var repass = document.getElementById("password").value;
        if (repass == '') {
            alert("Yêu cầu nhập đủ thông tin vào text box");
        } else {
            var duongdan = "xuli-qladmin.php?action=repass&id-user=" + id;
            document.getElementById("repass").action = duongdan;
        }
    }

    function xoa(id) {
        if (confirm("Bạn có muốn xóa chứ?")) {
            document.getElementById("xoa").href = "xuli-qladmin.php?action=xoa&&id-admin=" + id;
        } else {}
    }
</script>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản lý tài khoản Admin</h1>
    <?php if ($action == 'show') { ?>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?php for ($i = 0; $i < count($quyenquanlyadmin); $i++) {
                    if ($quyenquanlyadmin[$i] == 'them') {
                ?>
                        <a href="index.php?id=quanlyadmin&action=themtk" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-flag"></i>
                            </span>
                            <span class="text">Thêm mới tài khoản</span>
                        </a>
                <?php }
                } ?>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID Admin</th>
                                <th>Tên</th>
                                <th>Tên tài khoản</th>
                                <th>Thao tác thêm</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($data = mysqli_fetch_assoc($newquery)) {
                            ?>
                                <tr>
                                    <td><?php echo $data['id_admin'] ?></td>
                                    <td><?php echo $data['name'] ?></td>
                                    <td><?php echo $data['user_name'] ?></td>
                                    <td>
                                        <?php for ($i = 0; $i < count($quyenquanlyadmin); $i++) {
                                            if ($quyenquanlyadmin[$i] == 'repass') {
                                        ?>
                                                <a href="index.php?id=quanlyadmin&action=repass&id-admin=<?php echo $data['id_admin'] ?>" style="margin-right:5px" class="btn btn-info"> Đặt lại mật khẩu</a> <?php }
                                                                                                                                                                                                        } ?>
                                        <?php for ($i = 0; $i < count($quyenquanlyadmin); $i++) {
                                            if ($quyenquanlyadmin[$i] == 'xoa') {
                                        ?>
                                                <a href="" id="xoa" onclick="xoa(<?php echo $data['id_admin'] ?>)" class="btn btn-danger" style="margin-right:5px"> Xóa</a> <?php }
                                                                                                                                                                    } ?>
                                        <?php for ($i = 0; $i < count($quyenquanlyadmin); $i++) {
                                            if ($quyenquanlyadmin[$i] == 'setquyen') {
                                        ?>
                                                <a href="index.php?id=quanlyadmin&action=setquyen&id-admin=<?php echo $data['name'] ?>" class="btn btn-success btn-icon-split">
                                                    <span class="text">Thiết lập quyền</span>
                                                </a> <?php }
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

                                        <li class="paginate_button page-item <?php echo $active ?> "><a href="index.php?id=quanlyadmin&page=<?php echo $i ?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $i ?></a></li>
                                    <?php } else {
                                    ?>
                                        <li class="paginate_button page-item"><a href="index.php?id=quanlyadmin&page=<?php echo $i ?>" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link"><?php echo $i ?></a></li>
                                <?php }
                                }
                                ?>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    <?php }
    if ($action == "themtk") { ?>
        <div>
            <h3>Thêm tài khoản mới</h3>
            <form action="" method="POST" id="themtk" onsubmit="return checkthemtk()">
                <label for="ten">Tên:</label><br>
                <input type="text" name="ten" id="ten"> <br>
                <label for="tendn">Tên tài khoản:</label><br>
                <input type="text" name="tendn" id="tendn"><br>
                <label for="password">Password</label><br>
                <input type="text" name="password" id="password"><br>
                <button type="submit">Thực hiện</button>
            </form>
            <br>
            <button type="submit" onclick="window.history.back(-1)">Trở lại</button>
        </div>
    <?php } else if ($action == 'repass') {
        $id_user = $_GET['id-admin']; ?>
        <div>
            <h3>Đặt lại mật khẩu</h3>
            <form action="" id="repass" onsubmit="return checkrepass(<?php echo $id_user ?>)" method="POST">
                <label for="">Password mới</label>
                <input type="text" name="password" id="password">
                <button type="submit">Thực hiện</button>
            </form>
            <button type="submit" onclick="window.history.back(-1)">Trở lại</button>
        </div>
</div>
<?php } else if ($action == 'setquyen') {
        $id = $_GET['id-admin'];
        $sql1 = "SELECT * FROM tbl_admin,tbl_permission WHERE tbl_admin.name = tbl_permission.name AND tbl_admin.name = '$id'";
        $query1 = mysqli_query($con, $sql1);
        $data1 = mysqli_fetch_assoc($query1);
        $quyenquanlyadmin = explode(',', $data1['qladmin']);
        $quyenquanlyuser = explode(',', $data1['qluser']);
        $quyenquanlysanpham = explode(',', $data1['qlsp']);
        $quyenquanlyhoadon = explode(',', $data1['qlhd']);
?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Admin</th>
                            <th>Tên</th>
                            <th>Quản lý admin</th>
                            <th>Quản lý tài khoản khách hàng</th>
                            <th>Quản lý sản phẩm</th>
                            <th>Quản lý hóa đơn</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><?php echo $data1['id_admin'] ?></th>
                            <th><?php echo $data1['name'] ?></th>
                            <form action="xuli-qladmin.php?action=setquyen" method="POST">
                                <th>
                                    <input type="checkbox" id="qladx" name="qladx" value="xem"> Xem<br>
                                    <input type="checkbox" id="qladt" name="qladt" value="them"> Thêm tài khoản<br>
                                    <input type="checkbox" id="qladrp" name="qladrp" value="repass"> Đặt lại mật khẩu <br>
                                    <input type="checkbox" id="qladd" name="qladd" value="xoa"> Xóa <br>
                                    <input type="checkbox" id="qladsq" name="qladsq" value="setquyen"> Thiết lập quyền <br>
                                </th>
                                <th>
                                    <input type="checkbox" id="qlkhx" name="qlkhx" value="xem"> Xem<br>
                                    <input type="checkbox" id="qlkht" name="qlkht" value="them"> Thêm tài khoản<br>
                                    <input type="checkbox" id="qlkhrp" name="qlkhrp" value="repass"> Đặt lại mật khẩu <br>
                                    <input type="checkbox" id="qlkhs" name="qlkhs" value="sua"> Sửa<br>
                                </th>
                                <th>
                                    <input type="checkbox" id="qlspx" name="qlspx" value="xem"> Xem<br>
                                    <input type="checkbox" id="qlspt" name="qlspt" value="them"> Thêm sản phẩm<br>
                                    <input type="checkbox" id="qlspd" name="qlspd" value="xoa"> Xóa <br>
                                    <input type="checkbox" id="qlsps" name="qlsps" value="sua"> Sửa<br>
                                </th>
                                <th>
                                    <input type="checkbox" id="qlhdx" name="qlhdx" value="xem"> Xem<br>
                                    <input type="checkbox" id="qlhdxl" name="qlhdxl" value="xuli"> Xử lí<br>
                                </th>

                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="name" id="name" value="<?php echo $data1['name'] ?>">
                <button type="submit">Hoàn tất phân quyền</button>
                </form>
                <button type="submit" onclick="window.history.back(-1)">Trở lại</button>
                <?php
                for ($i = 0; $i < count($quyenquanlyadmin); $i++) {
                ?>
                    <script>
                        checkqladmin('<?php echo $quyenquanlyadmin[$i] ?>')
                    </script>
                <?php
                }
                for ($i = 0; $i < count($quyenquanlyuser); $i++) {
                ?>
                    <script>
                        checkqluser('<?php echo $quyenquanlyuser[$i] ?>')
                    </script>
                <?php
                }
                for ($i = 0; $i < count($quyenquanlysanpham); $i++) {
                ?>
                    <script>
                        checkqlsp('<?php echo $quyenquanlysanpham[$i] ?>')
                    </script>
                <?php
                }
                for ($i = 0; $i < count($quyenquanlyhoadon); $i++) {
                ?>
                    <script>
                        checkqlhd('<?php echo $quyenquanlyhoadon[$i] ?>')
                    </script>
            <?php
                }
            } ?>