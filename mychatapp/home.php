<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
<style>
.left_container
{
	width:25%;
	height:800px;
	background-color:#404040;
	left:0;
}	
.right_container
{
	width:70%;
	height:800px;
	background-color:#404040;
	margin-top:100px;
	position:relative;
	margin-top:-800px;
	margin-left:400px;
}
.btn
{
	width:140px;
	height:30px;

}
.msg
{
	position:relative;
	margin-top:-110px;
	margin-left:400px;

}
.content
{
	position: relative;
	margin-top:-5px;
}
.btn_logout
{
	position:relative;
	margin-left:820px;
	top:-50px;
	width:140px;
	height:30px;
}
.write
{
	position:fixed;
	left:430px;
	top:750px;

}
.inputform
{
	width:500px;

}
.btn_send
{
	width:140px;
	height:30px;
}
.list_item
{
	position: relative;
	left:300px;
}
.total
{
	position:relative;
	margin-top:-10px;
	margin-left:90px;
}
.username
{
	position:relative;
	
	left:100px;
}
.pic
{
	width:50px;
	height:50px;
	position: relative;
	left:20px;
	top:20px;
}
</style>
</head>
<body>
	<div>
	<div class="left_container">
		<br>
                     <div>
                        <center><a href="find_friends.php"><button class="btn" name="search_user" type="submit">Add new user</button></a></center>
                    </div>
                    <div>
                        <ul>
                           <?php include("get_users_data.php");?>
                        </ul>
                   </div>

     </div>
     <div class="right_container">
     	            <?php
                        $user=$_SESSION['user_email'];
                        $get_user="select * from users where user_email='$user'";
                        $run_user=mysqli_query($con,$get_user);
                        $row=mysqli_fetch_array($run_user);
                        $user_id=$row['user_id'];
                        $user_name=$row['user_name'];
                     ?>
                     <?php
                         if(isset($_GET['user_name'])){
                             global $con;
                             $get_username=$_GET['user_name'];
                             $get_user="select * from users where user_name='$get_username'";
                             $run_user=mysqli_query($con,$get_user);
                             $row_user=mysqli_fetch_array($run_user);
                             $username=$row_user['user_name'];
                             
                             $user_profile_image="avatar1.png";
                         }
                         $total_messages="select * from users_chat where (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username');";
                         $run_messages= mysqli_query($con,$total_messages);
                         $total=mysqli_num_rows($run_messages);
                     ?>
                     <div>
                       <div>
                           <img class='pic'src="avatar1.png">
                        </div>
                       </div>
                       <div class='right'>
                            <form method="post">
                                <p class="username"><?php echo"$username";?></p>
                                <span class="total"><?php echo $total;?> messages</span>&nbsp &nbsp
                                <button name="logout" class="btn_logout">logout</button>
                              </form>
                              <?php
                                if(isset($_POST['logout'])){
                                   
                                    $update_msg=mysqli_query($con,"update users set log_in='offline' where user_name='$username'");
                                    header("Location:logout.php");
                                    exit();
                                }
                              ?>
                        </div>
        </div>
        <div class="row">
             <div id="scrolling_to_bottom" class="col-md-12 right-header-contentchat">
             <?php
              $update_msg=mysqli_query($con,"update users_chat set msg_status='read' where sender_username='$username' AND receiver_username='$user_name'");
              $sel_msg="select * from users_chat where(sender_username='$user_name' AND receiver_username='$username') OR (sender_username='$username' AND receiver_username='$user_name') order by 1 asc";
              $run_msg= mysqli_query($con,$sel_msg);
              while($row=mysqli_fetch_array($run_msg)){
                  $sender_username=$row['sender_username'];
                  $receiver_username=$row['receiver_username'];
                  $msg_content=$row['msg_content'];
                  $msg_date=$row['msg_date'];
                  
              
                  ?>               
                   <ul>
                     <?php
                     if($user_name==$sender_username AND $username== $receiver_username){
                         echo"
                       
                         <div class='msg'>
                            $username <small>$msg_date</small>
                            <p class='content'>$msg_content</p>
                         </div>
                         
                         ";
                     }
                     else if($user_name==$receiver_username AND $username== $sender_username){
                        echo"
                        
                        <div class='msg'>
                           $username <small>$msg_date</small>
                           <br>
                           <p class='content'>$msg_content</p>
                        </div>
                        
                        ";
                     }
                     else{
                         echo"none";
                     }
                     ?>
                  </ul>
                  <?php
                     }
                  ?>
              </div>
          </div>
          <div> 
          	<div>
		             <form method="post" class='write'>
		                 <input class="inputform" autocomplete="off" type="text" name="msg_content" placeholder="Write your message...">
		                 <button class="btn_send" name="submit" >Send</button>
		            </form>
           </div>
           </div>
           <?php
if(isset($_POST['submit'])){
    $msg=htmlentities($_POST['msg_content']);
    if($msg=="")
    {
        echo"
        <div class='alert alert-danger'>
        <strong><center>Message was unable to send</center></strong>
        </div>
        "
        ;
    }
    else if(strlen($msg)>100){
        echo"
        <div class='alert alert-danger'>
        <strong><center>Message is too long</center></strong>
        </div>
        "
        ;
    }
    else{
        $insert="insert into users_chat(sender_username,receiver_username,msg_content,msg_status,msg_date)values('$user_name','$username','$msg','unread',NOW())";
        $run_insert= mysqli_query($con,$insert);
    }
 
}
?>

</body>
</html>