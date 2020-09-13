<?php
session_start();
require "b_header.php";
require "dbhandler.php";
!isset($_SESSION['buserId']) ? header("location:index.php"):null;
//echo $_SESSION['buserId'];
if(isset($_POST['bcat-submit'])){
	$bcat=$_POST['catname'];
	if($bcat==""){?>
		<script type="text/javascript">
		document.location.href=" ";
		</script>
		<?php
	}
	else{
	header("location:showitems.php?catName=".$bcat);}
}
if(isset($_GET['success'])){
	if($_GET['success']=='orderPlaced'){
		?>
		<script type="text/javascript">
		alert('Order Placed successfully');
		</script>
		<?php
	}
}
?>

  
  
 
   <div style="position:absolute;left:350px">
  <img style=""src="usepics/img2.jpg" alt="" width="1100" height="245" name="img"/>
  <form name="f1">
  <input type="hidden" name="h1" value="0" />
  </form>
</div>
<hr style="height:5px;width:180%;color:gray;background-color:gray;position:absolute;top:350px">
<div class="w3-card-4 w3-hover-shadow" style="position:relative; width:50%;left:450px;top:300px">
    <header class="w3-container w3-brown">
      <h3>Choose Category</h3>
    </header><br />
    <div class="w3-container">
      <p>Select</p>
      <hr style="height:5px;color:gray;background-color:gray">
	  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <p><select style="width:100%"name="catname" placeholder="Add Category" class="form-control"><option value="">Select One</option>
								<option value="men">Men</option>
                                <option value="women">Women</option>
                                <option value="kids">Kids</option> 
								<option value="electronics">Electronics</option>
                                <option value="kids">Others</option></select></p><br>
    </div>
    <button type="submit" name="bcat-submit" class="w3-button w3-block w3-dark-grey">Search</button>
	</form>
  </div><br />
  <div id="Page_top" class="w3-red" style=" width:90%;position:relative;top:340px;left:220px">
  <p> <marquee height="10%" behavior="scroll" scrollamount="13"direction="left" onmouseover="stop()" onmouseout="start()"><font color="#FFFF99"><h3>30%off on all summer wear...Hurry!!!</h3></font>
  <font color="#00CC99"><h4>Enjoy the pleasure of shopping with Marina...</h4></font></marquee><br>
  </p>
  </div>
  
  <script>
  function abc()
{
var arr=new Array("usepics/img1.jpg","usepics/img2.jpg","usepics/img3.jpg","usepics/img4.jpg","usepics/img5.jpg");
var ind=eval(document.f1.h1.value);
document.img.src=arr[ind];
document.f1.h1.value=ind+1;
if(document.f1.h1.value==5)
{
document.f1.h1.value=0;
}
}
setInterval("abc()",3000);
  </script>
  <?php
  require "b_footer.php";
  ?>