<?php
//session_start();

// Ensure the file path is correct
include($_SERVER['DOCUMENT_ROOT'] . '/phpcode/includes/connect.php');


//getting products
function getProducts(){
    global $con;

    //condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){

       

    
    $select_query="Select * from products order by rand() LIMIT 0,4";
    $result_query=mysqli_query($con,$select_query);
   // $row=mysqli_fetch_assoc($result_query);
    //echo $row['product_title'];
    while($row=mysqli_fetch_assoc($result_query)){
      $product_id=$row['product_id'];
      $product_title=$row['product_title'];
      $product_descrusernametion=$row['product_descrusernametion'];
     
      $product_image1=$row['product_image1'];
      $product_image2=$row['product_image2'];
      $product_image3=$row['product_image3'];

      
      $product_price=$row['product_price'];
      $category_id=$row['category_id'];
      $brand_id=$row['brand_id'];
      echo "<div class='col-md-4 mb-2'>
      <div class='card'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_descrusernametion</p>
          <p class='card-text'>Price: $product_price/-</p>
          <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
          <a href='product_details.php?product_id=$product_id' class='btn btn-secondary'>View More</a>
        </div>
</div></div>";
      
      


    }

}
}
}





// getting all products
function get_all_products(){
  global $con;

    //condition to check isset or not
    if(!isset($_GET['category'])){
        if(!isset($_GET['brand'])){

       

    
    $select_query="Select * from products order by rand()";
    $result_query=mysqli_query($con,$select_query);
   // $row=mysqli_fetch_assoc($result_query);
    //echo $row['product_title'];
    while($row=mysqli_fetch_assoc($result_query)){
      $product_id=$row['product_id'];
      $product_title=$row['product_title'];
      $product_descrusernametion=$row['product_descrusernametion'];
     
      $product_image1=$row['product_image1'];
      $product_image2=$row['product_image2'];
      $product_image3=$row['product_image3'];

      
      $product_price=$row['product_price'];
      $category_id=$row['category_id'];
      $brand_id=$row['brand_id'];
      echo "<div class='col-md-4 mb-2'>
      <div class='card'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
        <div class='card-body'>
          <h5 class='card-title'>$product_title</h5>
          <p class='card-text'>$product_descrusernametion</p>
          <p class='card-text'>Price: $product_price/-</p>
         <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
          <a href='#' class='btn btn-secondary'>View More</a>
        </div>
</div></div>";
      
      


    }

}
}
}

//getting unique categories
function get_unique_categories(){
    global $con;

    //condition to check isset or not
    if(isset($_GET['category'])){
       $category_id=$_GET['category'];

        $select_query="Select * from products where category_id=$category_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "
<div style='display: flex; justify-content: center; align-items: center; height: 70vh; width: 100vw;'>
    <h2 style='text-align: center; color: red;'>No stock for this Category</h2>
</div>";

    
        }
        while($row=mysqli_fetch_assoc($result_query)){
          $product_id=$row['product_id'];
          $product_title=$row['product_title'];
          $product_descrusernametion=$row['product_descrusernametion'];
         
          $product_image1=$row['product_image1'];
          $product_image2=$row['product_image2'];
          $product_image3=$row['product_image3'];
    
          
          $product_price=$row['product_price'];
          $category_id=$row['category_id'];
          $brand_id=$row['brand_id'];
          echo "<div class='col-md-4 mb-2'>
          <div class='card'>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title</h5>
              <p class='card-text'>$product_descrusernametion</p>
              <p class='card-text'>Price: $product_price/-</p>
              <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
              <a href='#' class='btn btn-secondary'>View More</a>
            </div>
    </div></div>";
          
          
    
    
        }
    
    }
    }
    //getting unique brands
function get_unique_brands(){
    global $con;

    //condition to check isset or not
    if(isset($_GET['brand'])){
       $brand_id=$_GET['brand'];

        $select_query="Select * from products where brand_id=$brand_id";
        $result_query=mysqli_query($con,$select_query);
        $num_of_rows=mysqli_num_rows($result_query);
        if($num_of_rows==0){
            echo "
<div style='display: flex; justify-content: center; align-items: center; height: 70vh; width: 100vw;'>
    <h2 style='text-align: center; color: red;'>This Brand is not available for service</h2>
</div>";

    
        }
        while($row=mysqli_fetch_assoc($result_query)){
          $product_id=$row['product_id'];
          $product_title=$row['product_title'];
          $product_descrusernametion=$row['product_descrusernametion'];
         
          $product_image1=$row['product_image1'];
          $product_image2=$row['product_image2'];
          $product_image3=$row['product_image3'];
    
          
          $product_price=$row['product_price'];
          $category_id=$row['category_id'];
          $brand_id=$row['brand_id'];
          echo "<div class='col-md-4 mb-2'>
          <div class='card'>
            <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title'>$product_title</h5>
              <p class='card-text'>$product_descrusernametion</p>
              <p class='card-text'>Price: $product_price/-</p>
              <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
              <a href='#' class='btn btn-secondary'>View More</a>
            </div>
    </div></div>";
          
          
    
    
        }
    
    }
    }


    
       

    
//displaying brands in sidenav
function getbrands(){
    global $con;
    $select_brands="select * from brands";
        $result_brands=mysqli_query($con,$select_brands);
        
        while($row_data=mysqli_fetch_assoc($result_brands)){
          $brand_title=$row_data['brand_title'];
          $brand_id=$row_data['brand_id'];
          echo " <li class='nav-item'>
          <a href='index.php?brand=$brand_id' class='nav-link text-light'>$brand_title</a>
        </li>";
        }
}

//displaying categories in sidenav
function getcategories(){
    global $con;
    $select_categories="select * from categories";
        $result_categories=mysqli_query($con,$select_categories);
        while($row_data=mysqli_fetch_assoc($result_categories)){
          $category_title=$row_data['category_title'];
          $category_id=$row_data['category_id'];
          echo " <li class='nav-item'>
          <a href='index.php?category=$category_id' class='nav-link text-light'>$category_title</a>
        </li>";
        }
}
function search_product() {
  global $con;

  // Check if search data is provided
  if (isset($_GET['search_data_product'])) {
      $search_data_values = $_GET['search_data'];

      // Sanitize input
      $search_data_values = mysqli_real_escape_string($con, $search_data_values);

      // Construct the query
      $search_query = "SELECT * FROM products WHERE product_keywords LIKE '%$search_data_values%'";

      // Execute the query
      $result_query = mysqli_query($con, $search_query);

      // Error handling for the query
      if (!$result_query) {
          die("Query failed: " . mysqli_error($con));
      }

      // Check number of rows
      $num_of_rows = mysqli_num_rows($result_query);

      if ($num_of_rows == 0) {
          echo "
<div style='display: flex; justify-content: center; align-items: center; height: 70vh; width: 100vw;'>
  <h2 style='text-align: center; color: red;'>No results match. No products found in this category.</h2>
</div>";
      } else {
          // Display results in a Bootstrap container
          echo "<div class='container'><div class='row'>";
          while ($row = mysqli_fetch_assoc($result_query)) {
              $product_id = $row['product_id'];
              $product_title = $row['product_title'];
              $product_descrusernametion = $row['product_descrusernametion'];
              $product_image1 = !empty($row['product_image1']) ? $row['product_image1'] : 'default_image.jpg';
              $product_price = $row['product_price'];

              echo "<div class='col-md-4 mb-2'>
                      <div class='card'>
                          <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='$product_title'>
                          <div class='card-body'>
                              <h5 class='card-title'>$product_title</h5>
                              <p class='card-text'>$product_descrusernametion</p>
                              <p class='card-text'>Price: $product_price/-</p>
                              <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
                              <a href='#' class='btn btn-secondary'>View More</a>
                          </div>
                      </div>
                  </div>";
          }
          echo "</div></div>"; // Close row and container
      }
  } else {
      echo "No search data provided.";
  }
}
// get username address function
 function $_SESSION["username"] {  
  //whether username is from the share internet  
   if(!empty($_SERVER['HTTP_CLIENT_username'])) {  
              $username = $_SERVER['HTTP_CLIENT_username'];  
     }  
  //whether username is from the proxy  
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
             $username = $_SERVER['HTTP_X_FORWARDED_FOR'];  
   }  
//whether username is from the remote address  
  else{  
          $username = $_SERVER['REMOTE_ADDR'];  
   }  
   return $username;  
 }  
$username = $_SESSION["username"];  
echo 'User Real username Address - '.$username;  


// cart function
function cart(){
    if(isset($_GET['add_to_cart'])){
        global $con;
         $get_username_add = $_SESSION["username"];
        $get_product_id = $_GET['add_to_cart'];
        
        // Check if the product is already in the cart
        $select_query = "SELECT * FROM cart_details WHERE username='$get_username_add' AND product_id=$get_product_id";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);

        if ($num_of_rows > 0) {
            echo "<scrusernamet>alert('Item is already present inside cart')</scrusernamet>";
            echo "<scrusernamet>window.open('index.php','_self')</scrusernamet>";
        } else {
            // Insert item with default quantity = 1
            $insert_query = "INSERT INTO cart_details (product_id, username, quantity) VALUES ($get_product_id, '$get_username_add', 1)";
            $result_query = mysqli_query($con, $insert_query);
            echo "<scrusernamet>alert('Item added to cart')</scrusernamet>";
            echo "<scrusernamet>window.open('index.php','_self')</scrusernamet>";
        }
    }
}

// Function to get cart item count
function cart_item(){
    global $con;
    $get_username_add = $_SESSION["username"];
    $select_query = "SELECT * FROM cart_details WHERE username='$get_username_add'";
    $result_query = mysqli_query($con, $select_query);
    $count_cart_items = mysqli_num_rows($result_query);
    echo $count_cart_items;
}

// Function to calculate total cart price
function total_cart_price(){
    global $con;
    $get_username_add = $_SESSION["username"];
    $total_price = 0;

    // Fetch all cart items
    $cart_query = "SELECT * FROM cart_details WHERE username='$get_username_add'";
    $result = mysqli_query($con, $cart_query);

    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $quantity = $row['quantity']; // Get quantity

        // Fetch product price
        $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
        $result_products = mysqli_query($con, $select_products);
        while ($row_product_price = mysqli_fetch_array($result_products)) {
            $product_price = $row_product_price['product_price'];
            $total_price += ($product_price * $quantity); // Multusernamely price with quantity
        }
    }
    
    echo $total_price; // Display final total
}

// get user order details
function get_user_order_details(){
    global $con;
    $username=$_SESSION['username'];
    $get_details="Select * from user_table where username='$username'";
    $result_query=mysqli_query($con,$get_details);
    while($row_query=mysqli_fetch_array($result_query)){
        $user_id=$row_query['user_id'];
        if(!isset($_GET['edit_account'])){
            if(!isset($_GET['my_orders'])){
                if(!isset($_GET['delete_account'])){
                    $get_orders="Select * from user_orders where 
                    user_id=$user_id and order_status='pending'";
                    $result_orders_query=mysqli_query($con,$get_orders);
                    $row_count=mysqli_num_rows($result_orders_query);
                    if($row_count>0){
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have <span class='text-danger'>$row_count</span>
                        pending orders</h3>
                        <p class='text-center'><a href='profile.php?my_orders' class='text-dark'>
                        Order Details</a></p>";
                    }else{
                        echo "<h3 class='text-center text-success mt-5 mb-2'>You have zero pending orders</h3>
                        <p class='text-center'><a href='../index.php' class='text-dark'>
                        Explore Products</a></p>"; 
                    }
                }
            }
        }
    }
}

 ?>

    

