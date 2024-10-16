<?php
// Include the necessary files
include_once 'dbconnection.php';  // Database connection
include_once 'User.php';      // User class

// Instantiate database and user object
$database = new Database();
$db = $database->getConnection();

// Create a new user object
$user = new User($db);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data using $_POST
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate that fields are not empty
    if (!empty($username) && !empty($email) && !empty($password)) {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Set the user properties
        $user->username = $username;
        $user->email = $email;
        $user->password = $hashedPassword;

        // Try to create the user
        if ($user->create()) {
            echo "<div class='alert alert-success'>User successfully registered.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error registering user. Please try again.</div>";
        }
    } else {
        // If any of the fields are empty, show an error message
        echo "<div class='alert alert-danger'>All fields are required. Please fill in the form completely.</div>";
    }
}
?>
