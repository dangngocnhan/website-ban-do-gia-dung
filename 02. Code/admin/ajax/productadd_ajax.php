<?php
include "../class/product_class.php";
// define("PATH_ROOT", dirname(__FILE__));
// include_once PATH_ROOT . "../lib/database.php";
define('__ROOT__', dirname(dirname(__FILE__))); 
require_once(__ROOT__.'/lib/database.php');

?>
<?php
$product = new product;
$danhmuc_id = $_GET['danhmuc_id']
?>
<!-- <script>
  alert("productadd_ajax");
</script> -->
<option value="">--Chọn1--</option>
<?php
 $show_brand_ajax = $product -> show_brand_ajax($danhmuc_id);
   if($show_brand_ajax){
     while ($result = $show_brand_ajax ->fetch_assoc()) {
  ?>
    <option value="<?php echo $result['loaisanpham_id']  ?>"><?php echo $result['loaisanpham_ten']  ?></option>
<?php
}}
?>