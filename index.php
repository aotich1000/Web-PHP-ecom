<?php
session_start();
include "./admincp/config/config.php";
// session_destroy();
if (isset($_GET['id'])) {
    $temp = $_GET['id'];
    if ($temp == "out") {
        session_destroy();
        header('location:index.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/myjs.js" type="text/javascript"></script>

    <title>Ai shop</title>
</head>

<body class="container-fluid">
    <div id="overlay">
        <div><img src="images/loading.gif" width="64px" height="64px" /></div>
    </div>
    <?php include "include/topbar.php"; ?>
    <?php include "include/header.php"; ?>
    <?php include "include/menu.php"; ?>
    <div class="conteiner" id="data">
    </div>
    <div id="main" id="main">
        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            if ($id == 'chitiet-sp') {
                include "include/chitiet-sp.php";
            }
            if ($id == 'quanlytaikhoan') {
                include "include/quanlytaikhoan.php";
            }
            if ($id == 'signin') {
                include "include/sign-in.php";
            }
            if ($id == 'signup') {
                include "include/sign-up.php";
            }
            if ($id == 'shop-cart') {
                include "include/shop-cart.php";
            }
        } else 
                if (isset($_GET['search'])) {
            include "include/hienthi-sp.php";
        } else {
            include "include/banner.php";
            include "include/sp-tieubieu.php";
        }
        ?>
        <div class="clear">
        </div>
    </div>
    <?php include "include/footer.php"; ?>
</body>

</html>