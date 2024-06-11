<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ma_sv = $_POST['ma_sv'];
    $passwordsv = $_POST['passwordsv'];

    // Kết nối cơ sở dữ liệu
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Kiểm tra thông tin đăng nhập
    $sql = "SELECT * FROM sinhvien WHERE ma_sv = '$ma_sv' AND passwordsv = '$passwordsv'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Lấy thông tin sinh viên
        $row = $result->fetch_assoc();
        $_SESSION['ma_sv'] = $row['ma_sv'];
        $_SESSION['hoten_sv'] = $row['hoten_sv'];

        // Chuyển hướng đến trang thông tin sinh viên
        header('Location: grades.php');
        exit();
    } else {
        $error = "Mã sinh viên hoặc mật khẩu không đúng!";
    }

    // Đóng kết nối
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Đăng nhập sinh viên</title>

  <!-- Custom fonts for this template-->
  <link href="bootstraps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="bootstraps/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Đăng nhập sinh viên</div>
      <div class="card-body">
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form action="login.php" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" name="ma_sv" id="inputMaSV" class="form-control" placeholder="Mã sinh viên" required="required" autofocus="autofocus">
              <label for="inputMaSV">Mã sinh viên</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" name="passwordsv" id="inputPassword" class="form-control" placeholder="Mật khẩu" required="required">
              <label for="inputPassword">Mật khẩu</label>
            </div>
          </div>
          <input type="submit" name="login" class="btn btn-primary btn-block" value="Đăng nhập">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="index.php?controllers=login&action=quen_mk">Quên mật khẩu?</a>
        </div>
      </div>
    </div>
  </div>

  
  <!-- Bootstrap core JavaScript-->
  <script src="bootstraps/vendor/jquery/jquery.min.js"></script>
  <script src="bootstraps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="bootstraps/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>