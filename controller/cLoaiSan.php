<?php
include_once("model/mLoaiSan.php");
    class cLoaiSan{
        public function GetALLLoaiSan(){
            $p = new mLoaiSan();
            $kq =$p->SelectALLLoaiSan();
            if(mysqli_num_rows($kq)>0){
                return $kq;
            }else{
                return false;
            }
        }
    }

?>