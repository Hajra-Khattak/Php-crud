
<?php

define("SERVER", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");
define("DATABASE", "siryousafproject");

$connect = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE  );

if(!$connect){
    $connect->connect_error;
}

?>
