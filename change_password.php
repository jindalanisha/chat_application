<?DOCTYPE html>
<?php
session_start();
include("header.php");
$con=mysqli_connect("localhost","root","root","chatapp") or die("connection not established");
if(!isset($_SESSION['user_email'])){
	header("location: signin.php");

}else{
	?>
	<html>
	<head>
		<title>Change Password</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet"  href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cludflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

	</head>
	<style >
	body{
	
		overflow-x: hidden;
	}
	</style>
	<body>
		<div class="row">
			<div class="col-sm-2"></div>
		</div>
	
		<div class="col-sm-8">
			<form action="" method="post" enctype="multipart/form-data">
				 <table class="table table-bordered table-hover">
              <tr aligh="center">
                <td colspan="6" class="active"><h2>Change Password </h2></td>
              </tr>
              <tr>
              	<td style="font-weight:bold;">Current password </td>
                <td>
                  <input type="password" name="c_pass" class="form-control" required placeholder="Current password" id="mypass"/>
                </td>
              </tr>
               <tr>
              	<td style="font-weight:bold;">New password </td>
                <td>
                  <input type="password" name="u_pass1" class="form-control" required placeholder="New password" id="mypass"/>
                </td>
              </tr>
               <tr>
              	<td style="font-weight:bold;">Confirm password </td>
                <td>
                  <input type="password" name="u_pass2" class="form-control" required placeholder="Confirm password" id="mypass"/>
                </td>
              </tr>
               <tr align="center">
              	<td colspan="6"></td>
              
                  <input type="submit" name="Change" value="Change" class="btn btn-info" />
                
              </tr>
              </table>
			</form>
			<?php 
					if(isset($_POST['Change'])){
						$c_pass=$_POST['c_pass'];
						$pass1=$_POST['u_pass1'];
						$pass2=$_POST['u_pass2'];
						$user=$_SESSION['user_email']
						$get_user="select * from users where user_email='$user'";
						$run_user=mysqli_query($con,$get_user);
						$row=mysqli_fetch_array($run_user);
						$user_pass=$row['user_pass'];
						if ($c_pass!=$user_pass) {
							# code...
							echo "
							<div class='alert alert-danger'>
							<strong>Your current password didnt match.</strong></div>

							";
						}
						if($pass1!=$pass2){
								echo "
							<div class='alert alert-danger'>
							<strong>New password and confirm password differ.</strong></div>

							";
						}
						if($pass1 < 9 AND $pass2 < 9){
								echo "
							<div class='alert alert-danger'>
							<strong>Password should be minimum 9 characters.</strong></div>

							";
						}
						if($pass1 == $pass2 AND $c_pass == $user_pass){
							$q="update users set user_pass='$pass1' where user_email='$user'";
							$update_pass=mysqli_query($con,$q);
								echo "
							<div class='alert alert-danger'>
							<strong>Password changed successfully.</strong></div>

							";

						}

	
					}

			?>
		</div>
		<div class="col-sm-2">
		</div>
	</body>
	</html>
<?php } ?>
