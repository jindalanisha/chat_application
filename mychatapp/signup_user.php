<?php
	$con=mysqli_connect("localhost","root","","mychatapp") or die("connection not established");
       
		$name=htmlentities(mysqli_real_escape_string($con,$_POST['username'])); //converts characters to html entities
		$pass=htmlentities(mysqli_real_escape_string($con,$_POST['password']));
		$email=htmlentities(mysqli_real_escape_string($con,$_POST['email']));
		$country=htmlentities(mysqli_real_escape_string($con,$_POST['country']));
		$gender=htmlentities(mysqli_real_escape_string($con,$_POST['gender']));
		//$rand=rand(1,2);
		if($name==''){
			echo "<script>alert('Name could not be verified')</script>";
		}
		if(strlen($pass)<8){
			echo "<script>alert('Password should be minimum 8 characters')</script>";
			exit();
		}
		$check_email= "select * from users where user_email='$email'"; 
		$run_email=mysqli_query($con,$check_email); 
		$check=mysqli_num_rows($run_email); //returns number of rows matched
		if($check==1){
			//means this email already exists
			echo "<script>alert('Email already exists,please try again.')</script>";
			echo "<script>window.open('signup.php','_self')</script>"; //redirects to the signup page
			exit();
		}
		$profile_pic="avatar1.png";
		$insert="insert into users (user_name,user_pass,user_email,user_profile,user_country,user_gender) values ('$name','$pass','$email','$profile_pic','$country','$gender')"; //inserting user data into database
		$query=mysqli_query($con,$insert);
		if($query){
			echo "<script>alert('Account creation successful.')</script>";
			echo "<script>window.open('signin.html','_self')</script>"; //redirect to sign in
		}else{
			echo("Error description: " . mysqli_error($con));
			//echo "<script>alert('Registration failed')</script>";

			//echo "<script>window.open('signup.html','_self')</script>"; //redirect
	}
	
?>
