<?php
session_start();
require "s_header.php";
require "dbhandler.php";
//echo $_SESSION['suserId'];
!isset($_SESSION['suserId']) ? header("location:index.php"):null;
$sql="select * from orders where s_name='$_SESSION[suserId]'";
$result=mysqli_query($conn, $sql);
if($result){
	while($row=mysqli_fetch_array($result)){
		$bname=$row['b_name'];
		$ino=$row['itmno'];
		$id=$row['od_id'];
		$pno=$row['prod_quant'];
	}
}
else{
	echo mysqli_error($conn);
}
?>

<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Add Items</h1>
                    </div>
                </div>
            </div>
        </div>
		<br />
<div class="row">
             <div class="col-lg-12">
                        <div class="card">
						<div class="card-header"><strong>Orders</strong></div>
                            <div class="card-body card-block">
							<table class="table table-bordered">
							      <tr>
								      <th>No</th>
									  <th>Product Number</th>
									  <th>Buyer Details</th>
								  </tr>
								  <?php
								  $qry2="select * from register where username='$bname'";
								  $result2=mysqli_query($conn, $qry2);
								  if($result2){
									  while($row2=mysqli_fetch_array($result2)){
										  ?>
										  <tr>
										  <td><?php echo $id;?></td>
										  <td><?php echo $ino;?></td>
										  <td>Name : <?php echo $row2['username'];?><br />
										  Quantity : <?php echo $pno?><br />
										  Email : <?php echo $row2['email'];?><br />
										  Contact No. : <?php echo $row2['phnNumber'];?><br />
										  Address : <?php echo $row2['address'];?>
										  </td>
										  </tr>
										  
										  
										  <?php
									  }
								  }
								  else{
									  echo mysqli_error($conn);
									  echo "NO Orders Yet";
								  }
								  ?>
								  
								  
								  </table>
							</div>
							</div>
							</div>
							</div>