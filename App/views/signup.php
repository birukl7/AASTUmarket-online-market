<?php
session_start();
require 'db.php';

// Function to sanitize input
function sanitizeInput($input) {
    return htmlspecialchars(trim(stripslashes($input)));
}

// Function to validate email format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password format (minimum 8 characters)
function validatePassword($password) {
    return preg_match('/^.{8,}$/', $password);
}

function validateName($name){
    return preg_match('/^[A-Za-z]+$/', $name);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input
    $first_name = sanitizeInput($_POST['first_name']);
    $last_name = sanitizeInput($_POST['last_name']);
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];

    // Initialize an array to store errors
    $errors = [];

    // Validate inputs
    if (empty($first_name)) {
        $errors['first_name'] = 'First name is required.';
    }

    if (empty($last_name)) {
        $errors['last_name'] = 'Last name is required.';
    }

    if (empty($email) || !validateEmail($email)) {
        $errors['email'] = 'Invalid email address.';
    }

    if (!validateName($first_name)){
        $errors['first_name'] = 'First name is invalid.';
    }

    if (!validateName($last_name)){
        $errors['last_name'] = 'Last name is invalid.';
    }

    if (empty($password) || !validatePassword($password)) {
        $errors['password'] = 'Password must be at least 8 characters long';
    }

    // If there are no errors, proceed with database insertion
    if (empty($errors)) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssss", $first_name, $last_name, $email, $password_hashed);
        if ($sql->execute()) {
            $_SESSION['loggedin'] = true;
            setcookie('username',$row['first_name'], time()+(86400), '/');
             // Store the first name in session
            header('Location: index.php');
            exit;
        } else {
            echo "Error: " . $sql->error;
        }
        $sql->close();
    }
    //your uncle
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../../Resources/css/output.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <script src="https://kit.fontawesome.com/ee4b6626a1.js" crossorigin="anonymous"></script>
    <title>Signup</title>
</head>
<body>
    
    <section class="h-screen max-w-5xl mx-auto">
        <div class="h-full relative">
        <a class="absolute top-10 p-3 bg-black text-white rounded-3xl text-sm cursor-pointer " href="index.php"><i class="fa-solid fa-arrow-left"></i></a>
            <!-- Left column container with background-->
            <div class="flex h-full flex-wrap items-center justify-center lg:justify-between">
                <div class="shrink-1 mb-12 grow-0 basis-auto md:mb-0 md:w-9/12 md:shrink-0 lg:w-6/12 xl:w-6/12">
                    <img src="../../Resources/images/hero.png" class="w-full" alt="Sample image" />
                </div>
    
                <!-- Right column container -->
                <div class="mb-12 md:mb-0 md:w-8/12 lg:w-5/12 xl:w-5/12">
                    <form method="post" action="">
                        <!--Sign in section-->
                        <div class="flex flex-row items-center justify-center lg:justify-start">
                            <p class="mb-5 me-4 text-lg">Sign up </p>
                        </div>
    
                        <!-- First Name input -->
                        <div class="relative mb-6" data-twe-input-wrapper-init>
                            <input type="text" name="first_name" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary" id="exampleFirstNameInput" placeholder="First Name" />

                            <label for="exampleFirstNameInput" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary">First Name</label>

                            <?php if(isset($errors['first_name'])): ?>
                            <p class="text-red-500 mt-1"><?php echo $errors['first_name']; ?></p>
                            <?php endif; ?>

                        </div>
    
                        <!-- Last Name input -->
                        <div class="relative mb-6" data-twe-input-wrapper-init>
                            <input type="text" name="last_name" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary" id="exampleLastNameInput" placeholder="Last Name" />
                            <label for="exampleLastNameInput" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary">Last Name</label>

                            <?php if(isset($errors['last_name'])): ?>
                            <p class="text-red-500 mt-1"><?php echo $errors['last_name']; ?></p>
                            <?php endif; ?>
                        </div>
    
                        <!-- Email input -->
                        <div class="relative mb-6" data-twe-input-wrapper-init>
                            <input type="email" name="email" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary" id="exampleFormControlInput2" placeholder="Email address" />
                            <label for="exampleFormControlInput2" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary">Email address</label>

                            <?php if(isset($errors['email'])): ?>
                            <p class="text-red-500 mt-1"><?php echo $errors['email']; ?></p>
                            <?php endif; ?>
                        </div>
    
                        <!-- Password input -->
                        <div class="relative mb-6" data-twe-input-wrapper-init>
                            <input type="password" name="password" class="peer block min-h-[auto] w-full rounded border-0 bg-transparent px-3 py-[0.32rem] leading-[2.15] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary" id="exampleFormControlInput22" placeholder="Password" />
                            <label for="exampleFormControlInput22" class="pointer-events-none absolute left-3 top-0 mb-0 max-w-[90%] origin-[0_0] truncate pt-[0.37rem] leading-[2.15] text-neutral-500 transition-all duration-200 ease-out peer-focus:-translate-y-[1.15rem] peer-focus:scale-[0.8] peer-focus:text-primary">Password</label>
                            <?php if(isset($errors['password'])): ?>
                            <p class="text-red-500 mt-1"><?php echo $errors['password']; ?></p>
                            <?php endif; ?>
                        </div>
    
                        <div class="mb-6 flex items-center justify-between">
                            <!-- Remember me checkbox -->
                            <div class="mb-[0.125rem] block min-h-[1.5rem] ps-[1.5rem]">
                            </div>
                        </div>
    
                        <!-- Register button -->
                        <div class="text-center lg:text-left">
                            <button type="submit" class="bg-black w-full p-3 rounded-md text-white hover:bg-slate-700 transition-all duration-200">
                                Register
                            </button>
    
                            <!-- Register link -->
                            <p class="mb-0 mt-2 pt-1 text-sm font-semibold">
                                Have an account?
                                <a href="login.php" class="text-danger transition duration-150 ease-in-out hover:text-danger-600 focus:text-danger-600 active:text-danger-700 underline">Login</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
          
          
          

</body>
</html>
