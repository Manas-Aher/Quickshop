<?php
@include 'config.php';

$message = '';

if(isset($_GET['add_to_cart'])){

   $product_name = $_GET['product_name'];
   $product_price = $_GET['product_price'];
   $product_image = $_GET['product_image'];
   $product_quantity = $_GET['product_quantity'];

   $check_cart = mysqli_query($conn, "SELECT * FROM cart WHERE name='$product_name'");

   if(mysqli_num_rows($check_cart) > 0){
      $message = "Product already in cart";
   }else{
      mysqli_query($conn,
      "INSERT INTO cart(name, price, image, quantity)
       VALUES('$product_name','$product_price','$product_image','$product_quantity')");
      $message = "Product added to cart";
   }
}
?>


<?php
@include 'config.php';

if(isset($_GET['id'])){

   $product_id = $_GET['id'];
  

   $product = mysqli_query($conn, "SELECT * FROM `products` WHERE id=$product_id");
 
 $select_product=mysqli_fetch_row($product);
 

}


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tutorial</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <!-- CSS -->
    <link href="style.css" rel="stylesheet">
    <meta name="robots" content="noindex,follow" />

  </head>

  <body>
  <?php include 'header1.php'; ?>
    <main class="container">

      <!-- Left Column / Headphones Image -->
      <div class="left-column">
        <img src="images/<?php echo $select_product[3]; ?>" alt="image">
        
      </div>


      <!-- Right Column -->
      <div class="right-column">

        <!-- Product Description -->
        <div class="product-description">
          <span >Product</span>
          <h1><?php echo $select_product[1]; ?></h1>
          <p><?php echo $select_product[4]; ?></p>
        </div>

        <!-- Product Configuration -->
        <div class="product-configuration">
          <!-- Secure Payment Info -->
          <div class="payment-info">
            🔐 Secure payments <br>
            💳 UPI | Card | Net Banking
          </div>

        <!-- Delivery Info -->
        <div class="delivery-info">
          🚚 Free delivery in 3–5 days <br>
          🔄 7 days return policy <br>
          🔒 1 year warranty
        </div>  
        <!-- Discount & Stock -->
        <div class="product-meta">
          <span class="badge">20% OFF</span>
          <span class="stock">In Stock</span>
        </div>
          <!-- Product Pricing -->
          <div class="product-price">
            <span>₹<?php echo $select_product[2]; ?></span>
            <form action="index.php" method="get">
              <input type="hidden" name="product_name" value="<?php echo $select_product[1]; ?>">
              <input type="hidden" name="product_price" value="<?php echo $select_product[2]; ?>">
              <input type="hidden" name="product_image" value="<?php echo $select_product[3]; ?>">
              <input type="submit" class="cart-btn" value="Add to Cart" name="add_to_cart">
            </form>
          </div>
      </div>
    </main>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <script src="script.js" charset="utf-8"></script>
  </body>
</html>

<?php
if($message != ''){
  echo "<div class='msg'>$message</div>";
}
?>

