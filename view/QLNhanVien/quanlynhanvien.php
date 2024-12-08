<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
    include_once("controller/cChuSan.php");
    $p = new ControllerChuSan();
    $maChuSan = $_SESSION['MaChuSan'];
    $kq = $p->getAllNhanVienByMaChuSan($maChuSan);
    if($kq){
        echo "<div class='header-container'>
                <h1>Quản lý nhân viên</h1>
                <a class='btn-add' href='?action=addNV'>Thêm nhân viên mới</a>
            </div>";
        echo "<table>";
        echo "<tr><th>Mã nhân viên</th><th>Tên nhân viên</th><th>Email</th><th>Số điện thoại</th><th>Địa chỉ</th><th>Giới tính</th><th>Hành động</th></tr>";
        while($r=mysqli_fetch_assoc($kq)){
                echo "<tr>";
                echo "<td>".$r["MaNhanVien"]."</td>";
                echo "<td>".$r["TenNhanVien"]."</td>";
                echo "<td>".$r["Email"]."</td>";
                echo "<td>".$r["SDT"]."</td>";
                echo "<td>".$r["DiaChi"]."</td>";
                echo "<td>" . (($r["GioiTinh"] == 0) ? "Nữ" : "Nam") . "</td>";
                echo "<td><a href='?action=updateNV&id=".$r["MaNhanVien"]."'>Sửa</a> | 
                        <a href='?action=deleteNV&id=".$r["MaNhanVien"]."'
                            onclick='return confirm("."\"Are you sure delete?\"".")'>Xóa</a></td>";
                echo "</tr>";
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