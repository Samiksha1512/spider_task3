<?php
session_start();
require "s_header.php";
require "dbhandler.php";
//echo $_SESSION['suserId'];
!isset($_SESSION['suserId']) ? header("location:index.php"):null;
$eno=$_GET['inmb'];
$res=mysqli_query($conn, "select * from items where itmNumber='$eno'");
while($row=mysqli_fetch_array($res)){
	$i_id=$row['id'];
	$i_num=$row['itmNumber'];
		$i_name=$row['itmName'];
		$i_desp=$row['itmDesp'];
		$i_quant=$row['itmQuantity'];
		$i_cost=$row['itmPrice'];
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
		
		<div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
						<form name="form1" action="edit.php?id=<?php echo $i_num?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                              <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header"><strong>Add Items</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group"><label  class=" form-control-label">Category</label><select name="catname" placeholder="Add Category" class="form-control"><option value="">Select One</option>
								<option value="men">Men</option>
                                <option value="women">Women</option>
                                <option value="kids">Kids</option> 
                                <option value="kids">Others</option></select></div>
                                    <div class="form-group"><label  class=" form-control-label">Item Name</label><input type="text" name="itmname" placeholder="Add Item Name" value="<?php echo $i_name; ?>" class="form-control"></div>
									<div class="form-group"><label  class=" form-control-label">Item Image</label><input type="file" name="itmimg" placeholder="Add Item Image" class="form-control" required></div>
									<div class="form-group"><label  class=" form-control-label">Item Price</label><input type="text" name="itmprice" placeholder="Add Item Price in numbers*" value="<?php echo $i_cost; ?>" class="form-control"></div>
									<div class="form-group"><label  class=" form-control-label">Item Quantity</label><input type="text" name="itmquant" placeholder="Add Item quantity in numbers*" value="<?php echo $i_quant; ?>" class="form-control"></div>
                                        <div class="form-group"><label  class=" form-control-label">Description</label><input type="text" name="itmdesp" placeholder="Add item Description" value="<?php echo $i_desp; ?>" class="form-control"></div>
										<div><input type="submit" name="updateitm" class="btn btn-success" value="Update Item"></div>
                                                    </div>
                                                </div>
                                            </div>  
                        </div>
						</form>
                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


<?php
require "s_footer.php";
?>