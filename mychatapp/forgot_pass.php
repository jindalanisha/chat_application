<!DOCTYPE html>
<html>
<head>
	<title>Sign in Page</title>
	<style>
		.signin
		{
          font-family: cursive;
          border: 1.5px solid black;
          width: 40%;
          margin-left: 55%;
		}
		.header
		{
		   border: 1px solid black;
		   background-color: #67C991;	
		}
		.mydiv
		{
			margin-top: 20px;
			margin-left:15px;
		}
		.btn
		{
			background-color: #67C991;
			width: 150px;
			height:30px;
			border: 1px solid black;
		}
		.inputid
		{
			background-color: #f2f2f2;
			border-radius: 5px;
			padding: 10px;
			width:87%;
			margin-top:10px;
		}
		body
		{
			background-image: url("img1.jpg");
			background-repeat: no-repeat;
			background-size: 100% 100%;
		}
		.register
		{
			margin-left: 50%;
		}
	</style>
</head>
<body>

   <br><br><br><br><br><br><br><br>
		  <div class="signin">
				  <form action="" method="POST">
						  <div class="header">
						  	 <center><h1>Forgot Password</h1></center>
						  </div>

						  <div class="mydiv">
								  	Email<br>
								  	<input class="inputid" type="email" name="email" placeholder="someone@mychat.com" required>
						  </div>

						  <div class="mydiv">
								  	Bestfriend name<br>
								  	<input class="inputid"  type="text" name="bf" placeholder="Someone..." required>
						  </div>

						  <div class="mydiv">
						  	       <center><input type="submit" name="submit"  class="btn"></center>
						  </div>
						  <br>
				  		
				  </form>

		  </div>
		  <div class="register">
				<center><p><a href="signin.html"> Back to signin</a></p></center>
		  </div>
          <br><br><br><br><br><br> <br><br><br><br><br><br> <br><br><br><br><br><br>
<?php
session_start();
include("connection.php");
if(isset($_POST['submit']))
{
    $email=htmlentities(mysqli_real_escape_string($con,$_POST['email']));
    $recovery_account=htmlentities(mysqli_real_escape_string($con,$_POST['bf']));
    $select_user="select * from users where user_email='$email' AND forgotten_pass='$recovery_account';";
    $query=mysqli_query($con,$select_user);
    $check_user=mysqli_num_rows($query);
    echo"<script>alert('$check_user')</script>";
    if($check_user==1)
    {
        $_SESSION['user_email']=$email;
        echo"<script>window.open('create_password.php','_self')</script>";

    }
    else{
       echo"<script>alert('Your email or bestfriend name is incorrect')</script>";
       echo"<script>window.open('forgot_pass.php','_self')</script>";
    }
}          



?>
</body>43ESX2ZZ
</html>