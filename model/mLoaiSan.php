<?php
    include_once("Model/mKetNoi.php");
    class mLoaiSan{
        public function SelectALLLoaiSan(){
            $p = new mKetNoi();
            $con=$p->moKetNoi();
            if($con){
                $truyvan = "select * from loaisan";
                $kq = mysqli_query($con, $truyvan);
                $p->dongKetNoi($con);
                return $kq;
            }else{
                return false;
            }
        }
    }
?>