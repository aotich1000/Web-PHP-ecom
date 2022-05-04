
<?php   
session_start();
include "./admincp/config/config.php";

if(isset($_GET['id'])){
 $temp = $_GET['id'];
 if($temp=="out"){
     session_destroy();
     header('location:index.php');
 }}
 
 ?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/myjs.js" type="text/javascript"></script>
    <title>Ai shop</title>
</head>
<body>
    <script>
        
    </script>
    <div class="wrapper">
    <div id="overlay"><div><img src="images/loading.gif" width="64px" height="64px"/></div></div>
        <?php include "include/topbar.php"; ?>
        <?php   include "include/header.php"; ?>
        <?php   include "include/menu.php";?>
        <div class="conteiner" id="data">
        </div>
        <div id="main" id="main">
             <?php 
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    
                    if($id == 'chitiet-sp'){
                        include "include/chitiet-sp.php";
                    }if($id == 'quanlytaikhoan'){
                        include "include/quanlytaikhoan.php";
                    }
                } else 
                if(isset($_GET['search'])){
                    include "include/hienthi-sp.php";
                }
                else{
                    include "include/banner.php";
                    include "include/sp-tieubieu.php";
                }
            ?>
             <div class="clear">
            </div>
        </div>

       
      
        <?php include "include/footer.php";?>
       
        
        
    </div>
</body>
</html>