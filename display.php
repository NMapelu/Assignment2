<?php
include_once 'Database.php';
include_once 'User.php';

// Instantiate the database and user objects
$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$stmt = $user->read();

// Display the user data
echo "<table class='table'>";
echo "<tr><th>ID</th><th>Username</th><th>Email</th></tr>";
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Access the row values directly instead of using extract()
    $id = $row['id'];
    $username = $row['username'];
    $email = $row['email'];

    // Output the values
    echo "<tr><td>{$id}</td><td>{$username}</td><td>{$email}</td></tr>";
}
echo "</table>";
?>
