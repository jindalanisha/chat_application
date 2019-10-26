<?php
session_start();
$con=mysqli_connect("localhost","root","root","chatapp") or die("connection not established");
 //if the sign in button is set
	$pass=htmlentities(mysqli_real_escape_string($con,$_POST['password']));
	$email=htmlentities(mysqli_real_escape_string($con,$_POST['email']));

	$select_user="select * from users where user_email='$email' and user_pass='$pass'";
	$query=mysqli_query($con,$select_user);
	$check_user=mysqli_num_rows($query);
	if($check_user==1){ //user record found
		$_SESSION['user_email']=$email;
		$update_msg=mysqli_query($con,"UPDATE users SET log_in='Online' WHERE user_email='$email'");

		$user=$_SESSION['user_email'];
		$get_user="select * from users where user_email='$email'";
		$run_user=mysqli_query($con,$get_user);
		$row=mysqli_fetch_array($run_user); //the result as an array

		$user_name=$row['user_name']; //username 
		echo "<script>window.open('home.php?user_name=$user_name','_self')</script>"; //directs the user to his mainpage

	}else{
		echo"
		<div>
			<strong>Check your email and password</strong>
		</div>";
	}

?>