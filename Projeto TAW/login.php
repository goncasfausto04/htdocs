<?php
session_start();
require_once 'config.php'; // Adjust the path as needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT id, password, role FROM accounts WHERE email = ?");
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a session
            $_SESSION['user_id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role; // Store the role in session
            header("Location: Homepage/homepage.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that email address.";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
