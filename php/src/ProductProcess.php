<?php
    require_once('scripts/Myscript.php');
    $db_handle = new myDBControl();

    if(isset($_GET['st'])){
        $st = $_GET['st'];

        if($st == "A"){
            $pid = $_POST['pid'];
            $pname = $_POST['pname'];
            $ptype = $_POST['ptype'];
            $punit = $_POST['punit'];
            $pcost = $_POST['pcost'];
            $price = $_POST['price'];
            $pcount = $_POST['pcount'];
            $plow = $_POST['plow'];
            $phigh = $_POST['phigh'];
            $pdetail = $_POST['pdetail'];
            $pstatus = $_POST['pstatus'];
            $fileupload = $_FILES['file_upload'];
            
            
            if($fileupload <> ''){
               $path = "img/Member/" . $cid . ".jpg";
               move_uploaded_file($_FILES['file_upload']['tmp_name'], $path);
            }
            $insql = $db_handle->Execquery("INSERT INTO PRODUCT VALUES('$pid','$pname', '$ptype','$punit','$pcost','$price','$pcount','$plow','$phigh','$path', '$pdetail', '$pstatus')");
        
            if($insql){
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลสำเร็จ');window.location = 'ProductManage.php';</script>";
             }else {
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลไม่สำเร็จ');window.location = 'ProductManage.php';</script>";
             }
        }

        if($st == "D"){
            $id = $_GET['id'];
            $del = $db_handle->Execquery("DELETE FROM PRODUCT WHERE Product_id = '$id'");

            if($del){
                echo "<script type='text/javascript'>alert('ลบข้อมูลสำเร็จ');window.location = 'ProductManage.php';</script>";
            }else{
                echo "<script type='text/javascript'>alert('ลบข้อมูลไม่สำเร็จ');window.location = 'ProductManage.php';</script>";
            }
        }

        if($st == "V"){
            $pid = $_POST['pid'];
            $pname = $_POST['pname'];
            $ptype = $_POST['ptype'];
            $punit = $_POST['punit'];
            $pcost = $_POST['pcost'];
            $price = $_POST['price'];
            $pcount = $_POST['pcount'];
            $plow = $_POST['plow'];
            $phigh = $_POST['phigh'];
            $pdetail = $_POST['pdetail'];
            $pstatus = $_POST['pstatus'];
            // $fileupload = $_FILES['file_upload'];

            $upsql = $db_handle->Execquery("UPDATE PRODUCT SET Product_name = '$pname', Product_type = '$ptype', Product_unit = '$punit', Product_cost = '$pcost', Product_price = '$price', Product_count = '$pcount', Product_low	 = '$plow', Product_high = '$phigh', Product_detail = '$pdetail', Product_status = '$pstatus' WHERE Product_id = '$pid'");

            if($upsql){
                echo "<script type='text/javascript'>alert('แก้ไขข้อมูลสำเร็จ');window.location = 'ProductManage.php';</script>";
            }else {
                echo "<script type='text/javascript'>alert('แก้ไขข้อมูลไม่สำเร็จ');window.location = 'ProductManage.php';</script>";
            }
        }
        

        
    }