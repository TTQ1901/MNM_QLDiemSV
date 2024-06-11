<?php
session_start();
require_once 'config.php';

// Kiểm tra xem người dùng đã đăng nhập chưa
if (!isset($_SESSION['ma_sv'])) {
    header("Location: login.php");
    exit();
}

// Đặt một biến lỗi để hiển thị thông báo lỗi
$error = '';

// Xử lý form gửi đi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $ma_sv = $_SESSION['ma_sv'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Kiểm tra mật khẩu cũ
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Truy vấn để lấy mật khẩu hiện tại của người dùng
    $sql = "SELECT passwordsv FROM sinhvien WHERE ma_sv = '$ma_sv'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['passwordsv'];

        // Kiểm tra mật khẩu cũ
        if (password_verify($old_password, $hashed_password)) {
            // Mật khẩu cũ đúng, kiểm tra mật khẩu mới và xác nhận mật khẩu mới
            if ($new_password === $confirm_password) {
                // Mật khẩu mới hợp lệ, cập nhật mật khẩu trong cơ sở dữ liệu
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_sql = "UPDATE sinhvien SET passwordsv = '$hashed_new_password' WHERE ma_sv = '$ma_sv'";
                if ($conn->query($update_sql) === TRUE) {
                    $error = "Thay đổi mật khẩu thành công!";
                } else {
                    $error = "Lỗi khi cập nhật mật khẩu: " . $conn->error;
                }
            } else {
                $error = "Mật khẩu mới và xác nhận mật khẩu không khớp!";
            }
        } else {
            $error = "Mật khẩu cũ không đúng!";
        }
    } else {
        $error = "Không tìm thấy người dùng!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cài đặt</title>

    <!-- Custom fonts for this template-->
    <link href="bootstraps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="bootstraps/css/sb-admin.css" rel="stylesheet">
</head>
<body class="bg-dark">

<?php include 'header.php'; ?>

<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">Thay đổi mật khẩu</div>
        <div class="card-body">
            <?php if (!empty($error)) { ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php } ?>
            <form action="caidat.php" method="post">
                <div class="form-group">
                    <label for="old_password">Mật khẩu cũ</label>
                    <input type="password" name="old_password" id="old_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="new_password">Mật khẩu mới</label>
                    <input type="password" name="new_password" id="new_password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Xác nhận mật khẩu mới</label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Thay đổi mật khẩu</button>
            </form>
        </div>
    </div>
</div>


<!-- Footer -->
<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Liên Hệ</h5>
                <p>Địa chỉ: 140 Lê Trọng Tấn, Tây Thạnh, Tân Phú, Thành phố Hồ Chí Minh</p>
                <p>Số điện thoại: 0123-456-789</p>
            </div>
            <div class="col-md-6">
                <h5>Thông Tin</h5>
                <p>Một số thông tin khác về trường hoặc website.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript-->
<script src="bootstraps/vendor/jquery/jquery.min.js"></script>
<script src="bootstraps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="bootstraps/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>