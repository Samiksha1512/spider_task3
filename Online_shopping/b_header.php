<!DOCTYPE html>
<html lang=en>
  <head>
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
  <meta charset="utf-8" http-equiv="encoding">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="styles/bdash.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  


	      var mySidebar = document.getElementById("mySidebar");
		  var overlayBg = document.getElementById("myOverlay");
		 
		  function w3_open(){
			  if(mySidebar.style.display==='block'){
				  mySidebar.style.display='none';
				  overlayBg.style.display='none';
			  }
			  else{
				  mySidebar.style.display='block';
				  overlayBg.style.display='block';
			  }
		  }
		  function w3_close(){
			 
				  mySidebar.style.display='none';
				  overlayBg.style.display='none';
	      }  
		  
	</script>

  </head>
  <body class="w3-pale-red">
 
   <div class="w3-bar w3-top w3-black w3-xxlarge" style="z-index:4">
   <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-grey" onclick="w3_open();"><i class="fa fa-bars"></i>Menu</button>
   <span class="w3-bar-item w3-right">
            Welcome, <?php echo $_SESSION['buserId'];?></span>
   </div>
   <nav class="w3-sidebar w3-collapse w3-red w3-animate-left" style="z-index:4; width:260px; height:100%" id="mySidebar"><br>
	<div class="w3-container w3-row">
	<div class="w3-col s5">
	<img src="https://www.getmdl.io/templates/dashboard/images/user.jpg" class="w3-circle w3-margin-right" style="width:46px"></div>
	<div class="w3-col s10 w3-bar">
	  <span>...
		</div>
		</div>
	<hr>
	<div class="w3-bar-block">
	<a href="" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close();" title="close menu"><i class="fa fa-remove fa-fw"></i>
    Close Menu</a>
    <a href="bdashboard.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i> Dashboard</a>
	<a href="showCart.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i> Cart</a>
    <a href="history.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i> History</a>
	<a href="blogout.php"  class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i> Logout </a>
   <br><br>
  </div>
 </nav>  
  <div class="w3-main" style="margin-left:300px; margin-top:70px; padding:10px">
	</div>
 