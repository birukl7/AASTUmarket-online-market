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
        <header class="header">
  <div class="logo">
    <img src="../../Resources/images/logo-dark.png" alt="Logo" />
  </div>
  <nav class="menu">
    <ul>
      <li><a href="./index.php">Home</a></li>
      <li><a href="./about.php">About</a></li>
      <li><a href="./products.php">Products</a></li>
      <li><a href="./blogs.php">Blogs</a></li>
      <li><a href="./contact.php">Contact</a></li>
    </ul>
  </nav>

      <?php
        // Check if the user is logged in
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
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
            
            echo '<ul class="flex gap-3 flex-row">
                    <li class=" list-none"><a href="signup.php" class="p-3 bg-black text-white rounded-lg hover:bg-[#e0e0e0] hover:outline hover:outline-1 hover:text-black transition-all duration-300 cursor-pointer">Signup</a></li>
                    <li class="list-none"><a href="login.php" class="p-3 hover:bg-black hover:text-white rounded-lg bg-[#e0e0e0] outline outline-1 text-black transition-all duration-300 cursor-pointer">Login</a></li>
                  </ul>';
        }
        ?> 

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
        <script>
            
		 document.querySelector('.hamburger-menu').addEventListener('click', function() {
  // Create a new div to hold the navigation menu items
  var navOverlay = document.createElement('div');
  navOverlay.className = 'nav-overlay';

  // Clone the existing navigation menu and append it to the new div
  var clonedMenu = document.querySelector('.menu ul').cloneNode(true);
  navOverlay.appendChild(clonedMenu);

  // Append the new div to the body
  document.body.appendChild(navOverlay);

  // Toggle the 'active' class on the menu to show/hide it
  document.querySelector('.menu').classList.toggle('active');

  // Close the navigation menu when clicking outside of it
  navOverlay.addEventListener('click', function() {
    document.querySelector('.menu').classList.remove('active');
    document.body.removeChild(navOverlay);
  });
});

            
        </script>
        
    </body>
</html>
