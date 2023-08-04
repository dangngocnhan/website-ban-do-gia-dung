<?php
include "header.php";
?>
<?php
if (isset($_GET['loaisanpham_id'])|| $_GET['loaisanpham_id']!=NULL){
    $loaisanpham_id = $_GET['loaisanpham_id'];
}
$get_loaisanpham = $index -> get_loaisanpham($loaisanpham_id); 
?>

    <section class="cartegory">
        <div class="container">
            <div class="cartegory-top row"> 
            <?php  
                $get_loaisanphamA = $index -> get_loaisanphamA($loaisanpham_id); 
                if($get_loaisanphamA){$result = $get_loaisanphamA ->fetch_assoc();} 
                ?>
                <p><a style="color:#000000;" href="">Trang chủ</a></p> <span>&#8594;</span> <p><?php if(isset($result['danhmuc_ten'])){echo $result['danhmuc_ten'];} else {echo "Vui lòng thêm danh mục";}?>
            </p><span>&#8594;</span><p><?php if(isset($result['loaisanpham_ten'])){echo $result['loaisanpham_ten'];}else {echo "Vui lòng thêm loại sản phẩm";}?></p>
            </div>  
        </div>
        <div class="container">
            <div class="row">
                <div class="cartegory-right">
                    <div class="row">
                        <div class="cartegory-right-top-item ">
                            <?php  
                            $get_loaisanphamA = $index -> get_loaisanphamA($loaisanpham_id);
                            if($get_loaisanphamA){$result = $get_loaisanphamA ->fetch_assoc();} 
                            ?>
                                <p><?php if(isset($result['loaisanpham_ten'])) {echo $result['loaisanpham_ten'];}else {echo "Hiện tại chưa có loại sản phẩm nào";}?></p>
                        </div>
                        <div class="cartegory-right-top-item">
                            <button><span>Bộ lọc</span><i class="fas fa-sort-down"></i></button>
                        </div>
                        <div class="cartegory-right-top-item">
                            <select name="" id="">
                                <option value="">Sắp xếp</option>
                                <option value="">Giá cao đến thấp</option>
                                <option value="">Giá thấp đến cao</option>
                            </select>
                        </div>
                    </div> 
                <!-- </div> -->
                        <div class="cartegory-right-content row">
                            <?php
                                if($get_loaisanpham){while($resultB = $get_loaisanpham ->fetch_assoc()){
                            ?>
                            <div class="cartegory-right-content-item">
                                <a href="product.php?sanpham_id=<?php echo $resultB['sanpham_id']?>"><img src="admin/uploads/<?php echo $resultB['sanpham_anh']?>" alt=""></a>
                                <a href="product.php?sanpham_id=<?php echo $resultB['sanpham_id']?>"> <h1 class="cartegory-right-content-item--h1"><?php echo $resultB['sanpham_tieude']?></h1></a>
                                <p><?php $resultA = number_format($resultB['sanpham_gia']); echo $resultA?><sup>đ</sup>
                                <span>
                                    <sub style="text-decoration: line-through;">
                                    <?php $resultA = number_format((int)($resultB['sanpham_gia'])+(int)($resultB['sanpham_gia'])*(30/100)); echo $resultA?><sup>đ</sup></sub> 
                                </span>
                                </p>
                            </div>
                            <?php
                            }}
                            ?>
                        </div>
                        <div class="cartegory-right-bottom row">
                            <div class="cartegory-right-bottom-items">
                                <p>Hiện thị 2 <span>&#124;</span> 4 sản phẩm</p>
                            </div>
                            <div class="cartegory-right-bottom-items">
                                <p><span>&#171;</span> 1 2 3 4 5 <span>&#187;</span> Trang cuối</p>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>

    <!-- -------------------------Footer -->
<?php
include "footer.php"
?>