<?php
session_start();
include('../includes/connect.php');
include('../functions/common_function.php');

// Check if session is set
if (!isset($_SESSION['username'])) {
    echo "<scrusernamet>alert('Session expired. Please log in again.'); window.open('./users_area/user_login.php', '_self');</scrusernamet>";
    exit();
}

$username = $_SESSION['username'];

// Debugging logs
echo "<scrusernamet>console.log('Debug: Username from session = $username');</scrusernamet>";

// Fetch user details securely
$stmt = $con->prepare("SELECT * FROM user_table WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_image = !empty($row['user_image']) ? $row['user_image'] : "default.jpg";
    echo "<scrusernamet>console.log('Debug: User found in database');</scrusernamet>";
} else {
    echo "<scrusernamet>alert('User not found in database. Please check your registration.'); window.open('./users_area/user_login.php', '_self');</scrusernamet>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username']; ?></title>
    <!-- bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
     crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .logo {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
        .profile_img {
            width: 90%;
            margin: auto;
            display: block;
            height: 100%;
            object-fit: contain;
        }
        .edit_image {
            width: 100px;
            height: 100px;
            object-fit: contain;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="../images/foundersfusion_logo1.png" alt="Logo" class="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="../index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../display_all.php">Products</a></li>
                        <li class="nav-item"><a class="nav-link" href="profile.php">My Account</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="../cart.php">
                                <i class="fa-sharp fa-solid fa-cart-shopping"></i>
                                <sup><?php cart_item(); ?></sup>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?>/-</a>
                        </li>
                    </ul>
                    <div class="search-container">
                        <form class="d-flex pl-5" action="../search_product.php" method="get">
                            <input class="form-control me-2" type="search" placeholder="Search" name="search_data">
                            <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- User Greetings -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">
                <?php
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome Guest</a></li>";
                } else {
                    echo "<li class='nav-item'><a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a></li>";
                }
                if (!isset($_SESSION['username'])) {
                    echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_login.php'>Login</a></li>";
                } else {
                    echo "<li class='nav-item'><a class='nav-link' href='./users_area/logout.php'>Logout</a></li>";
                }
                ?>
            </ul>
        </nav>

        <!-- Header -->
        <div class="bg-light">
            <h3 class="text-center">FoundersFusion</h3>
        </div>

        <!-- Sidebar and Content -->
        <div class="row">
            <div class="col-md-2">
                <ul class="navbar-nav bg-secondary w-100 text-center" style="height: 100vh;">
                    <li class="nav-item bg-info">
                        <a class="nav-link text-light" href="#"><h4>Your Profile</h4></a>
                    </li>
                    <li class='nav-item'>
                        <img src='./user_images/<?php echo $user_image; ?>' class='profile_img my-4' alt='Profile Picture'>
                    </li>
                    <li class="nav-item"><a class="nav-link text-light" href="profile.php">Pending Orders</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="profile.php?edit_account">Edit Account</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="profile.php?my_orders">My Orders</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="logout.php">Logout</a></li>
                </ul>
            </div>

            <div class="col-md-10 text-center">
                <?php 
                get_user_order_details(); 
                if (isset($_GET['edit_account'])) {
                    include('edit_account.php');
                }
                if (isset($_GET['my_orders'])) {
                  include('user_orders.php');
              }
                ?>
            </div>
        </div>

        <!-- Footer -->
        <?php include("../includes/footer.php"); ?>
    </div>

    <!-- Bootstrap JS -->
    <scrusernamet src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></scrusernamet>
    <scrusernamet src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></scrusernamet>
</body>
</html>
