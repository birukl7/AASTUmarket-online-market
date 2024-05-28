<?php
 session_start();
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
    <link rel="stylesheet" type="text/css" href="../../Resources/css/output.css">
	<title>AASTU ONLINE MARKET</title> 
        <link rel="stylesheet" type="text/css" href="../../Resources/css/style.css">
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

                    /* -------------------------------- 

            File#: _2_contact
            Title: Contact
            Descr: Contact block w/ info about how to get in touch
            Usage: codyhouse.co/license

            -------------------------------- */
            /* reset */
            *, *::after, *::before {
              box-sizing: border-box;
            }

            * {
              font: inherit;
              margin: 0;
              padding: 0;
              border: 0;
            }

            body {
              background-color: hsl(0, 0%, 100%);
              font-family: system-ui, sans-serif;
              color: hsl(230, 7%, 23%);
              font-size: 1rem;
            }

            h1, h2, h3, h4 {
              line-height: 1.2;
              color: hsl(230, 13%, 9%);
              font-weight: 700;
            }

            h1 {
              font-size: 2.0736rem;
            }

            h2 {
              font-size: 1.728rem;
            }

            h3 {
              font-size: 1.25rem;
            }

            h4 {
              font-size: 1.2rem;
            }

            ol, ul, menu {
              list-style: none;
            }

            button, input, textarea, select {
              background-color: transparent;
              border-radius: 0;
              color: inherit;
              line-height: inherit;
              appearance: none;
            }

            textarea {
              resize: vertical;
              overflow: auto;
              vertical-align: top;
            }

            a {
              color: hsl(250, 84%, 54%);
            }

            table {
              border-collapse: collapse;
              border-spacing: 0;
            }

            img, video, svg {
              display: block;
              max-width: 100%;
            }

            @media (min-width: 64rem) {
              body {
                font-size: 1.25rem;
              }

              h1 {
                font-size: 3.051rem;
              }

                h2 {
                font-size: 2.44rem;
              }

                h3 {
                font-size: 1.75rem;
              }

                h4 {
                font-size: 1.5625rem;
              }
            }

            /* variables */
            :root {
              /* colors */
              --co1-color-primary-hsl: 250, 84%, 54%;
              --co1-color-bg-hsl: 0, 0%, 100%;
              --co1-color-contrast-high-hsl: 230, 7%, 23%;
              --co1-color-contrast-higher-hsl: 230, 13%, 9%;
              --co1-color-contrast-medium-hsl: 225, 4%, 47%;

              /* spacing */
              --co1-space-2xs: 0.375rem;
              --co1-space-md: 1.25rem;
              --co1-space-lg: 2rem;
            }

            @media(min-width: 64rem){
              :root {
                /* spacing */
                --co1-space-2xs: 0.5625rem;
                --co1-space-md: 2rem;
                --co1-space-lg: 3.125rem;
              }
            }

            /* component */
            @media (min-width: 64rem) {
              .contact .google-maps {
                height: auto;
                padding-bottom: 0;
              }
            }

            /* utility classes */
            .co1-radius-md {
              border-radius: 0.25em;
            }

            .co1-color-contrast-medium {
              --co1-color-o: 1;
              color: hsla(var(--co1-color-contrast-medium-hsl), var(--co1-color-o, 1));
            }

            .co1-line-height-md {
              line-height: 1.4;
            }

            .co1-margin-bottom-2xs {
              margin-bottom: var(--co1-space-2xs);
            }

            .co1-font-bold {
              font-weight: 700;
            }

            .co1-padding-y-md {
              padding-top: var(--co1-space-md);
              padding-bottom: var(--co1-space-md);
            }

            .co1-gap-y-lg {
              row-gap: var(--co1-space-lg);
            }

            .co1-grid {
              display: grid;
              grid-template-columns: repeat(12, 1fr);
            }

            .co1-grid > * {
              min-width: 0;
              grid-column-end: span 12;
            }

            .co1-text-center {
              text-align: center;
            }

            .co1-margin-bottom-lg {
              margin-bottom: var(--co1-space-lg);
            }

            .co1-max-width-lg {
              max-width: 80rem;
            }

            .co1-container {
              width: calc(100% - 2*var(--co1-space-md));
              margin-left: auto;
              margin-right: auto;
            }

            .co1-z-index-1 {
              z-index: 1;
            }

            .co1-position-relative {
              position: relative;
            }

            @media(min-width: 64rem){
              .co1-padding-bottom-0\@md {
                padding-bottom: 0;
              }

              .co1-height-auto\@md {
                height: auto;
              }

              .co1-text-right\@md {
                text-align: right;
              }

              .co1-margin-bottom-0\@md {
                margin-bottom: 0;
              }

              .co1-justify-between\@md {
                justify-content: space-between;
              }

              .co1-flex\@md {
                display: flex;
              }

              .co1-gap-lg\@md {
                gap: var(--co1-space-lg);
              }

              .co1-col-6\@md {
                grid-column-end: span 6;
              }
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
      <li><a href="./contact.php" class=" text-red-300">Contact</a></li>
    </ul>
  </nav>
  <div class="buttons">

      <!-- conditional rendering based on user status -->
      <?php
       
        // Check if the user is logged in
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            // Display content for logged-in users
            echo '<div class="buttons">
            <a href="logout.php" class="p-3 bg-black text-white rounded-lg hover:bg-[#e0e0e0] hover:outline hover:outline-1 hover:text-black transition-all duration-300 cursor-pointer">Log Out <i class="fa-solid fa-arrow-right-from-bracket fa-rotate-180 ml-3"></i></a>

            <a href="./cart.php" class=" flex flex-col items-center gap-y-3">
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
                <span id="cart-count">0</span>
              </div>
            </a>

          </div>';
        } else {
            // Display content for non-registered users
            echo '<ul class="flex gap-3 flex-row">
                    <li><a href="./signup.php" class="p-3 bg-black text-white rounded-lg hover:bg-[#e0e0e0] hover:outline hover:outline-1 hover:text-black transition-all duration-300 cursor-pointer">Signup</a></li>
                    <li><a href="./login.php" class="p-3 hover:bg-black hover:text-white rounded-lg bg-[#e0e0e0] outline outline-1 text-black transition-all duration-300 cursor-pointer">Login</a></li>
                  </ul>';
        }
      ?>


        
      </div>
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
        <section class="contact co1-position-relative co1-z-index-1">
  <div class="co1-container co1-max-width-lg">
    <div class="co1-margin-bottom-lg">
      <h1 class="co1-text-center">Contact Us</h1>
    </div>

    <div class="co1-grid co1-gap-y-lg co1-gap-lg@md">
      <div class="co1-col-6@md">
        <dl class="details-list details-list--rows">
          <div class="details-list__item co1-padding-y-md co1-flex@md co1-justify-between@md">
            <dt class="co1-font-bold co1-margin-bottom-2xs co1-margin-bottom-0@md">Address</dt>
            <dd class="co1-line-height-md co1-text-right@md">
              Tulu Dimtu <br>1205<br>Addis Ababa, Ethiopia.
            </dd>
          </div>
        
          <div class="details-list__item co1-padding-y-md co1-flex@md co1-justify-between@md">
            <dt class="co1-font-bold co1-margin-bottom-2xs co1-margin-bottom-0@md">Email</dt>
            <dd>
              <a href="mailto:webmaster@example.com">hello@aastumarket.com</a>
            </dd>
          </div>
        
          <div class="details-list__item co1-padding-y-md co1-flex@md co1-justify-between@md">
            <dt class="co1-font-bold co1-margin-bottom-2xs co1-margin-bottom-0@md">Phone</dt>
            <dd class="co1-line-height-md co1-text-right@md">
              <p><a href="tel:+44 7656 6455">+251-874321522</a></p>
              <p class="co1-color-contrast-medium">Mon - Fri, 9AM - 5PM</p>
            </dd>
          </div>
        </dl>
      </div>

      <div role="application" class="google-maps co1-radius-md co1-col-6@md co1-height-auto@md co1-padding-bottom-0@md js-google-maps" data-coordinates="51.5658015,-0.40339"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3942.054914522372!2d38.81727237367134!3d8.874480191391337!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x164b794fa57008db%3A0xeb371ab5e9a42daa!2zVHVsdSBEaW10dSBzcXVhcmUgfCDhibHhiIkg4Yuy4Yid4YmxIOGKoOGLsOGJo-GJo-GLrQ!5e0!3m2!1sen!2set!4v1705841158161!5m2!1sen!2set" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
    </div>
  </div>
</section>

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
        

        <script>
          document.addEventListener('DOMContentLoaded', (event)  => {
              updateCartCount();
            });

            function updateCartCount() {
              // Get the cart from localStorage
              let cart = JSON.parse(localStorage.getItem('cart')) || [];
              // Update the cart count span
              document.getElementById('cart-count').textContent = cart.length;
            }
        </script>


    </body>
</html>
