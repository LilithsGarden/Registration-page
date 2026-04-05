<?php
session_start();
include 'connect.php';

// Redirect to login if not logged in
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit();
}

// Fetch profile picture for sidebar
$profilePic = "uploads/default-avatar.png"; // fallback
$user_id = $_SESSION['user_id'];
$res = $conn->query("SELECT profile_pic FROM user_profiles WHERE user_id = $user_id LIMIT 1");

if($res && $res->num_rows > 0){
    $row = $res->fetch_assoc();
    if(!empty($row['profile_pic'])){
        $profilePic = $row['profile_pic'];
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My App</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .nav-link.active {
        background-color: #495057;
        border-radius: 8px;
    }
    .nav-link:hover {
        background-color: #6c757d;
        border-radius: 8px;
    }
  </style>
</head>
<body>
  <div class="d-flex">
      <!-- Sidebar -->
      <?php include 'sidebar.php'; ?>

      <!-- Main Content -->
      <div class="flex-grow-1 p-4">
