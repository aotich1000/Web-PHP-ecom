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
<div class="menu">
  <ul>
    <li class="item-menu"><a href="index.php">Trang chủ</a></li>
    <li class="item-menu"> <a href="index.php?search="> Phân loại </a>
      <div class="dropdown">
        <ul>
          <?php
          while ($row_title = mysqli_fetch_array($query)) { ?>
            <li>
              <a id="loaisp" onclick="phanloai(<?php echo $row_title['id_loaisp'] ?>,1)">
                <?php echo $row_title['ten_loaisp']; ?>
              </a>
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </li>
  </ul>
</div>