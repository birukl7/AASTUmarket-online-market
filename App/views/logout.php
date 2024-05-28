<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logout</title>
</head>
<body>
  <script>
    // Clear localStorage
    localStorage.clear();

    // Redirect to the index.php page after a brief delay to ensure localStorage is cleared
    setTimeout(function() {
      window.location.href = 'index.php';
    }, 100); // Delay in milliseconds
  </script>
</body>
</html>

<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// No need to use PHP's header function for redirection here
// The redirection is handled by the JavaScript in the HTML section above
?>
