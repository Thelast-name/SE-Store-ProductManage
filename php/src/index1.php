<?php
    require_once('scripts/Myscript.php');
    $db_handle = new myDBControl();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Product ALL</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>

<body>

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



    <div class="con-a">
        <div class="hproduct">
            <h3>Product ALL</h3>
        </div>
        <div class="s">
            <form action="" method="get">
                <input type="text" class="i-text">
                <button type="button" class="b">search</button>
            </form>
            <select name="" id="" class="o">
                <option value="">1</option>
                <option value="">2</option>
            </select>
        </div>
        <div class="col-1">
        <?php
            $product = $db_handle->Textquery("SELECT * FROM PRODUCT");
            foreach ($product as $key => $value) {
            ?>
            <div class="card">
                <div class="card-img">
                    <img src="<?php echo $product[$key]['Product_picture']; ?>" alt="" class="img-1">
                </div>
                <div class="conent">
                    <p>Product Name: <?php echo $product[$key]['Product_name']; ?></p>
                    <p>Product Price: <?php echo $product[$key]['Product_price']; ?></p>
                    <p>Product Stock: <?php echo $product[$key]['Product_count']; ?></p>
                </div>
                <div class="card-foo">
                    <p>Shop now</p>
                </div>
            </div>
           <?php } ?>
        </div>
    </div>
    
</body>
</html>