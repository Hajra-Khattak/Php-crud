<?php

require_once dirname(__FILE__). "/layout/user/header.php";
?>

<form class="m-5 px-5 " action="<?php echo INSERT_FORM; ?>" method="POST">
  <div class="bg-info text-dark d-flex justify-content-center align-items-center">
  <div class="col-6 p-5">
  <div class="mb-3 ">
    <label for="exampleInputEmail1" class="form-label fw-bold">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label fw-bold">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <input type="submit" name="submit" class="btn btn-dark bg-black fw-bold" value="Save Data">
  </div>
  </div>
  
</form>


<?php
require_once dirname(__FILE__). "/layout/user/footer.php";
?>