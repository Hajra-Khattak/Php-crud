<?php
declare(strict_types=1);
        
function Filter_data($data){
    global $connect;
    
    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    $data = $connect->real_escape_string($data);

    return $data;
}

function ERROR_MSG(string $msg){
    $html = "<div class='alert alert-danger' role='alert'>
    {$msg}
    </div>";

    echo $html;
}
function SUCCESS_MSG(string $msg){
    $html = "<div class='alert alert-success' role='alert'>
    {$msg}
    </div>";

    echo $html;
}

function REFRESH_URL(int $sec, string $url){
    header("REFRESH: {$sec}, url={$url}");
}

function redirect_url(string $url){
    header("Location:{$url}");
}

function pre(array $a)
{
    echo "<pre>";
    print_r($a);
    echo "</pre>";
}

function File_upload(string $input, array $ext, string $destiny){

    $file = $_FILES[$input];

    $file_name = rand(1, 999) . "Haj" . $file["name"];

    $tem_name = $file["tmp_name"];

    $extension = $ext;

    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_ext = strtolower($file_ext);

    if(!in_array($file_ext, $extension)){
        return 1;
    }


    $absolute_Path = DOMAIN . $destiny . $file_name;
    $relative_Path = DOMAIN2 . $destiny . $file_name;

    if(move_uploaded_file($tem_name, $relative_Path)){

        $status = [
            "relative_path" => $relative_Path,
            "absolute_path" => $absolute_Path
        ];

        return $status;
    }
    else{
        return false;
    }


}

?>