<?php
require('fpdf186/fpdf.php');

// Check if all required parameters are set
if(isset($_POST['name'], $_POST['number'], $_POST['email'], $_POST['method'], $_POST['flat'], $_POST['street'], $_POST['city'], $_POST['state'], $_POST['country'], $_POST['pin_code'])) {
    // Assign values from POST data
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $flat = $_POST['flat'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $pin_code = $_POST['pin_code'];
    $product=$_POST["product"];
    $price=$_POST["price"];
    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    $pdf->Image('./images/icon.png',10,5,20); // Adjust the path and dimensions of the logo as needed
    $pdf->Cell(30);
    $pdf->SetFont('Arial', 'B', 21); // Move to the right to leave space between the logo and the company name
    $pdf->Cell(0, 10, 'QuickShop', 0, 1); // Adjust the company name as needed

    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');

    $pdf->Ln(10);
    
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0,10,"Total product: ".$product,0,1);
    $pdf->Cell(0,10,"Total price: ".$price,0,1);
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
