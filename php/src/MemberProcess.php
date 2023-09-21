<?php
    require_once('scripts/Myscript.php');
    $db_handle = new myDBControl();

    if(isset($_GET['st'])){
        $st = $_GET['st'];

        if($st == "A"){
            $cid = $_POST['cid'];
            $uname = $_POST['uname'];
            $passwd = $_POST['passwd'];
            $pname = $_POST['pname'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $mlev = $_POST['mlev'];
            $birth = $_POST['birth'];
            $address = $_POST['address'];
            $tel = $_POST['tel'];
            $fileupload = $_FILES['file_upload'];
            
            
            if($fileupload <> ''){
               $path = "img/Member/" . $cid . ".jpg";
               move_uploaded_file($_FILES['file_upload']['tmp_name'], $path);
            }
            $insql = $db_handle->Execquery("INSERT INTO CUSTOMER VALUES('$uname','$passwd', '$cid','$pname','$fname','$lname','$mlev','$birth','$address','$tel','$path')");
        
            if($insql){
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลสำเร็จ');window.location = 'MemberManage.php';</script>";
             }else {
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลไม่สำเร็จ');window.location = 'MemberManage.php';</script>";
             }
        }

        if($st == "D"){
            $id = $_GET['id'];
            $del = $db_handle->Execquery("DELETE FROM CUSTOMER WHERE Cust_id = '$id'");

            if($del){
                echo "<script type='text/javascript'>alert('ลบข้อมูลสำเร็จ');window.location = 'MemberManage.php';</script>";
            }else{
                echo "<script type='text/javascript'>alert('ลบข้อมูลไม่สำเร็จ');window.location = 'MemberManage.php';</script>";
            }
        }

        if($st == "V"){
            $cid = $_POST['cid'];
            $uname = $_POST['uname'];
            $passwd = $_POST['passwd'];
            $pname = $_POST['pname'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $mlev = $_POST['mlev'];
            $birth = $_POST['birth'];
            $address = $_POST['address'];
            $tel = $_POST['tel'];
            // $fileupload = $_FILES['file_upload'];

            $upsql = $db_handle->Execquery("UPDATE CUSTOMER SET Cust_UN = '$uname', Cust_PW	= '$passwd', Cust_prename = '$pname', Cust_firstname = '$fname', Cust_lastname = '$lname', Cust_level = '$mlev', Cust_birth = '$birth', Cust_address = '$address', Cust_tel = '$tel' WHERE Cust_id = '$cid'");

            if($upsql){
                echo "<script type='text/javascript'>alert('แก้ไขข้อมูลสำเร็จ');window.location = 'MemberManage.php';</script>";
            }else {
                echo "<script type='text/javascript'>alert('แก้ไขข้อมูลไม่สำเร็จ');window.location = 'MemberManage.php';</script>";
            }
        }
        

        
    }