<?php
$success=0;
$user=0;

if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'connect.php';
    $username=$_POST['username'];
    $password=$_POST['password'];

/*     $sql="insert into `registration`(username,password)
    values('$username','$password')";
    $result=mysqli_query($conn,$sql);

    if($result){
        echo "Data inserted successfully";
    }else{
        die(mysqli_error($conn));
    } */
    
    $sql="Select * from `registration` where username='$username'";

    $result=mysqli_query($conn,$sql);
    if($result){
        $num=mysqli_num_rows($result);
        if($num>0){
            // echo "User already exists";
            $user=1;
        }else{
            $password=password_hash($password,PASSWORD_BCRYPT);
    $sql="insert into `registration`(username,password)
    values('$username','$password')";
    $result=mysqli_query($conn,$sql);
    if($result){
        // echo "Signup successful";
        $success=1;
    }else{
        die(mysqli_error($conn));
    } 
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

    <title>Signup page</title>
  </head>
  <body>

<?php
if($user){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Oh no Sorry! </strong> User already exists.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>

<?php
if($success){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Successful! </strong> You are now successfully signed up.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}

?>

    <h1 class="text-center">Signup to our website</h1>
    <div class="container mt-5">
        <form action="sign.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Enter your username" name="username">
    
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password">
            </div>
  
            <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>
    </div>
  </body>
</html>