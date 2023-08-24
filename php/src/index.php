<!DOCTYPE html>
<html lang="en">
<?php
   require 'connectdb.php'; // Include the database connection file
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
<?php include('header.php'); ?>
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
        $reproduct = $pdo->prepare("SELECT PRODUCT.*, CONCAT(LEFT(Product_name, 10),'...') AS New_name, Type_name FROM PRODUCT INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type=PRODUCT_TYPE.Type_no) LIMIT 5;"); 
        $reproduct->execute();
        $repro = $reproduct->fetchAll(PDO::FETCH_ASSOC);
                    
    ?>
    <div class="product">
        <?php 
            foreach ($repro as $repro1) {
        ?>
            <div class="productBox">
                <img class="productImg" src="<?php echo $repro1["Product_picture"]; ?>">
                <div class="productTxt">
                    <p><?php echo $repro1["New_name"]; ?></p>
                    <p><?php echo $repro1['Type_name'] ?></p>
                    <p>Price :<?php echo $repro1['Product_price'] ?></p>
                    <button><a href="#">ซื้อสินค้า</a></button>
                </div>
            </div>
        <?php } ?>
    </div>
  

    <!-- พี่จาตุรนต์ -->
    <h3 class="text-cetner">All Product</h3>
    <div class="conn-1">
        <div class="search" type="submit" >
            <input type="text"  placeholder="Search" name="searvh" require>
            <button type="submit" name="act" value="" class="btn btn-default">ค้นหา</button>      
            <select class="select"  aria-label="Default select example">
                <option selected>เลือกประเภทสินค้า</option>
                <option value="1">ขนม</option>
                <option value="2">อาหาร</option>
                <option value="3">เครืองดื่ม</option>
            </select>
        </div>

        <div class="c-1">
            <?php 
                $stmt = $pdo->prepare("SELECT *, CONCAT(LEFT(Product_name, 13),'...') AS New_name, SUBSTRING(Type_name,LOCATE('-',Type_name)+1,50) AS New_type FROM PRODUCT INNER JOIN PRODUCT_TYPE ON (PRODUCT.Product_type = PRODUCT_TYPE.Type_no)");
                $stmt->execute();
            
                // Fetch the results as associative arrays
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                // Loop through the results and display them
                foreach ($results as $row) {
            ?>
                <div class="ca">
                    <div class="ca-img">
                        <img src="<?php echo $row['Product_picture'] ?>" alt="" class="img-1">
                    </div>
                    <div class="conent">
                        <p>ชื่อสินค้า: <?php echo $row['New_name'] ?></p>
                        <p>ประเภท: <?php echo $row['New_type'] ?></p>
                        <p>ราคา: <?php echo $row['Product_price']; ?></p>
                    </div>
                    <div class="ca-foo">
                        <p><a href="#" class="lc-1">Shop now</a></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


<body>

</body>

</html>