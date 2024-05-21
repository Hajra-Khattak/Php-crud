<?php
require_once dirname(__FILE__). "/layout/user/header.php";


if(isset($_GET["update"]) && !empty($_GET["update"])){
    $userId = $_GET["update"];
}else{
    redirect_url(dashboard);
}


?>

<?php

$sql_data = "SELECT * FROM `users` WHERE 'user_id' = '{$userId}'";

$data_fetch = $connect->query($sql_data);

if($data_fetch->num_rows > 0){

    $update =$data_fetch->fetch_assoc();
}
else{
    redirect_url(dashboard);
}

?>

<h2>UPDATE NOW</h2>
<form class="m-5 px-5 " action="<?php echo UPDATE_FROM_SUBMIT; ?>" method="POST">
  <input type="hidden" name="token" value="<?php echo base64_encode($userId) ?>" id="">
<div class="bg-info text-dark d-flex justify-content-center align-items-center">
  <div class="col-6 p-5">
  <div class="mb-3 ">
    <label  class="form-label fw-bold">Name</label>
    <input type="text" class="form-control" name="name"  value="<?php echo $update["name"] ?>" aria-describedby="emailHelp">
  </div>
  <div class="mb-3 ">
    <label for="exampleInputEmail1" class="form-label fw-bold">Email address</label>
    <input type="email" value="<?php echo $update['email']  ?>"  class="form-control" name="email"  id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label fw-bold">Password</label>
    <input type="password" class="form-control" value="<?php echo base64_decode($update['token'])  ?>" name="password" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <input type="submit" name="update" class="btn btn-dark bg-black fw-bold" value="Update Data">
  </div>
  </div>
  
</form>


<?php
require_once dirname(__FILE__). "/layout/user/footer.php";
?>