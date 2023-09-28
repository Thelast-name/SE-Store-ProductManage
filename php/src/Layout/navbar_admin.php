<?php
    session_start();
?>
<div class="adminHeader">
        <div class="main">
            <div class="title">
                Admin Zone
            </div>
            <p>Hi, <?php echo $_SESSION['username']; ?><a href="logout.php?logout" class="logout-B">Logout</a></b></p>
            <ul class="menubar">
                <li><b><a href="ProductManage.php">Product</b></li>
                <li><b><a href="EmployeeManage.php">Employee</a></b></li>
                <li><b><a href="MemberManage.php">Member</a></b></li>
            </ul>
       </div>
 </div>