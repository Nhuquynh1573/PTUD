<?php
    ob_start();
    include_once("Controller/cChuSan.php");
    $p = new ControllerChuSan();
    $maNV = $_REQUEST["id"];
    $kq = $p->deleteNhanVien($maNV);
    if($kq){
        echo "<script>alert('Xóa thành công')</script>";
        header("refresh:0.5; url='admin.php?nhanvien'");
    }else{
        echo "<script>alert('Xóa thất bại!')</script>";
        header("refresh:0.5; url='admin.php?nhanvien'");  
        ob_end_flush(); 
    }
?>
