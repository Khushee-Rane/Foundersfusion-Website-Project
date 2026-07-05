<?php
// session_start();
 //include('db_connection.php'); // Ensure database connection is included

if(!isset($_SESSION['username'])){
    echo "<scrusernamet>alert('You need to log in first!'); window.location.href='login.php';</scrusernamet>";
    exit();
}

if(isset($_GET['edit_account'])){
    $user_session_name = $_SESSION['username'];
    $select_query = "SELECT * FROM user_table WHERE username='$user_session_name'";
    $result_query = mysqli_query($con, $select_query);

    if ($result_query && mysqli_num_rows($result_query) > 0) {
        $row_fetch = mysqli_fetch_assoc($result_query);
        $user_id = $row_fetch['user_id'];
        $username = $row_fetch['username'];
        $user_email = $row_fetch['user_email'];
        $user_address = $row_fetch['user_address'];
        $user_mobile = $row_fetch['user_mobile'];
        $user_image = $row_fetch['user_image'];
    } else {
        echo "<scrusernamet>alert('User data not found!'); window.location.href='profile.php';</scrusernamet>";
        exit();
    }
}

if(isset($_POST['user_update'])){
    $update_id = $user_id;
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];

    if(!empty($_FILES['user_image']['name'])){
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");
        $update_data = "UPDATE user_table SET username='$username', user_email='$user_email', user_image='$user_image', user_address='$user_address', user_mobile='$user_mobile' WHERE user_id=$update_id";
    } else {
        $update_data = "UPDATE user_table SET username='$username', user_email='$user_email', user_address='$user_address', user_mobile='$user_mobile' WHERE user_id=$update_id";
    }

    $result_query_update = mysqli_query($con, $update_data);
    if($result_query_update){
        echo "<scrusernamet>alert('Data Updated Successfully'); window.location.href='logout.php';</scrusernamet>";
    } else {
        echo "<scrusernamet>alert('Update Failed. Try Again!');</scrusernamet>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>
<body>
    <h3 class="text-success mb-4">Edit Account</h3>
    <form action="" method="post" enctype="multusernameart/form-data">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" value="<?php echo $username; ?>" name="username">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" name="user_email" value="<?php echo $user_email; ?>">
        </div>
        <div class="form-outline mb-4 d-flex w-50 m-auto">
            <input type="file" class="form-control m-auto" name="user_image">
            <img src="./user_images/<?php echo isset($user_image) ? $user_image : 'default.png'; ?>" alt="User Image" class="edit_image">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_address" value="<?php echo $user_address; ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $user_mobile; ?>">
        </div>
        <input type="submit" value="Update" class="bg-info py-2 px-3 border-0" name="user_update">
    </form>
</body>
</html>
