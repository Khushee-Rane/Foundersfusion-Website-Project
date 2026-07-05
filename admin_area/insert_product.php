<?php
include('../includes/connect.php');
if(isset($_POST['insert_product'])){
    $product_title = mysqli_real_escape_string($con, $_POST['product_title']);
    $product_descrusernametion = mysqli_real_escape_string($con, $_POST['product_descrusernametion']);
    $product_keywords = mysqli_real_escape_string($con, $_POST['product_keywords']);
    $product_category = mysqli_real_escape_string($con, $_POST['product_category']);
    $product_brands = mysqli_real_escape_string($con, $_POST['product_brands']);
    $product_price = mysqli_real_escape_string($con, $_POST['product_price']);
    $product_status = mysqli_real_escape_string($con, 'true');

    // accessing images
    $product_image1 = mysqli_real_escape_string($con, $_FILES['product_image1']['name']);
    $product_image2 = mysqli_real_escape_string($con, $_FILES['product_image2']['name']);
    $product_image3 = mysqli_real_escape_string($con, $_FILES['product_image3']['name']);

    
    //accessing image temporary name
    $temp_image1=$_FILES['product_image1']['tmp_name'];
    $temp_image2=$_FILES['product_image2']['tmp_name'];
    $temp_image3=$_FILES['product_image3']['tmp_name'];

    // checking empty condition
    if($product_title=='' || $product_descrusernametion=='' || $product_keywords=='' ||
    $product_category=='' || $product_brands=='' || $product_price==''
     or $product_image1=='' || $product_image2=='' || $product_image3=='' ){
        echo "<scrusernamet>alert('Please fill all the available fields')</scrusernamet>";
        exit();
     }
     $check_query = "SELECT * FROM products WHERE product_title='$product_title'";
     $check_result = mysqli_query($con, $check_query);
     if (mysqli_num_rows($check_result) > 0) {
         echo "<scrusernamet>alert('Product with the same title already exists.')</scrusernamet>";
         exit();
     } else {
         // Move uploaded files
         move_uploaded_file($temp_image1, "./product_images/$product_image1");
         move_uploaded_file($temp_image2, "./product_images/$product_image2");
         move_uploaded_file($temp_image3, "./product_images/$product_image3");
        //insert query
        $insert_products="insert into products
        (product_title,product_descrusernametion,product_keywords,category_id,
        brand_id,product_image1,product_image2,product_image3,product_price,
        `date`,`status`) values('$product_title','$product_descrusernametion','$product_keywords',
        '$product_category','$product_brands','$product_image1',
        '$product_image2','$product_image3','$product_price',NOW(),'$product_status' )";
        $result_query=mysqli_query($con,$insert_products);
        if($result_query){
            echo "<scrusernamet>alert('Successfully Inserted the products')</scrusernamet>"; 
        }
     }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products-Admin Dashboard</title>

    <!-- bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
     integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
     <!-- font awesome link -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
      
     <!-- css file -->
      <link rel="stylesheet" href="../style.css"> 
     
</head>
<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- form -->
         <form action="" method="post" enctype="multusernameart/form-data">

            <!-- title -->
            <div class="form-outline w-50 m-auto">
                <label form="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title"
                 class="form-control mb-4" placeholder="Enter Product Title" 
                 autocomplete="off" required="required">
            </div>

            <!-- descrusernametion -->
            <div class="form-outline  w-50 m-auto">
                <label form="product_descrusernametion" class="form-label">Product Descrusernametion </label>
                <input type="text" name="product_descrusernametion" id="product_descrusernametion"
                 class="form-control mb-4" placeholder="Enter Product Descrusernametion " 
                 autocomplete="off" required="required">
            </div>

            <!-- keywords -->
            <div class="form-outline  w-50 m-auto">
                <label form="product_keywords" class="form-label">Product keywords </label>
                <input type="text" name="product_keywords" id="product_keywords"
                 class="form-control mb-4" placeholder="Enter Product keywords " 
                 autocomplete="off" required="required">
            </div>

            <!-- categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select mb-4" >
                    <option value="">Select a Category</option>
                    <?php
                    $select_query="Select * from categories";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc( $result_query)){
                        $category_title=$row['category_title'];
                        $category_id=$row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }


                    ?>
                   

                </select>
                
            </div> 

            <!-- brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brands" id="" class="form-select mb-4">
                    <option value="">Select a Brand</option>
                    <?php
                    $select_query="Select * from brands";
                    $result_query=mysqli_query($con,$select_query);
                    while($row=mysqli_fetch_assoc($result_query)){
                        $brand_title=$row['brand_title'];
                        $brand_id=$row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }


                    ?>
                   
                    

                </select>
                
            </div>
            
            <!-- Image 1 -->
            <div class="form-outline  w-50 m-auto">
                <label form="product_image1" class="form-label">Product Image 1 </label>
                <input type="file" name="product_image1" id="product_image1"
                 class="form-control mb-4" required="required">
                
                  
            </div>

            <!-- Image 2-->
            <div class="form-outline  w-50 m-auto">
                <label form="product_image2" class="form-label">Product Image 2</label>
                <input type="file" name="product_image2" id="product_image2"
                 class="form-control mb-4" required="required">
                
                  
            </div>

            <!-- Image 3-->
            <div class="form-outline  w-50 m-auto">
                <label form="product_image3" class="form-label">Product Image 3</label>
                <input type="file" name="product_image3" id="product_image3"
                 class="form-control mb-4" required="required">
                
                  
            </div>

            <!-- price -->
            <div class="form-outline  w-50 m-auto">
                <label form="product_price" class="form-label">Product Price </label>
                <input type="text" name="product_price" id="product_price"
                 class="form-control mb-4" placeholder="Enter Product Price " 
                 autocomplete="off" required="required">
            </div>
            
            <!-- insert button -->
            <div class="form-outline mb-4 w-50 m-auto">
               <input type="submit" name="insert_product"
                class="btn btn-info mb-3 px-3" value="Insert Products"> 
            </div>


         </form>
    </div>

</body>
</html>