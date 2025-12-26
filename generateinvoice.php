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

    // Include FPDF library
    require('fpdf186/fpdf.php');

    // Create a new instance of FPDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set font for the document
    $pdf->SetFont('Arial', 'B', 16);

    // Add logo and company name to the PDF
    $pdf->Image('./images/icon.png',10,5,20); // Adjust the path and dimensions of the logo as needed
    $pdf->Cell(30);
    $pdf->SetFont('Arial', 'B', 21); // Move to the right to leave space between the logo and the company name
    $pdf->Cell(0, 10, 'QuickShop', 0, 1); // Adjust the company name as needed

    $pdf->Ln(10);

    // Add title to the PDF
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');

    $pdf->Ln(10);

    // Set font for the content
    $pdf->SetFont('Arial', '', 14);

    // Add order details to the PDF
    $pdf->Cell(0, 10, 'Customer Name: ' . $name, 0, 1);
    $pdf->Cell(0, 10, 'Customer Number: ' . $number, 0, 1);
    $pdf->Cell(0, 10, 'Customer Email: ' . $email, 0, 1);
    $pdf->Cell(0, 10, 'Address: ' . $flat . ', ' . $street . ', ' . $city . ', ' . $state . ', ' . $country . ' - ' . $pin_code, 0, 1);
    $pdf->Cell(0, 10, 'Total Products: ' . $total_product, 0, 1);
    $pdf->Cell(0, 10, 'Total Price: ;' . $price_total, 0, 1);
    $pdf->Cell(0, 10, 'Payment Method: ' . $method, 0, 1);

    // Output the PDF
    $pdf->Output();
} else {
    echo "Order data not found!";
}
?>
