<?php
include 'init.php'; // handles session, connect.php, sidebar
include 'navbar.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_pic'])) {
    if ($_FILES['profile_pic']['error'] === 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['profile_pic']['name']);
        $targetFile = $targetDir . uniqid() . "_" . $fileName;

        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetFile)) {
                $stmt = $conn->prepare("UPDATE user_profiles SET profile_pic = ? WHERE user_id = ?");
                $stmt->bind_param("si", $targetFile, $user_id);
                $stmt->execute();
                $stmt->close();

                $success = "Profile picture uploaded successfully!";
            } else {
                $error = "Error uploading file.";
            }
        } else {
            $error = "Invalid file type. Only JPG, JPEG, PNG & GIF allowed.";
        }
    } else {
        $error = "No file selected or upload error.";
    }
}
?>

<!-- Main Content -->
<div class="flex-grow-1 p-4">
    <h2 class="mb-4">Upload Profile Picture</h2>

    <?php if (isset($success)) : ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php elseif (isset($error)) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="profile_pic" class="form-label">Choose a profile picture</label>
            <input class="form-control" type="file" name="profile_pic" id="profile_pic" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>

<?php include 'footer.php'; ?>
<?php include 'copy.php'; ?>