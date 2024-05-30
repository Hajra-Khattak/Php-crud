<?php 

define("HOST", "http://localhost");
// relative Path
define("HOST2", $_SERVER["DOCUMENT_ROOT"]);

define("FOLDER", "/SirYousafPhp/crud_project/");

define("DOMAIN", HOST.FOLDER);
// relative Path
define("DOMAIN2", HOST2.FOLDER);

// Dashboard Route
define("dashboard", DOMAIN."dashboard.php");


define("UPDATE_FROM", DOMAIN."update.php");

// form Submission Route
define("INSERT_FORM", DOMAIN."action/form_submit.php");

define("UPDATE_FROM_SUBMIT", DOMAIN."action/form_submit.php");
?>