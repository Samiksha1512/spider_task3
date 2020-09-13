<?php
require 'dbhandler.php'; 
if($_SERVER["REQUEST_METHOD"] == "POST"){
if(isset($_POST['B_submit'])){
	$bname = $_POST['B_uname'];
	$bmail = $_POST['B_email'];
	$bphn = $_POST['B_phn'];
	$bpass = $_POST['B_pwd'];
	$bpasscon = $_POST['B_pwdcon'];
	$badd = $_POST['B_add'];
	$role = 'buyer';
	if(empty($bname)|| empty($bmail)|| empty($bphn)|| empty($bpass)|| empty($bpasscon) ||empty($badd)){
		header("Location: register.php?error=emptyfield&uid=".$bname."&mail=".$bmail);
		exit;
	}
	else if(!filter_var($bmail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $bname)){
		header("Location: register.php?error=invaliduidmail");
		exit();
	}
	else if(!filter_var($bmail, FILTER_VALIDATE_EMAIL)){
		header("Location: register.php?error=invalidmail&uid=".$bname);
		exit();
	}
	else if(!preg_match("/^[a-zA-Z0-9]*$/", $bname)){
		header("Location: register.php?error=invaliduid&mail=".$bmail);
		exit();
    }
	else if($bpass !== $bpasscon){
		header("Location: register.php?error=passwordcheck&uid=".$bname."&mail=".$bmail."&role=".$role);
		exit();
	}
	else{
		$sql = "SELECT username FROM register WHERE username=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: register.php?error=sqlerror");
		exit();
		}
	    else{
		  mysqli_stmt_bind_param($stmt, "s", $bname);
		  mysqli_stmt_execute($stmt);
		  mysqli_stmt_store_result($stmt);
		  $resultCheck = mysqli_stmt_num_rows($stmt);
		  if($resultCheck==1){
			header("Location: register.php?error=usertaken&mail=".$bmail);
		  exit();
		   }
		  else{ 
		  $hashedpwd = password_hash($bpass, PASSWORD_DEFAULT);
			  $sql = "INSERT INTO register(username, email, password, phnNumber, address, role) VALUES('$bname', '$bmail', '$hashedpwd', '$bphn', '$badd', '$role')";
			  $result=mysqli_query($conn, $sql);
			  if($result){
				  header("Location: index.php?msgsignup=success");
		        exit();
			  }
			else{
				 echo mysqli_error($conn);
			   }
		  }
	  }
	}
}
else if(isset($_POST['S_submit'])){
	$sname = $_POST['S_uname'];
	$smail = $_POST['S_email'];
	$sphn = $_POST['S_phn'];
	$spass = $_POST['S_pwd'];
	$spasscon = $_POST['S_pwdcon'];
	$role = 'seller';
	if(empty($sname)|| empty($smail)|| empty($sphn)|| empty($spass)|| empty($spasscon)){
		header("Location: register.php?error=emptyfield&uid=".$sname."&mail=".$smail);
		exit;
	}
	else if(!filter_var($smail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $sname)){
		header("Location: register.php?error=invaliduidmail");
		exit();
	}
	else if(!filter_var($smail, FILTER_VALIDATE_EMAIL)){
		header("Location: register.php?error=invalidmail&uid=".$sname);
		exit();
	}
	else if(!preg_match("/^[a-zA-Z0-9]*$/", $sname)){
		header("Location: register.php?error=invaliduid&mail=".$smail);
		exit();
    }
	else if($spass !== $spasscon){
		header("Location: register.php?error=passwordcheck&uid=".$sname."&mail=".$smail."&role=".$role);
		exit();
	}
	else{
		$sql = "SELECT username FROM register WHERE username=?";
		$stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)){
		header("Location: register.php?error=sqlerror");
		exit();
		}
	    else{
		  mysqli_stmt_bind_param($stmt, "s", $sname);
		  mysqli_stmt_execute($stmt);
		  mysqli_stmt_store_result($stmt);
		  $resultCheck = mysqli_stmt_num_rows($stmt);
		  if($resultCheck==1){
			header("Location: register.php?error=usertaken&mail=".$smail);
		  exit();
		   }
		  else{ 
		  $hashedpwd = password_hash($spass, PASSWORD_DEFAULT);
			  $sql = "INSERT INTO register(username, email, password, phnNumber, role) VALUES('$sname', '$smail', '$hashedpwd', '$sphn', '$role')";
			  $result=mysqli_query($conn, $sql);
			  if($result){
				   header("Location: index.php?msgsignup=success");
		        exit();
			  }
			
			else{
			echo mysqli_error($conn);
			   }
		  }
	  }
	}
}
}
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration Page</title>
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
            <a href="#" class="logo">MR <span>.</span></a>

            <div class="heading">
               <h2>Marina</h2>
               <p>Your Right Choice</p>
            </div>

            <div class="success-msg">
               <p>Great! You are one of our members now</p>
               <a href="#" class="profile">Your Profile</a>
            </div>
         </div>


         <!-- Form Box -->
         <div class="col-sm-6 form">

            <!-- Login Form -->
            <div class="login form-peice switched">
			<div class="heading">
               <p style="position:relative;top:10px;left:200px">Buyer Registartion Form</p>
            </div>
               <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			   <h3></h3>
                  <div class="form-group">
                     <label>Full Name</label>
                     <input type="text" name="B_uname" id="name" class="name"required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label>Email Adderss</label>
                     <input type="text" name="B_email" id="email" class="email"required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label>Phone Number</label>
                     <input type="text" name="B_phn" id="phone"required>
                  </div>

                  <div class="form-group">
                     <label>Password</label>
                     <input type="password" name="B_pwd" id="password" class="pass"required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label>Confirm Password</label>
                     <input type="password" name="B_pwdcon" id="passwordCon" class="passConfirm"required>
                     <span class="error"></span>
                  </div>
				  <div class="form-group">
                     <label>Current Address</label>
                     <input type="text" name="B_add" id="curradd" class="addcurr"required>
                     <span class="error"></span>
                  </div>

                  <div class="CTA">
                     <input type="submit" name="B_submit" value="Signup As Buyer" id="submit">
                     <a href="#" class="switch">Signup As Seller</a>
                  </div>
               </form>
            </div><!-- End Login Form -->


            <!-- Signup Form -->
            <div class="signup form-peice">
			<div class="heading">
               <p style="position:relative;top:20px;left:200px">Seller Registartion Form</p>
            </div>
               <form class="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                  <div class="form-group">
                     <label for="name">Full Name</label>
                     <input type="text" name="S_uname" id="name" class="name"required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="email">Email Adderss</label>
                     <input type="email" name="S_email" id="email" class="email"required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="phone">Phone Number</label>
                     <input type="text" name="S_phn" id="phone"required>
                  </div>

                  <div class="form-group">
                     <label for="password">Password</label>
                     <input type="password" name="S_pwd" id="password" class="pass"required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="passwordCon">Confirm Password</label>
                     <input type="password" name="S_pwdcon" id="passwordCon" class="passConfirm"required>
                     <span class="error"></span>
                  </div>

                  <div class="CTA">
                     <input type="submit" name="S_submit" value="Signup As Seller" id="submit">
                     <a href="#" class="switch">Signup As Buyer</a>
                  </div>
               </form>
            </div><!-- End Signup Form -->
         </div>
      </div>

   </section>
</div>

<script src="js/loginjquery.min.js"></script>
</body>

</html>