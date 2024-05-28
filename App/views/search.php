<?php
session_start();
require 'db.php';
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
      $searchQuery = '';
      if (isset($_GET['search'])) {
          $searchQuery = trim(htmlspecialchars($_GET['search']));
      }

      // Fetch products based on the search query
      $sql = "SELECT * FROM products";
      if ($searchQuery) {
          $sql .= " WHERE name LIKE ? OR description LIKE ?";
      }

      $stmt = $conn->prepare($sql);

      if ($searchQuery) {
          $searchTerm = '%' . $searchQuery . '%';
          $stmt->bind_param("ss", $searchTerm, $searchTerm);
      }

      $stmt->execute();
      $result3 = $stmt->get_result();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../Resources/css/output.css">
  <link rel="stylesheet" type="text/css" href="../../Resources/css/style.css">
  <title>Search Result</title>
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

<body>
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
      
      <!-- Hamburger menu for mobiles -->
      <div class="hamburger-menu">
        <div class="bar"></div>
        <div class="bar"></div>
        <div class="bar"></div>
      </div>

    </div>


  </header>

  <div class="listProducts max-w-5xl mx-auto">
  <?php 
    if($result3->num_rows > 0){
    while ($row = $result3->fetch_assoc()) {
?>

      <a href="detail.php?id=<?php echo $row['id']; ?>" class="item">
                <img src="./admin/<?php echo htmlspecialchars($row['imagepath']); ?>">
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <div class="price"><?php echo htmlspecialchars($row['price']); ?> Birr</div>
      </a>
    <?php 
                }
              } else {
                  // No results found
                  echo '<p class="text-xl font-semibold pl-20">No products found.</p>';
              }
    
    ?>
</div>


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