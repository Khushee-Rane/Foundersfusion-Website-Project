<!-- connect file -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website using PHP and MySQL.</title>
    <!-- bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- css file --->
     <!-- <link rel="stylesheet" href="style.css">  --->
      <style>
  .logo {
    width: 50px;  /* Adjust to the desired width */
    height: 50px; /* Keep the aspect ratio consistent */
    object-fit: cover; /* Ensure the image fits properly */
    object-position: center; /* Center the logo */
}

</style> 



</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
  <a class="navbar-brand" href="#"><img src="images/foundersfusion_logo1.png" alt="Logo" class="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="display_all.php">Products</a>
        </li>
        <?php
if(isset($_SESSION['username'])){
  echo "<li class='nav-item'>
          <a class='nav-link' href='users_area/profile.php'>My Account</a>
      </li>";
}else{
  echo "<li class='nav-item'>
          <a class='nav-link' href='users_area/user_registration.php'>Register</a>
      </li>";
}

?>
        
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-sharp fa-solid fa-cart-shopping">

          </i><sup><?php cart_item();?></sup></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Total Price:<?php total_cart_price(); ?>/-</a>
        </li>

        
      </ul>
      <div class="search-container">
        <form class="d-flex pl-5" action="search_product.php" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" 
            aria-label="Search" name="search_data">
            <!--<button class="btn btn-outline-light" type="submit">Search</button> -->
            <input type="submit" value="Search" 
            class="btn btn-outline-light" name="search_data_product">
        </form>
    </div>
  </div>
</nav>
<!-- calling cart function -->
 <?php
  cart();
  ?>

<!-- second child -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
  <ul class="navbar-nav me-auto">
  
        <?php
        if(!isset($_SESSION['username'])){
          echo "<li class='nav-item'>
          <a class='nav-link' href='#'>Welcome Guest</a>
        </li>";
        }else{
          echo "<li class='nav-item'>
            <a class='nav-link' href='#'>Welcome " . $_SESSION['username']." </a>
          </li>";
        }
      if(!isset($_SESSION['username'])){
        echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/user_login.php'>Login</a>
        </li>";
      }else{
        echo "<li class='nav-item'>
          <a class='nav-link' href='./users_area/logout.php'>Logout</a>
        </li>";
      }
        ?>

  </ul>
 </nav>

 <!-- third child -->
  <div class="bg-light">
    <h3 class="text-center">FoundersFusion</h3>
  </div>

  <!--fourth child -->
  <div class="row px-1">
    <div class="col-md-10">
      <!-- products -->
       <div class="row">

       <!-- fetching products -->
        <?php
        // calling function
       getproducts();
       get_unique_categories();
       get_unique_brands();
       //$username = $_SESSION["username"];  
       //echo 'User Real username Address - '.$username; 

        ?>
        

        
<!-- row end -->        
        </div>
  <!-- col end -->     
    </div>
    <!-- sidenav -->
    <div class="col-md-2 bg-secondary p-0">
       <!-- brands to be displayed -->
       <ul class="navbar-nav me-auto text-center">
        <li class="nav-item bg-info">
          <a href="#" class="nav-link text-light"><h4>Delivery Brands</h4></a>
        </li>
        <?php
       getbrands();
      ?>
        
       </ul>
       <!-- categories to be displayed -->
       <ul class="navbar-nav me-auto text-center">
        <li class="nav-item bg-info">
          <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
        </li>
        <?php
       getcategories();

        ?>


       </ul>
    </div>

  </div>











  <!-- last child -->
 <!-- include footer -->
  <?php include("./includes/footer.php")     ?>
    
</div>
<!-- bootstrap js link --> 
<scrusernamet src="https://code.jquery.com/jquery-3.5.1.slim.min.js" 
 integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></scrusernamet>
<scrusernamet src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
 crossorigin="anonymous"></scrusernamet>   
</body>
</html>
