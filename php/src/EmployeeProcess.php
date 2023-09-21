<?php
    require_once('scripts/Myscript.php');
    $db_handle = new myDBControl();

    if(isset($_GET['st'])){
        $st = $_GET['st'];

        if($st == "A"){
            $eid = $_POST['eid'];
            $uname = $_POST['euname'];
            $passwd = $_POST['epw'];
            $pname = $_POST['epname'];
            $fname = $_POST['efname'];
            $lname = $_POST['elname'];
            $position = $_POST['position'];
            $pcode = $_POST['pcode'];
            $scode = $_POST['scode'];
            $bankA = $_POST['bankA'];
            $salary = $_POST['salary'];
            $fileupload = $_FILES['file_upload'];
            
            
            if($fileupload <> ''){
               $path = "img/Member/" . $cid . ".jpg";
               move_uploaded_file($_FILES['file_upload']['tmp_name'], $path);
            }
            $insql = $db_handle->Execquery("INSERT INTO EMPLOYEE VALUES('$uname','$passwd', '$eid','$pname','$fname','$lname','$position','$pcode','$scode','$bankA', '$salary', '$path')");
        
            if($insql){
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลสำเร็จ');window.location = 'EmployeeManage.php.php';</script>";
             }else {
                echo "<script type='text/javascript'>alert('บันทึกข้อมูลไม่สำเร็จ');window.location = 'EmployeeManage.php.php';</script>";
             }
        }

        if($st == "D"){
            $id = $_GET['id'];
            $del = $db_handle->Execquery("DELETE FROM EMPLOYEE WHERE Emp_id = '$id'");

            if($del){
                echo "<script type='text/javascript'>alert('ลบข้อมูลสำเร็จ');window.location = 'EmployeeManage.php.php';</script>";
            }else{
                echo "<script type='text/javascript'>alert('ลบข้อมูลไม่สำเร็จ');window.location = 'EmployeeManage.php.php';</script>";
            }
        }

        if($st == "V"){
            $eid = $_POST['eid'];
            $uname = $_POST['euname'];
            $passwd = $_POST['epw'];
            $pname = $_POST['epname'];
            $fname = $_POST['efname'];
            $lname = $_POST['elname'];
            $position = $_POST['position'];
            $pcode = $_POST['pcode'];
            $scode = $_POST['scode'];
            $bankA = $_POST['bankA'];
            $salary = $_POST['salary'];
            // $fileupload = $_FILES['file_upload'];

            $upsql = $db_handle->Execquery("UPDATE EMPLOYEE SET Emp_UN = '$uname', Emp_PW	= '$passwd', Emp_prename = '$pname', Emp_firstname = '$fname', Emp_lastname = '$lname', Emp_pos_id = '$position', Emp_code1	 = '$pcode', Emp_code2 = '$scode', Emp_bank = '$bankA', Emp_salary = '$salary' WHERE Emp_id = '$cid'");

            if($upsql){
                echo "<script type='text/javascript'>alert('แก้ไขข้อมูลสำเร็จ');window.location = 'EmployeeManage.php.php';</script>";
            }else {
                echo "<script type='text/javascript'>alert('แก้ไขข้อมูลไม่สำเร็จ');window.location = 'EmployeeManage.php.php';</script>";
            }
        }
        

        
    }