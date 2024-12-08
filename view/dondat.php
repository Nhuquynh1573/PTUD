<?php
ob_start();
include_once("controller/cDonDatSan.php");
$p = new cDonDatSan();
$kq = $p->GetALLDonDatSan(); // Gọi phương thức GetALLDonDatSan từ controller

?>

<div class="header-container">
    <h1>Quản lý đơn đặt sân</h1>
</div>

<?php
if ($kq && mysqli_num_rows($kq) > 0) {
    echo "<table>";
    echo "<tr>
            <th>Mã đơn</th>
            <th>Mã Khách Hàng</th>
            <th>Tên Khách Hàng</th>
            <th>Tên Sân</th>
            <th>Giờ Bắt Đầu</th>
            <th>Giờ Kết Thúc</th>
            <th>Tổng Tiền</th>
            <th>Trạng Thái</th>
            <th>Hành động</th>
          </tr>";

    while ($r = mysqli_fetch_assoc($kq)) {
        echo "<tr>";
        echo "<td>" . $r["MaDonDatSan"] . "</td>";
        echo "<td>" . $r["MaKhachHang"] . "</td>";
        echo "<td>" . $r["TenKhachHang"] . "</td>";
        echo "<td>" . $r["TenSanBong"] . "</td>";
        echo "<td>" . $r["GioBatDau"] . "</td>";
        echo "<td>" . $r["GioKetThuc"] . "</td>";
        echo "<td>" . $r["TongTien"] . "</td>";
        echo "<td>" . $r["TrangThai"] . "</td>";
        echo "<td>
        <a class='edit-button' href='?editDon=" . $r["MaDonDatSan"] . "'>Sửa</a>
        <form method='post' style='display: inline-block;' onsubmit='return confirmDelete()'>
            <input type='hidden' name='id' value='" . $r["MaDonDatSan"] . "'>
            <button type='submit' name='delete' class='delete-button'>Xóa</button>
        </form>";
        if ($r["TrangThai"] != "Đã đặt") {
            echo "<a class='indon-button' href='?printDon=" . $r["MaDonDatSan"] . "'>Duyệt</a>";
        }
        echo "</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>Không có đơn đặt sân nào!</p>";
}

// Xử lý xóa đơn đặt sân
if (isset($_POST["delete"])) {
    $maDonDatSan = $_POST["id"]; // Lấy giá trị id từ form
    $kq = $p->deletedatsan($maDonDatSan); // Gọi hàm delete từ controller
    if ($kq) {
        echo "<p style='color: green;'>Đơn đặt sân đã được xóa thành công!</p>";
        header("Location: ?dondat");
        ob_end_flush();
        exit();
    } else {
        echo "<p style='color: red;'>Không thể xóa đơn đặt sân. Vui lòng thử lại!</p>";
    }
}
?>

<style>
    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .header-container h1 {
        font-size: 24px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        text-align: center;
        padding: 10px;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .edit-button, .delete-button, .indon-button {
        padding: 5px 10px;
        color: white;
        text-decoration: none;
        border-radius: 3px;
        font-size: 14px;
        display: inline-block;
        margin: 0 5px;
    }

    .edit-button {
        background-color: #007bff;
    }

    .edit-button:hover {
        background-color: #0056b3;
    }

    .delete-button {
        background-color: #dc3545;
    }

    .delete-button:hover {
        background-color: #b21f2d;
    }

    .indon-button {
        background-color: #28a745;
    }

    .indon-button:hover {
        background-color: #218838;
    }
</style>

<script>
    function confirmDelete() {
        return window.confirm("Bạn có chắc chắn muốn xóa đơn đặt sân này không?");
    }

    // Kiểm tra trước khi gửi form
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function (e) {
            const gioBatDau = document.querySelector('[name="txtGioBatDau"]');
            const gioKetThuc = document.querySelector('[name="txtGioKetThuc"]');
            if (gioBatDau && gioKetThuc && gioBatDau.value >= gioKetThuc.value) {
                alert('Giờ bắt đầu phải nhỏ hơn giờ kết thúc!');
                e.preventDefault(); // Ngăn gửi form
            }
        });
    });
</script>
