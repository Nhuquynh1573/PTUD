<?php
    ob_start();

    include_once("Controller/cCoSo.php");
    $p = new cCoSo();
    $maCoSo = $_REQUEST["MaCoSo"];
    
    $kq = $p->deleteCoSo($maCoSo);
    if($kq){
        echo "<script>alert('Xóa thành công')</script>";
        header("refresh:0.5; url='admin.php?coso'");
    }else{
        echo "<script>alert('Xóa thất bại!')</script>";
        header("refresh:0.5; url='admin.php?coso'");  
        ob_end_flush(); 
    }
?>
