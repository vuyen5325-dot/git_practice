<?php
// Kết nối database
$pdo = new PDO("mysql:host=localhost;dbname=baitap;charset=utf8mb4", "root", "");

// Câu 1: Tạo bảng danh sách sinh viên
$pdo->exec("CREATE TABLE IF NOT EXISTS DanhSachSinhVien (
    MaSinhVien VARCHAR(10) PRIMARY KEY,
    HoTen VARCHAR(100),
    NgaySinh DATE,
    LopHoc VARCHAR(50),
    DiemTrungBinh FLOAT
)");

// Câu 2: Thêm 5 sinh viên mới (xóa bảng cũ trước để tránh trùng lặp)
$pdo->exec("TRUNCATE TABLE DanhSachSinhVien");
$pdo->exec("INSERT INTO DanhSachSinhVien VALUES ('SV001', 'Nguyen Van A', '2004-01-01', 'CNTT1', 7.0)");
$pdo->exec("INSERT INTO DanhSachSinhVien VALUES ('SV002', 'Tran Thi B', '2004-02-02', 'CNTT1', 8.0)");
$pdo->exec("INSERT INTO DanhSachSinhVien VALUES ('SV003', 'Le Van C', '2004-03-03', 'CNTT2', 6.5)");
$pdo->exec("INSERT INTO DanhSachSinhVien VALUES ('SV004', 'Pham Thi D', '2004-04-04', 'CNTT2', 9.0)");
$pdo->exec("INSERT INTO DanhSachSinhVien VALUES ('SV005', 'Hoang Van E', '2004-05-05', 'CNTT3', 5.5)");

// Câu 3: Cập nhật điểm SV001 thành 8.5
$pdo->exec("UPDATE DanhSachSinhVien SET DiemTrungBinh = 8.5 WHERE MaSinhVien = 'SV001'");

// Câu 4: Xóa sinh viên SV003
$pdo->exec("DELETE FROM DanhSachSinhVien WHERE MaSinhVien = 'SV003'");

// Câu 5: Tạo bảng lịch sử giao dịch
$pdo->exec("CREATE TABLE IF NOT EXISTS LichSuGiaoDich (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    NgayGiaoDich DATETIME DEFAULT CURRENT_TIMESTAMP,
    LoaiGiaoDich VARCHAR(50),
    SoTien DECIMAL(15, 2),
    MoTa TEXT
)");

// Hiển thị kết quả để kiểm tra
echo "<h3>DANH SACH SINH VIEN:</h3>";
$du_lieu = $pdo->query("SELECT * FROM DanhSachSinhVien");
foreach ($du_lieu as $dong) {
    echo $dong['MaSinhVien'] . " | " . $dong['HoTen'] . " | Lop: " . $dong['LopHoc'] . " | Diem: " . $dong['DiemTrungBinh'] . "<br>";
}

$pdo = null;
?>