<?php
if(isset($_GET['admin_id'])){
    Session::destroyAdmin();
}
?>

<section class="admin-content row space-between">
        <div class="admin-content-left">
        <div class="header-top-left">
            <a href="index.php"><p> <span>Gia</span>Dụng</p></a>
        </div>
            <ul>
                <li><a  href="#"> <img style="width:20px" src="icon/hi.png" alt="">Chào:  <span style="color:blueviolet; font-size:22px">DNN_   <?php echo Session::get('admin_name') ?></span><span style="color: red; font-size:20px">&#10084;</span></a>
                <li><a href="#"><img style="width:30px" src="icon/note.svg" alt="">Đơn hàng</a>
                    <ul>
                        <li><a href="orderlist.php">Chưa hoàn thành</a></li>
                        <li><a href="orderlistdone.php">Đã hoàn thành</a></li>
                        <li><a href="orderlistall.php">Tất cả Đơn hàng</a></li>
                    </ul>
                </li>
                <li><a href="#"><img style="width:20px" src="icon/options.png" alt="">Danh Mục Sản Phẩm</a>
                    <ul>
                        <li><a href="cartegorylist.php">Danh Sách Danh Mục</a></li>
                        <li><a href="cartegoryadd.php">Thêm Danh Mục Sản Phẩm</a></li>
                    </ul>
                </li>
                <li><a href="#"><img style="width:20px" src="icon/menu.png" alt="">Loại Sản Phẩm</a>
                    <ul>
                        <li><a href="brandlist.php">Danh sách Loại Sản Phẩm</a></li>
                        <li><a href="brandadd.php">Thêm Loại Sản Phẩm</a></li>
                    </ul>
                </li>
                <li><a href="#"><img style="width:20px" src="icon/article.png" alt="">Sản phẩm</a>
                    <ul>
                        <li><a href="productlist.php">Danh sách Sản phẩm</a></li>
                        <li><a href="productadd.php">Thêm Sản phẩm</a></li>
                    </ul>
                </li>
                <li><a href="#"><img style="width:20px" src="icon/picture.png" alt="">Ảnh Sản phẩm</a>
                    <ul>
                        <li><a href="anhsanphamlists.php">Danh sách Ảnh Sản Phẩm</a></li>
                        <li><a href="anhsanphamadds.php">Thêm Ảnh Sản Phẩm</a></li>
                    </ul>
                </li>

                <li><a href="?admin_id=<?php echo Session::get('admin_id') ?>"> <img style="width:20px" src="icon/logout.png" alt="">Đăng Xuất</a>
                    
                </li>
            </ul>
        </div>