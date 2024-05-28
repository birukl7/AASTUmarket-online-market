<?php
session_start();
require 'db.php';

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<html lang="en">
  <head>
    <meta charset="UTF-8"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<meta name="author" content="Group 4"> 
	<meta name="description "
	content="A better place for you to shop online"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">

	<title>AASTU ONLINE MARKET</title> 
        <link rel="stylesheet" type="text/css" href="../../Resources/css/style.css">
        <link rel="stylesheet" type="text/css" href="../../Resources/css/output.css">
        <script src="https://kit.fontawesome.com/ee4b6626a1.js" crossorigin="anonymous" defer></script>
	<style>
            
            /* cart */
            .cartTab {
              width: 400px;
              background-color: #353432;
              color: #eee;
              position: fixed;
              top: 0;
              right: -400px;
              bottom: 0;
              display: grid;
              grid-template-rows: 70px 1fr 70px;
              transition: 0.5s;
            }
            body.showCart .cartTab {
              right: 0;
            }
            body.showCart .container {
              transform: translateX(-250px);
            }
            .cartTab h1 {
              padding: 20px;
              margin: 0;
              font-weight: 300;
            }
            .cartTab .btn {
              display: grid;
              grid-template-columns: repeat(2, 1fr);
            }
            .cartTab button {
              background-color: #e8bc0e;
              border: none;
              font-family: Poppins;
              font-weight: 500;
              cursor: pointer;
            }
            .cartTab .close {
              background-color: #eee;
            }
            .listCart .item img {
              width: 100%;
            }
            .listCart .item {
              display: grid;
              grid-template-columns: 70px 150px 50px 1fr;
              gap: 10px;
              text-align: center;
              align-items: center;
            }
            .listCart .quantity span {
              display: inline-block;
              width: 25px;
              height: 25px;
              background-color: #eee;
              border-radius: 50%;
              color: #555;
              cursor: pointer;
            }
            .listCart .quantity span:nth-child(2) {
              background-color: transparent;
              color: #eee;
              cursor: auto;
            }
            .listCart .item:nth-child(even) {
              background-color: #eee1;
            }
            .listCart {
              overflow: auto;
            }
            .listCart::-webkit-scrollbar {
              width: 0;
            }

            /*layot check out*/

            .layOut {
              background-color: rgba(255, 0, 0, 0.295);
              width: 100%;
              top: 0;
              backdrop-filter: blur(5px);
              position: fixed;
              height: 100%;
              z-index: 3;
            }
            .checkOutBox {
              background-color: green;
              width: 700px;
              height: 500px;
              position: absolute;
              right: 30%;
              top: 30%;
              z-index: 5;
            }
            .hidden {
              display: none;
            }

            @media only screen and (max-width: 992px) {
              .listProduct {
                grid-template-columns: repeat(3, 1fr);
              }
            }

            /* mobile */
            @media only screen and (max-width: 768px) {
              .listProduct {
                grid-template-columns: repeat(2, 1fr);
              }
            }
                    @media only screen and (max-width: 768px) {
              .menu {
                display: none; /* Hide the navigation menu by default */
                flex-direction: column; /* Stack items vertically */
                align-items: center; /* Center items horizontally */
              }

              .menu.active {
                display: flex; /* Show the navigation menu when active */
              }

              .menu ul {
                width: 100%;
                text-align: center;
              }

              .menu li {
                padding: 10px;
              }

              .hamburger-menu {
                display: block; /* Show the hamburger menu icon */
                cursor: pointer;
              }

              .hamburger-menu .bar {
                width: 30px;
                height: 3px;
                background-color: #333;
                margin: 6px 0;
              }
            }
                  /* Your existing styles here */

            /* Add this CSS for the overlay */
            .nav-overlay {
              position: fixed;
              top: 0;
              left: 0;
              width: 100%;
              height: 100%;
              background: rgb(255 255 255 / 84%); /* Semi-transparent black overlay */
              display: flex;
              align-items: center;
              justify-content: center;
              z-index: 1000; /* Ensure it appears above other elements */
            }

            .nav-overlay ul {
              list-style: none;
              padding: 0;
              margin: 0;
            }

            .nav-overlay li {
              padding: 10px;
            }

		    

  </style>

  </head>

  <body>

      <!-- Main page header -->
    <header class="header ">
      <div class="logo">
        <img src="../../Resources/images/logo-dark.png" alt="Logo" />
      </div>

      <!-- NavBar -->
      <nav class="menu ">
        <ul>
          <li><a href="./index.php">Home</a></li>
          <li><a href="./about.php">About</a></li>
          <li><a href="./products.php">Products</a></li>
          <li><a href="./blogs.php">Blogs</a></li>
          <li><a href="./contact.php">Contact</a></li>



        </ul>
      </nav>


      <!-- conditional rendering based on user status -->
      <?php
      // Check if the user is logged in
      if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
          // Display content for logged-in users
          echo '<div class="buttons">
          <a href="logout.php" class="p-3 bg-black text-white rounded-lg hover:bg-[#e0e0e0] hover:outline hover:outline-1 hover:text-black transition-all duration-300 cursor-pointer">Log Out <i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180 ml-3"></i></a>
          <div class="icon-cart">
            <svg
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 18 20"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1"
              />
            </svg>
            <span>0</span>
          </div>
          
        </div>';
      } else {
          // Display content for non-registered users
          if(isset($_SESSION['loggedin'])){
            echo $_SESSION['loggedin'];
          }
          
          echo '<ul class="flex gap-3 flex-row">
                  <li><a href="signup.php" class="p-3 bg-black text-white rounded-lg hover:bg-[#e0e0e0] hover:outline hover:outline-1 hover:text-black transition-all duration-300 cursor-pointer">Signup</a></li>
                  <li><a href="login.php" class="p-3 hover:bg-black hover:text-white rounded-lg bg-[#e0e0e0] outline outline-1 text-black transition-all duration-300 cursor-pointer">Login</a></li>
                </ul>';
      }
      ?> 
        
        <!-- Hamburger menu for mobiles -->
        <div class="hamburger-menu">
          <div class="bar"></div>
          <div class="bar"></div>
          <div class="bar"></div>
        </div>

      </div>
    </header>

	    <div class="cartTab">
      <h1>Shopping Cart</h1>
      <div class="listCart"></div>
      <div class="btn">
        <button class="close">CLOSE</button>
        <button class="checkOut"><a href="checkout.html">Check Out</a></button>
      </div>
    </div>
    <script src="../../Resources/js/app.js"></script>
        <section class="hero mx-auto " style="max-width: 1200px; margin: 0 auto; padding: 0 25px;">
            <div class="hero-text-div">
                
                <h1>Discover the tools you need to thrive in the classroom and beyond</h1>
                <p class="hero-p">Shop with confidence knowing you're getting the best quality products. And Everything you need to succeed, delivered to your dorm doorstep.</p>
                <div class="hero-btn-div">
                    <a href="./products.php" class="btn">Shop Now</a>


                    <!-- conditional rendering based on user status-->
                    <?php
                    
                    // Check if the user is logged in
                    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                        // Display content for logged-in users
                        echo '<a href="./contact.html" class="p-3 rounded-full outline outline-1 px-12 hover:px-16 transition-all duration-300">Contact</a>';
                    } else {
                        // Display content for non-registered users
                        echo '<a href="#" class="p-3 rounded-full outline outline-1 px-12 hover:px-16 transition-all duration-300">Signup</a>';
                    }
                    ?>


                </div>
            </div>
            <div class="hero-img-div">
                    <img>
                </div>
        </section>
	    <section class="feature-v20 cd-padding-y-xl">
  <div class="cd-container cd-max-width-sm cd-margin-bottom-xl">
    <h1 class="cd-text-center">Our Services</h1>
  </div>

  <div class="cd-container cd-max-width-adaptive-lg">
    <ul class="feature-v20__list">
      <li class="feature-v20__item">
        <figure class="feature-v20__icon-wrapper">
          <svg class="feature-v20__icon cd-icon" viewBox="0 0 24 24" aria-hidden="true">
            <g fill="currentColor">
              <path d="M21 10H3c-1.103 0-2-.897-2-2V5c0-1.103.897-2 2-2h18c1.103 0 2 .897 2 2v3c0 1.103-.897 2-2 2z"></path>
              <rect x="1" y="12" width="6" height="9" rx="2" ry="2" opacity=".4"></rect>
              <rect x="9" y="12" width="14" height="9" rx="2" ry="2" opacity=".4"></rect>
            </g>
          </svg>
        </figure>

        <div class="cd-text-center">
          <h4 class="cd-margin-bottom-2xs">Easy to use</h4>
          <p class="feature-v20__paragraph">Our eCommerce website is made for anyone to use</p>
        </div>
      </li>

      <li class="feature-v20__item">
        <figure class="feature-v20__icon-wrapper">
          <svg class="feature-v20__icon cd-icon" viewBox="0 0 24 24" aria-hidden="true">
            <title>Many producr catalog</title>
            <g fill="currentColor">
              <path d="M9 9H4c-1.103 0-2-.897-2-2V4c0-1.103.897-2 2-2h5c1.103 0 2 .897 2 2v3c0 1.103-.897 2-2 2z"></path>
              <rect x="2" y="11" width="9" height="11" rx="2" ry="2" opacity=".4"></rect>
              <path d="M20 22h-5c-1.103 0-2-.897-2-2v-3c0-1.103.897-2 2-2h5c1.103 0 2 .897 2 2v3c0 1.103-.897 2-2 2z"></path>
              <rect x="13" y="2" width="9" height="11" rx="2" ry="2" transform="rotate(180 17.5 7.5)" opacity=".4"></rect>
            </g>
          </svg>
        </figure>

        <div class="cd-text-center">
          <h4 class="cd-margin-bottom-2xs">Many producr catalog</h4>
          <p class="feature-v20__paragraph">Explore form many of the product catagories we have</p>
        </div>
      </li>

      <li class="feature-v20__item">
        <figure class="feature-v20__icon-wrapper">
          <svg class="feature-v20__icon cd-icon" viewBox="0 0 24 24" aria-hidden="true">
            <title>Fast delivery</title>
            <g fill="currentColor">
              <circle cx="19" cy="9" r="5"></circle>
              <path d="M1 3.059A23.925 23.925 0 0 1 8 20c0-3.416 1.557-6.468 4-8.486" fill="none" opacity=".4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>
            </g>
          </svg>
        </figure>

        <div class="cd-text-center">
          <h4 class="cd-margin-bottom-2xs">Fast delivery</h4>
          <p class="feature-v20__paragraph">With a simple order watch the item show up at your dorm step.</p>
        </div>
      </li>

      <li class="feature-v20__item">
        <figure class="feature-v20__icon-wrapper">
          <svg class="feature-v20__icon cd-icon" viewBox="0 0 24 24" aria-hidden="true">
            <title>Easy controls</title>
            <g fill="currentColor">
              <path d="M17.5 11h-11C4.019 11 2 8.981 2 6.5S4.019 2 6.5 2h11C19.981 2 22 4.019 22 6.5S19.981 11 17.5 11z" opacity=".4"></path>
              <circle cx="6.5" cy="6.5" r="4.5"></circle>
              <path d="M6.5 13h11c2.481 0 4.5 2.019 4.5 4.5S19.981 22 17.5 22h-11C4.019 22 2 19.981 2 17.5S4.019 13 6.5 13z" opacity=".4"></path>
              <circle cx="17.5" cy="17.5" r="4.5"></circle>
            </g>
          </svg>
        </figure>

        <div class="cd-text-center">
          <h4 class="cd-margin-bottom-2xs">Easy Controls</h4>
          <p class="feature-v20__paragraph">You can track your orders and cancel at anytime</p>
        </div>
      </li>
    </ul>
  </div>
</section>
        <div class="title"><h2>PRODUCT TITLE</h2></div>
        <div class="slider" id="slider">
                <div class="scrollProducts">
                    <?php while ($row = $result->fetch_assoc()){?>
                      <a href="detail.php?id=<?php echo $row['id']; ?>" class="item">
                          <img src="./admin/<?php echo htmlspecialchars($row['imagepath']) ?>">
                          <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                          <div class="price"><?php echo htmlspecialchars($row['price']); ?> Birr</div>
                      </a>
                    <?php } ?>
                </div>
        </div>
        <div class="direction">
                <button id="prev"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 1 1.3 6.326a.91.91 0 0 0 0 1.348L7 13"/>
  </svg></button>
                <button id="next"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 13 5.7-5.326a.909.909 0 0 0 0-1.348L1 1"/>
  </svg></button>
            </div>
        <section class="hero">
            
            <div class="hero-img-div2">
                </div>
            <div class="hero-text-div">
                
                <h1>Let's tell you somethings about us</h1>
                <p class="hero-p">At AASTU, our aim was to enhance student life. We developed a secure, user-friendly ecommerce platform for easy access to university essentials like merchandise, textbooks, and event tickets. Our website fosters a thriving campus community while showcasing the synergy between technology and education. Explore our creation and experience the seamless blend of convenience and innovation!</p>
                <div class="hero-btn-div">
                    <a href="./contact.html" class="btn">About us</a>
                </div>
            </div>
        </section>
	    <div class="title"><h2>Blogs</h2></div>
	    <div class="containerb">
		    
			<div class="card">
				<div class="card-header">
					<img src="../../Resources/images/rover.jpeg" alt="rover" />
				</div>
				<div class="card-body">
					<span class="tag tag-teal">Technology</span>
					<h4>How to shop on AASTU Market</h4>
					<p>Explore how to order items on AASTU market</p>
					<div class="user">
						<img src="../../Resources/images/user-1.jpg" alt="user 1" />
						<div class="user-info">
							<h5>Birhan A.</h5>
							<small>2h ago</small>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<img src="../../Resources/images/ballons.jpeg" alt="ballons" />
				</div>
				<div class="card-body">
					<span class="tag tag-purple">Popular</span>
					<h4>How to Keep Going When You Don't Know What's Next</h4>
					<p>
						The future can be scary, but there are ways to deal with that fear.
					</p>
					<div class="user">
						<img src="../../Resources/images/user-2.jpg" alt="user 2" />
						<div class="user-info">
							<h5>Biruk L.</h5>
							<small>Yesterday</small>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<img src="../../Resources/images/city.jpeg" alt="city" />
				</div>
				<div class="card-body">
					<span class="tag tag-pink">AASTU</span>
					<h4>University of AASTU</h4>
					<p>Explore addis ababa university</p>
					<div class="user">
						<img src="../../Resources/images/user-3.jpg" alt="user 3" />
						<div class="user-info">
							<h5>Binyam F.</h5>
							<small>23 Dec 2023</small>
						</div>
					</div>
				</div>
			</div>
		</div>
        <footer class="main-footer me6-position-relative me6-z-index-1 me6-padding-top-xl">
  <div class="me6-container me6-max-width-lg">
    <div class="me6-grid me6-gap-y-lg me6-gap-lg@lg">
      <div class="me6-col-3@lg me6-order-2@lg me6-text-right@lg">
        <a class="main-footer__logo" href="#0">
		<div class="logo">
			<img src="../../Resources/images/logo-dark.png">
		</div>
           </a>
      </div>
      
      <nav class="me6-col-9@lg me6-order-1@lg">
        <ul class="me6-grid me6-gap-y-lg me6-gap-lg@xs">
          <li class="me6-col-6@xs me6-col-3@md">
            <h4 class="me6-margin-bottom-sm me6-text-base@md">Pages</h4>
            <ul class="me6-grid me6-gap-xs me6-text-sm@md">
              <li><a href="index.html" class="main-footer__link">Home</a></li>
              <li><a href="products.html" class="main-footer__link">Products</a></li>
              <li><a href="about.html" class="main-footer__link">About</a></li>
              <li><a href="blogs.html" class="main-footer__link">Blog</a></li>
              <li><a href="contact.html" class="main-footer__link">Contact</a></li>
            </ul>
          </li>

          <li class="me6-col-6@xs me6-col-3@md">
            <h4 class="me6-margin-bottom-sm me6-text-base@md">Shop</h4>
            <ul class="me6-grid me6-gap-xs me6-text-sm@md">
              <li><a href="#0" class="main-footer__link">Shipping policy</a></li>
              <li><a href="#0" class="main-footer__link">Refund policy</a></li>
            </ul>
          </li>

          <li class="me6-col-6@xs me6-col-3@md">
            <h4 class="me6-margin-bottom-sm me6-text-base@md">Resources</h4>
            <ul class="me6-grid me6-gap-xs me6-text-sm@md">
              <li><a href="#0" class="main-footer__link">Tutorials</a></li>
              <li><a href="#0" class="main-footer__link">Docs</a></li>
              <li><a href="#0" class="main-footer__link">Help center</a></li>
            </ul>
          </li>

          <li class="me6-col-6@xs me6-col-3@md">
            <h4 class="me6-margin-bottom-sm me6-text-base@md">About</h4>
            <ul class="me6-grid me6-gap-xs me6-text-sm@md">
              <li><a href="#0" class="main-footer__link">Company</a></li>
              <li><a href="#0" class="main-footer__link">Customers</a></li>
              <li><a href="#0" class="main-footer__link">Blog</a></li>
              <li><a href="#0" class="main-footer__link">Our story</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  
    <div class="me6-flex me6-flex-column me6-border-top me6-padding-y-xs me6-margin-top-lg me6-flex-row@md me6-justify-between@md me6-items-center@md">
      <div class="me6-margin-bottom-sm me6-margin-bottom-0@md">
        <div class="me6-text-sm me6-text-xs@md me6-color-contrast-medium me6-flex me6-flex-wrap me6-gap-xs">
          <span>&copy; AASTU Market</span>
          <a href="#0" class="me6-color-contrast-high">Terms</a>
          <a href="#0" class="me6-color-contrast-high">Privacy</a>
        </div>
      </div>

    </div>
  </div>
</footer>

        
    </body>
</html>
