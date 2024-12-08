<?php
if (isset($_GET['maLoaiSan'])) {
    $maLoaiSan = $_GET['maLoaiSan'];

    include_once("../controller/cGiaThue.php");
    $giaThueController = new cGiaThue();
    
    // Gọi phương thức của controller để lấy giá thuê theo mã loại sân
    $giaThue = $giaThueController->getGiaThueByLoaiSan($maLoaiSan);

    if ($giaThue) {
        // Khởi tạo mảng để lưu trữ giá thuê cho các buổi
        $giaSang = null;
        $giaChieu = null;
        
        // Duyệt qua các kết quả và gán giá cho buổi sáng và chiều
        foreach ($giaThue as $item) {
            // Chuyển đổi thời gian bắt đầu và kết thúc thành đối tượng DateTime
            $thoiGianBatDau = new DateTime($item['ThoiGianBatDau']);
            $thoiGianKetThuc = new DateTime($item['ThoiGianKetThuc']);
            $gioBatDau = $thoiGianBatDau->format('H:i');
            $gioKetThuc = $thoiGianKetThuc->format('H:i');
            
            // Kiểm tra xem thời gian bắt đầu và kết thúc có thuộc buổi sáng hay chiều
            if ($gioBatDau >= '06:00' && $gioKetThuc <= '12:00') {
                $giaSang = number_format($item['GiaThue'], 0, ',', '.');
            } elseif ($gioBatDau >= '12:00' && $gioKetThuc <= '18:00') {
                $giaChieu = number_format($item['GiaThue'], 0, ',', '.');
            }
        }

        // Trả về kết quả dưới dạng JSON
        echo json_encode([
            "success" => true,
            "giaSang" => $giaSang,
            "giaChieu" => $giaChieu
        ]);
    } else {
        // Nếu không tìm thấy dữ liệu
        echo json_encode(["success" => false, "message" => "Không tìm thấy dữ liệu"]);
    }
} else {
    // Nếu thiếu tham số mã loại sân
    echo json_encode(["success" => false, "message" => "Thiếu mã loại sân"]);
}
?>
