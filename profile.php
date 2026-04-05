<?php
include 'init.php';
include 'navbar.php'; 

$message = "";
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Fetch existing profile data (if any)
$sql = "SELECT * FROM user_profiles WHERE user_id = '$user_id' LIMIT 1";
$result = mysqli_query($conn, $sql);

$existingProfile = null;
if ($result && mysqli_num_rows($result) > 0) {
    $existingProfile = mysqli_fetch_assoc($result);
}

// Handle form submission
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_SESSION['username']; 
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $user_id = $_POST['user_id'];

    $sql = "INSERT INTO user_profiles (username, `name`, age, email, gender, user_id) 
        VALUES ('$username', '$name', '$age', '$email', '$gender', '$user_id')
        ON DUPLICATE KEY UPDATE 
            username = VALUES(username),
            `name` = VALUES(`name`),
            age = VALUES(age),
            email = VALUES(email),
            gender = VALUES(gender)";

    if(mysqli_query($conn, $sql)){
        $message = '<div class="alert alert-success">Profile saved successfully!</div>';
        $result = mysqli_query($conn, "SELECT * FROM user_profiles WHERE user_id = '$user_id' LIMIT 1");
        if ($result && mysqli_num_rows($result) > 0) {
            $existingProfile = mysqli_fetch_assoc($result);
        }
    } else {
        $message = '<div class="alert alert-danger">Error: ' . mysqli_error($conn) . '</div>';
    }
}
?>


          <h2 class="text-center mb-4">User Profile</h2>

          <?php echo $message; ?>

          <form action="profile.php" method="post" class="card p-4 shadow">
              <div class="mb-3">
                  <label class="form-label">Full Name</label>
                  <input type="text" name="name" class="form-control"
                         value="<?php echo $existingProfile['name'] ?? ''; ?>" required>
              </div>
              <div class="mb-3">
                  <label class="form-label">Age</label>
                  <input type="number" name="age" class="form-control"
                         value="<?php echo $existingProfile['age'] ?? ''; ?>" required>
              </div>
              <div class="mb-3">
                  <label class="form-label">Email</label>
                  <input type="email" name="email" class="form-control"
                         value="<?php echo $existingProfile['email'] ?? ''; ?>" required>
              </div>
              <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
              <div class="mb-3">
                  <label class="form-label">Gender</label>
                  <select name="gender" class="form-select" required>
                      <option value="" disabled <?php echo empty($existingProfile['gender']) ? 'selected' : ''; ?>>Select your gender</option>
                      <option value="Male" <?php echo ($existingProfile['gender'] ?? '') == 'Male' ? 'selected' : ''; ?>>Male</option>
                      <option value="Female" <?php echo ($existingProfile['gender'] ?? '') == 'Female' ? 'selected' : ''; ?>>Female</option>
                      <option value="Other" <?php echo ($existingProfile['gender'] ?? '') == 'Other' ? 'selected' : ''; ?>>Other</option>
                  </select>
              </div>
              <button type="submit" class="btn btn-primary w-100">Save Profile</button>
          </form>
          <?php include 'footer.php'; ?>
      </div>
    </div>
              <?php include 'copy.php'; ?>
  </body>

</html>
