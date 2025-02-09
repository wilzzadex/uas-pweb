<?php
// http://phpdanmysql.com
session_start();
session_destroy();
header("location:../index.php"); 
?>