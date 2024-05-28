<?php
session_start();
require '../db.php';

// Function to sanitize input
function sanitizeInput($input) {
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Check if product ID is provided
if (!isset($_GET['id'])) {
    header('Location: admin_dashboard.php');
    exit;
}

$id = intval($_GET['id']);

// Fetch the product details
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header('Location: admin_dashboard.php');
    exit;
}

$product = $result->fetch_assoc();

// Update product details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitizeInput($_POST['name']);
    $description = sanitizeInput($_POST['description']);
    $price = floatval($_POST['price']);
    $imagepath = sanitizeInput($_POST['imagepath']);

    $sql = "UPDATE products SET name = ?, description = ?, price = ?, imagepath = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsi", $name, $description, $price, $imagepath, $id);

    if ($stmt->execute()) {
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
  <link rel="stylesheet" type="text/css" href="../../Resources/css/output.css">

  <title>Edit Product</title>
</head>
<body>
  <div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Product</h1>
    <form action="" method="POST" class="max-w-lg mx-auto abg-white p-6 rounded-lg shadow-md">
      <div class="mb-4">
        <label for="name" class="block text-gray-700">Name</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" class="w-full p-2 border border-gray-300 rounded mt-1" required>
      </div>
      <div class="mb-4">
        <label for="description" class="block text-gray-700">Description</label>
        <textarea id="description" name="description" class="w-full p-2 border border-gray-300 rounded mt-1" required><?php echo htmlspecialchars($product['description']); ?></textarea>
      </div>
      <div class="mb-4">
        <label for="price" class="block text-gray-700">Price</label>
        <input type="number" id="price" name="price" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" class="w-full p-2 border border-gray-300 rounded mt-1" required>
      </div>
      <div class="mb-4">
        <label for="imagepath" class="block text-gray-700">Image Path</label>
        <input type="text" id="imagepath" name="imagepath" value="<?php echo htmlspecialchars($product['imagepath']); ?>" class="w-full p-2 border border-gray-300 rounded mt-1" required>
      </div>
      <div class="flex justify-end">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Update Product</button>
      </div>
    </form>
  </div>
</body>
</html>
