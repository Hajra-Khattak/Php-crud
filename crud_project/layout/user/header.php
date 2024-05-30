
<?php

require_once dirname(__DIR__) ."/../include/connection.php";
require_once dirname(__DIR__) ."/../include/helper.php";
require_once dirname(__DIR__) ."/../include/web.php";

?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <style>
            *{
                box-sizing: border-box;
                padding: 0;
                margin: 0;
                overflow-x: hidden;
            }
        </style>
    </head>

    <body class="bg-info">
    <?php
    require_once dirname(__FILE__)."/navbar.php";
    ?>
        

