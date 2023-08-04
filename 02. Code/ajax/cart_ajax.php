
<?php
// $part_dir = dirname(__DIR__).'/class';
// echo $part_dir;
// include $part_dir.'/index_class.php';

// require "class/index_class.php";
include "../class/index_class.php";
$index = new index;
?>

 <?php
//  echo $_POST['sanpham_tieude'];
//  echo $_POST['session_id'];
//  echo $_POST['sanpham_id'];
//  echo $_POST['sanpham_anh'];
//  echo $_POST['quantitys'];
//  echo $_POST['sanpham_gia'];

 ?>
<?php

if(isset($_POST['sanpham_anh'])){
    $sanpham_tieude = $_POST['sanpham_tieude'];
    $session_idA =  $_POST['session_id'];
    $sanpham_id = $_POST['sanpham_id'];
    $sanpham_anh = $_POST['sanpham_anh'];
    $sanpham_gia = $_POST['sanpham_gia'];
    $quantitys = $_POST['quantitys'];

    $insert_cart = $index -> insert_cart($sanpham_anh,$session_idA,$sanpham_id,$sanpham_tieude,$sanpham_gia,$quantitys);
}
else {
    echo "không GET được dữ liệu";
}
?>



