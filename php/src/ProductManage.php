<!DOCTYPE html>
<?php
    require_once('scripts/Myscript.php');
    $db_handle = new myDBControl();

    $x ='';
    if(isset($_POST['searvh'])) {
        $x = "WHERE (Product_name LIKE '%" . $_POST['searvh'] . "%')";
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
                Prodcut Management
            </div>
            <div class="col zoneLeft">
                <div class="">
                    <label>Member</label>
                    <button class="button1"><a href="?st=A">New Data</a></button>
                    <form action="?" method="POST">
                    <br><input type="text" name="searvh"><button class="button3">ค้นหา</button><br>
                </div><br>
                <div class="">
                    
                    <?php
                        $product = $db_handle->Textquery("SELECT * FROM PRODUCT $x;"); 
                    ?>                  
                    <table class="mainTable">
                        <tr>
                            <th>#id</th>
                            <th width="40%">Member name</th>
                            <th width="10%">In Stock</th>
                            <th>Work</th>
                        </tr>
                        <?php foreach ($product as $key => $value) { ?>
                            <tr>
                                <td><?php echo $product[$key]["Product_id"]; ?></td>
                                <td><?php echo $product[$key]["Product_name"]; ?></td>
                                <td><?php echo $product[$key]["Product_count"]; ?></td>
                                <td><button class="button2 bg-warning"><a href="?st=V&id=<?php echo $product[$key]['Product_id']; ?>">View</a></button>
                                    <button class="button2 bg-danger" onclick="return confirm('กรุณายืนยันการลบข้อมูล ?')"><a href="memberprocess.php?st=D&id=<?php echo $product[$key]['Product_id']; ?>">Delete</a></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
            <div class="col zoneRight">
                <?php
                $id = $product[0]['Product_id'];
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
                $product_show = $db_handle->Textquery("SELECT * FROM PRODUCT WHERE Product_id = '$id'"); 
                ?>
                <form action="ProductProcess.php?st=<?php echo $st; ?>" method="POST">
                    <div class=" detail">
                        <div class="row mb-2">
                            <div class="col-4 p-0"><b>Member id :</b></div>
                            <div class="col-4">
                                <input type="text" name="pid" class="form-control p-0 pl-2" value="<?php echo $product_show[0]["Product_id"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Product Name:</div>
                            <div class="col-4">
                                <input type="text" name="pname" class="form-control p-0 pl-2" value="<?php echo $product_show[0]["Product_name"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Product Type:</div>
                            <div class="col-4">
                                <input type="text" name="ptype" class="form-control p-0 pl-2" value="<?php echo $product_show[0]["Product_type"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Product unit :</div>
                            <div class="col-4">
                                <input type="text" name="punit" class="form-control p-0 pl-2" value="<?php echo $product_show[0]["Product_unit"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Product cost :</div>
                            <div class="col">
                                <input type="text" name="pcost" class="form-control p-0 pl-2" value="<?php echo $product_show[0]["Product_cost"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Product price :</div>
                            <div class="col-4 pr-0"><input type="text" name="price" class="form-control p-0 pl-2" value="<?php echo $product_show[0]["Product_price"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Product count :</div>
                            <div class="col"><input type="text" name="pcount" class="form-control p-0 pl-2" value="<?php echo $product_show[0]["Product_count"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Product low :</div>
                            <div class="col"><input type="text" name="plow" class="form-control p-0 pl-2" value="<?php echo $product_show[0]["Product_low"]; ?>"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Product high :</div>
                            <div class="col">
                                <input type="text" name="phigh" class="form-control p-0 pl-2" value="<?php echo $product_show[0]["Product_high"]; ?>">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Product detail :</div>
                            <div class="col"><textarea class="form-control p-0 pl-2" name="pdetail" rows=3><?php echo $product_show[0]["Product_detail"]; ?></textarea></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4 p-0">Product Status :</div>
                            <select name="pstatus" id="">
                                <option value=""><?php echo $product_show[0]['Product_status'] . " " . "[เดิม]"; ?></option>
                                    <option value="0">0 สินค้าปกติ</option>
                                    <option value="1">1 สินค้าแนะนะ</option>
                            </select>
                        </div>
                        <div class="row mb-2">
                            <div class="col-5">
                                <?php 
                                    if($_GET['st'] == 'A'){
                                        ?>
                                        <input type="file" name="file_upload" accept="image/jpeg" require>
                                    <?php }else { ?>
                                        <p class="pl-4">รูปสมาชิก</p>
                                        <img src="<?php echo $product_show[0]["Product_picture"]; ?>">
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