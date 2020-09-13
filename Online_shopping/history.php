<?php
session_start();
require "b_header.php";
require "dbhandler.php";
//echo $_SESSION['buserId'];
!isset($_SESSION['buserId']) ? header("location:index.php"):null;?>


<div class="container">
<div class="content mt-3">
            <div class="animated fadeIn">
			<div class="row">
                    <div class="col-lg-10">
                        <div class="card" style="position:relative; left:220px">
                            <div class="card-body"><strong>History</strong>
							<table class="table table-bordered">
							      <tr>
									  <th>Product Details</th>
									  <th>Image</th>
									  <th>Date</th>
								  </tr>


<?php
$qry=$sql="SELECT items.itmName, items.itmPrice, items.itmDesp, items.itmNumber, cartitems.prod_id, cartitems.buyerName, cartitems.orderDate, cartitems.prod_no FROM items JOIN cartitems ON items.id=cartitems.itemId WHERE cartitems.buyerName='$_SESSION[buserId]' && cartitems.status='ordered'";
$result=mysqli_query($conn, $qry);
if($result){
	$d=date("d-m-y");
	while($row=mysqli_fetch_array($result)){
	?>
    <tr>
	<td><strong><?php echo $row['itmName'];?></strong><br />
	Quantity : <?php echo $row['prod_no'];?><br />
	Price : Rs.<?php echo $row['itmPrice'];?>/item<br />
	 Description : <?php echo $row['itmDesp'];?>
	</td>
	<td><img style="height:100px; width:100px; display:block" src="itempics/<?php echo $row['itmNumber'];?>.jpg"></td>
	<td><?php echo $row['orderDate'];?></td>
	</tr>
	
<?php	
	}
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