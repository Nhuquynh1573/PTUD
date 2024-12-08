<?php
include_once("../model/mkh_DatSan.php");

class cDatSan {
    private $mDatSan;

    public function __construct() {
        $this->mDatSan = new mDatSan();
    }

    public function kiemTraLichTrung($maSanBong, $ngayDat, $gioBatDau, $gioKetThuc) {
        return $this->mDatSan->kiemTraTrungLich($maSanBong, $ngayDat, $gioBatDau, $gioKetThuc);
    }

    public function datSan($maSanBong, $maKhachHang, $ngayDat, $gioBatDau, $gioKetThuc, $tongTien) {
        $ketQua = $this->mDatSan->datSan($maSanBong, $maKhachHang, $ngayDat, $gioBatDau, $gioKetThuc, $tongTien);
        return $ketQua;
    }
}
?>

