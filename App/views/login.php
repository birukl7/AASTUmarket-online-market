<?php
session_start();
require 'db.php';

// Function to sanitize input
function sanitizeInput($input){
    $input = trim($input);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

// Function to validate email format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password format (minimum 8 characters)
function validatePassword($password) {
    return preg_match('/^.{8,}$/', $password);
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate email
    $email = sanitizeInput($_POST['email']);
    if (!validateEmail($email)) {
        $login_error = "Invalid email format.";
    } else {
        // Sanitize and validate password
        $password = $_POST['password'];
        if (!validatePassword($password)) {
            $login_error = "Password must be at least 8 characters long.";
        } else {
            // Query the database
            $sql = "SELECT * FROM users WHERE email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                if (password_verify($password, $row['password'])) {
                    $_SESSION['loggedin'] = true;
                    
                    setcookie('username',$row['first_name'], time()+(86400), '/');
                    header('Location: index.php'); // Redirect to the home page after successful login
                    exit;
                } else {
                    $login_error = "Invalid email or password.";
                }
            } else {
                $login_error = "Invalid email or password.";
            }
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
  <script src="https://kit.fontawesome.com/ee4b6626a1.js" crossorigin="anonymous"></script>
  <title>Log in</title>
</head>
<body>
  <!-- component -->
  <div class="h-screen w-screen">
    <div class="flex flex-col items-center flex-1 h-full justify-center px-4 sm:px-0">
        <div class="flex rounded-lg shadow-lg w-full sm:w-3/4 lg:w-1/2 bg-white sm:mx-0" style="height: 500px">
            <div class="flex flex-col w-full md:w-1/2 p-4 relative">
            <a class="absolute p-3 bg-black text-white rounded-3xl text-sm cursor-pointer " href="index.php"><i class="fa-solid fa-arrow-left"></i></a>
                <div class="flex flex-col flex-1 justify-center mb-8">
                    
                    <h1 class="text-4xl text-center font-thin">Welcome Back</h1>
                    <!-- <?php if (isset($login_error)) { ?>
                      <p><?php echo $login_error; ?></p>
                    <?php } ?> -->
                    <div class="w-full mt-4">
                        <form class="form-horizontal w-3/4 mx-auto" method="POST" action="#">
                            <div class="flex flex-col mt-4">
                                <input id="email" type="text" class="flex-grow h-8 px-2 border rounded border-grey-400" name="email" value="" placeholder="Email">
                            </div>
                            <div class="flex flex-col mt-4">
                                <input id="password" type="password" class="flex-grow h-8 px-2 rounded border border-grey-400" name="password" required placeholder="Password">
                            </div>
                            <?php if(isset($login_error)): ?>
                            <p class="text-red-500 mt-1"><?php echo $login_error; ?></p>
                            <?php endif; ?>
                            <div class="flex flex-col mt-8">
                                <button type="submit" class="bg-black hover:bg-transparent hover:outline hover:outline-1 hover:text-black text-white text-sm font-semibold py-2 px-4 rounded">
                                    Login
                                </button>
                            </div>
                            <p class="mb-0 mt-2 pt-1 text-sm font-semibold">
                                Create an account?
                                <a href="signup.php" class="text-danger transition duration-150 ease-in-out hover:text-danger-600 focus:text-danger-600 active:text-danger-700 underline">Sign Up</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="hidden md:block md:w-1/2 rounded-r-lg bg-contain" style="background: url('../../Resources/images/hero.png'); background-size: cover; background-position: center center;"></div>
        </div>
    </div>
</div>

</body>
</html>