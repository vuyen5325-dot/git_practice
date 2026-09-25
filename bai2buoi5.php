php
<?php
// Kết nối database 'baitap'
$pdo = new PDO("mysql:host=localhost;dbname=baitap;charset=utf8mb4", "root", "");

// BƯỚC 0: Tạo bảng và dữ liệu mẫu ban đầu
$pdo->exec("CREATE TABLE IF NOT EXISTS LichSuGiaoDich (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NgayGiaoDich DATE,
    LoaiGiaoDich VARCHAR(50),
    SoTien DECIMAL(15, 2),
    MoTa TEXT
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS DanhSachSanPham (
    MaSanPham VARCHAR(10) PRIMARY KEY,
    TenSanPham VARCHAR(100),
    GiaBan DECIMAL(15, 2),
    SoLuongTonKho INT
)");

$pdo->exec("TRUNCATE TABLE LichSuGiaoDich");
$pdo->exec("INSERT INTO LichSuGiaoDich (NgayGiaoDich, LoaiGiaoDich, SoTien, MoTa) VALUES 
    ('2023-01-01', 'Nạp tiền', 2000, 'Nạp tiền mặt'),
    ('2023-01-02', 'Chuyển khoản', 1500, 'Chuyển tiền cho bạn'),
    ('2023-01-03', 'Thanh toán', 800, 'Mua sắm online'),
    ('2023-01-04', 'Rút tiền', 300, 'Rút tiền mặt'),
    ('2023-01-05', 'Nạp tiền', 5000, 'Nhận lương')
");

$pdo->exec("TRUNCATE TABLE DanhSachSanPham");
$pdo->exec("INSERT INTO DanhSachSanPham VALUES 
    ('SP001', 'Laptop Dell', 15000000, 10),
    ('SP002', 'Chuột Logitech', 300000, 50),
    ('SP003', 'Bàn phím cơ', 800000, 30)
");

// BÀI TẬP
// 1. Thêm giao dịch mới
$pdo->exec("INSERT INTO LichSuGiaoDich (NgayGiaoDich, LoaiGiaoDich, SoTien, MoTa) 
            VALUES ('2023-05-07', 'rút tiền', 500, 'rút tiền ATM')");

// 2. Cập nhật số tiền giao dịch số thứ tự 3 thành 1000
$pdo->exec("UPDATE LichSuGiaoDich SET SoTien = 1000 WHERE ID = 3");

// 3. Xoá giao dịch số thứ tự 5
$pdo->exec("DELETE FROM LichSuGiaoDich WHERE ID = 5");

// 4. Tạo bảng sản phẩm (đã tạo ở Bước 0)

// 5. Thêm sản phẩm mới
$pdo->exec("INSERT INTO DanhSachSanPham VALUES 
    ('SP006', 'Điện thoại Samsung Galaxy A52', 6500000, 20)");

// Hiển thị kết quả
echo "<h3>BẢNG LỊCH SỬ GIAO DỊCH:</h3>";
$du_lieu1 = $pdo->query("SELECT * FROM LichSuGiaoDich");
foreach ($du_lieu1 as $dong) {
    echo "ID: " . $dong['ID'] . " | Ngày: " . $dong['NgayGiaoDich'] . " | Loại: " . $dong['LoaiGiaoDich'] . " | Số tiền: " . $dong['SoTien'] . " | Mô tả: " . $dong['MoTa'] . "<br>";
}

echo "<h3>BẢNG DANH SÁCH SẢN PHẨM:</h3>";
$du_lieu2 = $pdo->query("SELECT * FROM DanhSachSanPham");
foreach ($du_lieu2 as $dong) {
    echo "Mã: " . $dong['MaSanPham'] . " | Tên: " . $dong['TenSanPham'] . " | Giá: " . $dong['GiaBan'] . " | Tồn kho: " . $dong['SoLuongTonKho'] . "<br>";
}

$pdo = null;
?>