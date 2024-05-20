<?php

require_once dirname(__FILE__) . "/layout/user/header.php";


?>

<form class="p-5 m-5 " action="<?php echo INSERT_FORM ?>" style="background-color: black;" method="POST">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="pswd" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <input type="submit" value="INSERT" name="insert" class="btn btn-primary">
</form>




<div class="table-responsive">

    <?php

    $sql = "SELECT * FROM `users`";

    $exe_fetch = $conn->query($sql);

    if ($exe_fetch->num_rows > 0) {
        # code...
    

        ?>

        <table class="table table-bordered table-hover table-dark">
            <tr>
                <th>#</th>
                <th>USER NAME</th>
                <th>EMAIL</th>
                <th>ACTION</th>
            </tr>

            <?php

            while ($row = $exe_fetch->fetch_assoc()) {
                # code...
        
                ?>

                <tr>
                    <td><?php echo $row["user_id"] ?></td>
                    <td><?php echo $row["user_name"] ?></td>
                    <td><?php echo $row["email"] ?></td>
                    <td>

                        <div class="card">
                            <div class="card-body d-flex justify-content-center gap-3">

                                <a href="<?php echo UPDATE_FORM ?>?abc=<?php echo $row["user_id"]  ?>" class="btn btn-info">EDIT</a>

                                <button type="button" class="btn btn-danger">DELETE</button>

                            </div>
                        </div>

                    </td>
                </tr>

            <?php } ?>

        </table>

    <?php } else {



        ?>

        <h1> DATA NOT FOUND </h1>

    <?php } ?>
</div>

<?php

require_once dirname(__FILE__) . "/layout/user/footer.php";

?>