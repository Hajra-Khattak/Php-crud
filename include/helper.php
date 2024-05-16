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

?>