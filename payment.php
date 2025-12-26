<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Pay Here</title>
	<link rel="stylesheet" type="text/css" href="./css/payment.css">
</head>
<body>
<header>
	<div class="container">
		<div class="right">
			<h3>PAYMENT</h3>
			<form id="myForm" action="paymentsuccess.php" method="post">
				Accepted Card <br>
				<img src="./images/visa.png" width="65">
				<img src="./images/master.png" width="45">
                <img src="./images/credit.jpg" width="60">
				<br><br>

				Credit card number
                <input type="text" id="card_number" name="card_number" placeholder="Enter card number" maxlength="19" required>

            <script>
                function formatCardNumber(input) {
                    // Remove any non-numeric characters
                    let cardNumber = input.value.replace(/\D/g, '');
                    
                    // Insert hyphens after every 4 digits
                    cardNumber = cardNumber.replace(/(\d{4})(?=\d)/g, '$1-');

                    // Update the input value
                    input.value = cardNumber;
                }

                // Add event listener to format the card number as the user types
                document.getElementById('card_number').addEventListener('input', function() {
                    formatCardNumber(this);
                });
                </script>

				Exp month
                <input type="text" id="exp_month" name="exp_month" placeholder="Enter Month" maxlength="2" required>
                <script>
                    document.getElementById('exp_month').addEventListener('input', function() {
                        // Remove non-numeric characters
                        this.value = this.value.replace(/\D/g, '');
                        
                        // Ensure the value is within the range 01-12
                        const month = parseInt(this.value, 10);
                        if (month < 1 || month > 12) {
                            this.setCustomValidity('Invalid month. Please enter a number between 01 and 12.');
                        } else {
                            this.setCustomValidity('');
                        }
                    });
                    </script>

				<div id="zip">
					<label>
						Exp year
						<select>
							<option>Choose Year..</option>
							<option>2022</option>
							<option>2023</option>
							<option>2024</option>
							<option>2025</option>
                            <option>2026</option>
                            <option>2027</option>
                            <option>2028</option>
                            <option>2029</option>
                            <option>2030</option>
                            <option>2031</option>
						</select>
					</label>
						<label>
						CVV
                        <input type="number" id="cvv" name="cvv" placeholder="CVV" required>
                        <script>
                            document.getElementById('cvv').addEventListener('input', function() {
                                const maxLength = 3; // Maximum length of the CVV
                                if (this.value.length > maxLength) {
                                    this.value = this.value.slice(0, maxLength); // Truncate input to maximum length
                                }
                            });
                            </script>

					</label>
				</div>
                <input type="submit" href="paymentsuccess.php" value="Complete order">
			</form>
		</div>
	</div>
</header>
</body>
</html>