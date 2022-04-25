<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="images/fevicon.png" type="image/gif" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Officewears</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet"> <!-- range slider -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href= "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>
<style>
  .container{padding:20px;}
</style>
<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="header_top">
        <div class="container-fluid">
          <div class="top_nav_container">
            <div class="contact_nav">
              
            </div>
            
            
            <div class="user_option_box">
            
            <a href="logout.php" class="account-link">
                <!--<i class="fa fa-user" aria-hidden="true"></i>-->
                
                <span>
                  

                </span>
              </a>
            </div>
          </div>

        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.php">
              <span>
                Officewears
              </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ">
                <li class="nav-item ">
                  <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.php"> About</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="product.php">Products</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="why.php">Why Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="testimonial.php">Testimonial</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="logout.php">Sign Out</a>
                </li>
                
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
  </div>


  <!-- product section -->
  <main>
    <!-- Start DEMO HTML (Use the following code into your project)-->
<nav class="navbar navbar-inverse bg-inverse fixed-top bg-faded">
   <div class="row">
       <div class="col">
         <button type="button" class="btn btn-light txt-dark p-2" data-toggle="modal" data-target="#cart">Cart (<span class="total-count"></span>)</button><button class="clear-cart btn btn-light txt-dark p-2">Clear Cart</button></div>
   </div>
</nav>


<!-- Main -->
<div class="container">
   <div class="row">
     <div class="col col-md-6">
       <div class="card">
          <img class="card-img-top" src="./images/male.jpeg" alt="Card image cap">
          <div class="card-body">
              <h4 class="card-title">1. Suit </h4>
              <p class="card-text">Price: $200</p>
              <a href="#" data-name="Suit-Male" data-price="200" class="add-to-cart btn btn-primary">Add to cart</a>
          </div>
        </div>
     </div>
     <div class="col col-md-6">
       <div class="card">
 <img class="card-img-top" src="./images/female.png" alt="Card image cap">
 <div class="card-body">
   <h4 class="card-title">2. Suit </h4>
   <p class="card-text">Price: $200</p>
   <a href="#" data-name="Suit-Female" data-price="150" class="add-to-cart btn btn-primary">Add to cart</a>
 </div>
</div>
     </div>
     </div>
   </div>
</div>

 
<!-- Modal -->
<div class="modal fade" id="cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog modal-lg" role="document">
   <div class="modal-content">
     <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">Cart</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">
       <table class="show-cart table">
         
       </table>
       <div>Total price: $<span class="total-cart"></span></div>
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      
       <button type="button" class="order-now btn btn-primary">Order now</button>
     </div>
   </div>
 </div>
</div>
    <!-- END EDMO HTML (Happy Coding!)-->
</main>

  <!-- end product section -->


  <!-- info section -->
  <section class="info_section ">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="info_contact">
            <h5>
              <a href="" class="navbar-brand">
                <span>
                  Officewears
                </span>
              </a>
            </h5>
            <p>
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              RMIT
            </p>
            
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_info">
            <h5>
              Information
            </h5>
            <p>
            Officewears is an e-commerce web application which can be used by anyone who wants to start an e-commerce business online. He/She can clone this repo, add their products in the database and products page and start selling.
            </p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_links">
            <h5>
              Useful Link
            </h5>
            <ul>
              <li>
                <a href="index.php">
                  Home
                </a>
              </li>
              <li>
                <a href="about.php">
                  About
                </a>
              </li>
              <li>
                <a href="product.php">
                  Products
                </a>
              </li>
              <li>
                <a href="why.php">
                  Why Us
                </a>
              </li>
              <li>
                <a href="testimonial.php">
                  Testimonial
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_form ">
            <h5>
              Github Link
            </h5>
            
            <div class="social_box">
              <a href="">
                <i class="fa fa-github" aria-hidden="true"></i>
              </a>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info_section -->


  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
        &copy; <span id="displayYear"></span> Coded with love by team RMIT
      </p>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js'></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script  src="./js/script.js"></script>

</body>

</html>