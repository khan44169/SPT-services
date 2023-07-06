<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING); 
   

   $sql = "SELECT * FROM admins WHERE name='$name';";
   $res = mysqli_query($conn, $sql);
   // print_r($res);
   // echo(mysqli_error($conn) );

            if(mysqli_num_rows($res) != 0){
                $row = mysqli_fetch_array($res);
                if($pass != $row['password']){
                    $message[] = "Invalid password!";
                }
                else{
                    $result = "Loggedin successfully! Redirecting...";
                     $_SESSION['admin_id'] = $row['id'];
                     header('location:dashboard.php');
                }
            }
            else{
                $message[] = "Invalid username!";
            }
       

   

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<section class="form-container">

   <form action="" method="post">
      <h3>login</h3>
      <!-- <p>default username = <span>admin</span> & password = <span>111</span></p> -->
      <label>Name</label>
      <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <label>Password</label>
      <input type="password" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" class="btn" name="submit">
   </form>

</section>
   
</body>
</html>