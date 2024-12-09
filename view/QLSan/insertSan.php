<?php 
  
  include_once("controller/cCoSo.php");
  $p = new cCoSo();
  $maChuSan = $_SESSION['MaChuSan'];
  $kq = $p->GetCoSoByMaChuSan($maChuSan);
    ob_start();
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

?>
<h2 align="center">Thêm Sân Bóng</h2>
<form action="" method="post" enctype="multipart/form-data" class="form-container">
    <div class="form-group">
        <label for="TenSan">Tên Sân Bóng</label>
        <input type="text" id="TenSan" name="TenSan" required placeholder="VD: Sân số 3. Cơ sơ Quang Trung">
        <small class="error-message" style="color: red; display: none;">Tên không hợp lệ!</small>
    </div>
    <div class="form-group">
        <label for="LoaiSan">Loại Sân</label>
        <select id="LoaiSan" name="LoaiSan" required onchange="updatePrice()">
        <?php
         
        
         include_once("controller/cLoaiSan.php");
         $pls = new cLoaiSan();
         $kqls = $pls->GetALLLoaiSan();
  
  
          if ($kqls) {
           // Lặp qua từng cơ sở và tạo các option
              while ($row = mysqli_fetch_assoc($kqls)) {
                 echo "<option value='{$row['MaLoaiSan']}'>{$row['TenLoai']}</option>";
          }
          } else {
                 echo "<option value=''>Không có loại sân nào</option>";
         }
  ?>
        </select>
    </div>
    
    <div class="form-group">
    <label for="GiaThueSang">Giá thuê sân</label>
    <p>Sáng: <input type="text" id="GiaThueSang" name="GiaThueSang" readonly> VND</p>
    <p>Chiều: <input type="text" id="GiaThueChieu" name="GiaThueChieu" readonly> VND</p>
    </div>


    
    <div class="form-group">
        <label for="MoTaSan">Mô Tả Sân</label>
        <textarea id="MoTaSan" name="MoTaSan" placeholder="Mô tả sân (ví dụ: có đèn chiếu sáng, phòng thay đồ...)"></textarea>
    </div>
    <div class="form-group">
    <label for="GioMoCua">Giờ mở cửa:</label>
        <input type="time" id="GioBatDau" name="GioMoCua"  required>

        <label for="GioKetThuc">Giờ đóng cửa:</label>
        <input type="time" id="GioDongCua" name="GioDongCua"  required>
        <small class="error-message" style="color: red; display: none;">Thời gian không hợp lệ!</small>
    </div>
    <div class="form-group">
        <label for="MaNhanVien">Nhân Viên Quản Lí</label>
        <select id="MaNhanVien" name="MaNhanVien" required>
       
        <?php
         
        
       include_once("controller/cNhanVien.php");
       $pnv = new cNhanVien();
       $kqnv = $pnv->getNhanVienByMaChuSan($maChuSan);


        if ($kqnv) {
         // Lặp qua từng cơ sở và tạo các option
            while ($row = mysqli_fetch_assoc($kqnv)) {
               echo "<option value='{$row['MaNhanVien']}'>{$row['TenNhanVien']}</option>";
        }
        } else {
               echo "<option value=''>Không có nhân viên nào</option>";
       }
?>
        </select>
    </div>
    <div class="form-group">
    <label for="MaCoSo">Cơ Sở</label>
    <select id="MaCoSo" name="MaCoSo" required>
        <?php

        // Tạo đối tượng cCoSo và lấy danh sách cơ sở
      

        if ($kq) {
            // Lặp qua từng cơ sở và tạo các option
            while ($row = mysqli_fetch_assoc($kq)) {
                echo "<option value='{$row['MaCoSo']}'>{$row['TenCoSo']}</option>";
            }
        } else {
            echo "<option value=''>Không có cơ sở nào</option>";
        }
        ?>
    </select>
</div>

    <div class="form-group">
        <label for="AnhSan">Hình Ảnh Sân</label>
        <input type="file" id="AnhSan" name="AnhSan" accept="image/*">
    </div>
    <div class="form-group" style="display: flex; justify-content: space-between;">
        <input type="submit" name="btnThemSan" value="Thêm Sân">
        <input type="reset" value="Hủy" onclick="history.back();">
    </div>
        

</div>

</form>


    <script>

        document.addEventListener("DOMContentLoaded", function () {
    // Lấy các phần tử DOM
    const errorMessage = document.querySelector(".error-message");
    const form = document.querySelector(".form-container");
    const thoiGianHoatDongInput = document.getElementById("ThoiGianHoatDong");
    const tenSanInput = document.getElementById("TenSan");
    const loaiSanSelect = document.getElementById("LoaiSan");
    const giaThueSang = document.getElementById("GiaThueSang");
    const giaThueChieu = document.getElementById("GiaThueChieu");

    // Hàm cập nhật giá thuê dựa vào loại sân
    function updatePrice() {
        const maLoaiSan = loaiSanSelect.value;

        switch (maLoaiSan) {
            case "1":
                giaThueSang.value = "100,000";
                giaThueChieu.value = "120,000";
                break;
            case "2":
                giaThueSang.value = "150,000";
                giaThueChieu.value = "170,000";
                break;
            case "3":
                giaThueSang.value = "200,000";
                giaThueChieu.value = "250,000";
                break;
            default:
                giaThueSang.value = "...";
                giaThueChieu.value = "...";
                break;
        }
    }

    // Gọi hàm để cập nhật giá khi trang được tải
    updatePrice();

    // Gán sự kiện khi người dùng thay đổi loại sân
    loaiSanSelect.addEventListener("change", updatePrice);
    // Hàm kiểm tra tên sân hợp lệ
    function validateTenSan() {
        const tenSanValue = tenSanInput.value.trim();
        const errorElement = document.querySelector(".error-message");

        if (tenSanValue === "" || tenSanValue.length < 3) {
            tenSanInput.style.border = "2px solid red"; // Viền đỏ nếu không hợp lệ
            errorElement.style.display = "block";
            errorElement.innerText = "Tên sân phải có ít nhất 3 ký tự!";
            return false;
        } else {
            tenSanInput.style.border = "2px solid green"; // Viền xanh nếu hợp lệ
            errorElement.style.display = "none";
            return true;
        }
    }

    // Hàm kiểm tra thời gian hoạt động hợp lệ
        function validateThoiGianHoatDong() {
        const value = thoiGianHoatDongInput.value.trim();
        const errorElement = thoiGianHoatDongInput.nextElementSibling;

        // Điều chỉnh regex để hỗ trợ định dạng giờ từ 1 chữ số hoặc 2 chữ số
        const regex = /^([1-9]|1[0-9]|2[0-3]):[0-5][0-9]\s-\s([1-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;

        // Kiểm tra định dạng thời gian
        if (!regex.test(value)) {
            thoiGianHoatDongInput.style.border = "2px solid red";
            errorElement.style.display = "block";
            errorElement.innerText = "Thời gian hoạt động phải theo định dạng: HH:MM - HH:MM (Ví dụ: 6:00 - 23:00)";
            return false;
        }

        // Tách giờ bắt đầu và kết thúc
        const [start, end] = value.split(" - ");

        // Hàm chuyển đổi thời gian thành số phút kể từ 00:00
        function convertToMinutes(time) {
            const [hour, minute] = time.split(":");
            let hourInt = parseInt(hour);
            let minuteInt = parseInt(minute);

            // Tính tổng số phút từ 00:00
            return hourInt * 60 + minuteInt;
        }

        const startTimeInMinutes = convertToMinutes(start);
        const endTimeInMinutes = convertToMinutes(end);

        // Kiểm tra giờ kết thúc phải lớn hơn giờ bắt đầu
        if (startTimeInMinutes >= endTimeInMinutes) {
            thoiGianHoatDongInput.style.border = "2px solid red";
            errorElement.style.display = "block";
            errorElement.innerText = "Giờ kết thúc phải lớn hơn giờ bắt đầu.";
            return false;
        }

        // Nếu hợp lệ, hiển thị thông báo đúng
        thoiGianHoatDongInput.style.border = "2px solid green";
        errorElement.style.display = "none";
        return true;
    }

    // Gán sự kiện khi rời khỏi ô nhập thời gian hoạt động
    thoiGianHoatDongInput.addEventListener("blur", validateThoiGianHoatDong);

    // Gán sự kiện khi rời khỏi ô nhập tên sân
    tenSanInput.addEventListener("blur", validateTenSan);

    // Gán sự kiện onchange cho loại sân
    loaiSanSelect.addEventListener("change", updatePrice);

    // Xử lý khi submit form
   
});

        

</script>

<?php
include_once("controller/cSan.php");
$psb = new cSan();

if (isset($_POST['btnThemSan'])) {
    // Lấy dữ liệu từ form
    $tenSanBong = $_POST['TenSan'];
    $loaiSan = $_POST['LoaiSan'];
    $moTaSan = $_POST['MoTaSan'];
    $giomocua = $_POST['GioMoCua'];
    $giodongcua = $_POST['GioDongCua'];
    $thoiGianHoatDong = $giomocua.' - '.$giodongcua;
  
   
    $maNhanVien = $_POST['MaNhanVien'];
    $maCoSo = $_POST['MaCoSo'];

    // Xử lý file ảnh
    if (isset($_FILES['AnhSan']) && $_FILES['AnhSan']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "img/SanBong/"; // Thư mục lưu ảnh
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true); // Tạo thư mục nếu chưa tồn tại
        }

        $fileTmpPath = $_FILES['AnhSan']['tmp_name'];
        $fileName = basename($_FILES['AnhSan']['name']);
        $fileSize = $_FILES['AnhSan']['size'];
        $fileType = $_FILES['AnhSan']['type'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif']; // Các loại file được phép

        // Kiểm tra loại file và kích thước
        if (in_array($fileExtension, $allowedExtensions) && $fileSize <= 5 * 1024 * 1024) { // Giới hạn 5MB
            $newFileName = $tenSanBong . '.' . $fileExtension; // Đổi tên file để tránh trùng lặp
            $targetFilePath = $targetDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
                // Gọi phương thức thêm sân bóng với tên file ảnh
                $kq = $psb->insertSanBong($tenSanBong, $thoiGianHoatDong, $moTaSan, $newFileName, $maNhanVien, $loaiSan, $maCoSo);
               
                if ($kq) {
                    echo "<script>alert('Thêm sân bóng thành công!')</script>";
                    echo '<script>window.location.href="admin.php?sanbong";</script>';

                } else {
                    
                    echo "<script>alert('Thêm sân bóng thất bại')</script>";
                    echo '<script>window.location.href="admin.php?action=addSan";</script>';
           //         
                }
            } else {
                echo "<script>alert('Không thể di chuyển file!')</script>";
            }
        } else {
            echo "<script>alert('File không hợp lệ hoặc quá lớn (giới hạn 5MB)!')</script>";
        }
    } else {
        echo "<script>alert('Vui lòng chọn file ảnh!')</script>";
    }
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding-left: 0;
        align-items: center;
        height: 100vh;
    }

    h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
    }

    .form-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 400px;
        margin-left: 400px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #555;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
    }

    .form-group input[type="submit"],
    .form-group input[type="reset"] {
        width: 48%;
        cursor: pointer;
        font-weight: bold;
        border: none;
        border-radius: 5px;
        padding: 10px;
        margin-right: 4%;
        background-color: #007bff;
        color: white;
        transition: background-color 0.3s ease;
    }

    .form-group input[type="reset"] {
        background-color: #6c757d;
    }

    .form-group input[type="submit"]:hover {
        background-color: #0056b3;
    }

    .form-group input[type="reset"]:hover {
        background-color: #495057;
    }
</style>


