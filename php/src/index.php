<!DOCTYPE html>
<html lang="en">
<?php
    require_once('scripts/Myscript.php');
    $db_handle = new myDBControl();
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
    <?php $productdetail = $db_handle->Textquery("SELECT PRODUCT.*, CONCAT(LEFT(Product_name, 10),'...') AS New_name FROM PRODUCT LIMIT 5"); ?>
    <div class="product">
        <?php foreach ($productdetail as $key => $value) {
        ?>
            <div class="productBox">
                <img class="productImg" src="<?php echo $productdetail[$key]["Product_picture"]; ?>">
                <div class="productTxt">
                    <h3>The best : #<?php echo $key + 1; ?></h3>
                    <p>Name : <?php echo $productdetail[$key]["New_name"]; ?></p>
                    <button><a href="#">ซื้อสินค้า</a></button>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- พี่จาตุรนต์ -->
    <div class="conn-1">
        <h3 class="text-cetner">All Product</h3>
        <form class="navbar-form navbar-left" method="get">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search" name="searvh" require>
            </div>
            <button type="submit" name="act" value="" class="btn btn-default">
                ค้นหา</button>
        </form>
        <div class="c-1">
            <?php for ($i = 0; $i <= 30; $i++) { ?>
                <div class="ca">
                    <div class="ca-img">
                        <img src="https://images.unsplash.com/photo-1572635196237-14b3f281503f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=580&q=80" alt="" class="img-1">
                    </div>
                    <div class="conent">
                        <p>Product Name: item1</p>
                        <p>Product Category:</p>
                        <p>Product Price: $20</p>
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