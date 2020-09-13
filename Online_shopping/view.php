<?php
session_start();
require "s_header.php";
require "dbhandler.php";
//echo $_SESSION['suserId'];
!isset($_SESSION['suserId']) ? header("location:index.php"):null;
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$itmCat = $_POST['catname'];
	if(isset($_POST['submitcat'])){
	header("location:view.php?i_cat=".$itmCat);
	}
}
?>
<div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>View Added Items</h1>
                    </div>
                </div>
            </div>
        </div>
		
<div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
						<form name="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                              <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header"><strong>Select Category to view Items</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group"><label  class=" form-control-label">Category</label><select name="catname" placeholder="Add Category" class="form-control"><option value="">Select One</option>
								<option value="men">Men</option>
                                <option value="women">Women</option>
                                <option value="kids">Kids</option>
                                <option value="kids">Others</option>
								</select></div>
										<div><input type="submit" name="submitcat" class="btn btn-success" value="See Items"></div>
                                                    </div>
                                                </div>
                                            </div>  
                        </div>
						</form>
                    </div>
                                            </div>
                                        </div>
										
										<div class="row">
                    <div class="col-lg-12">
                        <div class="card">
						<div class="card-header"><strong>Items</strong></div>
                            <div class="card-body card-block">
							<table class="table table-bordered">
							      <tr>
								      <th>No</th>
									  <th>Product Name</th>
									  <th>Image</th>
									  <th>Price</th>
									  <th>Description</th>
									  <th>Quantity</th>
									  <th>Date</th>
									  <th>Edit</th>
									  <th>Delete</th>
								  </tr>
								  <?php
								  if(isset($_GET['i_cat'])){
									  $itm_cat=$_GET['i_cat'];
									  $sql=mysqli_query($conn, "select * from items where category='$itm_cat' && sellerName='$_SESSION[suserId]'");
									  while($row=mysqli_fetch_array($sql)){
										  $i=$row['itmNumber'];
										  ?>
										  <tr>
										       <td><?php echo $row['itmNumber'];?></td>
											   <td><?php echo $row['itmName'];?></td>
											   <td><img style="height:80px; width:80px; display:block" src="itempics/<?php echo $i;?>.jpg"></td>
											   <td><?php echo $row['itmPrice'];?></td>
											   <td><?php echo $row['itmDesp'];?></td>
											   <td><?php echo $row['itmQuantity'];?></td>
											   <td><?php echo $row['date'];?></td>
											   <td><a href="edit_items.php?inmb=<?php echo $row['itmNumber'];?>">Edit</a></td>
											   <td><a href="delete.php?inmb=<?php echo $row['itmNumber'];?>">Delete</a></td>
											   
											   
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
<?php
require "s_footer.php";
?>