<?php
session_start();
include 'connect.php';

// Check if user is logged in
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['delete'])){
    // First delete the profile (if exists)
    $stmt = $conn->prepare("DELETE FROM user_profiles WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();

    // Then delete the user account
    $stmt = $conn->prepare("DELETE FROM registration WHERE id = ?");
    $stmt->bind_param("i", $user_id);

    if($stmt->execute()){
        // Account deleted, destroy session
        session_unset();
        session_destroy();
        
        // Redirect to login with message
        header("Location: login.php?message=account_deleted");
        exit();
    } else {
        echo "Error deleting account: " . $conn->error;
    }

    $stmt->close();
}
?>
