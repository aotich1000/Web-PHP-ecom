<div class="dk-content">
    <?php
    if (isset($_GET['trangthai'])) {
        $result = $_GET['trangthai'];

        if ($result == 'dktk') {
            echo   '<script> alert("Bạn đã đăng ký thành công.")</script>';
        }
        if ($result == 'sai-tk-mk') {
            $err['false'] = "Tài khoản hoặc mât khẩu sai.";
        }
    }
    ?>
    <div class="sign-in">
        <div class="title-dk">
            <h1>Đăng nhập</h1>
        </div>

        <div class="sign-form">
            <form action="signin.php" method="POST" onsubmit="return ktdangnhap()">
                <div class="form-group">
                    <label for="username">Tên đăng nhập:</label> <br>
                    <input type="text" name="username" id="username" placeholder="Nhập tên đăng nhập">
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu:</label><br>
                    <input type="password" name="password" id="password" placeholder="Nhập mật khẩu"><br><br>
                    <div class="err-mess"> <span> <?php echo (isset($err['false'])) ? $err['false'] : '' ?></span> </div>
                </div>

                <div class="form-submit">
                    <input type="submit" id="submit" value="Đăng nhập" name="submit">
                </div>

        </div>
        </form>
        <div class="form-group">
            <a href="#">Quên mật khẩu?</a>
        </div>
        <div class="form-group">
            Bạn chưa có tài khoản?<a href="index.php?id=signup"> Đăng ký thành viên</a>
        </div>
    </div>