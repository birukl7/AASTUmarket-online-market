<?php

require 'helper_functions.php';
require 'view_products.php';

if (!isset($_SESSION['admin_loggedin']) || $_SESSION['admin_loggedin'] !== true) {
    header('Location: admin_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = sanitizeInput($_POST['name']);
  $description = sanitizeInput($_POST['description']);
  $price = floatval($_POST['price']);
  $imagepath = '';

  // Handle image upload
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
      $fileTmpPath = $_FILES['image']['tmp_name'];
      $fileName = $_FILES['image']['name'];
      $fileSize = $_FILES['image']['size'];
      $fileType = $_FILES['image']['type'];
      $fileNameCmps = explode(".", $fileName);
      $fileExtension = strtolower(end($fileNameCmps));
      $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');

      if (in_array($fileExtension, $allowedfileExtensions) && $fileSize < 4 * 1024 * 1024) { // 4MB
          $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
          $uploadFileDir = 'Resources/images/';
          $dest_path = $uploadFileDir . $newFileName;

          if (move_uploaded_file($fileTmpPath, $dest_path)) {
              $imagepath = $dest_path;
          } else {
              $error_message = 'There was an error moving the uploaded file.';
          }
      } else {
          $error_message = 'Invalid file type or size exceeds 4MB.';
      }
  }

  // Insert product into database
  if (empty($error_message)) {
      $sql = "INSERT INTO products (name, description, price, imagepath) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("ssds", $name, $description, $price, $imagepath);

      if ($stmt->execute()) {
          $success_message = 'Product posted successfully.';
      } else {
          $error_message = 'Error posting product: ' . $conn->error;
      }
  }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../../Resources/css/output.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" type="text/css" href="../../../Resources/css/output.css">
  <title>Admin Dashboard</title>
</head>
<body>
  <div class=" w-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-lg w-96">
      <h1 class="text-2xl font-thin text-center mb-6">Admin Dashboard</h1>
      <div class="mt-6 text-center">
        <a href="admin_logout.php" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">Logout</a>
      </div>
    </div>
  </div>

  <div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Products</h1>
    <table class="min-w-full bg-white">
      <thead>
        <tr>
          <th class="py-2 px-4 border-b border-gray-200">Image</th>
          <th class="py-2 px-4 border-b border-gray-200">Name</th>
          <th class="py-2 px-4 border-b border-gray-200">Price</th>
          <th class="py-2 px-4 border-b border-gray-200">Description</th>
          <th class="py-2 px-4 border-b border-gray-200">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
          <tr>
            <td class="py-2 px-4 border-b border-gray-200">
              <img src="<?php echo htmlspecialchars($row['imagepath']); ?>" alt="Product Image" class="w-24 h-24 object-cover">
            </td>
            <td class="py-2 px-4 border-b border-gray-200"><?php echo htmlspecialchars($row['name']); ?></td>
            <td class="py-2 px-4 border-b border-gray-200"><?php echo htmlspecialchars($row['price']); ?></td>
            <td class="py-2 px-4 border-b border-gray-200"><?php echo htmlspecialchars($row['description']); ?></td>
            <td class="py-2 px-4 border-b border-gray-200">
              <a href="edit.php?id=<?php echo $row['id']; ?>" class="text-blue-500 hover:text-blue-700">Edit</a>
              
              <form action="delete_product.php" method="POST" class="inline-block">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
              </form>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

  <div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Post a New Product</h1>
    <?php if (isset($error_message)): ?>
        <p class="text-red-500"><?php echo $error_message; ?></p>
    <?php endif; ?>
    <?php if (isset($success_message)): ?>
        <p class="text-green-500"><?php echo $success_message; ?></p>
    <?php endif; ?>

    
    <form action="" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 rounded mt-1" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea id="description" name="description" class="w-full p-2 border border-gray-300 rounded mt-1" required></textarea>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-gray-700">Price</label>
            <input type="number" id="price" name="price" step="0.01" class="w-full p-2 border border-gray-300 rounded mt-1" required>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700">Product Image</label>
            <input type="file" id="image" name="image" class="w-full p-2 border border-gray-300 rounded mt-1" required>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Post Product</button>
        </div>
    </form>
  </div>
</body>
</html>
