<?php 
      include_once("./model/mNhanVien.php");
      class cNhanVien{
        public function getAllNhanVien(){
            $p = new ModelNhanVien();
            $kq = $p->selectAllNhanVien();
            if(!$kq){
                echo "Không có dữ liệu!";
            }else{
                if($kq->num_rows > 0)
                    return $kq;
            }
        }

        public function getNhanVienByMaChuSan($maChuSan){
            $p = new ModelNhanVien();
            $kq = $p->selectNhanVienByMaChuSan($maChuSan);
            if(!$kq){
                echo "Không có dữ liệu!";
            }else{
                if($kq->num_rows > 0)
                    return $kq;
            }
        }

        
      }

?>