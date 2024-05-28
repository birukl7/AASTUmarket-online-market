<?php
session_start();
require '../db.php';
require 'helper_functions.php';

$login_error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $email = sanitizeInput($_POST['email']);
    $password = sanitizeInput($_POST['password']);

    // Validate inputs
    if (validateEmail($email) && validatePassword($password)) {
        // Check admin credentials
        $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['admin_loggedin'] = true;
                setcookie('admin_username',$row['name'], time()+(86400), '/');
              
                header('Location: admin_dashboard.php'); // Redirect to admin dashboard
                exit;
            } else {
                $login_error = "Invalid email or password.";
            }
        } else {
            $login_error = "Invalid email or password.";
        }
    } else {
        $login_error = "Invalid email or password format.";
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
  <title>Admin Login</title>
</head>
<body>
  <div class="h-screen w-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded shadow-lg w-96">
      <h1 class="text-2xl font-thin text-center mb-6">Admin Login</h1>
      <?php if (!empty($login_error)) { ?>
        <p class="text-red-500 text-center mb-4"><?php echo $login_error; ?></p>
      <?php } ?>
      <form method="POST" action="">
        <div class="mb-4">
          <label for="email" class="block text-sm mb-2">Email</label>
          <input id="email" type="text" name="email" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-6">
          <label for="password" class="block text-sm mb-2">Password</label>
          <input id="password" type="password" name="password" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white py-2 rounded">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
