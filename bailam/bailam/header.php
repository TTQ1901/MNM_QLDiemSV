<!-- header.php -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<a href="grades.php" class="btn btn-primary">Xem điểm sinh viên</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="grades.php">Trang Chủ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="lienhe.php">Liên Hệ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gioithieu.php">Giới Thiệu</a>
      </li>
    </ul>
  </div>
  <ul class="navbar-nav ml-auto"> 
        <li class="nav-item">
            <a class="nav-link" href="thaydoi_matkhau.html">Cài đặt</a>
        </li>
        <li class="nav-item">
            <!-- Sử dụng một JavaScript để xác nhận hành động từ người dùng trước khi đăng xuất -->
            <a class="nav-link" href="javascript:void(0);" onclick="confirmLogout()">Đăng xuất</a>
        </li>
    </ul>
</nav>

<!-- JavaScript để xác nhận đăng xuất -->
<script>
    function confirmLogout() {
        if (confirm("Bạn có chắc muốn đăng xuất không?")) {
            window.location.href = "login.php"; // Chuyển hướng đến trang logout.php khi người dùng đồng ý đăng xuất
        }
    }
</script>