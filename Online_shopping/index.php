<?php
session_start();
require 'dbhandler.php'; 
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	if(isset($_POST['buyersubmit'])){
		$buid=$_POST['buyeruid'];
	    $bpwd=$_POST['buyerpwd'];
		if(empty($buid) || empty($bpwd)){
		header("Location: index.php?error=emptyfields");
		exit();
		}
		else{
			$sql = "SELECT * FROM register WHERE role='buyer' && username=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: index.php?error=sqlerror");
		    exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $param_uid);
			$param_uid=$buid;
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($result)){
				$pwdCheck = password_verify($bpwd, $row['password']);
				if($pwdCheck == false){
					header("Location: index.php?error=wrongpassword");
		            exit();
				}
				else if($pwdCheck == true){
					$_SESSION['buserId'] = $buid;
					header("Location: bdashboard.php");
		            exit();
				}
				else{
					header("Location: index.php?error=wrongpassword");
		            exit();
				}
			}
			else{
				header("Location: index.php?error=nouser");
		        exit();
			}
		}
		}
		mysqli_stmt_close($stmt);
  mysqli_close($conn);
	}

else if(isset($_POST['sellersubmit'])){
	$suid=$_POST['selleruid'];
	    $spwd=$_POST['sellerpwd'];
		if(empty($suid) || empty($spwd)){
		header("Location: index.php?error=emptyfields");
		exit();
		}
		else{
			$sql = "SELECT * FROM register WHERE role='seller' && username=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: index.php?error=sqlerror");
		    exit();
		}
		else{
			mysqli_stmt_bind_param($stmt, "s", $param_uid);
			$param_uid=$suid;
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if($row = mysqli_fetch_assoc($result)){
				$pwdCheck = password_verify($spwd, $row['password']);
				if($pwdCheck == false){
					header("Location: index.php?error=wrongpassword");
		            exit();
				}
				else if($pwdCheck == true){
					$_SESSION['suserId'] = $suid;
					
					header("Location: sdashboard.php?succees=loginsucces");
		            exit();
				}
				else{
					header("Location: index.php?error=wrongpassword");
		            exit();
				}
			}
			else{
				header("Location: index.php?error=nouser");
		        exit();
			}
		}
		}
		mysqli_stmt_close($stmt);
  mysqli_close($conn);
}
	else{
	header("Location: index.php");
	exit();
}
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	
	    <link rel="stylesheet" href="styles/logincss1.css"/>
</head>
<body>


<div class="container">
   <section id="formHolder">

      <div class="row">

         <!-- Brand Box -->
         <div class="col-sm-6 brand">
            <p class="logo">MR <span>.</span></p>

            <div class="heading">
               <h2>Marina</h2>
               <p>Your Right Choice</p>
            </div>
         </div>


         <!-- Form Box -->
         <div class="col-sm-6 form">

            <!-- Buyer Login Form -->
            <div class="login form-peice switched">
			<div class="heading">
               <p style="position:relative;top:80px;left:200px">Buyer Login Form</p>
            </div>
               <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                  <div class="form-group">
                     <label for="loginemail">Username</label>
                     <input type="text" name="buyeruid" id="loginemail" required>
                  </div>

                  <div class="form-group">
                     <label for="loginPassword">Password</label>
                     <input type="password" name="buyerpwd" id="loginPassword" required>
                  </div>

                  <div class="CTA">
                     <input type="submit" name="buyersubmit" value="Login As buyer">
                     <a href="#" class="switch">Login As Seller</a>
                  </div>
               </form>
            </div><!-- End Login Form -->


            <!-- Seller Login Form -->
            <div class="signup form-peice">
			<div class="heading">
               <p style="position:relative;top:80px;left:200px">Seller Login Form</p>
            </div>
               <form class="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                  <div class="form-group">
                     <label for="email">Username</label>
                     <input type="text" name="selleruid" id="email" class="email"required>
                     <span class="error"></span>
                  </div>


                  <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" name="sellerpwd" id="password" class="pass"required>
                     <span class="error"></span>
                  </div>

                  
                  <div class="CTA">
                     <input type="submit" name="sellersubmit" value="Login As Seller" id="submit">
                     <a href="#" class="switch">Login As Buyer</a>
                  </div>
               </form>
            </div><!-- End Signup Form -->
         </div>
      </div>

   </section>
   <div class="col-sm-6 btn">
<h3>New to the Site ?</h3>
<p>Click to Register</p><a href="register.php">Register Here</a>
</div>
</div>


<script type="text/javascript">
$(document).ready(function () {

    // Detect browser for css purpose
    if (navigator.userAgent.toLowerCase().indexOf('firefox') > -1) {
        $('.form form label').addClass('fontSwitch');
    }

   
    // form switch
    $('a.switch').click(function (e) {
        $(this).toggleClass('active');
        e.preventDefault();

        if ($('a.switch').hasClass('active')) {
            $(this).parents('.form-peice').addClass('switched').siblings('.form-peice').removeClass('switched');
        } else {
            $(this).parents('.form-peice').removeClass('switched').siblings('.form-peice').addClass('switched');
        }
    });



});

</script>
</body>

</html>