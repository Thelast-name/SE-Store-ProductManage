<!DOCTYPE html>
<?php
    require_once('scripts/Myscript.php');
    $db_handle = new myDBControl();

    $x ='';
    if(isset($_POST['searvh'])) {
        $x = "WHERE (Emp_firstname LIKE '%" . $_POST['searvh'] . "%')
        OR (Emp_lastname LIKE '%" . $_POST['searvh'] . "%')";
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
</head>

<body class="">
    <?php include "Layout/navbar_admin.php"; ?>
    <div class="main">
        <div class="adminZone">
            <div class="headTopic">
                Employee Management
            </div>
            <div class="col zoneLeft">
                <div class="">
                    <button class="button1"><a href="?st=A">New Data</a></button>
                    <form action="?" method="POST">
                    <br><input type="text" name="searvh"><button class="button3">ค้นหา</button><br>
                </div><br>
                <div class="">
                    
                    <?php
                      $emp_sql = $db_handle->Textquery("SELECT *, CONCAT(TRIM(Emp_firstname ),'  ',Emp_lastname) AS New_name FROM EMPLOYEE INNER JOIN POSITION ON (EMPLOYEE.Emp_pos_id=POSITION.Pos_id) $x;");
                    ?>                  
                    <table class="mainTable">
                        <tr>
                            <th>#id</th>
                            <th width="40%">Employee name</th>
                            <th width="10%">Position</th>
                            <th>Work</th>
                        </tr>
                        <?php foreach ($emp_sql as $key => $value) { ?>
                            <tr>
                                <td><?php echo $emp_sql[$key]["Emp_id"]; ?></td>
                                <td><?php echo $emp_sql[$key]["New_name"]; ?></td>
                                <td><?php echo $emp_sql[$key]["Pos_name"]; ?></td>
                                <td><button class="button2 bg-warning"><a class="ab" href="?st=V&id=<?php echo $emp_sql[$key]['Emp_id']; ?>">View</a></button>
                                    <button class="button2 bg-danger" onclick="confirm('กรุณายืนยันการลบข้อมูล ?')"><a class="ab" href="?st=D&id=<?php echo $emp_sql[$key]['Emp_id']; ?>">Delete</a></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="col zoneRight">
                <?php
                $id = $emp_sql[0]['Emp_id'];
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
                $emp_show = $db_handle->Textquery("SELECT *, CONCAT(TRIM(Emp_firstname),'  ',Emp_lastname) AS New_name FROM EMPLOYEE WHERE Emp_id = '$id'");
                ?>
                <form action="EmployeeManage.php?st=<?php echo $st; ?>" method="POST">
                    <div class=" detail">
                        <div class="row mb-2">
                            <div class="col-4 p-0"><b>Member id :</b></div>
                            <div class="col-4">
                                <input type="text" name="eid" class="form-control p-0 pl-2" value="<?php echo $emp_show[0]["Emp_id"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">User Name :</div>
                            <div class="col-4">
                                <input type="text" name="euname" class="form-control p-0 pl-2" value="<?php echo  $emp_show[0]["Emp_UN"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Password :</div>
                            <div class="col-4">
                                <input type="text" name="epw" class="form-control p-0 pl-2" value="<?php echo  $emp_show[0]["Emp_PW"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0"> Prename :</div>
                            <div class="col">
                                <input type="text" name="epname" class="form-control p-0 pl-2" value="<?php echo  $emp_show[0]["Emp_prename"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Employee Name:</div>
                            <div class="col-4">
                                <input type="text" name="efname" class="form-control p-0 pl-2" value="<?php echo $emp_show[0]["Emp_firstname"]; ?>">
                            </div>
                            <div class="col-4">
                                <input type="text" name="elname" class="form-control p-0 pl-2" value="<?php echo $emp_show[0]["Emp_lastname"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Position :</div>
                            <div class="col-4">
                                <select name="position" classclass="form-control p-0 pl-2">
                                    <option><?php echo  $emp_show[0]["Emp_pos_id"] . " " . "[เดิม]"; ?></option>
                                    <?php 
                                        $member_show =  $db_handle->Textquery("SELECT Pos_id,Pos_name FROM POSITION");
                                        foreach ($member_show as $key_1 => $value) { ?>
                                        <option value="<?php echo $member_show[$key_1]['Pos_id']; ?>"><?php echo $member_show[$key_1]['Pos_id'] . " " . $member_show[$key_1]['Pos_name']; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Personal Code:</div>
                            <div class="col-4 pr-0"><input type="text" name="pcode" class="form-control p-0 pl-2" value="<?php echo  $emp_show[0]["Emp_code1"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Social Code:</div>
                            <div class="col"><input type="text" name="scode" class="form-control p-0 pl-2" value="<?php echo  $emp_show[0]["Emp_code2"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Bank Account:</div>
                            <div class="col"><input type="text" name="bankA" class="form-control p-0 pl-2" value="<?php echo  $emp_show[0]["Emp_bank"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Salary :</div>
                            <div class="col"><input type="text" name="salary" class="form-control p-0 pl-2" value="<?php echo $emp_show[0]["Emp_salary"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5">
                                <?php 
                                    if($_GET['st'] == 'A'){
                                        ?>
                                        <input type="file" name="file_upload" accept="image/jpeg" require>
                                    <?php }else { ?>
                                        <p class="pl-4">รูปสมาชิก</p>
                                        <img src="<?php echo  $emp_show[0]["Emp_picture"]; ?>">
                                 <?php  } ?>
                            </div>
                            <div class="col-5 ">
                                <button type="submit">Insert / Update Data</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    
</body>

</html>