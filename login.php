<?php
$login = false;
$error = false;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    // fetch user by username only
    $sql = "SELECT * FROM `registration` WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];
        $user_id = $row['id'];



        // verify the entered password with the hashed one
        if(password_verify($password, $hashed_password)){
    // start session if you want to keep user logged in
    session_start();
    $_SESSION['username'] = $username;
    $_SESSION['user_id'] = $user_id; // store user ID in session

    // redirect to dashboard.php (or any page)
    header("Location: welcome.php");
    exit(); // always call exit after header()
} else {
    $error = true; // wrong password
}
    }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <title>Login page</title>
  </head>
  <body>

<?php
if($login){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Congratulations! You have been logged in </strong> Redirecting you shortly...
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>

<?php
if($error){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Sadly! </strong> You are not registered with us.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>

    
    <h1 class="text-center">Get back into your account</h1>
    <div class="container mt-5">
        <form action="login.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input type="text" class="form-control" placeholder="Enter your username" name="username">
    
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password">
            </div>
  
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
  </body>
</html>