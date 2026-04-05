
<!-- Sidebar -->
    <div class="bg-dark text-white p-3 vh-100 d-flex flex-column" style="width: 220px;">
        <div class="text-center my-3">
            <?php if($profilePic): ?>
                <img src="<?php echo $profilePic; ?>" 
                alt="Profile Picture" 
                class="rounded-circle d-block mx-auto" 
                style="width: 100px; height: 100px; object-fit: cover;">
            <?php else: ?>
                <img src="uploads/default-avatar.png" 
                alt="Default Avatar" 
                class="rounded-circle d-block mx-auto" 
                style="width: 100px; height: 100px; object-fit: cover;">
            <?php endif; ?>
        </div>
        <h4 class="text-center">Menu</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white <?php if(basename($_SERVER['PHP_SELF']) == 'welcome.php') echo 'active'; ?>" href="welcome.php">Welcome</a>
            </li>            
            <li class="nav-item">
                <a class="nav-link text-white <?php if(basename($_SERVER['PHP_SELF']) == 'profile.php') echo 'active'; ?>" href="profile.php">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php if(basename($_SERVER['PHP_SELF']) == 'upload.php') echo 'active'; ?>" href="upload.php">Upload Picture</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php if(basename($_SERVER['PHP_SELF']) == 'about.php') echo 'active'; ?>" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="logout.php">Logout</a>
            </li>
        </ul>

    <!-- Delete Account Button (Pinned to Bottom) -->
    <div class="mt-auto">
        <form method="POST" action="delete.php" 
              onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
            <button type="submit" name="delete" 
                    class="btn btn-danger w-100 text-start">
                Delete Account
            </button>
        </form>
    </div>
    </div>