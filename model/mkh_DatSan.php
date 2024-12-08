<?php
include_once("mKetNoi.php");

class mDatSan {
    private $ketNoi;

    public function __construct() {
        $this->ketNoi = new mKetNoi();
    }

    public function kiemTraNgayDat($ngayDat) {
        $today = date("Y-m-d"); 
        if ($ngayDat < $today) {
            return false; 
        }
        return true; 
    }

    public function getTenKhachHang($maKhachHang) {
        $con = $this->ketNoi->moKetNoi();
        $sql = "SELECT TenKhachHang FROM khachhang WHERE MaKhachHang = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $maKhachHang);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $this->ketNoi->dongKetNoi($con);
        return $row ? $row['TenKhachHang'] : null;
    }

    public function datSan($maSanBong, $maKhachHang, $ngayDat, $gioBatDau, $gioKetThuc, $tongTien) {
        $con = $this->ketNoi->moKetNoi();

        if (!$this->kiemTraNgayDat($ngayDat)) {
            return false; 
        }

        $tenKhachHang = $this->getTenKhachHang($maKhachHang);
        if (!$tenKhachHang) {
            return false; // Customer not found
        }

        $trangThai = 'Chờ duyệt';
        $sqlDatSan = "INSERT INTO dondatsan1 (MaKhachHang, TenKhachHang, MaSanBong, NgayDat, GioBatDau, GioKetThuc, TongTien, TrangThai) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sqlDatSan);
        $stmt->bind_param("isisssds", $maKhachHang, $tenKhachHang, $maSanBong, $ngayDat, $gioBatDau, $gioKetThuc, $tongTien, $trangThai);
        $ketQua = $stmt->execute();

        $this->ketNoi->dongKetNoi($con);
        return $ketQua;
    }

    public function kiemTraTrungLich($maSanBong, $ngayDat, $gioBatDau, $gioKetThuc) {
        $con = $this->ketNoi->moKetNoi();
        $sql = "SELECT COUNT(*) as count FROM dondatsan1
                WHERE MaSanBong = ? AND NgayDat = ? AND
                ((GioBatDau <= ? AND GioKetThuc > ?) OR
                (GioBatDau < ? AND GioKetThuc >= ?))";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("isssss", $maSanBong, $ngayDat, $gioBatDau, $gioBatDau, $gioKetThuc, $gioKetThuc);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $this->ketNoi->dongKetNoi($con);
        return $row['count'] > 0;
    }
}
?>

