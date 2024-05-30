
<?php

require_once dirname(__DIR__)."/layout/user/header.php";

    // if ($status["error"] > 0) {

    //     foreach ($status["msg"] as $value) {
    //         echo $value . "<br>";
    //     }
    // }

    if(isset($_POST["uploadFile"]) && !empty(isset($_POST["uploadFile"])) ){

        $ext = ["jpg", "png", "jpeg", "pdf"];
        $file = File_upload("profile", $ext, "assets/images/");

        if($file == 1){
            $string = strtoupper(implode(" , ", $ext ));
            echo "{$string} ONLY ALLOWED";
            REFRESH_URL(2, dashboard);
        }
        else{
            // pre($file);
            // REFRESH_URL(2, dashboard);

            $encode = json_encode($file);
        }

        if($file == false){
            echo "UPLOADING ERROR ";
        }
    }


    // =============== Image Upload ============
    // if(isset($_POST["uploadFile"]) && !empty(isset($_POST["uploadFile"]))){

    //     $file = $_FILES["profile"];
    //     $file_name = $file["name"];
    //     $temp_name = $file["tmp_name"];

    //     $ext = ["jpg", "png", "jpeg", "pdf"];

    //     $fileExt = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    //     if(!in_array($fileExt, $ext)){
    //         $string = strtoupper(implode("," , $ext));

    //         echo "{$string}  ONLY ALLOWED";

    //         die;
    //     }

    //     $destiny = DOMAIN2 ."/assets/images/" . $file_name;

    //     if(move_uploaded_file($temp_name, $destiny)){
    //         echo "FILE UPLOADED";
    //     }
    //     else{
    //         echo "FILE NOT UPLOADED";
    //     }

    // }

    // ============== Update ==================

if(isset($_POST["update"]) && !empty($_POST["update"])){

    $name = Filter_data($_POST["name"]);
    $email = Filter_data($_POST["email"]);
    $pass = Filter_data($_POST["password"]);

    // =====  Case 1 code ========== ====
    $inputFile = "profile";
    $file = $_FILES[$inputFile];
    $extention = ["jpg", "png", "jpeg", "pdf"];

    // ======================

    $user_Id = Filter_data(base64_decode($_POST["token"]));

    $status = [
        "error" => 0,
        "msg" => []
    ];
    
    // =======================================
    // ============================  case 1 ==========================

/**
 *  file upload but data remain same 
 * 
 *  sub-case 1 
 * 
 *    if we have old file or not  then we should have to delete that prv file 
 * the upload new file 
 * 
 * 
 * 
 */
    if(isset($file["name"]) && !empty($file["name"])){

        // ================== old file exist ===== 
            $checkAddress = "SELECT * FROM `user_address` WHERE `user_id`= '{$user_Id}'"; 
            $check_exe = $connect->query($checkAddress);

            if($check_exe->num_rows > 0){
                $address_fetch = $check_exe->fetch_assoc();

                if(isset($address_fetch["image"])){
                    $oldImage = json_decode($address_fetch["image"], true);
                    if(isset($oldImage["relative_path"])){

                        $relative = $oldImage["relative_path"];
                       
                        if(file_exists($relative)){
                            unlink($relative);
                        }
                    }


                }

            }
       
        
            // ====== new file upload ===========
        $file = File_upload($inputFile, $extention, "/assets/images/");
        // ============= file error checking ========= 
        if($file == 1){
            $status["error"]++;
            $string = strtoupper(implode(" , ", $extention ));

            array_push($status["msg"], "{$string} ONLY ALLOWED");

        }
        if($file == false){
            $status["error"]++;

            array_push($status["msg"], "UPLOADING ERROR");
        }

        // ===================================================
        // =======================================
        //  case 2
       
       /**
        * file is not uploading but data changed  
        * 
        */
    }
    else{
        $checkAddress = "SELECT * FROM `user_address` WHERE `user_id`= '{$user_Id}'"; 
        $check_exe = $connect->query($checkAddress);

        if($check_exe->num_rows > 0){
            $exe_fetch = $check_exe->fetch_assoc();

            if(isset($exe_fetch["image"])){
                $file = json_decode($exe_fetch["image"], true);
            }
            else{
                $file = null;
            }
        }
        else{
            $file = null;
        }
    }


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


    $sql_check = "SELECT * FROM `users` WHERE `email`= '{$email}' AND `user_id`<>'{$user_Id}'";
    $check_email = $connect->query($sql_check);
    if($check_email -> num_rows > 0){
        $status["error"]++;
        array_push($status["msg"], "EMAIL ALREADY EXISTTTT");
    }

// ============== check email =======
    if($status["error"] > 0){
        foreach($status["msg"] as $value){
            ERROR_MSG($value) ;
        }
        REFRESH_URL(2, dashboard);
    }
    // ================== DATA INSERTION AND UPDATION =============
    else{
        // ======================== Case 1 =================================

        if(is_array($file)){
            $file = json_encode($file);
        }

        $checkAddress = "SELECT * FROM `user_address` WHERE `user_id`= '{$user_Id}'"; 
        $check_exe = $connect->query($checkAddress);

        
        if($check_exe->num_rows > 0 ){
            // update Address 
            $updateAddress = "UPDATE `user_address` SET `image` = '{$file}' WHERE `user_id`= '{$user_Id}'";
            $exe = $connect->query($updateAddress);
            // insert address
        }else{
            $insertAddress = "INSERT INTO `user_address` ( `image`, `user_id`) VALUES ('{$file}', '{$user_Id}')";
            $exe = $connect->query($insertAddress);
            
        }

        // =========== /Case 1 end =======================

        $hash = password_hash($pass, PASSWORD_BCRYPT);
        $encrypt = base64_encode($pass);
        
        $update = " UPDATE `users` SET `name`='{$name}',`email`='{$email}',`password`='{$hash}',`token`='{$encrypt}' WHERE `user_id` = '{$user_Id}'";
        $exe = $connect->query($update);

        if($exe){
            if($connect->affected_rows > 0){
                SUCCESS_MSG("DATA UPDATED SUCCESSFULLY  ");
            }
            else{
                ERROR_MSG("DATA HAS NOT UPDATED  {$update}");
            }
        }else{
            ERROR_MSG("ERROR IN EXECUTION {$update}");
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