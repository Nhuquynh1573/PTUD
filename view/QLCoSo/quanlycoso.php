<?php
include_once("controller/cCoSo.php");
$p = new cCoSo();

// Lấy mã chủ sân từ session
$maChuSan = $_SESSION['MaChuSan'];


// Lấy danh sách sân bóng theo mã chủ sân
$kq = $p->GetCoSoByMaChuSan($maChuSan); // Lấy tất cả sân bóng của chủ sân

// Kiểm tra xem có dữ liệu hay không
if ($kq) {
    // Hiển thị tiêu đề và nút thêm sân mới
    echo "<div class='header-container'>
            <h1>Quản lý sân</h1>
            <a class='btn-add' href='?action=addCoSo'>Thêm Cơ Sở mới</a>
        </div>";

    // Bắt đầu bảng hiển thị thông tin sân bóng
    echo "<table>";
    echo "<tr>
            <th>Mã Cơ Sở</th>
            <th>Tên Cơ Sở</th>
            <th>Địa Chỉ</th>
            <th>Mô tả</th>
            <th>Tên Chủ Sân</th>
            <th>Thao Tác</th>
            
          </tr>";

    // Duyệt qua từng sân bóng và hiển thị thông tin
    while ($r = mysqli_fetch_assoc($kq)) {
        
        echo "<tr>";
        echo "<td>" . htmlspecialchars($r["MaCoSo"]) . "</td>"; // Sử dụng htmlspecialchars() để bảo vệ dữ liệu
        echo "<td>" . htmlspecialchars($r["TenCoSo"]) . "</td>";
        echo "<td>" . htmlspecialchars($r["DiaChi"]) . "</td>";
        echo "<td>" . htmlspecialchars($r["MoTa"]) . "</td>";
              
        echo "<td>" . htmlspecialchars($r["TenChuSan"]) . "</td>";    

        $maCoSo = htmlspecialchars($r['MaCoSo']);
        // Sửa và Xóa
        echo "<td>
                <a href='?action=updateCoSo&MaCoSo=$maCoSo&MaChuSan=$maChuSan' class='edit-button'>Sửa</a>
                <a href='?action=deleteCoSo&MaCoSo=$maCoSo' class='delete-button' onclick='return confirm(\"Bạn chắc chắn muốn xóa cơ sở này?\")'>Xóa</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // Thông báo nếu không có dữ liệu
    echo "<p>Không có dữ liệu cơ sở nào.</p>";
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
    