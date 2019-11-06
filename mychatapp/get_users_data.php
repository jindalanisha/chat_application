<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style>
    .i
    {
      height:40px;
      width:40px;
      position:relative;
      top:20px;
    }
    .onoff
    {
      position: relative;
      left:105px;
      top:3px;
    }
    .name
    {
      padding-left:100px;
    }
    .mylink
    {
      color:red;
      position:relative;
      top:15px;
    }
    .details
    {

    }
    .online
    {
      height: 5px;
      position:relative;
      left:100px;
      width: 5px;
      background-color:green;
      border-radius: 50%;
      display: inline-block;
    }
    .offline
    {
      height: 5px;
      width: 5px;
      position: relative;;
      left:100px;
      background-color:black;
      border-radius: 50%;
      display: inline-block;
    }
    .left
    {
       margin-left:0px;
    }
    .right
    {
       margin-right:0px;
       position:relative;
       top:-50px;
    }
  </style>
</head>
<body>
<?php
$con=mysqli_connect("localhost","root","","mychatapp");
$user="select * from users";
$run_user= mysqli_query($con,$user);
while($row_user=mysqli_fetch_array($run_user)){
    $user_id=$row_user['user_id'];
    $user_name=$row_user['user_name'];
    $user_profile=$row_user['user_profile'];
    $login=$row_user['log_in'];
    echo"
      <li>
      <div>
       <div class='left'>
       <img class='i' src='$user_profile'>
       </div>
       <div class='right'>
       <p class='name'><a class='mylink' href='home.php?user_name=$user_name'>$user_name</a></p>";
       if($login=="Online"){
           echo"<span class='online'></span><i class='onoff'>Online</i>";
       }else{
        echo"<span class='offline'></span><i class='onoff'>Offline</i>";
       }
       "
       </div>
       </div>
      </li>
    ";
    
}
?> 
</body>
</html>
