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
    <title>Ecommerce Website-Cart details</title>
    <!-- bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- css file-->
     <link rel="stylesheet" href="style.css">
<style>
.cart_img {
    width: 80px; /* Set desired width */
    height: 80px;  /* Maintain aspect ratio */
   
}



</style>


</head>
<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Logo</a>
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
        <li class="nav-item">
          <a class="nav-link" href="users_area/user_registration.php">Register</a>
      </li>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cart.php"><i class="fa-sharp fa-solid fa-cart-shopping">

          </i><sup><?php cart_item();?></sup></a>
        </li>
       
        
      </ul>
      <div class="search-container">
        
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

  <!-- fourth child-table -->

  <div class="container d-flex justify-content-center">
    <div class="row">
        <form action="" method="post">
            <table class="table table-bordered text-center">
                <?php
                global $con;
                $get_username_add = $_SESSION["username"];
                $total_price = 0;
                $cart_query = "SELECT * FROM cart_details WHERE username='$get_username_add'";
                $result = mysqli_query($con, $cart_query);
                $result_count = mysqli_num_rows($result);

                if ($result_count > 0) {
                    echo "<thead> 
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                                <th colspan='4'>Operations</th>
                            </tr>
                          </thead>
                          <tbody>";

                    while ($row = mysqli_fetch_array($result)) {
                        $product_id = $row['product_id'];
                        $quantity = $row['quantity']; // Get quantity from cart

                        $select_products = "SELECT * FROM products WHERE product_id='$product_id'";
                        $result_products = mysqli_query($con, $select_products);

                        while ($row_product_price = mysqli_fetch_array($result_products)) {
                            $product_price = $row_product_price['product_price'];
                            $product_title = $row_product_price['product_title'];
                            $product_image1 = $row_product_price['product_image1'];
                            $subtotal = $product_price * $quantity;
                            $total_price += $subtotal;
                ?>
                            <tr>
                                <td><?php echo $product_title; ?></td>
                                <td><img src="admin_area/product_images/<?php echo $product_image1; ?>" alt="" class="cart_img"></td>
                                <td>
    <input type="text" name="qty[<?php echo $product_id; ?>]" 
        class="form-input w-50" value="<?php echo $quantity; ?>" 
        min="1">
</td>

                                <td><?php echo $subtotal; ?>/-</td>
                                <td><input type="checkbox" name="removeitem[]" value="<?php echo $product_id; ?>"></td>
                                <td>
                                    <input type="submit" value="Update Cart" class="bg-info px-3 py-2 border-0 mx-3" name="update_cart">
                                    <input type="submit" value="Remove Cart" class="bg-danger px-3 py-2 border-0 mx-3 text-light" name="remove_cart">
                                </td>
                            </tr>
                <?php
                        }
                    }
                } else {
                    echo "<div class='d-flex justify-content-center'><h2 class='text-danger'>Cart is Empty</h2></div>";
                }
                ?>
                </tbody>
            </table>

            <!-- Subtotal Section -->
            <div class="d-flex mb-5">
                <?php
                if ($result_count > 0) {
                    echo "<h4 class='px-3'>Subtotal: <strong class='text-info'>$total_price/-</strong></h4>
                          <input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'> 
                          <a href='./users_area/checkout.php'><button type='button' class='bg-secondary px-3 py-2 border-0 text-light'>Checkout</button></a>";
                } else {
                    echo "<input type='submit' value='Continue Shopping' class='bg-info px-3 py-2 border-0 mx-3' name='continue_shopping'>";
                }

                if (isset($_POST['continue_shopping'])) {
                    echo "<scrusernamet>window.open('index.php','_self')</scrusernamet>";
                }
                ?>
            </div>
        </form>
    </div>
</div>

<?php
// Function to update cart items
if (isset($_POST['update_cart'])) {
    foreach ($_POST['qty'] as $id => $quantity) {
        if ($quantity > 0) {
            $update_cart = "UPDATE cart_details SET quantity=$quantity WHERE product_id=$id AND username='$get_username_add'";
            mysqli_query($con, $update_cart);
        }
    }
    echo "<scrusernamet>window.open('cart.php','_self')</scrusernamet>";
}

// Function to remove selected cart items
if (isset($_POST['remove_cart'])) {
    if (!empty($_POST['removeitem'])) {
        foreach ($_POST['removeitem'] as $remove_id) {
            $delete_query = "DELETE FROM cart_details WHERE product_id=$remove_id AND username='$get_username_add'";
            mysqli_query($con, $delete_query);
        }
    }
    echo "<scrusernamet>window.open('cart.php','_self')</scrusernamet>";
}
?>
