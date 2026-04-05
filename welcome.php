<?php 
include 'init.php';
include 'navbar.php'; 

$user_id = $_SESSION['user_id']; 

// Fetch user profile details
$sql = "SELECT `name`, email, gender, age, profile_pic FROM user_profiles WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();
?>

<div class="container mt-5 text-center">
    <h1 class="mb-4">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 🎉</h1>

    <?php if ($profile): ?>
        <!-- Profile Picture -->
        <div class="mb-4">
            <img src="<?php echo $profile['profile_pic'] ?: 'uploads/default-avatar.png'; ?>" 
                 alt="Profile Picture" 
                 class="rounded-circle shadow" 
                 style="width: 120px; height: 120px; object-fit: cover;">
        </div>

        <!-- Profile Details in Table -->
        <div class="d-flex justify-content-center">
            <table class="table table-bordered table-striped w-50 text-start">
                <tbody>
                    <tr>
                        <th scope="row">Full Name</th>
                        <td><?php echo htmlspecialchars($profile['name']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Email</th>
                        <td><?php echo htmlspecialchars($profile['email']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Gender</th>
                        <td><?php echo htmlspecialchars($profile['gender']); ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Age</th>
                        <td><?php echo htmlspecialchars($profile['age']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-muted">No profile details found. Please complete your profile.</p>
    <?php endif; ?>

    <!-- Link to Profile Page -->
    <a href="profile.php" class="btn btn-primary mt-3">Go to Profile</a>
</div>

<?php include 'footer.php'; ?>
<?php include 'copy.php'; ?>
