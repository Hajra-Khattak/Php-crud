
<?php

require_once dirname(__DIR__)."/layout/user/header.php";

    // if ($status["error"] > 0) {

    //     foreach ($status["msg"] as $value) {
    //         echo $value . "<br>";
    //     }
    // }

    // ============== Update ==================

if(isset($_POST["update"]) && !empty($_POST["update"])){

    $name = Filter_data($_POST["name"]);
    $email = Filter_data($_POST["email"]);
    $pass = Filter_data($_POST["password"]);

    $user_Id = Filter_data(base64_decode($_POST["token"]));

    $status = [
        "error" => 0,
        "msg" => []
    ];

    if(!isset($email) || empty($email)){
        $status["error"]++;
        array_push($status["msg"], "EMAIL iS REQUIRED");

    }else{
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $status["error"]++;
            array_push($status["msg"], "EMAIL IS NOT VALID");
        }
    }

    if(!isset($pass) || empty($pass)){
        $status["error"]++;
        array_push($status["msg"], "PASSWORD IS REQUIRED");
    }

    if(!isset($name) || empty($name)){
        $status["error"]++;
        array_push($status["msg"], "NAME IS REQUIRED");
    }


    $sql_check = "SELECT * FROM `users` WHERE `email`= '{$email}'";
    $check_email = $connect->query($sql_check);
    if($check_email -> num_rows > 0){
        $status["error"]++;
        array_push($status["msg"], "EMAIL ALREADY EXISTTTT");
    }


    if($status["error"] > 0){
        foreach($status["msg"] as $value){
            ERROR_MSG($value) ;
        }
        REFRESH_URL(2, dashboard);
    }
    else{

        $hash = password_hash($pass, PASSWORD_BCRYPT);
        $encrypt = base64_encode($pass);

        $insert = "INSERT INTO `users` (`email`, `password`, `token`)
        VALUES ('{$email}', '{$hash}', '{$encrypt}')";

        $exe = $connect->query($insert);

        if($exe){
            if($connect->affected_rows > 0){
                SUCCESS_MSG("DATA UPDATED SUCCESSFULLY");
            }
            else{
                ERROR_MSG("DATA HAS NOT UPDATED");
            }
        }else{
            ERROR_MSG("ERROR IN EXECUTION {$insert}");
        }
    }

    REFRESH_URL(2, dashboard);
}

// =============== Insert ====================

if(isset($_POST["submit"]) && !empty($_POST["submit"])){

     $email = Filter_data($_POST["email"]);
     $pass = Filter_data($_POST["password"]);


    $status = [
        "error" => 0,
        "msg" => []
    ];
    

if(!isset($email) || empty($email)){
    $status["error"]++;
    array_push($status["msg"], "EMAIL IS REQUIRED");

}
else{
    // ========== Email Validity ===============
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $status["error"]++;
        array_push($status["msg"], "EMAIL FORMAT IS INVALID");
    }
}

    // ================ Email Check =============

    $sql_check = "SELECT * FROM `users` WHERE `email`= '{$email}'";

    $check_email = $connect->query($sql_check);
    if($check_email -> num_rows > 0){
        $status["error"]++;
        array_push($status["msg"], "EMAIL EXISTTTT");
    }


    if(!isset($pass) || empty($pass)){
        $status["error"]++;
        array_push($status["msg"], "PASSWORD IS REQUIRED");
    }

    if($status["error"] > 0){
        foreach($status["msg"] as $value){
            ERROR_MSG($value) ;
        }
        REFRESH_URL(2, dashboard);
    }
    else{

        // ========== Encrypt Password ============ 
        // ========= Hash Password ================
        $encrypt = base64_encode($pass); 
        $hash = password_hash($pass, PASSWORD_BCRYPT);
        $insert_data = "INSERT INTO `users`(`email`, `password`, `token`) VALUES ('{$email}', '{$hash}','{$encrypt}')";

        $execute = $connect->query($insert_data);

        if($execute){
            if($connect->affected_rows > 0){
                SUCCESS_MSG("DATA IS INSERTED SECCESSFULLY ");
            }else{
                ERROR_MSG("DATA CAN'T BE INSERTED {$insert_data}");
            }
        }
    else{
        ERROR_MSG("ERROR IN QUERY {$insert_data}");
    }
    
    REFRESH_URL(2, dashboard);
    
}


}
?>


<?php
    require_once dirname(__DIR__)."/layout/user/footer.php";

?>