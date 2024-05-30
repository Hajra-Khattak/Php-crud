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

<form class="d-flex p-5 m-5 justify-content-center" action="<?php echo INSERT_FORM ?>" enctype="multipart/form-data" method="POST">
  <div class="col-6">
    <div class="mb-3">
      <label for="" class="form-label">Image</label>
      <input type="file" name="profile" class="form-control"  aria-describedby="helpId" />
      <small id="helpId" class="text-muted">Help text</small>
    </div>
    <input type="submit" name="uploadFile" value="UPLOAD" class="btn btn-primary">
  </div>
</form>


<?php

$sql_data = "SELECT * FROM `users`";

$data_fetch = $connect->query($sql_data);

if($data_fetch->num_rows > 0){


?>


<div class="row">
  <div class="table-responsive p-5 d-flex justify-content-center align-items-center">

<table class="table table-striped table-primary table-hover">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col" class="d-flex justify-content-center">Action</th>
    </tr>
  </thead>
  <tbody>
    <tr>

    <?php

    while($row = $data_fetch->fetch_assoc()){
  

  
    ?>
      <th ><?php  echo $row["user_id"];  ?></th>
      <td><?php  echo $row["name"];  ?></td>
      <td><?php  echo $row["email"];  ?></td>
      <td>

        <div class="">
          <div class="d-flex justify-content-center gap-2">   
            <a href="<?php echo UPDATE_FROM ?>?update=<?php echo base64_encode($row['user_id']) ?>" class="btn btn-success">Edit</a>
            <a href="" class="btn btn-danger"> Delete</a>
          </div>
        </div>

      </td>
    </tr>
    
    <?php
      }
    ?>
    
  </tbody>
</table>

</div>
</div>

<?php

}

else{

  echo "<h2> Data not found </h2>";
}
?>

<?php
require_once dirname(__FILE__). "/layout/user/footer.php";
?>