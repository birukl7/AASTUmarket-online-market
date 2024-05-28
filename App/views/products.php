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
        <link rel="stylesheet" type="text/css" href="../../Resources/css/output.css">
        <title>AASTU ONLINE MARKET</title> 
        <link rel="stylesheet" type="text/css" href="../../Resources/css/style.css">
        <script src="https://kit.fontawesome.com/ee4b6626a1.js" crossorigin="anonymous" ></script>
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
            /* font-family: Poppins; */
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
    <body class="font-roboto">
      <header class="header">
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
    <!-- checkOut -->
    <!-- checkOut -->
    <!-- checkOut -->
    <div class="layOut hidden">
      <div class="checkOutBox hidden">
        <button class="btnCloseBox">✖️</button>
      </div>
    </div>
        <div class="container">
            <div class="title">Products</div>
            <!-- search bar for products -->
         
            <form action="search.php" class="relative" method="GET">
              <input type="search" name="search" id="" class="rounded-full w-1/2 max-w-md p-3 pl-7 focus:outline-1 focus:outline-none  shadow-2xl mb-5" placeholder="search a product..."  >
              <button type="submit" class=" hover:cursor-pointer  bg-black p-3 rounded-full text-white ml-3 hover:outline-1 hover:outline hover:text-black hover:bg-transparent">
                <i class="fa-solid fa-magnifying-glass  "></i>
              </button>
            </form>
              
                <div class="listProducts max-w-5xl mx-auto">
                    <?php while ($row = $result->fetch_assoc()){?>
                      <a href="detail.php?id=<?php echo $row['id']; ?>" class="item">
                          <img src="./admin/<?php echo htmlspecialchars($row['imagepath']) ?>">
                          <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                          <div class="price"><?php echo htmlspecialchars($row['price']); ?> Birr</div>
                      </a>
                    <?php } ?>
                </div>
        </div>


    </body>
</html>
