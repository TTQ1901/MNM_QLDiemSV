<?php
session_start();
if (!isset($_SESSION['ma_sv'])) {
    header("Location: login.php");
    exit();
}

include 'config.php'; // Bao gồm tệp cấu hình cơ sở dữ liệu

// Lấy mã sinh viên từ session
$ma_sv = $_SESSION['ma_sv'];

// Tạo kết nối tới cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn để lấy thông tin sinh viên
$sql_sv = "SELECT * FROM sinhvien WHERE ma_sv = '$ma_sv'";
$result_sv = $conn->query($sql_sv);

if ($result_sv->num_rows > 0) {
    $row_sv = $result_sv->fetch_assoc();
    $hoten_sv = $row_sv['hoten_sv'];
    $ngay_sinh_sv = $row_sv['ngay_sinh'];
    $gioi_tinh_sv = $row_sv['gioi_tinh'];
    $dan_toc_sv = $row_sv['dan_toc'];
    $noi_sinh_sv = $row_sv['noi_sinh'];
    $ma_lop_sv = $row_sv['ma_lop'];
} else {
    $hoten_sv = "Không tìm thấy tên sinh viên";
    $ngay_sinh_sv = "";
    $gioi_tinh_sv = "";
    $dan_toc_sv = "";
    $noi_sinh_sv = "";
    $ma_lop_sv = "";
}
$result_sv = $conn->query($sql_sv);

if ($result_sv->num_rows > 0) {
    $row_sv = $result_sv->fetch_assoc();
    $hoten_sv = $row_sv['hoten_sv'];
} else {
    $hoten_sv = "Không tìm thấy tên sinh viên";
}

// Truy vấn để lấy điểm của sinh viên
$sql = "SELECT monhocphan.ma_mon, monhocphan.ten_mon, monhocphan.sotinchi, diemhocphan.diem_giua_ky, diemhocphan.diem_thi_hp 
        FROM diemhocphan 
        JOIN monhocphan ON diemhocphan.ma_mon = monhocphan.ma_mon 
        WHERE diemhocphan.ma_sv = '$ma_sv'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Điểm của sinh viên</title>

    <!-- Custom fonts for this template-->
    <link href="bootstraps/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="bootstraps/css/sb-admin.css" rel="stylesheet">
</head>
<body id="page-top">

<!-- Header -->
<?php include 'header.php'; ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Điểm của bạn</h2>
        </div>
        <div class="card-body">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <!-- Khung ảnh đại diện -->
                        <img src="images/avatar.jpg" class="img-fluid rounded-circle" alt="Ảnh đại diện">
                    </div>
                        <!-- thông tin sinh viên -->
                    <div class="col-md-8">
                        <p><strong>Mã sinh viên:</strong> <?php echo $ma_sv; ?></p>
                        <p><strong>Họ và tên:</strong> <?php echo $hoten_sv; ?></p>
                        <p><strong>Ngày sinh:</strong> <?php echo $ngay_sinh_sv; ?></p>
                        <p><strong>Giới tính:</strong> <?php echo $gioi_tinh_sv; ?></p>
                        <p><strong>Dân tộc:</strong> <?php echo $dan_toc_sv; ?></p>
                        <p><strong>Nơi sinh:</strong> <?php echo $noi_sinh_sv; ?></p>
                        <p><strong>Lớp:</strong> <?php echo $ma_lop_sv; ?></p>
                        <p class="text-success">Đăng nhập thành công! Đây là bảng điểm của bạn:</p>

                        <table class="table table-bordered">
                        <thead>
    <tr>
        <th>STT</th>
        <th>Môn học</th>
        <th>Số tín chỉ</th>
        <th>Điểm giữa kỳ</th>
        <th>Điểm thi</th>
        <th>Điểm kết thúc môn</th>
        <th>Điểm chữ</th>
        <th>Xếp loại</th>
    </tr>
</thead>
<tbody>
    <?php
    $tong_tin_chi = 0; // Khởi tạo biến tổng số tín chỉ
    $tong_diem = 0; // Khởi tạo biến tổng điểm
    $stt = 0; // Khởi tạo biến số thứ tự
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $stt++; // Tăng số thứ tự lên 1 sau mỗi lần lặp
            $tong_tin_chi += $row["sotinchi"]; // Cộng dồn số tín chỉ
            $diem_giua_ky = $row["diem_giua_ky"];
            $diem_thi_hp = $row["diem_thi_hp"];
            $diem_ket_thuc = round(($diem_giua_ky * 0.3 + $diem_thi_hp * 0.7), 2);
            $diem_chu = ''; // Khởi tạo biến điểm chữ
            // Xác định điểm chữ dựa trên điểm kết thúc môn
            if ($diem_ket_thuc >= 8.5) {
                $diem_chu = 'A';
            } elseif ($diem_ket_thuc >= 7) {
                $diem_chu = 'B';
            } elseif ($diem_ket_thuc >= 5.5) {
                $diem_chu = 'C';
            } elseif ($diem_ket_thuc >= 4) {
                $diem_chu = 'D';
            } else {
                $diem_chu = 'F';
            }
            
            // Tính điểm số tương ứng với điểm chữ
            switch ($diem_chu) {
                case 'A':
                    $diem_so = 4.0;
                    break;
                case 'B':
                    $diem_so = 3.0;
                    break;
                case 'C':
                    $diem_so = 2.0;
                    break;
                case 'D':
                    $diem_so = 1.0;
                    break;
                default:
                    $diem_so = 0.0;
            }
            
            $tong_diem += $diem_so * $row["sotinchi"]; // Tính tổng điểm
            
            // Xác định xếp loại
            $xep_loai = ''; // Khởi tạo biến xếp loại
            switch ($diem_chu) {
                case 'A':
                    $xep_loai = 'Xuất sắc';
                    break;
                case 'B':
                    $xep_loai = 'Giỏi';
                    break;
                case 'C':
                    $xep_loai = 'Khá';
                    break;
                case 'D':
                    $xep_loai = 'Trung bình';
                    break;
                default:
                    $xep_loai = 'Yếu';
            }

            echo "<tr><td>" . $stt . "</td><td>" . $row["ten_mon"] . "</td><td>" . $row["sotinchi"] . "</td><td>" . $diem_giua_ky . "</td><td>" . $diem_thi_hp . "</td><td>" . $diem_ket_thuc . "</td><td>" . $diem_chu . "</td><td>" . $xep_loai . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='8' class='text-center'>Không có điểm</td></tr>";
    }
    
    // Tính điểm trung bình tích lũy
    if ($tong_tin_chi > 0) {
        $gpa = round($tong_diem / $tong_tin_chi, 2);
    } else {
        $gpa = 0.0;
    }
    ?>
</tbody>
<tfoot>
    <tr>
        <td colspan="2">Tổng số tín chỉ: <?php echo $tong_tin_chi; ?></td>
        <td colspan="6">Điểm trung bình tích lũy (GPA): <?php echo $gpa; ?></td>
    </tr>
</tfoot>
</div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->

<!-- Bootstrap core JavaScript-->
<script src="bootstraps/vendor/jquery/jquery.min.js"></script>
<script src="bootstraps/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="bootstraps/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>
</html>