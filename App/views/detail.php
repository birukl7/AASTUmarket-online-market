<?php
session_start();
require 'db.php';

$sql = "SELECT * FROM products";
$result2 = $conn->query($sql);

function sanitizeInput($input) {
  $input = trim($input);
  $input = stripslashes($input);
  $input = htmlspecialchars($input);
  return $input;
}

// Check if product ID is provided
if (!isset($_GET['id'])) {
  header('Location: index.php');
  exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: index.php');
    exit;
}
$product = $result->fetch_assoc();


?>


<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Group 4" />
    <meta name="description " content="A better place for you to shop online" />
    <title>Product Detail</title>
    <link
      rel="stylesheet"
      type="text/css"
      href="../../Resources/css/detail.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="../../Resources/css/style.css"
    />
    <link rel="stylesheet" type="text/css" href="../../Resources/css/output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=RocknRoll+One&family=Truculenta:opsz,wght@12..72,100..900&display=swap" rel="stylesheet">
    <style>
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
          <li><a href="./about.html">About</a></li>
          <li><a href="./products.php">Products</a></li>
          <li><a href="./blogs.html">Blogs</a></li>
          <li><a href="./contact.html">Contact</a></li>



        </ul>
      </nav>


      <!-- conditional rendering based on user status -->
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

    

    <div class="container">
      <div class="title">PRODUCT DETAIL</div>
      <div class="detail">
        <div class="image">
          <img id="product-image" src="./admin/<?php echo htmlspecialchars($product['imagepath']) ?>" />
        </div>
        <div class="content">
          <h1 id="product-name" class="name"><?php echo htmlspecialchars($product['name']); ?></h1>
          <div id="product-price" class="price"><?php echo htmlspecialchars($product['price']); ?> Birr</div>
          <div class="buttons flex items-center">
            <button><a href="checkout.html">Check Out</a></button>

            <?php 
              if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){
                echo '
                <button class="topProductAddToCart" onclick="addToCart()">
                  Add To Cart
                  <span>
                    <svg
                      class=""
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
                  </span>
                </button>';
              } else {
                echo '<div><a href="./login.php" class="p-3 bg-black text-white rounded-lg hover:bg-[#e0e0e0] hover:outline hover:outline-1 py-10 hover:text-black transition-all duration-300 cursor-pointer">Login To Add To Cart</a></div>';
              }
            ?>
          </div>
          <div id="product-description" class="description"><?php echo htmlspecialchars($product['description']); ?></div>
        </div>
      </div>

      <div class="title">Similar product</div>
      <div class="listProducts">
        <?php while ($row = $result2->fetch_assoc()){?>
          <a href="detail.php?id=<?php echo $row['id']; ?>" class="item">
            <img src="./admin/<?php echo htmlspecialchars($row['imagepath']) ?>">
            <h2><?php echo htmlspecialchars($row['name']); ?></h2>
            <div class="price"><?php echo htmlspecialchars($row['price']); ?> Birr</div>
          </a>
        <?php } ?>
      </div>
    </div>

    <script>
      function addToCart() {
        // Retrieve product details from the DOM
        const productImage = document.getElementById('product-image').src;
        const productName = document.getElementById('product-name').textContent;
        const productPrice = document.getElementById('product-price').textContent;
        const productDescription = document.getElementById('product-description').textContent;

        // Create a product object
        const product = {
          image: productImage,
          name: productName,
          price: productPrice,
          description: productDescription
        };

        // Get existing cart items from localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

          // Update the cart count span


        // Add the new product to the cart
        cart.push(product);

        document.getElementById('cart-count').textContent = cart.length;
        // Store the updated cart in localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Optional: Provide feedback to the user
        alert('Product added to cart!');
      }

    </script>



    <script>
      
      // fetch("../../Resources/js/Products.json")
      //   .then((response) => response.json())
      //   .then((data) => {
      //     products = data;
      //     showDetail();
      //   });

      // function showDetail() {
      //   //remove datas default from HTML
      //   let detail = document.querySelector(".detail");
      //   let listProductk = document.querySelector(".listProducts");
      //   const topProductAddToCart = document.querySelector(
      //     ".topProductAddToCart"
      //   );
      //   const checkOut = document.querySelector(".checkOut");

      //   // let productId = new URLSearchParams(window.location.search).get("id");
      //   // let thisProduct = products.filter((value) => value.id == productId)[0];


      //   // //if there is no product with id = productId => return to home page
      //   // if (!thisProduct) {
      //   //   window.location.href = "/";
      //   // }

      //   // detail.querySelector(".image img").src = thisProduct.image;
      //   // detail.querySelector(".name").innerText = thisProduct.name;
      //   // detail.querySelector(".price").innerText = thisProduct.price + " Birr";
      //   // detail.querySelector(".description").innerText =
      //   //   "$" + thisProduct.description;

      //   topProductAddToCart.addEventListener("click", function (event) {
      //     event.preventDefault();
      //     const positionClick = event.target;
      //     addToCart(productId);
      //   });

      //   products
      //     .filter((value) => value.id != productId)
      //     .forEach((product) => {

      //       let newProduct = document.createElement("div");
      //       newProduct.dataset.id = product.id;
      //       newProduct.classList.add("item");
      //       newProduct.innerHTML = `<img src="${product.image}" alt="">
      //           <h2><a href = '../../App/views/detail.php?id=${product.id}'>${product.name}</a></h2>
      //           <div class="price">${product.price} Birr</div>`;
      //       listProductk.appendChild(newProduct);
      //     });

      //   listProduct.addEventListener("click", (event) => {
      //     let positionClick = event.target;
      //     if (positionClick.classList.contains("addCart")) {
      //       let id_product = positionClick.parentElement.dataset.id;
      //       addToCart(id_product);
      //     }
      //   });
      // }

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
