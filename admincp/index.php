<?php
session_start();
include "config/config.php";
if (isset($_SESSION['admin']) == null) {
    header("location:login.php");
}
if (isset($_GET['action'])) {
    $actiondx = $_GET['action'];
    if ($actiondx == 'dangxuat') {
        session_destroy();
        header("location: login.php");
    }
}
$name = $_SESSION['admin']['name'];
$sql1 = "SELECT * FROM tbl_admin,tbl_permission WHERE tbl_admin.name = tbl_permission.name AND tbl_admin.name = '$name'";
$query1 = mysqli_query($con, $sql1);
$data1 = mysqli_fetch_assoc($query1);
$quyenquanlyadmin = explode(',', $data1['qladmin']);
$quyenquanlyuser = explode(',', $data1['qluser']);
$quyenquanlysanpham = explode(',', $data1['qlsp']);
$quyenquanlyhoadon = explode(',', $data1['qlhd']);
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aishop - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php include "include/sidebar.php" ?>
        <?php include "include/top-bar.php" ?>
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            switch ($id) {
                case 'quanlyadmin':
                    include "include/ql_admin.php";
                    break;
                case 'quanlyuser':
                    include "include/ql-taikhoan-kh.php";
                    break;
                case 'quanlysanpham':
                    include "include/ql-sanpham.php";
                    break;
                case 'quanlyhoadon':
                    include "include/ql-hoadon.php";
                    break;
                case 'quanlydanhmuc':
                    include "include/ql_danhmuc.php";
                    break;
                case 'quanlybanner':
                    include "include/ql_banner.php";
                    break;
                case 'thongke':
                    include "include/thongke.php";
                    break;
                default:
                    include "include/ql-sanpham.php";
                    break;
            }
        } else 
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            switch ($id) {
                case 'quanlyadmin':
                    include "include/ql_admin.php";
                    break;
                case 'quanlyuser':
                    include "include/ql-taikhoan-kh.php";
                    break;
                case 'quanlysanpham':
                    include "include/ql-sanpham.php";
                    break;
                case 'quanlyhoadon':
                    include "include/ql-hoadon.php";
                    break;
                case 'thongke':
                    include "include/thongke.php";
                    break;
                default:
                    include "include/ql-sanpham.php";
                    break;
            }
        } else include "include/ql-sanpham.php"
        ?>


    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    <script src="js/demo/chart-bar-demo.js"></script>
    <script src="js/chart.js"></script>
</body>

</html>