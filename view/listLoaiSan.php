<?php
    include_once("controller/cLoaiSan.php");
    $p = new cLoaiSan();
    $kq =$p->GetALLLoaiSan();
    if($kq){
        while($r=mysqli_fetch_assoc($kq)){
            echo "<a href='?idloai=".$r["MaLoaiSan"]."'>".$r['TenLoai']."</a>"."<br>";
        }      
    }else{
        echo"Khong co du lieu";
    }
    
?>