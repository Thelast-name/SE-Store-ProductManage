<?php
    require_once('scripts/Myscript.php');
    $db_handle = new myDBControl();
    session_start();

    $username = $_POST['username'];    
    $pass = $_POST['pass'];
        
    echo $username . "<br>";
    echo $pass . "<br>";
    $check_login = $db_handle->Textquery("SELECT * FROM AUTHENDATA WHERE Uname = '" . $username ."' AND Passwd = '" . $pass . "'");
    echo $check_login[0]['Firstname'];
    if(!empty($check_login)) {
        if($check_login[0]['Tid'] == '1'){
            $_SESSION['username'] = $check_login[0]['Firstname'];
            $_SESSION['Id'] = $check_login[0]['Id'];
            header('Location: MyProfile.php');
        }else {
            $_SESSION['username'] = $check_login[0]['Firstname'];
            header('Location: MemberManage.php');
        } 
    }else {
        $_SESSION['error'] = "คุณไม่มีสิทธิ์ในการเข้าสู่ระบบ";
        header('Location: login.php');
    }
?>