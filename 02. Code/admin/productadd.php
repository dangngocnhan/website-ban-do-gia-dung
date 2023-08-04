<?php

include "header.php";
include "leftside.php";

?>
<?php
$product = new product();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
    // echo "<pre>";
    //  var_dump($_FILES);
	$insert_product = $product ->insert_product($_POST,$_FILES);
    // header('Location:productlist.php');
}

?>
 <div class="admin-content-right">
            <div class="product-add-content">
                <?php
                if(isset($insert_product)){echo $insert_product; }
                ?>
                <form action="productadd.php" method="POST" enctype="multipart/form-data">
                    <label for="">Tên sản phẩm<span style="color: red;">*</span></label> <br>
                    <input required type="text" name="sanpham_tieude"> <br>

                    <label for="">Mã sản phẩm<span style="color: red;">*</span></label> <br>
                    <input required type="text" name="sanpham_ma"> <br>

                  
                    <label for="">Chọn danh mục<span style="color: red;">*</span></label> <br>
                    <select required="required" name="danhmuc_id" id="danhmuc_id">
                        <option value="">--Chọn--</option>
                        <?php
                        $show_danhmuc = $product ->show_danhmuc();
                        if($show_danhmuc){while($result=$show_danhmuc->fetch_assoc()){
                        ?>
                        <option value="<?php echo $result['danhmuc_id'] ?>"><?php echo $result['danhmuc_ten'] ?></option>
                        <?php
                        }}
                        ?>
                    </select>

                    <label for="">Chọn Loại sản phẩm<span style="color: red;">*</span></label> <br>
                    <select required name="loaisanpham_id" id="loaisanpham_id">
                        <option value="">--Chọn--</option> 
                    </select>

                    <label for="">Giá sản phẩm<span style="color: red;">*</span></label> <br>
                    <input required type="text" name="sanpham_gia"> <br>  

                    <label for="">Thông số kỹ thuật<span style="color: red;">*</span></label> <br>
                    <textarea class="ckeditor"  required name="sanpham_chitiet" cols="60" rows="5"></textarea><br>  
                    <label  for="">Thông tin sản phẩm<span style="color: red;">*</span></label> <br>
                    <textarea class="ckeditor" required name="sanpham_baoquan" cols="60" rows="5"></textarea><br> 

                    <label for="">Ảnh đại diện<span style="color: red;">*</span></label> <br>
                    <input required type="file" name="sanpham_anh"> <br> 

                    <label for="">Ảnh chi tiết<span style="color: red;">*</span></label> <br>
                    <input required type="file" name="sanpham_anh_chitiet"> <br> 

                    <label for="">Ảnh Sản phẩm<span style="color: red;">*</span></label> <br>
                    <input required type="file" multiple  name="sanpham_anhs[]"> <br>   

                    <button class="admin-btn" name="submit" type="submit">Gửi</button>  
                </form>
            </div>           
        </div>
    </section>
    <section>
    </section>
    <script src="js/script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 

    <script> 
        CKEDITOR.replace( 'ckeditor', {
            filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
            filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
        } );  
    </script>

    <script>
    $(document).ready(function(){
        $("#danhmuc_id").change(function(){
            // alert($(this).val())
            var x = $(this).val()
            $.get("productadd_ajax.php",{danhmuc_id:x},function(data){
                $("#loaisanpham_id").html(data); 
            })
        })
    })
    </script>
</body>
</html>  