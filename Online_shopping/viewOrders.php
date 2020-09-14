<?php
session_start();
require "s_header.php";
require "dbhandler.php";
//echo $_SESSION['suserId'];
!isset($_SESSION['suserId']) ? header("location:index.php"):null;?>
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
$sql="select * from orders where s_name='$_SESSION[suserId]'";
$result=mysqli_query($conn, $sql);
if($result){
	while($row=mysqli_fetch_array($result)){
		$bname=$row['b_name'];
	
	
								  $qry2="select * from register where username='$bname'";
								  $result2=mysqli_query($conn, $qry2);
								  if($result2){
									  while($row2=mysqli_fetch_array($result2)){
										  $name=$row2['username'];
										  $email=$row2['email'];
										  $conct=$row2['phnNumber'];
										  $addrs=$row2['address'];
									  }
}
else{
	echo mysqli_error($conn);
}
										  ?>
										  <tr>
										  <td><?php echo $row['od_id'];?></td>
										  <td><?php echo $row['itmno'];?></td>
										  <td>Name : <?php echo $name;?><br />
										  Quantity : <?php echo $row['prod_quant'];?><br />
										  Email : <?php echo $email;?><br />
										  Contact No. : <?php echo $conct;?><br />
										  Address : <?php echo $addrs;?>
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
