<?php
session_start();
require "b_header.php";
require "dbhandler.php";
!isset($_SESSION['buserId']) ? header("location:index.php"):null;
$catname=$_GET['catName'];
$sql=mysqli_query($conn,"select * from items where category='$catname'");
$numrow=mysqli_num_rows($sql);
?>
<div class="container">
<form action="action.php?catname=<?php echo $catname;?>" method="post" style="position:relative; left:100px" >
<input type="text" name="search" id="search" placeholder=" search item name" style="width:500px; height:50px">
<input type="submit" name="searchsubmit" value="Search" style="height:50px">
</form>
<hr style="background-color:black; width:1500px">
</div>
<div class="container">
<div class="card-deck">
<?php
for($i=0; $i<$numrow;$i++){
    while($row=mysqli_fetch_array($sql)){
		$i_num=$row['itmNumber'];
		$i_name=$row['itmName'];
		$i_desp=$row['itmDesp'];
		$i_quant=$row['itmQuantity'];
		$i_cost=$row['itmPrice'];
		?>
		
<div class="col-sm-6 col-md-4 col-lg-4 mt-4">
                <div class="card position-relative">
                    <img class="card-img-top" src="itempics/<?php echo $i_num;?>.jpg">
                    <form action="showCart.php?id=<?php echo $row['id'];?>" method="post"><div class="card-block">
                        <h4 class="card-title"><?php echo $i_name;?></h4>
                        <div class="meta">
                           Price: Rs. <?php echo $i_cost;?>
                        </div>
                        <div class="card-text">
                            Description : <?php echo $i_desp?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="float-right"><button type="submit" name="addCart">Add to Cart</button></span>
                        <span><i class=""></i>Hurry..! Only <?php echo $i_quant;?> Left</span>
                    </div>
					</form>
                </div>
            </div>
			
			<?php
				
		}
	}
	
?>
				</div>

</div>



