<?php
include_once("controller/cSan.php");
$p = new cSan();

// Lấy mã chủ sân từ session
$maChuSan = $_SESSION['MaChuSan'];

// Lấy danh sách sân bóng theo mã chủ sân
$kq = $p->getAllSanBongByMaChuSan($maChuSan); // Lấy tất cả sân bóng của chủ sân

// Kiểm tra xem có dữ liệu hay không
if ($kq) {
    // Hiển thị tiêu đề và nút thêm sân mới
    echo "<div class='header-container'>
            <h1>Quản lý sân</h1>
            <a class='btn-add' href='?action=addSan'>Thêm sân mới</a>
        </div>";

    // Bắt đầu bảng hiển thị thông tin sân bóng
    echo "<table>";
    echo "<tr>
            <th>Mã sân bóng</th>
            <th>Tên sân bóng</th>
            <th>Thời gian hoạt động</th>
            <th>Mô tả</th>
            <th>Hình ảnh</th>
            <th>Nhân viên quản lý</th>
            <th>Loại sân</th>
            <th>Tên cơ sở</th>
            <th>Hành động</th>
          </tr>";

    // Duyệt qua từng sân bóng và hiển thị thông tin
    while ($r = mysqli_fetch_assoc($kq)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($r["MaSanBong"]) . "</td>"; // Sử dụng htmlspecialchars() để bảo vệ dữ liệu
        echo "<td>" . htmlspecialchars($r["TenSanBong"]) . "</td>";
        echo "<td>" . htmlspecialchars($r["ThoiGianHoatDong"]) . "</td>";
        echo "<td>" . htmlspecialchars($r["MoTa"]) . "</td>";

        // Hiển thị hình ảnh sân bóng nếu có
        $hinhAnh = !empty($r['HinhAnh']) ? htmlspecialchars($r['HinhAnh']) : 'default.jpg'; // Nếu không có hình ảnh, hiển thị hình mặc định
        echo "<td><img src='img/SanBong/$hinhAnh' width='100px' height='80px' alt='Hình ảnh sân bóng'/></td>";

        echo "<td>" . htmlspecialchars($r["TenNhanVien"]) . "</td>";
        echo "<td>" . htmlspecialchars($r["TenLoai"]) . "</td>";
        echo "<td>" . htmlspecialchars($r["TenCoSo"]) . "</td>";

        // Lấy mã sân bóng cho liên kết sửa và xóa
        $maSanBong = htmlspecialchars($r['MaSanBong']);
        
        // Sửa và Xóa
        echo "<td>
                <a href='?action=updateSanBong&MaSanBong=$maSanBong&MaChuSan=$maChuSan' class='edit-button'>Sửa</a>
                <a href='?action=deleteSanBong&MaSanBong=$maSanBong' class='delete-button' onclick='return confirm(\"Bạn chắc chắn muốn xóa sân này?\")'>Xóa</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // Thông báo nếu không có dữ liệu
    echo "<p>Không có dữ liệu sân bóng nào.</p>";
}
?>

<style>
    .header-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .header-container h1{
        background-color: #e0f2e9;
        color: #333;
        width: 100%;
        margin: 0;
        padding: 10px; 
        box-sizing: border-box;
    }
    .btn-add {
        background-color: #4CAF50; /* Màu nền xanh lá cây */
        color: white; /* Màu chữ trắng */
        padding: 10px 20px;
        text-align: center;
        align-items: right;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10px;
        margin-left: 80%;
        cursor: pointer;
        border: none;
        border-radius: 4px;
    }
    .edit-button {
    color: white;
    background-color: blue;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
}

.edit-button:hover {
    background-color: darkblue;
}

/* CSS for Delete button */
.delete-button {
    color: white;
    background-color: red;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
}

.delete-button:hover {
    background-color: darkred;
}
    </style>
    