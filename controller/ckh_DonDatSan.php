<?php
include_once("./model/mkh_DonDatSan.php");

class cDonDatSan {
    public function getALLDonByMaKhachHang($makhachhang) {
        $p = new mDonDatSan();
        $kq = $p->selectALLDonByMaKhachHang($makhachhang);
        if($kq){
            return $kq;
        }else{
            echo "Không có dữ liệu!";
        }
    }

    public function huyDonDatSan($maDonDatSan) {
        $p = new mDonDatSan();
        $kq = $p->huyDonDatSan($maDonDatSan);
            return $kq;
    }

    public function getALLChiTietDonByMaKhachHang($maDonDatSan) {
        $p = new mDonDatSan();
        $kq = $p->selectALLChiTietDonByMaKhachHang($maDonDatSan);
        if($kq){
            return $kq;
        }else{
            echo "Không có dữ liệu!";
        }
    }
   
}
?>