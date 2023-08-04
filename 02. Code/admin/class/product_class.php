<?php
// include "../lib/database.php";
include_once "../helper/format.php"
// require_once "config/config.php";
// include_once "../helper/format.php";
// require_once "config/config.php";
// require_once "lib/database.php";
?>

<?php
 class product
 {

    private $db;
    private $fm;

    public function __construct(){
        $this ->db = new Database();
        $this ->fm = new Format();
    }
    public function insert_anhsp($sanpham_id,$sp_anh) {
        $query = "INSERT INTO tbl_sanpham_anh (sanpham_id,sanpham_anh) VALUES ('$sanpham_id','$sp_anh')";
        $result = $this ->db ->insert($query);
        header('Location:anhsanphamlists.php');
        return $result;
    }
    public function insert_product($data,$file){
              $sanpham_tieude = $data['sanpham_tieude'];
              $sanpham_ma = $data['sanpham_ma'];
              $danhmuc_id = $data['danhmuc_id'];
              $loaisanpham_id = $data['loaisanpham_id']; 
              $sanpham_gia = $data['sanpham_gia'];
              $sanpham_chitiet = $data['sanpham_chitiet'];
              $sanpham_baoquan = $data['sanpham_baoquan'];

              $sanpham_anh = $_FILES['sanpham_anh']['name'];
            //   $file_size = $_FILES['sanpham_anh']['size'];
              $file_temp = $_FILES['sanpham_anh']['tmp_name'];

            //   $div = explode('.',$file_name);
            //   $file_ext = strtolower(end($div));
            //   $sanpham_anh = substr(md5(time()),0,10).'.'.$file_ext;
            //   $upload_image = "uploads/".$sanpham_anh;
            //   move_uploaded_file( $file_temp,$upload_image);
              move_uploaded_file($file_temp,"uploads/".$sanpham_anh);

              $sanpham_anh_chitiet = $_FILES['sanpham_anh_chitiet']['name'];
            //   $file_size1 = $_FILES['sanpham_anh_chitiet']['size'];
              $file_temp1 = $_FILES['sanpham_anh_chitiet']['tmp_name'];

            //   $div1 = explode('.',$file_name1);
            //   $file_ext1 = strtolower(end($div1));
            //   $sanpham_anh_chitiet = substr(md5(time()),0,10).'.'.$file_ext1;
            //   $upload_image1 = "uploads/".$sanpham_anh_chitiet;
            //   move_uploaded_file( $file_temp1,$upload_image1);
              move_uploaded_file( $file_temp1,"uploads/".$sanpham_anh_chitiet);

              $query = "INSERT INTO tbl_sanpham (sanpham_tieude,sanpham_ma,danhmuc_id,loaisanpham_id,sanpham_gia,sanpham_chitiet,sanpham_baoquan,sanpham_anh,sanpham_anh_chitiet) 
                        VALUES 
                    ('$sanpham_tieude','$sanpham_ma','$danhmuc_id','$loaisanpham_id','$sanpham_gia','$sanpham_chitiet','$sanpham_baoquan','$sanpham_anh','$sanpham_anh_chitiet')";
              $result = $this ->db ->insert($query);
              if($result) {
                $query = "SELECT * FROM tbl_sanpham ORDER BY sanpham_id DESC LIMIT 1";
                $result = $this -> db ->select($query) ->fetch_assoc();
                $sanpham_id = $result['sanpham_id'];
                $filename = $_FILES['sanpham_anhs']['name'] ;
                $filetmp =  $_FILES['sanpham_anhs']['tmp_name'] ;
                // foreach ($filetmp as $key => $element) {
                //         move_uploaded_file( $filetmp[$key],"uploads/".$element);
                // }
                foreach ($filename as $key => $element) {
                        move_uploaded_file( $filetmp[$key],"uploads/".$element);
                        $query = "INSERT INTO tbl_sanpham_anh (sanpham_id,sanpham_anh) VALUES ('$sanpham_id','$element')";
                        $result = $this -> db ->insert($query);
                    } 
                }
              header('Location:productlist.php');
              return $result;               
    }
        // $alert = "<span class = 'alert-style'>Thành công</span> "; return $alert;
    public function show_product(){
        // $query = "SELECT * FROM tbl_baiviet ORDER BY baiviet_id DESC";
        $query = "SELECT tbl_sanpham.*, tbl_danhmuc.danhmuc_ten,tbl_loaisanpham.loaisanpham_ten
        FROM tbl_sanpham INNER JOIN tbl_danhmuc ON tbl_sanpham.danhmuc_id = tbl_danhmuc.danhmuc_id
        INNER JOIN tbl_loaisanpham ON tbl_sanpham.loaisanpham_id = tbl_loaisanpham.loaisanpham_id 
        ORDER BY tbl_sanpham.sanpham_id DESC  ";
        $result = $this -> db ->select($query);
        return $result;
    }
    public function show_danhmuc(){
        $query = "SELECT * FROM tbl_danhmuc ORDER BY danhmuc_id DESC";
        $result = $this -> db ->select($query);
        return $result;
    }
    public function show_loaisanpham(){
        $query = "SELECT * FROM tbl_loaisanpham ORDER BY loaisanpham_id DESC";
        $result = $this -> db ->select($query);
        return $result;
    }
 
    public function get_sanpham($sanpham_id){
        $query = "SELECT * FROM tbl_sanpham WHERE sanpham_id = '$sanpham_id'";
        $result = $this -> db ->select($query);
        return $result;
    }
    public function get_anh($sanpham_id){
        $query = "SELECT tbl_sanpham_anh.*, tbl_sanpham.sanpham_ma
        FROM tbl_sanpham_anh INNER JOIN tbl_sanpham ON tbl_sanpham_anh.sanpham_id = tbl_sanpham.sanpham_id
        WHERE tbl_sanpham_anh.sanpham_id = $sanpham_id
        ORDER BY tbl_sanpham_anh.sanpham_anh_id ASC";
        $result = $this -> db ->select($query);
        return $result;
    }
 
    public function get_all_anh(){
        $query = "SELECT tbl_sanpham_anh.*, tbl_sanpham.sanpham_ma
        FROM tbl_sanpham_anh INNER JOIN tbl_sanpham ON tbl_sanpham_anh.sanpham_id = tbl_sanpham.sanpham_id
        ORDER BY tbl_sanpham_anh.sanpham_anh_id DESC  ";
        $result = $this -> db ->select($query);
        return $result;
    }

 
    public function update_product($data,$file,$sanpham_id ) {
        $sanpham_tieude = $data['sanpham_tieude'];
        $sanpham_ma = $data['sanpham_ma'];
        $danhmuc_id = $data['danhmuc_id'];
        $loaisanpham_id = $data['loaisanpham_id']; 
        $sanpham_gia = $data['sanpham_gia'];
        $sanpham_chitiet = $data['sanpham_chitiet'];
        $sanpham_baoquan = $data['sanpham_baoquan'];

        $sanpham_anh = $_FILES['sanpham_anh']['name'];
        //   $file_size = $_FILES['sanpham_anh']['size'];
          $file_temp = $_FILES['sanpham_anh']['tmp_name'];

        //   $div = explode('.',$file_name);
        //   $file_ext = strtolower(end($div));
        //   $sanpham_anh = substr(md5(time()),0,10).'.'.$file_ext;
        //   $upload_image = "uploads/".$sanpham_anh;
        //   move_uploaded_file( $file_temp,$upload_image);
          move_uploaded_file($file_temp,"uploads/".$sanpham_anh);

          $sanpham_anh_chitiet = $_FILES['sanpham_anh_chitiet']['name'];
        //   $file_size1 = $_FILES['sanpham_anh_chitiet']['size'];
          $file_temp1 = $_FILES['sanpham_anh_chitiet']['tmp_name'];

        //   $div1 = explode('.',$file_name1);
        //   $file_ext1 = strtolower(end($div1));
        //   $sanpham_anh_chitiet = substr(md5(time()),0,10).'.'.$file_ext1;
        //   $upload_image1 = "uploads/".$sanpham_anh_chitiet;
        //   move_uploaded_file( $file_temp1,$upload_image1);
          move_uploaded_file( $file_temp1,"uploads/".$sanpham_anh_chitiet);

    
        $filenames = $_FILES['sanpham_anhs']['name'] ;
        $filetmps =  $_FILES['sanpham_anhs']['tmp_name'] ;

        // if(!empty($sanpham_anh) && !empty($sanpham_anh_chitiet) && !empty($filenames))
        // {
        //     $query = "UPDATE tbl_sanpham SET                            
        //     sanpham_tieude = '$sanpham_tieude', 
        //     sanpham_ma = '$sanpham_ma', 
        //     danhmuc_id = '$danhmuc_id', 
        //     loaisanpham_id = '$loaisanpham_id',  
        //     sanpham_gia = '$sanpham_gia',
        //     sanpham_chitiet = '$sanpham_chitiet',
        //     sanpham_baoquan = '$sanpham_baoquan',
        //     sanpham_anh = '$sanpham_anh',
        //     sanpham_anh_chitiet = '$sanpham_anh_chitiet'
        //     WHERE sanpham_id = '$sanpham_id'";
        //     $result = $this ->db ->update($query);
        //     if($result ) {
        //         $query = "DELETE  FROM tbl_sanpham_anh WHERE sanpham_id = '$sanpham_id'";
        //         $result = $this -> db ->delete($query);
        //         foreach ($filenames as $key => $element) {
        //                 move_uploaded_file( $filetmps[$key],"uploads/".$element);
        //                 $query = "INSERT INTO tbl_sanpham_anh (sanpham_id,sanpham_anh) VALUES ('$sanpham_id','$element')";
        //                 $result = $this -> db ->insert($query);
        //             }
        //         }
        //     header('Location:productlist.php');
        //     return $result; 
        
        // }   

        // if(empty($sanpham_anh))
        // {
        //     $query = "UPDATE tbl_sanpham SET      
        //     sanpham_anh = '$sanpham_anh' 
        //     WHERE sanpham_id = '$sanpham_id'";
        //     $result = $this ->db ->update($query);
        //     header('Location:productlist.php');
        //     return $result; 
        // }   
        if(!empty($sanpham_anh) && !empty($sanpham_anh_chitiet) && !empty($filenames))
        {
            $query = "UPDATE tbl_sanpham SET                            
            sanpham_tieude = '$sanpham_tieude', 
            sanpham_ma = '$sanpham_ma', 
            danhmuc_id = '$danhmuc_id', 
            loaisanpham_id = '$loaisanpham_id',  
            sanpham_gia = '$sanpham_gia',
            sanpham_chitiet = '$sanpham_chitiet',
            sanpham_baoquan = '$sanpham_baoquan',
            sanpham_anh = '$sanpham_anh',
            sanpham_anh_chitiet = '$sanpham_anh_chitiet'
            WHERE sanpham_id = '$sanpham_id'";
            $result = $this ->db ->update($query);
            if($result ) {
                $query = "DELETE  FROM tbl_sanpham_anh WHERE sanpham_id = '$sanpham_id'";
                $result = $this -> db ->delete($query);
                foreach ($filenames as $key => $element) {
                        move_uploaded_file( $filetmps[$key],"uploads/".$element);
                        $query = "INSERT INTO tbl_sanpham_anh (sanpham_id,sanpham_anh) VALUES ('$sanpham_id','$element')";
                        $result = $this -> db ->insert($query);
                    }
                }
            header('Location:productlist.php');
            return $result; 
        
        }   
        // else if(!empty($sanpham_anh) && !empty($sanpham_anh_chitiet) && empty($filenames)) {
        //     $query = "UPDATE tbl_sanpham SET                            
        //     sanpham_tieude = '$sanpham_tieude', 
        //     sanpham_ma = '$sanpham_ma', 
        //     danhmuc_id = '$danhmuc_id', 
        //     loaisanpham_id = '$loaisanpham_id',  
        //     sanpham_gia = '$sanpham_gia',
        //     sanpham_chitiet = '$sanpham_chitiet',
        //     sanpham_baoquan = '$sanpham_baoquan',
        //     sanpham_anh = '$sanpham_anh',
        //     sanpham_anh_chitiet = '$sanpham_anh_chitiet'
        //     WHERE sanpham_id = '$sanpham_id'";
        //     $result = $this ->db ->update($query);
        //     header('Location:productlist.php');
        //     return $result;
        // }
        // else if(!empty($sanpham_anh) && empty($sanpham_anh_chitiet) && !empty($filenames)) {
        //     $query = "UPDATE tbl_sanpham SET                            
        //     sanpham_tieude = '$sanpham_tieude', 
        //     sanpham_ma = '$sanpham_ma', 
        //     danhmuc_id = '$danhmuc_id', 
        //     loaisanpham_id = '$loaisanpham_id',  
        //     sanpham_gia = '$sanpham_gia',
        //     sanpham_chitiet = '$sanpham_chitiet',
        //     sanpham_baoquan = '$sanpham_baoquan',
        //     sanpham_anh = '$sanpham_anh'
        //     WHERE sanpham_id = '$sanpham_id'";
        //     $result = $this ->db ->update($query);
        //     if($result ) {
        //         $query = "DELETE  FROM tbl_sanpham_anh WHERE sanpham_id = '$sanpham_id'";
        //         $result = $this -> db ->delete($query);
        //         foreach ($filenames as $key => $element) {
        //                 move_uploaded_file( $filetmps[$key],"uploads/".$element);
        //                 $query = "INSERT INTO tbl_sanpham_anh (sanpham_id,sanpham_anh) VALUES ('$sanpham_id','$element')";
        //                 $result = $this -> db ->insert($query);
        //             }
        //         }
        //     header('Location:productlist.php');
        //     return $result; 
        // }
        // else if(empty($sanpham_anh) && !empty($sanpham_anh_chitiet) && !empty($filenames)) {
        //     $query = "UPDATE tbl_sanpham SET                            
        //     sanpham_tieude = '$sanpham_tieude', 
        //     sanpham_ma = '$sanpham_ma', 
        //     danhmuc_id = '$danhmuc_id', 
        //     loaisanpham_id = '$loaisanpham_id',  
        //     sanpham_gia = '$sanpham_gia',
        //     sanpham_chitiet = '$sanpham_chitiet',
        //     sanpham_baoquan = '$sanpham_baoquan', 
        //     sanpham_anh_chitiet = '$sanpham_anh_chitiet'
        //     WHERE sanpham_id = '$sanpham_id'";
        //     $result = $this ->db ->update($query);
        //     if($result ) {
        //         $query = "DELETE  FROM tbl_sanpham_anh WHERE sanpham_id = '$sanpham_id'";
        //         $result = $this -> db ->delete($query);
        //         foreach ($filenames as $key => $element) {
        //                 move_uploaded_file( $filetmps[$key],"uploads/".$element);
        //                 $query = "INSERT INTO tbl_sanpham_anh (sanpham_id,sanpham_anh) VALUES ('$sanpham_id','$element')";
        //                 $result = $this -> db ->insert($query);
        //             }
        //         }
        //     header('Location:productlist.php');
        //     return $result; 
        // }  
        // else if(!empty($sanpham_anh) && empty($sanpham_anh_chitiet) && empty($filenames) ) {
        //     $query = "UPDATE tbl_sanpham SET                            
        //     sanpham_tieude = '$sanpham_tieude', 
        //     sanpham_ma = '$sanpham_ma', 
        //     danhmuc_id = '$danhmuc_id', 
        //     loaisanpham_id = '$loaisanpham_id',  
        //     sanpham_gia = '$sanpham_gia',
        //     sanpham_chitiet = '$sanpham_chitiet',
        //     sanpham_baoquan = '$sanpham_baoquan', 
        //     sanpham_anh = '$sanpham_anh'
        //     WHERE sanpham_id = '$sanpham_id'";
        //     $result = $this ->db ->update($query);
        //     header('Location:productlist.php');
        //     return $result;
        // }
        // else if(empty($sanpham_anh) && !empty($sanpham_anh_chitiet) && empty($filenames)) {
        //     $query = "UPDATE tbl_sanpham SET                            
        //     sanpham_tieude = '$sanpham_tieude', 
        //     sanpham_ma = '$sanpham_ma', 
        //     danhmuc_id = '$danhmuc_id', 
        //     loaisanpham_id = '$loaisanpham_id',  
        //     sanpham_gia = '$sanpham_gia',
        //     sanpham_chitiet = '$sanpham_chitiet',
        //     sanpham_baoquan = '$sanpham_baoquan', 
        //     sanpham_anh_chitiet = '$sanpham_anh_chitiet'
        //     WHERE sanpham_id = '$sanpham_id'";
        //     $result = $this ->db ->update($query);
        //     header('Location:productlist.php');
        //     return $result;
        // }
        // else if(empty($sanpham_anh) && empty($sanpham_anh_chitiet) && !empty($filenames)) {
        //     $query = "UPDATE tbl_sanpham SET                            
        //     sanpham_tieude = '$sanpham_tieude', 
        //     sanpham_ma = '$sanpham_ma', 
        //     danhmuc_id = '$danhmuc_id', 
        //     loaisanpham_id = '$loaisanpham_id',  
        //     sanpham_gia = '$sanpham_gia',
        //     sanpham_chitiet = '$sanpham_chitiet',
        //     sanpham_baoquan = '$sanpham_baoquan'
        //     WHERE sanpham_id = '$sanpham_id'";      
        //     $result = $this ->db ->update($query); 
        //     if($result ) {
        //         $query = "DELETE  FROM tbl_sanpham_anh WHERE sanpham_id = '$sanpham_id'";
        //         $result = $this -> db ->delete($query);
        //         foreach ($filenames as $key => $element) {
        //                 move_uploaded_file( $filetmps[$key],"uploads/".$element);
        //                 $query = "INSERT INTO tbl_sanpham_anh (sanpham_id,sanpham_anh) VALUES ('$sanpham_id','$element')";
        //                 $result = $this -> db ->insert($query);
        //             }
        //         }
        //     header('Location:productlist.php');
        //     return $result; 
        // }
        else {
                $query = "UPDATE tbl_sanpham SET                            
                sanpham_tieude = '$sanpham_tieude', 
                sanpham_ma = '$sanpham_ma', 
                danhmuc_id = '$danhmuc_id', 
                loaisanpham_id = '$loaisanpham_id',  
                sanpham_gia = '$sanpham_gia',
                sanpham_chitiet = '$sanpham_chitiet',
                sanpham_baoquan = '$sanpham_baoquan'
                WHERE sanpham_id = '$sanpham_id'";
                $result = $this ->db ->update($query);
                header('Location:productlist.php');
                return $result; 
        }
    }
                    
        
    public function delete_product($sanpham_id){
            $query = "DELETE  FROM tbl_sanpham WHERE sanpham_id = '$sanpham_id'";
            $result = $this -> db ->delete($query);
            if($result) {$alert = "<span class = 'alert-style'> Delete Thành công</span> "; return $alert;}
            else {$alert = "<span class = 'alert-style'> Delete Thất bại</span>"; return $alert;}
        


        }
    public function delete_product_anh($sanpham_id){
            $query = "DELETE  FROM tbl_sanpham_anh WHERE sanpham_id = '$sanpham_id'";
            $result = $this -> db ->delete($query);
            if($result) {$alert = "<span class = 'alert-style'> Delete Thành công</span> "; return $alert;}
            else {$alert = "<span class = 'alert-style'> Delete Thất bại</span>"; return $alert;}
        


        }
    public function delete_anh_sanpham($sanpham_anh_id){
            $query = "DELETE  FROM tbl_sanpham_anh WHERE sanpham_anh_id = '$sanpham_anh_id'";
            $result = $this -> db ->delete($query);
            if($result) {$alert = "<span class = 'alert-style'> Delete Thành công</span> "; return $alert;}
            else {$alert = "<span class = 'alert-style'> Delete Thất bại</span>"; return $alert;}
        }

    public function show_brand_ajax($danhmuc_id){
            $query = "SELECT * FROM tbl_loaisanpham WHERE danhmuc_id = '$danhmuc_id'";
            $result = $this -> db ->select($query);
            return $result;
        }

    public function show_payment(){
        $query = "SELECT * FROM tbl_payment ORDER BY payment_id DESC";
        $result = $this -> db ->select($query);
        return $result;
    }
    public function show_order($order_id) {
        $query = "SELECT tbl_order.*, tbl_payment.*,tbl_diachi.*
        FROM tbl_order INNER JOIN tbl_payment ON tbl_order.order_id = tbl_payment.order_id
        INNER JOIN tbl_diachi ON tbl_order.customer_xa = tbl_diachi.ma_px
        WHERE tbl_payment.statusA = 0 and tbl_order.order_id = '$order_id'
        ORDER BY tbl_payment.payment_id DESC ";
        $result = $this -> db ->selectdc($query);
        return $result;
    }
            
    public function show_order_detail($session_idA, $payment_id, $order_id){
        $query = "SELECT * FROM tbl_carta 
                WHERE session_idA = '$session_idA' 
                    and payment_id = '$payment_id'
                    and order_id = '$order_id'
                ORDER BY carta_id DESC";
        $result = $this -> db ->select($query);
        return $result;
    }
    public function show_order_done($order_id){
        $query = "SELECT tbl_order.*, tbl_payment.*,tbl_diachi.*
        FROM tbl_order INNER JOIN tbl_payment ON tbl_order.order_id = tbl_payment.order_id
        INNER JOIN tbl_diachi ON tbl_order.customer_xa = tbl_diachi.ma_px
        WHERE tbl_payment.statusA = 1 and tbl_order.order_id = '$order_id'
        ORDER BY tbl_payment.payment_id DESC ";
        $result = $this -> db ->selectdc($query);
        return $result;
    }
    public function update_order($status,$session_idA,$payment_id,$order_id){
        $query = "UPDATE tbl_payment SET statusA = '$status' 
                WHERE session_idA = '$session_idA' and payment_id = '$payment_id' and order_id = '$order_id' ";
        $result = $this ->db ->update($query);
        // header('Location:orderlist.php');
        return $result;

    }
    public function show_orderAll($order_id){
        $query = "SELECT tbl_order.*, tbl_payment.*,tbl_diachi.*
            FROM tbl_order INNER JOIN tbl_payment ON tbl_order.order_id = tbl_payment.order_id
            INNER JOIN tbl_diachi ON tbl_order.customer_xa = tbl_diachi.ma_px
            WHERE tbl_order.order_id = '$order_id'
            ORDER BY tbl_payment.payment_id DESC   ";
        $result = $this -> db ->select($query);
        return $result;
    } 
    public function delete_carta($session_idA,$payment_id,$order_id){
        $query = "DELETE  FROM tbl_carta 
            WHERE session_idA = '$session_idA' and payment_id = '$payment_id' and order_id = '$order_id' ";
        $result = $this -> db ->delete($query);
        return $result;
    }
    public function delete_payment($session_idA,$payment_id,$order_id){
        $query = "DELETE  FROM tbl_payment 
            WHERE session_idA = '$session_idA' and payment_id = '$payment_id' and order_id = '$order_id' ";
        $result = $this -> db ->delete($query);
        return $result;
    }
    public function delete_order($session_idA,$order_id){
        $query = "DELETE  FROM tbl_order WHERE session_idA = '$session_idA' and order_id = '$order_id' ";
        $result = $this -> db ->delete($query);
        return $result;
    }
   
}

 
?>