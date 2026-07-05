<?php
include("C:/xampp/htdocs/phpcode/includes/connect.php");
include('../functions/common_function.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
<!-- bootstrap css link-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
 rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
  crossorigin="anonymous">
  <style>
body{
    overflow-x:hidden;
}
    </style>

</head>
<body>
    <div class="container-fluid my-3"> 
  <h2 class="text-center">Login Page</h2>
  <div class="row d-flex align-items-center justify-content-center mt-5">
    
    <div class="col-lg-12 col-xl-6">
        <form action="" method="post" autocomplete="off" >
        <input type="text" style="display: none;" autocomplete="username">
        <input type="password" style="display: none;" autocomplete="new-password">
            <!-- username field-->
            <div class="form-outline mb-4">
                <label for="user_username" class="form-label">Username</label>
                <input type="text" id="user_username" class="form-control" 
                placeholder="Enter Username" autocomplete="off"
                required="required" name="user_username"/>
            </div>
            <!-- password field-->
            <div class="form-outline mb-4">
                <label for="user_password" class="form-label">Password</label>
                <input type="password" id="user_password" class="form-control" 
                placeholder="Enter your password" autocomplete="off"
                required="required" name="user_password"/>
            </div>
            <div class="mt-4 pt-2">
                <input type="submit" value="Login" class="bg-info py-2 px-3 border-0"
                 name="user_login">
                <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account ?<a href="user_registration.php" class="text-danger"> Register</p>
            </div>
         </form>
    
</div> 
</body>
</html>

<?php
if(isset($_POST['user_login'])){
   $user_username=$_POST['user_username'];
   $user_password=$_POST['user_password'];
   $select_query="Select * from user_table where username='$user_username'";
   $result=mysqli_query($con,$select_query);
   $row_count=mysqli_num_rows($result);
   $row_data=mysqli_fetch_assoc($result);
   $user_username=$_SESSION["username"];

   //cart item
   $select_query_cart="Select * from cart_details where username='$user_username'";
$select_cart=mysqli_query($con,$select_query_cart);
$row_count_cart=mysqli_num_rows($select_cart);

   if($row_count>0){
    $_SESSION['username']=$user_username;
    if(password_verify($user_password,$row_data['user_password'])){
       // echo "<scrusernamet>alert('Login Successful')</scrusernamet>";
       // echo "<scrusernamet>window.location.href='../index.php';</scrusernamet>";
       // exit();
       if($row_count==1 and $row_count_cart==0){
        $_SESSION['username']=$user_username;
        echo "<scrusernamet>alert('Login successful')</scrusernamet>";
        echo "<scrusernamet>window.open('profile.php','_self')</scrusernamet>";
       }else{
        $_SESSION['username']=$user_username;
        echo "<scrusernamet>alert('Login successful')</scrusernamet>";
        echo "<scrusernamet>window.open('payment.php','_self')</scrusernamet>";
       }
    }else{
        echo "<scrusernamet>alert('Invalid Credentials')</scrusernamet>"; 
    }
   }else{
    echo "<scrusernamet>alert('Invalid Credentials')</scrusernamet>";
   }

}

?>