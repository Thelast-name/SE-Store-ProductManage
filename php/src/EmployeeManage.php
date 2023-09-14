<!DOCTYPE html>
<?php
    require 'connectdb.php';

    $x ='';
    if(isset($_POST['searvh'])) {
        $x = "WHERE (Cust_fistname LIKE '%" . $_POST['searvh'] . "%')
        OR (Cust__lastname LIKE '%" . $_POST['searvh'] . "%')";
    }

?>

<html lang="en">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Member Management</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/Style.css">
    <link rel="stylesheet" href="css/adminStyle.css">

</head>

<body class="">
    <div class="adminHeader">
        <div class="main">
            <div class="title">
                Admin Zone
            </div>
            <p>Hi, <?php echo "jaturon"; ?><a href="index.php" class="logout-B">Logout</a></b></p>
            <ul class="menubar">
                <li><b><a href="ProductManage.php">Product</b></li>
                <li><b><a href="EmployeeManage.php">Employee</a></b></li>
                <li><b><a href="MemberManage.php">Member</a></b></li>
            </ul>
        </div>
    </div>

    <div class="main">
        <div class="adminZone">
            <div class="headTopic">
                Employee Management
            </div>
            <div class="col zoneLeft">
                <div class="">
                    <label>Member</label>
                    <button class="button1"><a href="?st=A">New Data</a></button>
                    <form action="MemberManage.php" method="POST">
                    <br><input type="text" name="searvh"><button class="button3">ค้นหา</button><br>
                </div><br>
                <div class="">
                    
                    <?php
                      $member_sql = $pdo->prepare("SELECT *, CONCAT(TRIM(Emp_firstname ),'  ',Emp_lastname) AS New_name FROM EMPLOYEE INNER JOIN POSITION ON (EMPLOYEE.Emp_pos_id=POSITION.Pos_id) $x;"); 
                      $member_sql->execute();
                      $member = $member_sql->fetchAll(PDO::FETCH_ASSOC);
                    ?>                  
                    <table class="mainTable">
                        <tr>
                            <th>#id</th>
                            <th width="50%">Member name</th>
                            <th>Work</th>
                        </tr>
                        <?php foreach ($member as $member_show) { ?>
                            <tr>
                                <td><?php echo $member_show["Emp_id"]; ?></td>
                                <td><?php echo $member_show["New_name"]; ?></td>
                                <td><button class="button2 bg-warning"><a href="?st=V&id=<?php echo $member_show['Emp_id']; ?>">View</a></button>
                                    <button class="button2 bg-danger" onclick="return confirm('กรุณายืนยันการลบข้อมูล ?')"><a href="memberprocess.php?st=D&id=<?php echo $member_show['Emp_id']; ?>">Delete</a></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="col zoneRight">
                <?php
                $id = $member_show['Emp_id'];
                $st = 'V';
                if (isset($_GET['st'])) {
                    $st = $_GET['st'];
                }

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                }
                if (isset($_GET['st'])) {
                    if ($_GET['st'] == 'A') {
                        $id = '';
                    }
                }
                $DataMember_sql = $pdo->prepare("SELECT *, CONCAT(TRIM(Emp_firstname ),'  ',Emp_lastname) AS New_name FROM EMPLOYEE WHERE Emp_id = '$id'"); 
                $DataMember_sql->execute();
                $DataMember = $DataMember_sql->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <form action="MemberProcess.php?st=<?php echo $st; ?>" method="POST">
                <?php foreach ($DataMember as $DataMember_show) { ?>
                    <div class=" detail">
                        <div class="row mb-2">
                            <div class="col-4 p-0"><b>Member id :</b></div>
                            <div class="col-4">
                                <input type="text" name="cid" class="form-control p-0 pl-2" value="<?php echo $DataMember_show["Emp_id"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0"> ชื่อนาม-สกุล:</div>
                            <div class="col-4">
                                <input type="text" name="uname" class="form-control p-0 pl-2" value="<?php echo $DataMember_show["Emp_firstname"]; ?>">
                            </div>
                            <div class="col-4">
                                <input type="text" name="uname" class="form-control p-0 pl-2" value="<?php echo $DataMember_show["Emp_lastname"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">ตำแหน่ง :</div>
                            <div class="col-4">
                                <input type="text" name="passwd" class="form-control p-0 pl-2" value="<?php echo $DataMember_show["Emp_pos_id"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0"> Prename :</div>
                            <div class="col">
                                <input type="text" name="pname" class="form-control p-0 pl-2" value="<?php echo $DataMember_show["Emp_prename"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Emp code 1:</div>
                            <div class="col-4 pr-0"><input type="text" name="fname" class="form-control p-0 pl-2" value="<?php echo $DataMember_show["Emp_code1"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Emp code 2 :</div>
                            <div class="col"><input type="text" name="mlevel" class="form-control p-0 pl-2" value="<?php echo $DataMember_show["Emp_code2"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Emp Bank :</div>
                            <div class="col"><input type="text" name="birth" class="form-control p-0 pl-2" value="<?php echo $DataMember_show["Emp_bank"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Salary :</div>
                            <div class="col"><textarea class="form-control p-0 pl-2" name="address" rows=3><?php echo $DataMember_show["Emp_salary"]; ?></textarea></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5">
                                <?php 
                                    if(!isset($_GET['st']) == 'A'){
                                        ?>
                                        <input type="file" name="file_upload" accept="image/jpeg" require>
                                    <?php }else { ?>
                                        <p class="pl-4">รูปสมาชิก</p>
                                        <img src="<?php echo $DataMember_show["Cust_picture"]; ?>">
                                 <?php  } ?>
                            </div>
                            <div class="col-5 ">
                              
                                <button type="submit">Insert / Update Data</button>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </form>
            </div>
        </div>
    </div>
    
    
</body>

</html>