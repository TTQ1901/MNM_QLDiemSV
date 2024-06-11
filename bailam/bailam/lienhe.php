<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="styles/custom.css" rel="stylesheet">
</head>
<body>

<!-- Header -->
<?php include 'header.php'; ?>

<!-- Main Content -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Liên Hệ</h3>
                </div>
                <div class="card-body">
                    <p class="text-center">Chào mừng bạn đến với trang Liên Hệ của chúng tôi. Chúng tôi rất vui lòng được nghe từ bạn.</p>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="name">Họ và Tên:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Nội dung:</label>
                            <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Gửi</button>
                    </form>
                </div>
            </div>
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

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>