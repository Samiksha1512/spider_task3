<?php
session_start();
require "b_header.php";
require "dbhandler.php";
//echo $_SESSION['buserId'];
!isset($_SESSION['buserId']) ? header("location:index.php"):null;
if(isset($_GET['id'])){
$eno=$_GET['id'];}
$d=date("m-d-y");
if(isset($_POST['addCart'])){
	mysqli_query($conn, "insert into cartitems(itemId, buyerName, status, orderDate) values('$eno', '$_SESSION[buserId]', 'notordered', '$d')");
	$last_id=mysqli_insert_id($conn);
}


?>
<div class="container">
<div class="content mt-3">
            <div class="animated fadeIn">
			<div class="row">
                    <div class="col-lg-10">
                        <div class="card" style="position:relative; left:220px">
                            <div class="card-body">
							<table class="table table-bordered">
							      <tr>
									  <th>Product Details</th>
									  <th>Image</th>
									  <th>Place order</th>
									  <th>Delete</th>
								  </tr>
								  <?php
								  $sql="SELECT items.itmName, items.itmPrice, items.itmDesp, items.itmNumber, items.itmQuantity, cartitems.prod_id, cartitems.buyerName FROM items JOIN cartitems ON items.id=cartitems.itemId WHERE cartitems.buyerName='$_SESSION[buserId]' && cartitems.status='notordered'";
								  $result= mysqli_query($conn,$sql);
								  if($result){
									  while($rows=mysqli_fetch_assoc($result)){
										  ?>
										  <tr>
										 <td><strong> <?php echo $rows['itmName'];?></strong><br />
										  Price : <?php echo $rows['itmPrice'];?><br />
										  Description : <?php echo $rows['itmDesp'];?>
										  </td>
										  <td>
										  <img style="height:100px; width:100px; display:block" src="itempics/<?php echo $rows['itmNumber'];?>.jpg">
										  </td>
										  <td>
										  <form action="placeorder.php?inmb=<?php echo $rows['itmNumber'];?>&&id=<?php echo $rows['prod_id']?>" method="post">
										  <input type="number" name="no_i" min="1" max="<?php echo $rows['itmQuantity'];?>"><br /><br />
										  <input type="submit" name="buysubmit" value="Buy Now">
										  </form>
										  </td>
										  <td><a href="removeCartitem.php?id=<?php echo $rows['prod_id']?>">Remove Item</td>
										  </tr>
										  <?php
									  }
								  }
								  else{
									  echo mysqli_error($conn);
		                               echo"<br />";
		                              echo "Not Updated";
								  }
								  ?>

</table>
							</div>
							</div>
							</div>
							</div>
								  
                                    </div>
                                </div>
</div>