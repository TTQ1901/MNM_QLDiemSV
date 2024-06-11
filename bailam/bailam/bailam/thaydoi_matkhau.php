<?php
// Kết nối tới cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quan_ly_diem";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối không thành công: " . $conn->connect_error);
}

// Lấy dữ liệu từ form
$ma_sv = $_POST['ma_sv'];
$matkhau_cu = $_POST['matkhau_cu'];
$matkhau_moi = $_POST['matkhau_moi'];

// Kiểm tra mật khẩu cũ
$sql = "SELECT * FROM sinhvien WHERE ma_sv = '$ma_sv' AND passwordsv = '$matkhau_cu'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mật khẩu cũ chính xác, tiến hành cập nhật mật khẩu mới
    $update_sql = "UPDATE sinhvien SET passwordsv = '$matkhau_moi' WHERE ma_sv = '$ma_sv'";
    if ($conn->query($update_sql) === TRUE) {
        echo "Thay đổi mật khẩu thành công!";
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    echo "Mật khẩu cũ không chính xác!";
}

$conn->close();
?>