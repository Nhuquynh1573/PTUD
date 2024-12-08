<?php
include_once(__DIR__ . '/../model/mDonDatSan.php'); 

class cDonDatSan {
    public function GetAllDonDatSan() {
        $model = new mDonDatSan();
        return $model->GetALLDonDatSan(); // Lấy tất cả đơn đặt sân
    }

    public function ThemDonDatSan($tenKH, $sdt, $ngayDat, $gioBatDau, $gioKetThuc, $tenSanBong) {
        $model = new mDonDatSan();
        return $model->ThemDonDatSan($tenKH, $sdt, $ngayDat, $gioBatDau, $gioKetThuc, $tenSanBong);
    }

    public function PheDuyetDon($maDonDatSan) {
        $model = new mDonDatSan();
        return $model->PheDuyetDon($maDonDatSan);
    }

    public function getinsertDatSan($mkh,$tkh,$ms,$nd, $gbd,$gkt,$tt) {
        $model = new mDonDatSan();
        $kq = $model->insertDatSan($mkh,$tkh,$ms,$nd, $gbd,$gkt,$tt);
        if($kq){
            return $kq;
        }else{
            return false;
        }
    }
    public function getKiemTraSDT($sdt){
        $model = new mDonDatSan();
        $kq = $model->KiemTraSDT($sdt);
        if($kq){
            if($kq->num_rows>0){
                while($r = $kq->fetch_assoc()){
                    $_SESSION["TenKH"] = $r["TenKhachHang"];
                    $_SESSION["MaKH"] = $r["MaKhachHang"];
                }
                return $kq;
            }else{
                return 0;
            }
        }else{
            return false;
        }
    }
    

    public function getKiemTraTrungGio($ngayDat) {
        // Tạo đối tượng model để gọi phương thức kiểm tra trùng giờ
        $model = new mDonDatSan();
        $kq = $model->KiemTraTrungGio($ngayDat);
    
        if ($kq) {
            if ($kq->num_rows > 0) {
                // Nếu có đơn trùng giờ, trả về kết quả
                return $kq;
            } else {
                // Nếu không có đơn trùng giờ
                return 0;
            }
        } else {
            // Trường hợp có lỗi trong việc truy vấn
            return false;
        }
    }

    public function getupdateTrangThaiDon($madon){
        // Tạo đối tượng model để gọi phương thức kiểm tra trùng giờ
        $model = new mDonDatSan();
        $kq = $model->updateTrangThaiDon($madon);
    
        if ($kq) {
            return $kq;
        } else {
            // Trường hợp có lỗi trong việc truy vấn
            return false;
        }
    }

    public function duyetVaGuiThongTinDonDatSan($maDonDatSan) {
        $model = new mDonDatSan();
        $thongTinDon = $model->getThongTinVaCapNhatTrangThaiDon($maDonDatSan);
    
        if ($thongTinDon) {
            return $thongTinDon; // Trả về thông tin đơn đặt sân
        }
        return false; // Trả về false nếu thất bại
    }

    public function deletedatsan($maDonDatSan) {
        $p = new mDonDatSan(); // Gọi model
        $kq = $p->deletedatsan($maDonDatSan); // Gọi hàm deletedatsan trong model
        return $kq; // Trả về kết quả
    }
    
    
    
}
?>