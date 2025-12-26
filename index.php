<?php
session_start();
@include 'config.php';

$user_email = isset($_SESSION['email']) ? mysqli_real_escape_string($conn, $_SESSION['email']) : null;
$message = [];

if(isset($_GET['add_to_cart'])) {
    // If user is not logged in, redirect to login
    if(!$user_email){
        header("Location: ./Login/login.php");
        exit();
    }

    $product_name = mysqli_real_escape_string($conn, $_GET['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_GET['product_price']);
    $product_image = mysqli_real_escape_string($conn, $_GET['product_image']);
    $product_quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$product_name' AND user_email='$user_email'");

    if(mysqli_num_rows($select_cart) > 0){
        $message[] = 'Product already added to cart';
    } else {
        mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity, user_email) 
                             VALUES('$product_name','$product_price','$product_image','$product_quantity','$user_email')");
        $message[] = 'Product added to cart successfully';
    }
}

// Cart count
$row_count = 0; // default
if(isset($_SESSION['email'])){
    $user_email = mysqli_real_escape_string($conn, $_SESSION['email']);
    $select_rows = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_email='$user_email'");
    $row_count = mysqli_num_rows($select_rows);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quickshop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.tailwindcss.com"></script>
    <!-- fontawesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <!-- custom css -->
    <link rel = "stylesheet" href = "css/main.css">
    <style>
        #dropdownMenu2{
            color:black;
        }
    </style>

</head>
<body>
<div id="productDetailsPrompt" class="product-details-prompt"></div>
    
    <!-- navbar -->
    <nav class = "navbar navbar-expand-lg navbar-light bg-white py-4 fixed-top">
        <div class = "container pl-16">
            <a class = "navbar-brand d-flex justify-content-between align-items-center order-lg-0" href = "index.php">
                <img src = "images/icon.png" alt = "site icon">
                <span class = "text-uppercase fw-lighter ms-2">Quickshop</span>
            </a>

            <div class = "order-lg-2 nav-btns pr-16">
                <button type = "button" class = "btn position-relative">
                    <a href="cart.php" style="color: black;"><i class = "fa fa-shopping-cart"></i></a>
                   <span class = "position-absolute top-0 start-100 translate-middle badge bg-primary"><?php echo $row_count; ?></span>
                </button>
            </div>

            <button class = "navbar-toggler border-0" type = "button" data-bs-toggle = "collapse" data-bs-target = "#navMenu">
                <span class = "navbar-toggler-icon"></span>
            </button>

         
                <ul class = "navbar-nav mx-auto text-center">
                    <li class = "nav-item px-2 py-2">
                        <a class = "nav-link text-uppercase text-dark" href = "">home</a>
                    </li>
                    <li class = "nav-item px-2 py-2">
                        <a class = "nav-link text-uppercase text-dark" href = "#collection">Electronics</a>
                    </li>
                    <li class = "nav-item px-2 py-2">
                        <a class = "nav-link text-uppercase text-dark" href = "#offers">Discounts</a>
                    </li>
                    <li class = "nav-item px-2 py-2">
                        <a class = "nav-link text-uppercase text-dark" href = "./Login/login.php">Login</a>
                    </li>
                    <li class = "nav-item px-2 py-2">
                        <a class = "nav-link text-uppercase text-dark" href = "#about">about us</a>
                    </li>
                    <?php if (isset($_SESSION['email'])): ?>
                    <li class = "nav-item px-2 py-2">
                        <div class="dropdown">
                                <button class="btn-secondary dropdown-toggle pt-[6px] pl-[28px] text-center" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false" style="background-color:white;border:none;color:black;">
                                    <?= strtok(htmlspecialchars($_SESSION['email']), '@'); ?>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <li><a class="dropdown-item" href="./Login/logout.php">Logout</a></li>
                                </ul>
                        </div>
                    </li>
                    <?php endif; ?>
                    <li class = "nav-item px-2 py-2">

                    <?php if(isset($_GET['name'])) { ?>
                       
                        <div style="display:flex; flex-direction: row; justify-content: center; align-items: center; width: 150px;height: 10px;margin-top: 13px; padding-left: 110px; ">
                   
                   <p style="width: 5px !important;"></p>
                    <h5 style="color: white;font-size: 16px;"></h5>
                      
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                style="background-color:white;border: none ;">
                <?php echo $_GET['name']; ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <button class="dropdown-item" onclick="logout()" type="button">Logout</button>
                  <!-- Inside the <head> section of your HTML -->
                  <script>
                        function logout() {
                            // AJAX request to clear the cart
                            var xhr = new XMLHttpRequest();
                            xhr.open("GET", "clear_cart.php", true);
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    // Redirect to the index page after clearing the cart
                                    window.location.href = 'index.php';
                                }
                            };
                            xhr.send();
                        }
                    </script>


                </div>
                </div>
                      </div>
                    <?php } ?>

                   
                    </li>
                </ul>
            
        </div>
    </nav>
    <!-- end of navbar -->

    <!-- header -->
    <header id = "header" class = "vh-100 carousel slide" data-bs-ride = "carousel" style = "padding-top: 104px;">
        <div class = "container h-100 d-flex align-items-center carousel-inner">
            <div class = "text-center carousel-item active">
                <h2 class = "text-capitalize text-white">best Product</h2>
                <h1 class = "text-uppercase py-2 fw-bold text-white">new arrivals</h1>
                <a href = "#collection" class = "btn mt-3 text-uppercase">shop now</a>
            </div>
            <div class = "text-center carousel-item">
                <h2 class = "text-capitalize text-white">best price & offer</h2>
                <h1 class = "text-uppercase py-2 fw-bold text-white">new season</h1>
                <a href = "#collection" class = "btn mt-3 text-uppercase">buy now</a>
            </div>
        </div>

        <button class = "carousel-control-prev" type = "button" data-bs-target="#header" data-bs-slide = "prev">
            <span class = "carousel-control-prev-icon"></span>
        </button>
        <button class = "carousel-control-next" type = "button" data-bs-target="#header" data-bs-slide = "next">
            <span class = "carousel-control-next-icon"></span>
        </button>
    </header>
    <!-- end of header -->

</br>
</br>
    <!-- collection -->
    <section id = "collection" class = "py-5">
        <div class = "container">
            <div class = "title text-center">
                <h2 class = "position-relative d-inline-block text-3xl">New Products</h2>
            </div>

            <?php include 'header1.php'; ?>

            <div class="container">

            <section class="products">
</br>
</br>


            <div class="box-container flex flex-wrap items-center justify-center gap-20">

                <?php
                
                $select_products = mysqli_query($conn, "SELECT * FROM `products`");
                
                if(mysqli_num_rows($select_products) > 0){
                    
                    while($fetch_product = mysqli_fetch_assoc($select_products)){
                        $id=$fetch_product["id"];
                ?>

               
                    <div class="productBox" id="myProducts" >
                    
                                
                                <a href="product_detail.php?id=<?=$id?>"><img src="images/<?php echo $fetch_product['image']; ?>" class='w-[400px] h-[220px]'  alt="">
                    </a>
                               
                                <div class = "text-center">
                                    <div class = "rating mt-3">
                                        <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                        <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                        <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                        <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                        <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                    </div>
                                    <h4 class="text-capitalize my-1"><?php echo $fetch_product['name']; ?></h4>
                                    <div class="price mb-2" class = "fw-bold">₹<?php echo $fetch_product['price']; ?>/-</div>
                                    
                                    <form action="./index.php" method="get" onsubmit='return checkLogin();'>
                                        <input type="hidden" name="product_name"  value="<?php echo $fetch_product['name']; ?>">
                                        <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                        <input type="hidden" name="product_image"  value="<?php echo $fetch_product['image']; ?>">
                                        <input type="submit" class="btn" value="Add to cart" name="add_to_cart">
                                    </form>
                                </div>
                                
                            
                    </div>
              

                <?php
                    };
                };
                ?>

            </div>

            </section>
        </div>
    </section>
</div>
    <!-- end of collection -->

    <!-- special products -->
    <section id = "special" class = "py-5">
        <div class = "container">
            <div class = "title text-center py-5">
                <h2 class = "position-relative d-inline-block text-3xl">CPU Cases</h2>
            </div>
            <?php include 'header1.php'; ?>

            <div class="container">

            <section class="products">
</br>
</br>


            <div class="box-container grid grid-cols-3 gap-4 pl-20">

                <?php
                
                $select_products = mysqli_query($conn, "SELECT * FROM `product`");
                
                if(mysqli_num_rows($select_products) > 0){
                    
                    while($fetch_product = mysqli_fetch_assoc($select_products)){
                ?>

               
                    <div class="box">
                    
                                
                                    <img src="images/<?php echo $fetch_product['image']; ?>" class="w-80 md:h-[220px]" alt="">
                                
                               
                                <div class = "text-center pr-36">
                                    <div class = "rating mt-3">
                                        <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                        <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                        <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                        <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                        <span class = "text-primary"><i class = "fas fa-star"></i></span>
                                    </div>
                                <h4 class="text-capitalize my-1"><?php echo $fetch_product['name']; ?></h4>
                                <div class="price" class = "fw-bold">₹<?php echo $fetch_product['price']; ?>/-</div>
                                </div>
                                <form action="./index.php" method="get">
                                    <input type="hidden" name="product_name"  value="<?php echo $fetch_product['name']; ?>">
                                    <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                    <input type="hidden" name="product_image"  value="<?php echo $fetch_product['image']; ?>">
                                    <input type="submit" class="btn ml-20" value="Add to cart" name="add_to_cart">
                    </br>
                                </form>
                                
                            
                    </div>
              

                <?php
                    };
                };
                ?>

            </div>

            </section>
            
        </div>
        <script>
        function productDetails(a){
            
        }
        </script>
    </section>
    <!-- end of special products -->

    <!-- blogs -->
    <section id = "offers" class = "py-5">
        <div class = "container">
            <div class = "row d-flex align-items-center justify-content-center text-center justify-content-lg-start text-lg-start">
                <div class = "offers-content pl-16">
                    <span class = "text-white">Discount Up To 40%</span>
                    <h2 class = "mt-2 mb-4 text-white">Grand Sale Offer!</h2>
                    <a href = "#" class = "btn">Buy Now</a>
                </div>
            </div>
        </div>
    </section>
    <!-- end of blogs -->

   <!--Sign up-->
    <section id = "newsletter" class = "py-5">
        <div class = "container">
            <div class = "d-flex flex-column align-items-center justify-content-center">
                <div class = "title text-center pt-3 pb-5">
                    <h2 class = "position-relative d-inline-block ms-4 text-3xl">Sign up</h2>
                </div>

                <p class = "text-center text-muted">Get E-mail updates about our latest shop and special offers.</p>
                <div class = "input-group mb-3 mt-3">
                    <input type = "text" class = "form-control p-[15px]" placeholder="Enter Your Email ...">
                    <button class = "btn btn-primary" type = "submit">Sign up</button>
                </div>
            </div>
        </div>
    </section>
   <!--end of sign up-->

    <!-- about us -->
    <section id = "about" class = "py-5">
        <div class = "container">
            <div class = "row gy-lg-5 align-items-center">
                <div class = "col-lg-6 order-lg-1 text-center text-lg-start">
                    <div class = "title pt-3 pb-5">
                        <h2 class = "position-relative d-inline-block ms-4 text-3xl">About Us</h2>
                    </div>
                    <p class = "lead text-muted">WHO WE ARE</p>
                    <p>Quickshop is Fastgrowing Ecommerce Website. Our Mission is to help Gamers to get best PC Setup and Equipments for Gaming.</p>
</br>
                    <p>Focused on excellence for our clients, we are well established with a reputation for great service and a high-quality finish.</p>
                </div>
                <div class = "col-lg-6 order-lg-0">
                    <img src = "images/about_us1.jpg" alt = "" class = "img-fluid">
                </div>
            </div>
        </div>
    </section>
    <!-- end of about us -->


    <!-- footer -->
    <footer class="bg-gray-900 py-10 text-white">
  <div class="container mx-auto px-6">
    <div class="flex flex-wrap justify-center justify-between">

      <!-- Brand & Description -->
      <div class="w-full sm:w-80">
        <a href="index.php" class="text-2xl font-bold uppercase tracking-wider inline-block mb-4">Quickshop</a>
        <p class="text-gray-400">
          Quickshop is an Ecommerce Shopping Website where you can buy gaming equipment and computer products at affordable prices.
        </p>
      </div>

      <!-- Links -->
      <div class="w-full sm:w-auto">
        <h5 class="text-lg font-semibold mb-4">Links</h5>
        <ul class="space-y-3">
          <li>
            <a href="#header" class="text-gray-400 hover:text-white flex items-center">
              <i class="fas fa-chevron-right me-2"></i> Home
            </a>
          </li>
          <li>
            <a href="#collections" class="text-gray-400 hover:text-white flex items-center">
              <i class="fas fa-chevron-right me-2"></i> Electronics
            </a>
          </li>
          <li>
            <a href="#offers" class="text-gray-400 hover:text-white flex items-center">
              <i class="fas fa-chevron-right me-2"></i> Discounts
            </a>
          </li>
          <li>
            <a href="./Login/login.php" class="text-gray-400 hover:text-white flex items-center">
              <i class="fas fa-chevron-right me-2"></i> Login
            </a>
          </li>
          <li>
            <a href="#about" class="text-gray-400 hover:text-white flex items-center">
              <i class="fas fa-chevron-right me-2"></i> About Us
            </a>
          </li>
        </ul>
      </div>

      <!-- Contact Us -->
      <div class="w-full sm:w-auto">
        <h5 class="text-lg font-semibold mb-4">Contact Us</h5>
        <ul class="space-y-3 text-gray-400">
          <li class="flex items-start">
            <i class="fas fa-map-marked-alt mt-1 me-3"></i>
            Khairani Road, Ghatkopar, Mumbai-400 086, India
          </li>
          <li class="flex items-start">
            <i class="fas fa-envelope mt-1 me-3"></i>
            quickshop1710@gmail.com
          </li>
          <li class="flex items-start">
            <i class="fas fa-phone-alt mt-1 me-3"></i>
            +91 9594506957
          </li>
        </ul>
      </div>

      <!-- Social Links -->
      <div class="w-full sm:w-auto lg:mr-5">
        <h5 class="text-lg font-semibold mb-4">Follow Us</h5>
        <div class="flex space-x-4">
          <a href="#" class="text-gray-400 hover:text-white text-2xl">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white text-2xl">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white text-2xl">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="text-gray-400 hover:text-white text-2xl">
            <i class="fab fa-pinterest"></i>
          </a>
        </div>
      </div>

    </div>
  </div>
</footer>

<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4" style="overflow: hidden; font-family: 'Segoe UI', sans-serif;">
      
      <div class="modal-header bg-white border-bottom">
        <h5 class="modal-title fw-bold" id="loginModalLabel">Login Required</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
    <div class="modal-body text-center py-4 px-4">
        <div class="mx-auto mb-3" style="width: 70px; height: 70px; background-color: #f1f1f1; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
            <i class="fas fa-user-lock fa-2x text-secondary"></i>
        </div>
        
        <h5 class="fw-bold mb-2" style="color: #333;">Login Required</h5>
        <p class="fs-6 text-muted mb-4">You need to log in to add items to your cart and continue shopping securely.</p>
    </div>
    <div class="modal-footer border-0 justify-content-center py-3">
        <button type="button" class="btn btn-dark btn-lg px-5 rounded-pill" 
                onclick="window.location.href='./Login/login.php'" 
                style="box-shadow: 0 6px 15px rgba(0,0,0,0.1); transition: transform 0.2s, box-shadow 0.2s;">
            Login
        </button>
        <button type="button" class="btn btn-outline-secondary btn-lg px-5 rounded-pill" data-bs-dismiss="modal"
                style="transition: transform 0.2s, box-shadow 0.2s;">Cancel</button>
    </div>
    </div>
  </div>
</div>






    <!-- end of footer -->




    <!-- jquery -->
    <script src = "js/jquery-3.6.0.js"></script>
    <!-- isotope js -->
    <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script>
    <!-- bootstrap js -->
    <script src = "bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <!-- custom js -->
    <script src = "js/script.js"></script>
    <script src="script.js"></script>
<script>
function checkLogin() {
    <?php if(!isset($_SESSION['email'])): ?>
        var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
        loginModal.show();
        return false; // stop form submission
    <?php endif; ?>
    return true; // proceed if logged in
}
</script>






</body>
</html>