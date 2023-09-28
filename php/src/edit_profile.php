<?php
    // require_once('scripts/Myscript.php');
    // $db_handle = new myDBControl();

    $id = $_GET['id'];
    $user = $_POST['Uname'];
    $passwd = $_POST['PW'];
    $prename = $_POST['prename'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $c_level = $_POST['C_level'];
    $birth = $_POST['birth'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];

    // $edit_sql = $db_handle->Execquery("UPDATE CUSTOMER SET Cust_UN = '$user', Cust_PW = '$passwd', Cust_prename = "$prename", Cust_firstname = '$fname', Cust_lastname = '$lname', Cust_level = '$C_level', Cust_birth = '$birth', Cust_address = '$address', Cust_tel = '$tel' WHERE 	Cust_id = '$id'");
    // echo "UPDATE CUSTOMER SET Cust_UN = '$user', Cust_PW = '$passwd', Cust_prename = "$prename", Cust_firstname = '$fname', Cust_lastname = '$lname', Cust_level = '$C_level', Cust_birth = '$birth', Cust_address = '$address', Cust_tel = '$tel' WHERE Cust_id = '$id'";
    // echo $id . ': ' . $user . '|' . $passwd . '|' . $prename . '|' . $fname . '|' . $lname . '|' . $c_level . '|' . $birth . '|' . $tel . '|';

    // if($edit_sql){
    //     echo "<script type='text/javascript'>alert('แก้ไขข้อมูลสำเร็จ');window.location = 'MyProfile.php';</script>";
    // }else {
    //     echo "<script type='text/javascript'>alert('แก้ไขข้อมูลไม่สำเร็จ');window.location = 'MyProfile.php.php';</script>";
    // }