<div class="top-bar">
    <!-- <div class="log-field">
        <?php if (!isset($_SESSION['user'])) {
        ?>
            <div>
                <div>
                    <a href="index.php?id=signup"><button>Đăng ký</button></a>
                </div>
                <div>
                    <a href="index.php?id=signin"><button>Đăng nhập</button></a>
                </div>
            </div>
        <?php
        } else if (isset($_SESSION['user'])) {
            $data = $_SESSION['user']; ?>
            <div>
                <div class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="images/icon-user.png" alt="anhdaidien" class="user-icon">
                    <?php echo $data['hoten'] ?>
                </div>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="index.php?id=quanlytaikhoan">Quản lý tài khoản</a>
                    <a class="dropdown-item" href="index.php?id=out">Đăng xuất</a>
                </div>
            </div>
        <?php } ?>
    </div> -->
</div>