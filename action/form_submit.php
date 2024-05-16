
<?php

require_once dirname(__DIR__)."/layout/user/header.php";





    // if ($status["error"] > 0) {

    //     foreach ($status["msg"] as $value) {
    //         echo $value . "<br>";
    //     }
    // }




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
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $status["error"]++;
        array_push($status["msg"], "EMAIL FORMAT IS INVALID");
    }
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