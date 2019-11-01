<!DOCTYPE html>
<?php
session_start();
include("connection.php");
if(!isset($_SESSION['user_email'])){
    header("location:signin.php");
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MY CHAT-HOME</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
    <link rel="stylesheet" type="text/css"  href="home.css">
    
<link rel = "stylesheet" href = "https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/bootstrap.min.css" >
<script src = "https://code.jquery.com/jquery-1.11.3.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">



<script src = "https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<link rel="stylesheet" href="index.css">
<link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet"> 
</head>
<body>
    <div class="container main-section">
        <div  class="row">
            <div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
                <div class="input-group-searchbox">
                    <div class="input-group-btn">
                        <center><a href="find_friends.php"><button class="btn btn-default search-icon" name="search_user" type="submit">Add new user</button></a></center>
                    </div> 
                 </div>
                 <div class="left-chat">
                     <ul>
                         <?php include("get_users_data.php");?>
                     </ul>
                 </div>   
             </div>
             <div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
                 <div class="row">
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
                             $user_profile_image=$row_user['user_profile'];

                         }
                         $total_messages="select * from users_chat where (sender_username='$user_name' AND receiver_username='$username') OR (receiver_username='$user_name' AND sender_username='$username');";
                         $run_messages= mysqli_query($con,$total_messages);
                         $total=mysqli_num_rows($run_messages);
                     ?>
                   <div class="col-md-12 right-header">
                       <div class="right-header-img">
                           <img src="<?php echo"user_profile_image";?>">
                        </div>
                        <div class="right-header-detail">
                            <form method="post">
                                <p><?php echo"$username";?></p>
                                <span><?php echo $total;?>messages</span>&nbsp &nbsp
                                <button name="logout" class="btn-btn-danger">logout</button>
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

                </div>
                <div class="row">
             <div id="scrolling_to_bottom" class="col-md-12 right-header-contentchat">
             <?php
              $update_msg=mysqli_query($con,"update users_chat set msg_status='read' where sender_username='$username' AND receiver_username='$user_name'");
              $sel_msg="select * from users_chat where(sender_username='$user_name' AND receiver_username='$username') OR (sender_username='$user_name' AND receiver_username='$username') order by 1 asc";
              $run_msg= mysqli_query($con,$sel_msg);
              while($row=mysqli_fetch_array($run_msg)){
                  $sender_username=$row['sender_username'];
                  $receiver_username=$row['receiver_username'];
                  $msg_content=$row['msg_content'];
                  $msg_date=$row['msg_date'];
                  
              
?>                <ul>
                     <?php
                     if($user_name==$sender_username AND $username== $receiver_username){
                         echo"
                         <li>
                         <div class='rightside-chat'>
                            <span>$username <small>$msg_date</small></span>
                            <p>$msg_content</p>
                         </div>
                         </li>
                         ";
                     }
                     else if($user_name==$receiver_username AND $username== $sender_username){
                        echo"
                        <li>
                        <div class='rightside-chat'>
                           <span>$username <small>$msg_date</small></span>
                           <p>$msg_content</p>
                        </div>
                        </li>
                        ";
                     }
                     else{
                         echo"none";
                     }
                     ?>
                  </ul>
                  <?php
                  }?>
               </div>
           </div>
        <div class="row"> <div class="col-md-12 right-chat-textbox">
             <form method="post">
                 <input autocomplete="off" type="text" name="msg_content" placeholder="Write your message...">
                 <button class="btn" name="submit"><i class="fa fa-telegram" aria-hidden="true"></i></button>
                </form>
        </div>
    </div></div>
                            </div></div>
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