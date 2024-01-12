<?php
// In a real-world scenario, you'd validate credentials against a database
$validUsername = 'Rodney';
$validPassword = '123';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredUsername = $_POST['username'];
    $enteredPassword = $_POST['password'];

    // Validate credentials
    if ($enteredUsername === $validUsername && $enteredPassword === $validPassword) {
        session_start();
        $_SESSION['username'] = $enteredUsername;
        header('Location: index.php'); // Redirect to the main page after successful login
        exit();
    } else {
        echo 'Invalid username or password.';
    }
}
?>
