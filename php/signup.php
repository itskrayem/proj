
<?php

session_start();
require "connection.php";

if (isset($_POST['signin'])) {
        header('Location:http://localhost/web%20project/sign_in.php');
        session_destroy(); 
}

 ?>




<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
    <link rel="stylesheet" href="login.css">
    <script src="jquery-3.6.0.min.js"></script>
    </head>
<body>

   <div>
  <?php
     

     if (isset($_POST['go'])) {

         $Em = $_POST['E-Mail'];

        $email  = filter_var($Em, FILTER_SANITIZE_EMAIL);

         $sql = "SELECT * FROM user WHERE email=?"; 
         $stmt = $conn->prepare($sql); 
         $stmt->bind_param("s", $email);
         $stmt->execute();
         $result = $stmt->get_result(); 
         $user = $result->fetch_assoc();
        
        
        

         if($user['email']!=''){

        echo "<script>alert('Email Already has an account')</script>";


          }else{   


               $fname= $_POST['firstname'];
        $lname= $_POST['lastname'];
      
       $name=$fname ." ".$lname;
       
       $pass= $_POST['Password'];


       $name   = filter_var($name, FILTER_SANITIZE_STRING);
      
       $pass   = filter_var($pass, FILTER_SANITIZE_STRING);
       $pass = PASSWORD_HASH($pass, PASSWORD_DEFAULT);
       $PFP    ="pfps/pfp.png";
       $status ="......";
       $field  ="......";
       $bio    ="......";


       $sql= "INSERT INTO user (email,name,password,status,field,bio,pfp) VALUES(?,?,?,?,?,?,?)";
       $stmt= $conn->prepare($sql);
       $stmt->bind_param("sssssss",$email,$name,$pass,$status,$field,$bio,$PFP);
       $stmt->execute();
       $result= $stmt->get_result();

       $_SESSION['email']=$email;
       $_SESSION['posts']='all';
       $_SESSION['word']='';
       header('Location: http://localhost/web%20project/home.php');
       die;
          };


}
  

     
    ?>
</div>
    
<header>
    <h3><b class="free">Free</b>dom Pen</h3>
     <div class="links">
      <label for="signin" style="cursor: pointer;">Sign in</label>
  </div>
  </header>

      <form method="POST">

      <input type="submit" name="signin" id="signin" style="display: none;">
      </form>
	
    <div class="signe-up">




	<form method="post">
		<label for="firstname" class="red">First Name</label> 

  <input type="text" id="firstname" name="firstname" class="clear" required>

  <label for="lastname" class="red">Last Name</label>  

  <input type="text" id="lastname" name="lastname" class="clear" required>

  <label for="E-Mail" class="red">E-Mail</label>  

  <input type="email" id="email" name="E-Mail" class="clear" required>

  <label for="Password" class="red">Password</label>

  <input type="password" id="pass" name="Password" class="clear" required>


  <input class="button" type="submit" value="Sign up" name="go">
  </form>


    </div>

    

   


   
 


</script>
</body>
</html>