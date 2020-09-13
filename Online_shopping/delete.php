<?php
session_start();
require "dbhandler.php";
$eno=$_GET['inmb'];
mysqli_query($conn, "delete from items where itmNumber='$eno' ");
header("location:sdashboard.php?delete=successfull");
exit();
?>