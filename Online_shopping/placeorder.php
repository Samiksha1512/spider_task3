<?php
session_start();
require "dbhandler.php";
if(isset($_POST['buysubmit'])){
	$prodNo=$_POST['no_i'];
	if(empty($prodNo)){
		header("location:showCart.php?error=orderNotPlaced");
	}
	else{
		
		$i_num=$_GET['inmb'];
$eno=$_GET['id'];
$d=date("m-d-y");
		$res="UPDATE items SET itmQuantity=itmQuantity-'$prodNo' WHERE itmNumber='$i_num'";
		if(mysqli_query($conn, $res)){
$sql="UPDATE cartitems SET status='ordered', prod_no='$prodNo', orderDate='$d' WHERE prod_id='$eno'";
if(mysqli_query($conn,$sql)){
	$qry1="select * from items where itmNumber='$i_num'";
	$result= mysqli_query($conn,$qry1);
	if($result){
		while($row=mysqli_fetch_array($result)){
			$s_name=$row['sellerName'];
			$itm_name=$row['itmName'];
		}
	$qry="INSERT INTO orders(s_name, itm_name, b_name, prod_quant, od_date, itmno) values('$s_name', '$itm_name', '$_SESSION[buserId]', '$prodNo', '$d', '$i_num')";
	if(mysqli_query($conn, $qry)){
		header("location:bdashboard.php?success=orderPlaced");
		exit();
	}
	else{
		echo mysqli_error($conn);
	}
	}
	else{
		echo mysqli_error($conn);
	}
}
else{
		echo mysqli_error($conn);
	}
	}
	else{
		echo mysqli_error($conn);
	}
	}
}
?>