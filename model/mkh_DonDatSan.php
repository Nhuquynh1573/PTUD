<?php
include_once("mKetNoi.php");

class mDonDatSan {
    public function selectALLDonByMaKhachHang($makhachhang) {
        $p = new mKetNoi();
        $con = $p->moKetNoi();
        $sql = "SELECT dondatsan1.*, sanbong.TenSanBong 
                FROM dondatsan1
                LEFT JOIN sanbong ON dondatsan1.MaSanBong = sanbong.MaSanBong 
                WHERE dondatsan1.MaKhachHang = $makhachhang 
                ORDER BY dondatsan1.NgayDat DESC";
        $kq = mysqli_query($con, $sql);
        if (!$kq) {
            die("Query failed: " . mysqli_error($con));
        }
        $p->dongKetNoi($con);
        return $kq; 
    }

    public function huyDonDatSan($maDonDatSan){
        $p = new mKetNoi();
        $truyvan = "
            DELETE FROM dondatsan1
            WHERE MaDonDatSan = $maDonDatSan";
        $con = $p -> moKetNoi();
        $kq = mysqli_query($con, $truyvan);
        $p -> dongKetNoi($con);
        return $kq;
      }
    
      public function selectALLChiTietDonByMaKhachHang($maDonDatSan) {
        $p = new mKetNoi();
        $con = $p->moKetNoi();
        $sql = "SELECT dondatsan1.*, sanbong.TenSanBong, khachhang.TenKhachHang, khachhang.SDT, khachhang.Email, khachhang.DiaChi
                FROM dondatsan1
                LEFT JOIN sanbong ON dondatsan1.MaSanBong = sanbong.MaSanBong 
                LEFT JOIN khachhang ON dondatsan1.MaKhachHang = khachhang.MaKhachHang
                WHERE dondatsan1.MaDonDatSan = $maDonDatSan";
        $kq = mysqli_query($con, $sql);
        if (!$kq) {
            die("Query failed: " . mysqli_error($con));
        }
        $p->dongKetNoi($con);
        return $kq; 
    }

}
?>