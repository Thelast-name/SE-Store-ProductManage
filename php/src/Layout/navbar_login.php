<?php 
    session_start(); 
?>
<div class="header">
    <div class="main">
      <div class="title">
        Member Management 
      </div>
      <ul class="menuber">
        <p>Hello! <?php echo $_SESSION['username']; ?></p>
        <li><a href="MyProfile.php">MyProfile</a></li>
        <li><a href="Basket.php">Basket</a></li>
        <li><a href="logout.php?logout=1">Logout</a></li>
      </ul>
    </div>
</div>