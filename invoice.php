<?php
require('fpdf186/fpdf.php');

// Check if all required parameters are set
if(isset($_GET['order_id'], $_GET['name'], $_GET['number'], $_GET['email'], $_GET['method'], $_GET['flat'], $_GET['street'], $_GET['city'], $_GET['state'], $_GET['country'], $_GET['pin_code'])) {
    // Assign values from URL parameters
    $orderid = $_GET['order_id'];
    $name = $_GET['name'];
    $number = $_GET['number'];
    $email = $_GET['email'];
    $method = $_GET['method'];
    $flat = $_GET['flat'];
    $street = $_GET['street'];
    $city = $_GET['city'];
    $state = $_GET['state'];
    $country = $_GET['country'];
    $pin_code = $_GET['pin_code'];

    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Order ID: ' . $orderid, 0, 1);
    $pdf->Cell(0, 10, 'Customer Name: ' . $name, 0, 1);
    $pdf->Cell(0, 10, 'Customer Number: ' . $number, 0, 1);
    $pdf->Cell(0, 10, 'Customer Email: ' . $email, 0, 1);
    $pdf->Cell(0, 10, 'Address: ' . $flat . ', ' . $street . ', ' . $city . ', ' . $state . ', ' . $country . ' - ' . $pin_code, 0, 1);
    $pdf->Cell(0, 10, 'Payment Method: ' . $method, 0, 1);
    // Output PDF
    $pdf->Output();
} else {
    echo "Required parameters are missing!";
}
?>
