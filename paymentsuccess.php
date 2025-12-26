<?php
session_start();

// Check if order data is available in the session
if(isset($_SESSION['order_data'])) {
    // Retrieve order data from the session
    $name = $_SESSION['order_data']['name'];
    $number = $_SESSION['order_data']['number'];
    $email = $_SESSION['order_data']['email'];
    $method = $_SESSION['order_data']['method'];
    $flat = $_SESSION['order_data']['flat'];
    $street = $_SESSION['order_data']['street'];
    $city = $_SESSION['order_data']['city'];
    $state = $_SESSION['order_data']['state'];
    $country = $_SESSION['order_data']['country'];
    $pin_code = $_SESSION['order_data']['pin_code'];
    $total_product = $_SESSION['order_data']['total_product'];
    $price_total = $_SESSION['order_data']['price_total'];

    // Now you can use these variables to display the order details or generate the PDF
} else {
    echo "Order data not found!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Completed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
        }

        .circle {
            position: relative;
            display: inline-block;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            border: 10px solid #4CAF50; /* Green border */
            margin-bottom: 20px;
        }

        .big-check {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 230px;
            color: #4CAF50; /* Green color */
        }

        .message {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .small-message {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .button {
            padding: 10px 20px;
            font-size: 24px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="circle">
            <div class="big-check">&#10003;</div>
        </div>
        <div class="message">Transaction Completed Successfully</div>
        <div class="small-message">Thank you for your payment</div>
        <button id='download_invoice3' class="button">Download Invoice</button>
        <button onclick="redirectToIndex()" class="button">Continue Shopping</button>
    </div>

    <script>
document.getElementById('download_invoice3').addEventListener('click', function() {
    // Create a new FormData object
    var formData = new FormData();
    
    // Add order data to formData
    formData.append('name', "<?php echo $name; ?>");
    formData.append('number', "<?php echo $number; ?>");
    formData.append('email', "<?php echo $email; ?>");
    formData.append('method', "<?php echo $method; ?>");
    formData.append('flat', "<?php echo $flat; ?>");
    formData.append('street', "<?php echo $street; ?>");
    formData.append('city', "<?php echo $city; ?>");
    formData.append('state', "<?php echo $state; ?>");
    formData.append('country', "<?php echo $country; ?>");
    formData.append('pin_code', "<?php echo $pin_code; ?>");
    
    // Create an XMLHttpRequest object
    var xhr = new XMLHttpRequest();
    xhr.open('POST', './generateinvoice.php', true);
    xhr.responseType = 'blob'; // Set response type to blob for downloading files
    
    // Define onload event handler
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Create a blob URL from the response
            var blob = new Blob([xhr.response], { type: 'application/pdf' });
            var url = window.URL.createObjectURL(blob);

            // Create a link element and trigger the download
            var a = document.createElement('a');
            a.href = url;
            a.download = 'invoicedownloads.pdf';
            document.body.appendChild(a);
            a.click();

            // Clean up
            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);
        } else {
            // Handle error
            console.error('Failed to download invoice');
        }
    };
    
    // Send formData as the request body
    xhr.send(formData);
});
</script>

<script>
    function redirectToIndex() {
        window.location.href = 'index.php';
    }
</script>

</body>
</html>
