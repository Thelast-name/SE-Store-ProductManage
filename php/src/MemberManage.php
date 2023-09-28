<!DOCTYPE html>
<?php
require_once('scripts/Myscript.php');
$db_handle = new myDBControl();

$x ='';
if(isset($_POST['searvh'])) {
    $x = "WHERE (Cust_firstname LIKE '%" . $_POST['searvh'] . "%')
    OR (Cust_lastname LIKE '%" . $_POST['searvh'] . "%')";
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
                Member Management
            </div>
            <div class="col zoneLeft">
                <div class="">
                    <button class="button1"><a href="?st=A">New Data</a></button>
                    <form action="MemberManage.php" method="POST">
                        <br><input type="text" name="searvh"><button class="button3">ค้นหา</button><br>
                    </form>
                </div><br>
                <div class="">
                    <?php $Data = $db_handle->Textquery("SELECT *, CONCAT(TRIM(Cust_firstname),'  ',Cust_lastname) AS New_name FROM CUSTOMER INNER JOIN MEMBER_LEVEL ON (CUSTOMER.Cust_level=MEMBER_LEVEL.Lev_id) $x;");
                    ?>                  
                    <table class="mainTable">
                        <tr>
                            <th>#id</th>
                            <th width="40%">Member name</th>
                            <th width="10%">Birthdate</th>
                            <th>Work</th>
                        </tr>
                        <?php foreach ($Data as $key => $value) { ?>
                            <tr>
                                <td><?php echo $Data[$key]["Cust_id"]; ?></td>
                                <td><?php echo $Data[$key]["New_name"]; ?></td>
                                <td><?php echo $Data[$key]["Cust_birth"]; ?></td>
                                <td><button class="button2 bg-warning"><a class="ab" href="?st=V&id=<?php echo $Data[$key]['Cust_id']; ?>">View</a></button>
                                    <button class="button2 bg-danger" onclick="confirm('กรุณายืนยันการลบข้อมูล ?')"><a class="ab" href="MemberProcess.php?st=D&id=<?php echo $Data[$key]['Cust_id']; ?>">Delete</a></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="col zoneRight">
                <?php
                $id = $Data[0]['Cust_id'];
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
                $DataMember = $db_handle->Textquery("SELECT * FROM CUSTOMER WHERE Cust_id = '$id'");
                ?>
                <form action="MemberProcess.php?st=<?php echo $st; ?>" method="POST" enctype="multipart/form-data">
                    <div class=" detail">
                        <div class="row mb-2">
                            <div class="col-4 p-0"><b>Member id :</b></div>
                            <div class="col-4">
                                <input type="text" name="cid" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_id"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">User Name :</div>
                            <div class="col-4">
                                <input type="text" name="uname" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_UN"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Password :</div>
                            <div class="col-4">
                                <input type="text" name="passwd" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_PW"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0"> Prename :</div>
                            <div class="col">
                                <input type="text" name="pname" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_prename"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Member Name :</div>
                            <div class="col-4 pr-0"><input type="text" name="fname" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_firstname"]; ?>"></div>
                            <div class="col-4 pl-0"><input type="text" name="lname" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_lastname"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Member Level :</div>
                            <select name="mlev" id="">
                                <option value=""><?php echo $DataMember[0]['Cust_level'] . " " . "[เดิม]"; ?></option>
                                <?php 
                                    $member_show =  $db_handle->Textquery("SELECT Lev_id,Lev_name FROM MEMBER_LEVEL");
                                    foreach ($member_show as $key_1 => $value) { ?>
                                    <option value="<?php echo $member_show[$key_1]['Lev_id'] ;?>"><?php echo $member_show[$key_1]['Lev_id'] . " " . $member_show[$key_1]['Lev_name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Birthday :</div>
                            <div class="col"><input type="text" name="birth" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_birth"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Address :</div>
                            <div class="col"><textarea class="form-control p-0 pl-2" name="address" rows=3><?php echo $DataMember[0]["Cust_address"]; ?></textarea></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Telephone :</div>
                            <div class="col"><input type="text" name="tel" class="form-control p-0 pl-2" value="<?php echo $DataMember[0]["Cust_tel"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5">
                                <?php 
                                    if($_GET['st'] == 'A'){
                                        ?>
                                        <input type="file" name="file_upload" accept="image/jpeg" require>
                                    <?php }else { ?>
                                        <p class="pl-4">รูปสมาชิก</p>
                                        <img src="<?php echo $DataMember[0]["Cust_picture"]; ?>">
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