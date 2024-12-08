<?php 
      include_once("mKetnoi.php");
      class ModelKhachHang {
            public function SelectKhachHangByMaChuSan($machusan){
                  $p = new mKetNoi();
                  $con=$p->moKetNoi();
                  if($con){
                      $truyvan = "SELECT kh.*
                                    FROM khachhang kh
                                    JOIN dondatsan dd ON kh.MaKhachHang = dd.MaKhachHang
                                    JOIN chitietdondatsan ct ON dd.MaDonDatSan = ct.MaDonDatSan
                                    JOIN sanbong sb ON ct.MaSanBong = sb.MaSanBong
                                    JOIN coso cs ON sb.MaCoSo = cs.MaCoSo
                                    JOIN chusan ch ON cs.MaChuSan = ch.MaChuSan
                                    WHERE ch.MaChuSan = '$machusan';

                              ";
                      $kq = mysqli_query($con, $truyvan);
                      $p->dongKetNoi($con);
                      return $kq;
                  }else{
                      return false;
                  }
              }
      }

?>