<?php
    ob_start();

    include_once("Controller/cSan.php");
    $p = new cSan();
    $maSanBong = $_REQUEST["MaSanBong"];
    
    $kq = $p->deleteSanBong($maSanBong);
    if($kq){
        echo "<script>alert('Xóa thành công')</script>";
        header("refresh:0.5; url='admin.php?sanbong'");
    }else{
        echo "<script>alert('Xóa thất bại!')</script>";
        header("refresh:0.5; url='admin.php?sanbong'");  
        ob_end_flush(); 
    }
?>
