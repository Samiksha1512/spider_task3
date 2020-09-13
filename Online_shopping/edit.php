<?php
session_start();
require "dbhandler.php";
$eno=$_GET['id'];
if(isset($_POST['updateitm'])){
	$d=date("d-m-y");
	$i_img=$_FILES['itmimg']['name'];
	$res = "UPDATE items SET category='$_POST[catname]', itmName='$_POST[itmname]', itmImg='$i_img', itmPrice='$_POST[itmprice]', itmQuantity='$_POST[itmquant]', itmDesp='$_POST[itmdesp]', sellerName='$_SESSION[suserId]', date='$d' WHERE itmNumber='$eno'";
	if(mysqli_query($conn, $res)){
	move_uploaded_file($_FILES['itmimg']['tmp_name'],"itempics/$_POST[itmno].jpg");
	header("location:sdashboard.php?update=successfull");
	exit();
	}
	else{
		echo mysqli_error($conn);
		echo"<br />";
		echo "Not Updated";
	}
}
?>