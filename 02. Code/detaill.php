<?php
include "header.php";
$session_id = session_id();
?>
    <!-- -----------------------DELIVERY---------------------------------------------- -->
    <section class="detail">
        <div class="container">
           <div class="detail-top">
                <p>CHI TIẾT ĐƠN HÀNG</p>
            </div>
            <hr>
            <?php 
                $show_payment = $index -> show_payment1($session_id);
                if($show_payment){while($result = $show_payment->fetch_assoc()){
                    $payment_id =  $result['payment_id'];
                    $order_id = $result['order_id'];
                    $status = $result['statusA'];
            ?>
            <h1 style="text-align: left;">Mã đơn hàng:<span style="font-size: 20px; color: #378000;">DNN_<?php $ma = substr($session_id,0,5).$payment_id.$order_id; echo $ma   ?></span></h1>
            <div class="detail-text">
                <div class="detail-text-left-content">
                    <p><span style="font-weight: bold; color:red">Thông tin giao hàng </span> --------------------------------------------------------------------------------</p>
                    <br> 
                    <?php 
                        $show_order1 = $index -> show_order1($session_id,$order_id); 
                        if($show_order1){while($result1 = $show_order1->fetch_assoc()){
                    ?>
                    <p><span style="font-weight: bold;">Họ và tên</span>: <?php echo $result1['customer_name']  ?></p>
                    <p><span style="font-weight: bold;">Số ĐT</span>: <?php echo $result1['customer_phone']  ?></p>
                    <p><span style="font-weight: bold;">Địa chỉ</span>: <?php echo $result1['customer_diachi']  ?>, <?php echo $result1['phuong_xa']  ?>, <?php echo $result1['quan_huyen']  ?>, <?php echo $result1['tinh_tp']  ?></p>
                    <?php
                    }}
                    ?>
                   
                    <p><span style="font-weight: bold;">Phương thức giao hàng</span>: <?php echo $result['giaohang']  ?></p>
                    <p><span style="font-weight: bold;">Phương thức thanh toán</span>: <?php echo $result['thanhtoan']  ?></p>
                    <p><span style="font-weight: bold;">Tình trạng đơn hàng</span>: <?php if($status){echo "<span style='color:#378000;'>Đã hoàn thành</span>";} else { echo "<span style='color:red;'>Chưa hoàn thành</span>";}  ?></p>
                    
            
                </div>
                <div class="detail-text-right-content">
                    <p><span style="font-weight: bold;color:red">Thông tin đơn hàng hàng</span></p>  <br>
                    <div class="detail-text-right">
                    <table>
                        <tr>
                                <th>Sản phẩm</th>
                                <th>Tên sản phẩm</th> 
                                <th>SL</th>
                                <th>Giá</th>
                        </tr>
                        <?php
                            
                            $SL = 0;
                            $TT = 0;
                            $show_carta = $index -> show_carta1($session_id,$payment_id,$order_id);
                            if($show_carta){while($result = $show_carta->fetch_assoc()){
                            
                        ?>               
                        <tr>
                            <td><img src="<?php echo $result['sanpham_anh'] ?>" alt=""></td>
                            <td><p><?php echo $result['sanpham_tieude'] ?></p></td>
                            <td><span><?php echo $result['quantitys'] ?></span></td>
                            <td><p><?php $resultC = number_format($result['sanpham_gia']); echo $resultC ?><sup>đ</sup></p></td>
                            <?php $a = (int)$result['sanpham_gia']; $b = (int)$result['quantitys']; $TTA = $a*$b;   ?>
                        </tr>
                        <?php
                        $SL = $SL + $result['quantitys'];
                        $TT =  $TT  + $TTA ;
                        
                            }}
                        ?>
                        <tr>
                            <td>TỔNG TIỀN GIỎ HÀNG</td>
                            <td></td>
                            <td></td>
                            <td><?php $resultC = number_format($TT); echo $resultC ?><sup>đ</sup></td>
                        </tr>
                    </table>
                </div>
                <!-- <div class="detail-content-right-bottom">
                    <table>
                            <tr>
                                <th colspan="2"><p>TỔNG TIỀN GIỎ HÀNG</p></th>
                            </tr>
                            <tr>
                                <td>TỔNG SẢN PHẨM</td>
                                <td><?php $resultC = number_format($SL); echo $resultC ?></td>
                            </tr>
                            <tr>
                                <td>TỔNG TIỀN HÀNG</td>
                                <td><p><?php $resultC = number_format($TT); echo $resultC ?><sup>đ</sup></p></td>
                            </tr>
                            <tr>
                                <td>THÀNH TIỀN</td>
                                <td><p><?php $resultD = number_format($TT); echo $resultD; ?><sup>đ</sup></p></td>
                            </tr>
                            <tr>
                                <td>TẠM TÍNH</td>
                                <td><p style="font-weight: bold; color: black;"><?php $resultC = number_format($TT); echo $resultC ?><sup>đ</sup></p></td>
                            </tr>
                        </table>
                </div> -->
                
                </div>
        
            </div>
            <hr>
            <?php
            }}
            ?>
            <br><br><br><br>
            <div  class="success-button">
                <a href="index.php"><button>TIẾP TỤC MUA SẮM</button></a>
            </div>
            <br>
            <p style="text-align: center;">Mọi thắc mắc quý khách vui lòng liên hệ hotline <span  style="font-size: 20px; color: red;">0392151071 </span> hoặc chat với kênh hỗ trợ trên website để được hỗ trợ nhanh nhất.</p>
        </div>
    </section>

     <!-- -------------------------Footer -->
<?php
include "footer.php"
?>