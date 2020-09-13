<?php
session_start();
require "s_header.php";
require "dbhandler.php";
//echo $_SESSION['suserId'];
!isset($_SESSION['suserId']) ? header("location:index.php"):null;
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$itmCat=$_POST['catname'];
	$i_name=$_POST['itmname'];
	$i_no=$_POST['itmno'];
	$i_price=$_POST['itmprice'];
	$i_quantity=$_POST['itmquant'];
	$i_img=$_FILES['itmimg']['name'];
	$i_desp=$_POST['itmdesp'];
	$d=date("d-m-y");
	$sql = "SELECT itmNumber FROM items WHERE itmNumber='$i_no'";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: sdashboard.php?error=sqlerror");
		exit();
		}
		else{
			 mysqli_stmt_execute($stmt);
		  mysqli_stmt_store_result($stmt);
		  $resultCheck = mysqli_stmt_num_rows($stmt);
		  if($resultCheck==1){
			header("Location: sdashboard.php?error=Numbertaken");
		  exit();
		   }
		}
	if(empty($i_name) ||empty($i_no) || empty($i_price) || empty($i_desp)|| empty($i_desp)){
		header("location:sdashboard.php?error=emptyfields");
		exit();
	}
	else if($itmCat==""){
		header("location:sdashboard.php?error=emptyfields");
		exit();
	}
	else{
		if(mysqli_query($conn, "insert into items(category, itmName, itmNumber, itmImg, itmPrice, itmQuantity, itmDesp, sellerName, date) values('$itmCat', '$i_name', '$i_no', '$i_img', '$i_price', '$i_quantity', '$i_desp', '$_SESSION[suserId]', '$d')")){
			 move_uploaded_file($_FILES['itmimg']['tmp_name'],"itempics/$i_no.jpg");
		header("location:sdashboard.php?added=successfully");
		exit();
		}
		else
	 {
	   header("location:sdashboard.php?error=notInserted");
		exit();
	   }
		
	}
}
if(isset($_GET['added'])){
	if($_GET['added']=='successfully'){
		?>
		<script type="text/javascript">
		alert('Item added successfully');
		</script>
		<?php
	}
}
if(isset($_GET['update'])){
	if($_GET['update']=='successfull'){
		?>
		<script type="text/javascript">
		alert('Item updated successfully');
		</script>
		<?php
	}
}
if(isset($_GET['error'])){
	if($_GET['error']=='notInserted'){
		?>
		<script type="text/javascript">
		alert('Some error occur');
		</script>
		<?php
	}
	if($_GET['error']=='Numbertaken'){
		?>
		<script type="text/javascript">
		alert('Take another Item Number');
		</script>
		<?php
	}
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
						<form name="form1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                              <div class="col-lg-10">
                        <div class="card">
                            <div class="card-header"><strong>Add Items</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group"><label  class=" form-control-label">Category</label><select name="catname" placeholder="Add Category" class="form-control"><option value="">Select One</option>
								<option value="men">Men</option>
                                <option value="women">Women</option>
                                <option value="kids">Kids</option> 
								<option value="electronics">Electronics</option> 
                                <option value="kids">Others</option></select></div>
                                    <div class="form-group"><label  class=" form-control-label">Item Name</label><input type="text" name="itmname" placeholder="Add Item Name" class="form-control"></div>
									<div class="form-group"><label  class=" form-control-label">Item Number</label><input type="text" name="itmno" placeholder="4-digit Number" class="form-control"></div>
									<div class="form-group"><label  class=" form-control-label">Item Image</label><input type="file" name="itmimg" placeholder="Add Item Image" class="form-control"></div>
									<div class="form-group"><label  class=" form-control-label">Item Price</label><input type="text" name="itmprice" placeholder="Add Item Price in numbers*" class="form-control"></div>
									<div class="form-group"><label  class=" form-control-label">Item Quantity</label><input type="text" name="itmquant" placeholder="Add Item quantity in numbers*" class="form-control"></div>
                                        <div class="form-group"><label  class=" form-control-label">Description</label><input type="text" name="itmdesp" placeholder="Add item Description" class="form-control"></div>
										<div><input type="submit" name="submititm" class="btn btn-success" value="Add Item"></div>
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