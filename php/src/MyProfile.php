<?php 
  session_start(); 
  require_once('scripts/Myscript.php');
  $db_handle = new myDBControl();

  if(empty($_SESSION['username']) &&  empty($_SESSION['Id'])){
    header('location: login.php');
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <link rel="stylesheet" href="css/mystyle.css" />
  <title>My Profile</title>
</head>

<body>
  <?php include 'Layout/navbar_login.php'; ?>
  <?php 
    $id = $_SESSION['Id'];
    $myProfile = $db_handle->Textquery("SELECT * FROM CUSTOMER WHERE Cust_id = '$id'");
  ?>
  <div class="main">
    <h2 class="h23">My Profile</h2>
    <div class="page-login">
      <div class="col-1">
        <h3 class="h33">Member Data : <?php echo $myProfile[0]['Cust_id']; ?></h3>
        <div class="login">
          <form action="edit_profile.php?id=<?php echo $myProfile[0]['Cust_id']; ?>" method="post">
            <div class="f">
              <label class="l">User Name</label>
              <input type="text" class="inp" name="Uname" value="<?php echo $myProfile[0]['Cust_UN']; ?>"/>
            </div>
            <div class="f">
              <label class="l">Password</label>
              <input type="text" class="inp" name="PW" value="<?php echo $myProfile[0]['Cust_PW']; ?>"/>
            </div>
            <div class="f">
              <label class="l">Prename</label>
              <select name="C_prename" class="select-op">
                  <option value="<?php echo $myProfile[0]['Cust_prename']; ?>"><?php echo $myProfile[0]['Cust_prename'] . " " . "[เดิม]"; ?></option>
                  <option value="นาย">นาย</option>
                  <option value="นาง">นาง</option>
                  <option value="นางสาว">นางสาว</option>
              </select>
            </div>
            <div class="f">
              <label class="l">Member name</label>
              <input type="text" class="inp" name="fname" value="<?php echo $myProfile[0]['Cust_firstname']; ?>" />
              <input type="text" class="inp" name="lname" value="<?php echo $myProfile[0]['Cust_lastname']; ?>" />
            </div>
            <div class="f">
              <label class="l">Member Level</label>
              <select name="c_level" class="select-op">
                <option value="<?php echo $myProfile[0]['Cust_level']; ?>"><?php echo $myProfile[0]['Cust_level'] . " " . "[เดิม]"; ?></option>
                <?php 
                    $member_show =  $db_handle->Textquery("SELECT Lev_id,Lev_name FROM MEMBER_LEVEL");
                    foreach ($member_show as $key_1 => $value) { ?>
                      <option value="<?php echo $member_show[$key_1]['Lev_id'] ;?>"><?php echo $member_show[$key_1]['Lev_id'] . " " . $member_show[$key_1]['Lev_name']; ?></option>
                  <?php } ?>
              </select>
            </div>
            <div class="f">
              <label class="l">Brithday</label>
              <input type="text" class="inp" name="birth" value="<?php echo $myProfile[0]['Cust_birth']; ?>" />
            </div>
            <div class="f">
              <label class="l">Address</label>
              <textarea id="" cols="15" rows="5" name="address" class="inp"><?php echo $myProfile[0]['Cust_address']; ?></textarea>
            </div>
            <div class="f">
              <label class="l">Telephone</label>
              <input type="text" class="inp" name="tel" value="<?php echo $myProfile[0]['Cust_tel']; ?>"/>
            </div>
            <div class="end-1">
              <button class="btn-shop" type="submit">Edit Profile</button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-2">
        <h2>My Picture</h2>
        <img class="img-p" src="<?php echo $myProfile[0]['Cust_picture']; ?>"/>
        <div>
          <p>จำนวนซื้อ <?php echo $myProfile[0]['n']; ?> ครั้ง</p>
          <p>จำนวนสินค้า <?php echo $myProfile[0]['sum_pro']; ?> หน่วย</p>
          <p>จำนวนเงิน <?php echo $myProfile[0]['price']; ?> บาท</p>
        </div>
      </div>
    </div>
  </div>
  <?php include('layout/footer.php'); ?>
</body>

</html>