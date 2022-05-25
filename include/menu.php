<?php
$sql_loaisp = "SELECT * FROM tbl_phanloaisp ORDER BY id_loaisp ";
$query = mysqli_query($con, $sql_loaisp);
?>
<script>
    function phanloai(loaisp, page) {
        $.ajax({
            url: "hienthi-sp-ajax-phanloai.php",
            type: "GET",
            cache: false,
            data: {
                page_no: page,
                loaisp: loaisp
            },
            beforeSend: function() {
                $("#overlay").show();
                $("#main").hide();
            },
            success: function(response) {
                $("#data").html(response);
                setInterval(function() {
                    $("#overlay").hide();
                }, 500);
            }
        });
        $(document).on("click", ".page-link", function(e) {
            e.preventDefault();
            var pageId = $(this).attr("id");
            phanloai(loaisp, pageId);
        });
    }
</script>
<div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Trang chủ</a>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Phân loại</a>
                    <ul class="dropdown-menu">
                        <?php
                        while ($row_title = mysqli_fetch_array($query)) { ?>
                            <li>
                                <a class="dropdown-item" id="loaisp" onclick="phanloai(<?php echo $row_title['id_loaisp'] ?>,1)">
                                    <?php echo $row_title['ten_loaisp']; ?>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>
        </div>
    </nav>
</div>