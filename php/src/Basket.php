<?php
  session_start(); 
  require_once('scripts/Myscript.php');
  $db_handle = new myDBControl();

  if(empty($_SESSION['username']) &&  empty($_SESSION['Id'])){
    header('location: login.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Basket</title>
    <link rel="stylesheet" href="css/mystyle.css" />
</head>
<body>
    <?php include 'Layout/navbar_login.php'; ?>
    <div class="main">
    <h2 class="h23"> My Basket</h2>
    <?php 
        $id = $_SESSION['Id'];
        $basket_show = $db_handle->Textquery("SELECT *,CONCAT(LEFT(Product_name, 15),'...') AS New_name FROM BASKET_DETAIL INNER JOIN PRODUCT ON BASKET_DETAIL.Product_id = PRODUCT.Product_id WHERE Cust_id = '$id'");
        if(empty($basket_show)){ ?>
            <div class="h-22">
                <p class="Te-1">ไม่มีสินค้าในตะกร้า</p>
            </div>
        <?php }else { ?>
            <div class="page-login">
                <?php
                    $pid = $_GET['id'];
                    $product_show = $db_handle->Textquery("SELECT * FROM PRODUCT INNER JOIN PRODUCT_TYPE ON PRODUCT.Product_type = PRODUCT_TYPE.Type_no WHERE Product_id = '$pid'");
                ?>
                <?php 
                    if(!empty($product_show)){ ?>
                    <div class="col-1">
                    <div class="page-login">
                    <div class="col-1">
                        <div class="img-pr">
                            <img class="img-pr-o" src="<?php echo $product_show[0]['Product_picture']; ?>" width="200px">
                        </div>
                    </div>
                    <div class="col-2">
                        id: <?php echo $product_show[0]['Product_id']; ?>
                    </div>
                </div>
                    <div class="">
                    <form action="?" method="post">
                        <input type="hidden" name="pro_id" value="<?php echo $product_show[0]['Product_id'];?>">
                        <div class="f">
                            <p class="l">ชื่อสินค้า :</p>
                            <label type="text" class="inp"><?php echo $product_show[0]['Product_name']; ?></label>
                        </div>
                        <div class="f">
                            <p class="l">ประเภทสินค้า :</p>
                            <label type="text" class="inp"><?php echo $product_show[0]['Type_name']; ?></label>
                        </div>
                        <div class="f">
                            <p class="l">ราคาขาย :</p>
                            <label type="text" class="inp"><?php echo $product_show[0]['Product_price'] . ' ' . "บาท"; ?></label>
                            <input type="hidden" name="price" value="<?php echo $product_show[0]['Product_price'];?>">
                        </div>
                        <div class="f">
                            <p class="l">จำนวนคงเหลือ :</p>
                            <label type="text" class="inp"><?php echo $product_show[0]['Product_count'] . ' ' .$product_show[0]['Product_unit']; ?></label>
                            <input type="hidden" name="unit" value="<?php echo $product_show[0]['Product_unit'];?>">
                        </div>
                        <div class="f">
                            <p class="l">รายละเอียด :</p>
                            <label type="text" class="inp"><?php echo $product_show[0]['Product_detail']; ?></label>
                        </div>
                        
                            <div class="f">
                                <label class="l">จำนวนซื้อ</label>
                                <input type="text" class="inp" name="Quantity"/>
                            </div>
                                <div class="a">
                                    <button class="btn-shop" type="submit" name="submit">Add to cart</button>
                                </div>
                            </div>
                    </form>
                    </div>
                    <?php } ?>
               
                <?php
                if(isset($_POST['submit'])){
                    $pid = $_SESSION['Id'];
                    $Quantity = $_POST['Quantity'];
                    $pro_id =$_POST['pro_id'];
                    $price = $_POST['price'];
                    $unit = $_POST['unit'];
                    $insql = $db_handle->Execquery("INSERT INTO BASKET_DETAIL (Cust_id,Product_id,Product_num,Product_unit,Product_price,Basket_status) VALUES('$pid','$pro_id','$Quantity','$unit','$price','1')");
                    
                    if($insql){
                        echo "<script type='text/javascript'>alert('บันทึกข้อมูลสำเร็จ');window.location = 'Basket.php';</script>";
                     }else {
                        echo "<script type='text/javascript'>alert('บันทึกข้อมูลไม่สำเร็จ');window.location = 'Basket.php';</script>";
                     }
                }

                if($_GET['st'] == 'D'){
                    $id = $_GET['id'];
                    $cid = $_SESSION['Id'];
                    $del = $db_handle->Execquery("DELETE FROM BASKET_DETAIL WHERE Product_id = '$id' AND Cust_id = '$cid'");

                    if($del){
                        echo "<script type='text/javascript'>alert('บันทึกข้อมูลสำเร็จ');window.location = 'Basket.php';</script>";
                     }else {
                        echo "<script type='text/javascript'>alert('บันทึกข้อมูลไม่สำเร็จ');window.location = 'Basket.php';</script>";
                     }
                    }
                    
            ?>
            <div class="col-2">
                <div class="f">
                    <p class="c j">Basket List : </p>
                    <a class="btn-shop end-1" href="index.php">Shopping again</a>
                </div>
                <table width="100%" border="1">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Count</th>
                        <th>Total</th>
                        <th>Manage</th>
                    </tr>
                    <?php 
                        $total_num = 0;
                        $total_price = 0;
                        foreach ($basket_show as $key => $value) { 
                    ?>
                    <tr>
                        <td><?php echo $basket_show[$key]['Product_id']; ?></td>
                        <td><?php echo $basket_show[$key]['New_name']; ?></td>
                        <td><?php echo $basket_show[$key]['Product_price']; ?></td>
                        <td><?php echo $basket_show[$key]['Product_num']; ?></td>
                        <td><?php echo $basket_show[$key]['Product_num'] * $basket_show[$key]['Product_price']; ?></td>
                        <td><a class="a-link" href="?st=D&id=<?php echo $basket_show[$key]['Product_id']; ?>">ลบ</a></td>
                    </tr>
                    <?php 
                        $total_num = $basket_show[$key]['Product_num'] + $total_num;
                        $total_price = $basket_show[$key]['Product_price'] + $total_price;
                    ?>
                    <?php } ?>
                </table>
               <div class="c-3">
                    <div class="col-1">Total</div>
                    <div class="col-2"><?php echo $total_num . " " . "หน่วย"; ?></div>
                    <div class="col-2"><?php echo $total_price . " " . "บาท"; ?></div>
               </div>
                <div class="c">
                    <p>ประเภทการชำระเงิน :</p>
                    <div class="col-1">
                        <input type="radio" name="pay" id="" value="pay_oneline" >
                        <label for="">ชำระเงินโอนบัญชี</label>
                    </div>
                    <div class="col-2">
                        <input type="radio" name="pay" id="" value="pay_delivery">
                        <label for="">ชำระเงินปลายทาง</label>
                    </div>
                    <div class="con-1">
                        <p>ธนาคารต้นทางที่โอนเงิน :</p>
                    </div>
                    <div class="col-2">
                        <select name="" id="" class="select-op">
                            <option value="">ธนาคารกรุงเทพ</option>
                            <option value="">ธนาคารกสิกรไทย</option>
                            <option value="">ธนาคารกรุงไทย</option>
                            <option value="">ธนาคารกรุงศรีอยุธยา</option>
                            <option value="">ธนาคารไทยพาณิชย์</option>
                        </select>
                    </div>
                   <div class="page-login">
                        <div class="col-1">
                            <p>วันที่โอนเงิน</p>
                            <input type="date" name="" id="">
                        </div>
                        <div class="col-2">
                            <p>เวลาโอนเงิน</p>
                            <input type="time" name="" id="">
                        </div>
                   </div>
                    
                </div>
                <div class="a">
                    <button class="btn-shop"><a href="lnvoice.php">ยืนยันการสั่งซื้อสินค้า</a></button>
                </div>
            </div>
            </div>
        </div>
        <?php } ?>

   

</body>
</html>