<!DOCTYPE html>
<html lang="en">
<?php
    require_once('scripts/Myscript.php');
    $db_handle = new myDBControl();
    session_start(); 

    $x = '';
    // ตรวจสอบการส่ง คำค้น
    if (isset($_POST['searvh'])) {
        $x = "WHERE (Product_name LIKE '%".$_POST['searvh']."%')";    
    }

    //ตรวจสอบการส่ง ประเภทสินค้า
    if (isset($_GET['Stype'])) {
        $x = "WHERE (Product_type = '".$_GET['Stype']."')";    
    }
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5673603 Software Construction and Evolution</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/Style.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

<!-- พี่ออมสิน -->
<?php include('Layout/header.php'); ?>
<div class="container">
    <!-- วราวุฒิ -->
    <header class="header">
        <div id="carouselExample" class="carousel slide">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/1.png" class="image_slice" alt=" ...">
                </div>
                <div class="carousel-item">
                    <img src="img/2.png" class="image_slice" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/3.png" class="image_slice" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="img/4.png" class="image_slice" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </header>

    <!-- นราวิชญ์ -->
    <?php 
        $productdetail = $db_handle->Textquery("SELECT PRODUCT.*, CONCAT(LEFT(Product_name, 10),'...') AS New_name, Type_name FROM PRODUCT INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type=PRODUCT_TYPE.Type_no) LIMIT 5;"); 
   
                   
    ?>
    <div class="c-1-top">
        <?php 
           foreach ($productdetail as $key => $value) {
        ?>
            <div class="ca">
                <div class="ca-img">
                    <img class="img-1" src="<?php echo $productdetail[$key]["Product_picture"]; ?>">
                </div>
                <div class="conent">
                    <p><?php echo $productdetail[$key]["New_name"]; ?></p>
                    <p><?php echo $productdetail[$key]['Type_name'] ?></p>
                    <p>Price :  <?php echo $productdetail[$key]['Product_price'] ?></p>
                    <div class="ca-foo">
                        <?php
                          if(empty($_SESSION['username']) &&  empty($_SESSION['Id'])){ ?>
                            <a href="#" class="lc-1">Shop now</a>
                          <?php }else { ?>
                            <a href="Basket.php?id=<?php echo $productdetail[$key]["Product_id"]; ?>" class="lc-1">Shop now</a>
                          <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
  

    <!-- พี่จาตุรนต์ -->
    <div class="row search">
            <div class="col-5">
                <form action= "index.php" Method="POST">
                    <input type="text" placeholder="Search" name="searvh" require>
                    <button type="submit" name="act" class="s-btn-search">ค้นหา</button>
                </form>
            </div>
            <div class="col-2"></div>
            <div class="col-5">
                <?php $Typedetail = $db_handle->Textquery("SELECT * FROM PRODUCT_TYPE;") ?>                
                <select aria-label="Default select example" name = "Stype" 
                onchange="window.location='index.php?Stype='+this.value+''">
                    <?php if (empty($Typedetail)) { ?>
                        <option selected>ไม่มีประเภทสินค้า</option>    
                    <?php } else { ?>
                        <option selected>ทุกประเภทสินค้า</option>
                        <?php foreach ($Typedetail as $key => $value) {?>
                             <option value="<?php echo $Typedetail[$key]["Type_no"]; ?>">
                             <?php echo $Typedetail[$key]["Type_name"]; ?></option>
                             <?php } 
                    } ?>
                </select>
            </div>
        </div>

        <div class="c-1">
            <?php 
                $allpro = $db_handle->Textquery("SELECT PRODUCT.*, CONCAT(LEFT(Product_name, 20),'...') AS New_name, Type_name FROM PRODUCT INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type=PRODUCT_TYPE.Type_no) ".$x.";");
               
                 foreach ($allpro  as $key => $value) {
            ?>
                <div class="ca">
                    <div class="ca-img">
                        <img src="<?php echo $allpro [$key]['Product_picture'] ?>" alt="" class="img-1">
                    </div>
                    <div class="conent">
                        <p><strong><?php echo $allpro[$key]["New_name"]; ?></strong></p>
                        <p>Price: <?php echo $allpro [$key]['Product_price'] ?></p>
                        <p>Stock in : <?php echo $allpro[$key]["Product_count"]; ?></p>
                    </div>
                    <div class="ca-foo">
                        <?php
                          if(empty($_SESSION['username']) &&  empty($_SESSION['Id'])){ ?>
                            <a href="#" class="lc-1">Shop now</a>
                          <?php }else { ?>
                            <a href="Basket.php?id=<?php echo $allpro[$key]["Product_id"]; ?>" class="lc-1">Shop now</a>
                          <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


<body>

</body>

</html>