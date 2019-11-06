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
				  <form action="signin.php" method="POST">
						  <div class="header">
						  	 <center><h1>Create new password</h1></center>
						  </div>

						  <div class="mydiv">
								  	Enter Password<br>
								  	<input class="inputid"  type="password" name="password1" placeholder="Password" required>
						  </div>

						  <div class="mydiv">
								  	Confirm Password<br>
								  	<input class="inputid"  type="password" name="password2" placeholder="Confirm Password" required>
						  </div>

						  <div class="mydiv">
						  	       <center><input type="submit" name="change"  class="btn"></center>
						  </div>
						  <br>
				  		
				  </form>

          </div>
          <?php
          session_start();
          include("connection.php");
          if(isset($_POST['submitchange']))
          {
              $user=$_SESSION['user_email'];
                $pass1=$_POST['password1'];
                $pass2=$_POST['password2'];
                if($pass1!=$pass2)
                {
                    echo"
                    <div class='alert alert-danger>
                    <strong>Your new password didn't match with confirm password</strong>
                    <div>
                    ";
                }
                if($pass1<9  NAD $pass2<9){
                    echo"
                    <div class='alert alert-danger>
                    <strong>Use 9 or more then 9 characters</strong>
                    <div>
                    ";
                }
                if($pass1==$pass2)
                {
                    $update_pass=mysqli_query($con,"UPDATE users ste user_pass='$pass1' where user_email='$user'");
                    session_destroy();
                    echo"<script>alert('Go ahead and signin')</script>";
                    echo"<script>window.open('signin.html','_self')</script>";
                }
          }
          ?>
		 
		  <br><br><br><br><br><br> <br><br><br><br><br><br> <br><br><br><br><br><br>

</body>43ESX2ZZ
</html>