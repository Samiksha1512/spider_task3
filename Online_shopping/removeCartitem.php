<?php
session_start();
require "dbhandler.php";
$eno=$_GET['id'];
mysqli_query($conn, "delete from cartitems where prod_id='$eno' ");
header("location:bdashboard.php?delete=successfull");
exit();
?>