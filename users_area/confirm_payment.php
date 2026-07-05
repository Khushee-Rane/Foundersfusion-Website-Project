<?php
session_start();
include('../includes/connect.php');

$order_id = "";
$invoice_number = "";
$amount_due = "";

// Check if order_id is provided in URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $select_data = "SELECT * FROM user_orders WHERE order_id = $order_id";
    $result = mysqli_query($con, $select_data);

    if ($result && mysqli_num_rows($result) > 0) {
        $row_fetch = mysqli_fetch_assoc($result);
        $invoice_number = $row_fetch['invoice_number'];
        $amount_due = $row_fetch['amount_due'];
    } else {
        echo "<h3 class='text-center text-danger'>Invalid Order ID</h3>";
        exit(); // Stop execution if order_id is invalid
    }
}

// Process form submission
if (isset($_POST['confirm_payment'])) {
    $invoice_number = mysqli_real_escape_string($con, $_POST['invoice_number']);
    $amount = mysqli_real_escape_string($con, $_POST['amount']);
    $payment_mode = mysqli_real_escape_string($con, $_POST['payment_mode']);

    // Ensure all fields are filled
    if (!empty($order_id) && !empty($invoice_number) && !empty($amount) && !empty($payment_mode) && $payment_mode != "Select Payment") {
        $insert_query = "INSERT INTO user_payments (order_id, invoice_number, amount, payment_mode)
                        VALUES ('$order_id', '$invoice_number', '$amount', '$payment_mode')";
        $result = mysqli_query($con, $insert_query);

        if ($result) {
            echo "<h3 class='text-center text-light'>Successfully completed the payment</h3>";
            echo "<scrusernamet>window.open('profile.php?my_orders','_self')</scrusernamet>";
        } else {
            echo "<h3 class='text-center text-danger'>Payment processing failed</h3>";
        }
    } else {
        echo "<h3 class='text-center text-warning'>Please fill in all fields correctly</h3>";
        
    }
    $update_orders="update user_orders set order_status='Complete' where order_id=$order_id";
    $result_orders=mysqli_query($con,$update_orders);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" 
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    
    <!-- CSS file -->
    <link rel="stylesheet" href="style.css">  

    <style>
        .form-outline {
            margin-bottom: 30px; /* Adjust spacing as needed */
        }
    </style>
</head>
<body class="bg-secondary">
    <div class="container my-5">
        <h1 class="text-center text-light">Confirm Payment</h1>
        <form action="" method="post">
            <div class="row justify-content-center mb-3">
                <div class="col-md-6 text-center">
                    <input type="text" class="form-control" name="invoice_number"
                    value="<?php echo htmlspecialchars($invoice_number); ?>" readonly>
                </div>
            </div>

            <div class="row justify-content-center mb-3">
                <div class="col-md-6 text-center">
                    <label for="amount" class="text-light">Amount</label>
                    <input type="text" class="form-control" name="amount"
                    value="<?php echo htmlspecialchars($amount_due); ?>" readonly>
                </div>
            </div>

            <div class="row justify-content-center mb-3">
                <div class="col-md-6 text-center">
                    <select name="payment_mode" class="form-select w-50 m-auto" style="height: 40px; font-size: 20px; padding: 5px;">
                        <option>Select Payment</option>
                        <option>UPI</option>
                        <option>Netbanking</option>
                        <option>Paypal</option>
                        <option>Cash on Delivery</option>
                        <option>Pay Offline</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-md-6 text-center">
                    <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm"
                    name="confirm_payment">
                </div>
            </div>
        </form>
    </div>
</body>
</html>
