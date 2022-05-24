<div class="header container">
    <div class="row justify-content-evenly">

        <div class="logo col">
            <a href="index.php"><img src="./images/logo2.png" alt="logo"></a>
        </div>
        <div class="search-box col-6">
            <form action="index.php" method="GET">
                <input type="text" name="search" id="sr-field" placeholder="Bạn muốn tìm gì...">
                <button type="submit">
                    <p>Tìm Kiếm</p>
                </button>
            </form>
        </div>
        <div class="col d-flex align-items-center">

            <div class="shop-cart col-3">
                <a href="index.php?id=shop-cart"><img src="./images/shop-cart.png" alt="shop-cart"></a>
            </div>

            <!-- <div class="log-field"> -->
            <?php if (!isset($_SESSION['user'])) {
            ?>
                <div class=" col d-flex align-items-center justify-content-evenly">
                    <a href="index.php?id=signin" class="btn btn-warning">Đăng nhập</a>
                    <a class="btn btn-success" href="index.php?id=signup">Đăng ký</a>
                </div>
            <?php
            } else if (isset($_SESSION['user'])) {
                $data = $_SESSION['user']; ?>
                <div>
                    <div class="dropdown-toggle col-2" id="dropdownMenuButton" data-toggle="dropdown">
                        <img src="images/icon-user.png" alt="anhdaidien" class="user-icon">
                        <?php echo $data['hoten'] ?>
                    </div>
                    <div class="dropdown">
                        <a class="dropdown-item" href="index.php?id=quanlytaikhoan">Quản lý tài khoản</a>.
                        <a class="dropdown-item" href="index.php?id=out">Đăng xuất</a>
                    </div>
                </div>
            <?php } ?>
            <!-- </div> -->
        </div>
    </div>
</div>