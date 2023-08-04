<?php
include "header.php";
include "leftside.php";
// include "class/product_class.php";
include_once "../helper/format.php";
// define('__ROOT__', dirname(dirname(__FILE__))); 
// // include "class/product_class.php";
// require_once(__ROOT__.'../admin/class/product_class.php');
?>
<?php
$product = new product();
?>
<?php
if (isset($_GET['status'])){
    $status = $_GET['status'];
    $session_idA = $_GET['session_idA'];
    $payment_id = $_GET['payment_id'];
    $order_id = $_GET['order_id'];
    $update_order = $product -> update_order($status,$session_idA,$payment_id,$order_id);

    }
   
?>
        <div class="admin-content-right">   
            <div class="table-content">
                <h1 style="color:#333">Tất cả các đơn hàng:</h1>
                <br>
                <table>
                    <tr>
                        <th>Stt</th>
                        <th>Mã đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tên</th>
                        <th>Điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Giao hàng</th>
                        <th>Thanh toán</th>
                        <th>Chi tiết đơn hàng</th>   
                        <th>Tình trạng</th>              
                        <th>Tùy chỉnh</th>
                    </tr> 


                    <?php
                     $status_dao;
                    $show_payment = $product  -> show_payment();
                    if($show_payment){$i=0;while($result = $show_payment->fetch_assoc()){$i++;
                        if($result['statusA']){
                            $status_dao = 0;
                        }else $status_dao = 1;
                        $show_orderAll = $product  -> show_orderAll($result['order_id']);
                        if($show_orderAll){while($result1 = $show_orderAll->fetch_assoc()){  
                    ?>
                   <tr> 
                       <td> <?php echo $i ?></td>
                       <td> DNN_<?php $ma = substr($result['session_idA'],0,5).$result['payment_id'].$result['order_id']; echo $ma   ?></td>
                       <td> <?php echo $result1['order_date']?></td>
                       <td> <?php echo $result1['customer_name']?></td>
                       <td> <?php echo $result1['customer_phone'] ?></td>
                       <td> <?php echo $result1['customer_diachi']  ?>, <?php echo $result1['phuong_xa']  ?>, <?php echo $result1['quan_huyen']  ?>, <?php echo $result1['tinh_tp']  ?></td>
                       <td> <?php echo $result1['giaohang']  ?></td>
                       <td> <?php echo $result1['thanhtoan']  ?></td>
                       <td> <a href="orderdetail.php?session_idA=<?php echo $result['session_idA'].'&payment_id='.$result['payment_id'].'&order_id='.$result['order_id'] ?>">Xem</a></td>  
                       <td><a style="color:#378000" href="<?php echo '?status='.$status_dao.'&session_idA='.$result['session_idA'].'&payment_id='.$result['payment_id'].'&order_id='.$result['order_id'] ?>">
                            <?php if($result['statusA']==1){echo "<span style='color:#378000'>Đã hoàn thành<span>";} else {echo "<span style='color:tomato'>Chưa hoàn thành<span>";} ?>
                            </a></td>          
                       <!-- <td><php if($result['statusA']==1){echo "<span style='color:#378000'>Đã hoàn thành<span>";} else {echo "<span style='color:tomato'>Chưa hoàn thành<span>";} ?></td> -->
                       <td><a href="orderdelete.php?session_idA=<?php echo $result['session_idA'].'&payment_id='.$result['payment_id'].'&order_id='.$result['order_id']  ?>" onclick="return confirm('Đơn hàng sẽ bị xóa vĩnh viễn, bạn có chắc muốn tiếp tục không?');">Xóa</a></td>
                   </tr>
                   <?php
                    }}
                    }}
                 ?>
                </table>
               </div>        
        </div>
    </section>
    <section>
    </section>
    <script src="js/script.js"></script>
</body>
</html>  