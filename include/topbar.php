
<div class="top-bar">
            <div class="log-field">
                <?php if(!isset($_SESSION['user'])){
                   ?>
                    <div>
                <div>
                    <a href="signup.php"><button>Đăng ký</button></a>
                </div>
                <div>
                <a href="signin.php"><button>Đăng nhập</button></a>
                </div>
                </div>
                <?php
                }
                else if(isset($_SESSION['user'])){ 
                    $data = $_SESSION['user'];?>
                    <div>
                        Xin chào, <?php echo $data['hoten'] ?> 
                    <a class="qltk" href="index.php?id=quanlytaikhoan">Quản lý tài khoản</a>.
                    <a class="qltk" href="index.php?id=out">Đăng xuất</a>
                    </div>
                   <?php }?>
            </div>
        </div>