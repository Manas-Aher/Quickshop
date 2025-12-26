
<?php
// Include FPDF library
require('./fpdf186/fpdf.php');

// Include database connection
@include 'config.php';

// Fetch order ID from the URL
if(isset($_GET['order_id'])) {
    // Sanitize the input to prevent SQL injection
    $orderid = mysqli_real_escape_string($conn, $_GET['order_id']);
    
    // Fetch order details from the database using the order ID
    $order_query = mysqli_query($conn, "SELECT * FROM `order` WHERE order_id = '$orderid'");
    if($order_query) {
        if(mysqli_num_rows($order_query) > 0) {
            // Fetch order data
            $order_data = mysqli_fetch_assoc($order_query);
            $name = $order_data['name'];
            $email = $order_data['email'];
            $number = $order_data['number'];
            $flat = $order_data['flat'];
            $street = $order_data['street'];
            $city = $order_data['city'];
            $state = $order_data['state'];
            $country = $order_data['country'];
            $pin_code = $order_data['pin_code'];
            $total_products = $order_data['total_products'];
            $total_price = $order_data['total_price'];
            $method = $order_data['method'];
        } else {
            // Handle case when order is not found
            echo 'Order not found!';
        }
    } else {
        // Handle query failure
        echo 'Query failed: ' . mysqli_error($conn);
    }
} else {
    // Handle case when order ID is not provided in URL
    echo 'Order ID not provided!';
}
// Generate PDF invoice
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'Invoice',0,1,'C');
// Add order details to the PDF
$pdf->Cell(0,10,'Name: ' . $name,0,1);
$pdf->Cell(0,10,'Email: ' . $email,0,1);
$address = implode(', ', [$flat, $street, $city, $state,$country]);
$pdf->Cell(0, 10, 'Address: ' . $address, 0, 1);
$pdf->Cell(0,10,'Pincode: ' . $pin_code,0,1);
$pdf->Cell(0,10,'Total Products: ' . $total_products,0,1);
$pdf->Cell(0,10,'Total Price: ' . $total_price,0,1);
$pdf->Cell(0,10,'Payment Method: ' . $method,0,1);
// Add more order details as needed

// Save the PDF file
$pdf->Output('D', 'invoice.pdf'); // 'D' for force download
exit; 

?>
