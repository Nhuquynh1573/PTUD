<?php
    include_once("controller/cSan.php");
    $p = new cSan();
    $kq = $p->GetALLSan();
    if($kq){
        echo "<div class='header-container'>
                <h1>Quản lý sân</h1>
                <a class='btn-add' href='?addSP'>Thêm sân mới</a>
            </div>
            ";
        echo "<table>";
        echo "<tr><th>Mã sân bóng</th><th>Tên sân bóng</th><th>Thời gian hoạt động</th><th>Mô tả</th><th>Hình ảnh</th><th>Mã nhân viên</th><th>Mã loại sân</th><th>Mã cơ sở</th><th>Hành động</th></tr>";
        while($r=mysqli_fetch_assoc($kq)){
                echo "<tr>";
                echo "<td>".$r["MaSanBong"]."</td>";
                echo "<td>".$r["TenSanBong"]."</td>";
                echo "<td>".$r["ThoiGianHoatDong"]."</td>";
                echo "<td>".$r["MoTa"]."</td>";
                echo "<td>"."<img src='img/SanBong/".$r['HinhAnh']."' width='100px' height='80px'/></td>";
                echo "<td>".$r["MaNhanVien"]."</td>";
                echo "<td>".$r["TenLoai"]."</td>";
                echo "<td>".$r["MaCoSo"]."</td>";
                echo "<td><a class='edit-button'>Sửa</a>"." <a class='delete-button'>Xóa</a>"."</td>";
        }
        echo "</table>";
        }else{
            echo "Không có dữ liệu";
        }
?>

<style>
         .header-container {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }
    .header-container h1{
        background-color: #e0f2e9;
        color: #333;
        width: 100%;
        margin: 0;
        padding: 10px; 
        box-sizing: border-box;
    }
    .btn-add {
        background-color: #4CAF50; /* Màu nền xanh lá cây */
        color: white; /* Màu chữ trắng */
        padding: 10px 20px;
        text-align: center;
        align-items: right;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10px;
        margin-left: 80%;
        cursor: pointer;
        border: none;
        border-radius: 4px;
    }
    .edit-button {
    color: white;
    background-color: blue;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
}

.edit-button:hover {
    background-color: darkblue;
}

/* CSS for Delete button */
.delete-button {
    color: white;
    background-color: red;
    padding: 5px 10px;
    text-decoration: none;
    border-radius: 3px;
}

.delete-button:hover {
    background-color: darkred;
}
    </style>