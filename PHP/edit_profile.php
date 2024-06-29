<?php
// Include database connection file
include 'db.php';

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['login_as'])) {
    header("Location: ../HTML/login.html");
    exit();
}

// Get the username and login_as from the session
$username = $_SESSION['username'];
$table = $_SESSION['login_as'];

// Prepare and execute the SQL query to fetch user data
$stmt = $pdo->prepare("SELECT Name, email, Mobile_No, username, interests, skills, experience FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit();
}

// Update user profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $interests = $_POST['interests'];
    $skills = $_POST['skills'];
    $experience = $_POST['experience'];

    $updateStmt = $pdo->prepare("UPDATE users SET Name = ?, email = ?, Mobile_No = ?, interests = ?, skills = ?, experience = ? WHERE username = ?");
    $updateStmt->execute([$name, $email, $mobile, $interests, $skills, $experience, $username]);

    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="..\CSS\styles.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="path_to_logo_image" alt="Logo">
        </div>
        <input type="text" class="search-bar" placeholder="Search">
        <nav>
            <a href="#">Home</a>
            <a href="#">My Network</a>
            <a href="#">Jobs</a>
            <a href="#">Messaging</a>
            <a href="#">Notifications</a>
        </nav>
    </div>

    <div class="second">
    <div class="left-profile">
    <div class="profile-photo">
        <img src="path_to_profile_photo" alt="Profile Photo">
        <form method="POST" action="edit_profile.php" enctype="multipart/form-data">
            <input type="file" name="profile_photo">
            <button type="submit" name="add_profile_photo">Add Profile Photo</button>
        </form>
    </div>
    <h3><?php echo htmlspecialchars($user['Name']); ?></h3>
    <p><?php echo htmlspecialchars($user['email']); ?></p>
</div>

        <div class="right-profile">
            <form method="POST" action="edit_profile.php">
                <div class="above">
                    <div class="logo1">
                        <div class="logo">
                            <img src="path_to_logo_image" alt="Logo">
                        </div>
                        <div class="logo-part">
                            <div class="heading1">
                                <h1>Edit Profile</h1>
                            </div>
                            <div class="para">
                                <p>Update your profile information</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="below">
                    <div class="experience">
                        <h2>Edit Basic Information</h2>
                        <label for="name">Name:</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($user['Name']); ?>" required>
                        <label for="email">Email:</label>
                        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        <label for="mobile">Mobile No:</label>
                        <input type="text" name="mobile" value="<?php echo htmlspecialchars($user['Mobile_No']); ?>" required>
                    </div>

                    <div class="interests">
                        <h2>Edit Interests</h2>
                        <label for="interests">Interests:</label>
                        <textarea name="interests" required><?php echo htmlspecialchars($user['interests']); ?></textarea>
                    </div>

                    <div class="skills">
                        <h2>Edit Skills</h2>
                        <label for="skills">Skills:</label>
                        <textarea name="skills" required><?php echo htmlspecialchars($user['skills']); ?></textarea>
                    </div>

                    <div class="experience">
                        <h2>Edit Experience</h2>
                        <label for="experience">Experience:</label>
                        <textarea name="experience" required><?php echo htmlspecialchars($user['experience']); ?></textarea>
                    </div>

                    <button type="submit" class="button">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>


<?php
//...

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //...

    if (isset($_POST['add_profile_photo'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir. basename($_FILES["profile_photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
        if ($check!== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["profile_photo"]["size"] > 500000) {
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType!= "jpg" && $imageFileType!= "png" && $imageFileType!= "jpeg") {
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file)) {
                // Update user profile photo in database
                $updateStmt = $pdo->prepare("UPDATE users SET profile_photo =? WHERE username =?");
                $updateStmt->execute([$target_file, $username]);

                // Redirect to profile page
                header("Location: profile.php");
                exit();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}

//...
?>