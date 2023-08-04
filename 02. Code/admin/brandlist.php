<?php
include "header.php";
include "leftside.php";
// include "class/cartegory_class.php";
// define('__ROOT__', dirname(dirname(__FILE__))); 
// require_once(__ROOT__.'../admin/class/cartegory_class.php');
$brand = new brand;
$show_brand = $brand -> show_brand()
?>
       <div class="admin-content-right">
            <div class="table-content">
                <table>
                    <tr>
                        <th>Stt</th>
                        <th>ID</th>
                        <th>Danh mục</th>
                        <th>Loại sản phẩm</th>
                        <th>Tùy chỉnh</th>
                    </tr>
                    <?php
                    if($show_brand){$i=0; while($result= $show_brand->fetch_assoc()){
                        $i++
                   
                    ?>
                    <tr>
                        <td> <?php echo $i ?></td>
                        <td> <?php echo $result['loaisanpham_id'] ?></td>
                        <td> <?php echo $result['danhmuc_ten']  ?></td>
                        <td> <?php echo $result['loaisanpham_ten'] ?></td>
                        <td><a style="margin-right: 20px;" href="brandedit.php?loaisanpham_id=<?php echo $result['loaisanpham_id'] ?>">Sửa</a> | <a style="margin-left: 20px;" href="branddelete.php?loaisanpham_id=<?php echo $result['loaisanpham_id'] ?>">Xóa</a></td>
                    </tr>
                    <?php
                     }}
                    ?>
                   
                </table>
               </div>  
               <button class="button_themdanhmuc"><a href="./brandadd.php">Thêm loại sản phẩm</a></button>         
        </div>
    </section>
    <section>
    </section>
    <script src="js/script.js"></script>
</body>
</html>  