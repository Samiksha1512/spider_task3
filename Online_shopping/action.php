<?php
session_start();
require "b_header.php";
require "dbhandler.php";
//echo $_SESSION['suserId'];
!isset($_SESSION['buserId']) ? header("location:index.php"):null;
if(isset($_POST['searchsubmit'])){
	$inpText=$_POST['search'];
	$cat_name=$_GET['catname'];
	$qry="SELECT * FROM items WHERE category='$cat_name' && itmName Like '%$inpText%'";
	$result=mysqli_query($conn, $qry);
	$numrow=mysqli_num_rows($result);?>
	<div class="container">
<div class="card-deck">
<?php
	for($i=0; $i<$numrow;$i++){
		while($row=mysqli_fetch_array($result)){
			?>
			<div class="col-sm-6 col-md-4 col-lg-4 mt-4">
                <div class="card position-relative">
                    <img class="card-img-top" src="itempics/<?php echo $row['itmNumber'];?>.jpg">
                    <form action="showCart.php?id=<?php echo $row['id'];?>" method="post"><div class="card-block">
                        <h4 class="card-title"><?php echo $row['itmName'];?></h4>
                        <div class="meta">
                           Price: $<?php echo $row['itmPrice'];?>
                        </div>
                        <div class="card-text">
                            Description : <?php echo $row['itmDesp'];?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="float-right"><button type="submit" name="addCart">Add to Cart</button></span>
                        <span><i class=""></i>Hurry..! Only <?php echo $row['itmQuantity'];?> Left</span>
                    </div>
					</form>
                </div>
            </div>
			<?php
		}
	}
}
?>