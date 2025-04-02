<?php include "config.php"; 

SESSION_start();

session_unset();

session_destroy();

header("Location: {$hostname}/admin/");


?>
