<?php
include_once("model/mKhachHang.php");

    class cKhachHang{
        public function GetKhachHangByMaChuSan($maChuSan){
            $p = new ModelKhachHang();
            $kq =$p->SelectKhachHangByMaChuSan($maChuSan);
            if(mysqli_num_rows($kq)>0){
                return $kq;
            }else{  
                return false;
            }
        }

        

        
    }
?>