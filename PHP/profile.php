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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="..\CSS\styles.css">
</head>
<body>
    <div class="header">
        <div class="logo">
            <img src="" alt="Logo">
        </div>
        <input type="text" class="search-bar" placeholder="Search">
        <nav>
            <a href="../HTML/dashboard.html">HOME</a>
            <a href="../HTML/inbox.html">INBOX</a>
            <a href="edit_profile.php">SETTINGS</a>
            <a href="profile.php"><u>PROFILE</u></a>
        </nav>
    </div>
    <div class="second">
        <div class="left-profile">
            <div class="profile-photo">
                <img src="" alt="Profile Photo">
            </div>
            <h2><?= htmlspecialchars($user['Name']); ?></h2>
            <p><?= htmlspecialchars($user['email']); ?></p>
            <p><?= htmlspecialchars($user['Mobile_No']); ?></p>
        </div>
        <div class="right-profile">
            <div class="above">
                <p>Followers</p>
                <div class="new logo1">
                    <div class="logo">
                        <img src="" alt="New Logo">
                    </div>
                    <div class="logo-part">
                        <h2 class="heading1"><?= htmlspecialchars($user['Name']); ?></h2>
                    </div>
                </div>
                <p>Followers</p>
                <div class="second logo1">
                    <div class="logo">
                        <img src="" alt="Second Logo">
                    </div>
                    <div class="logo-part">
                        <h2 class="heading1"><?= htmlspecialchars($user['Name']); ?></h2>
                        
                    </div>
                </div>
            </div>
            <div class="below">
                <p>Followers</p>
                <div class="third logo1">
                    <div class="logo">
                        <img src="" alt="Third Logo">
                    </div>
                    <div class="logo-part">
                        <h2 class="heading1"><?= htmlspecialchars($user['Name']); ?></h2>
                        
                    </div>
                </div>
                <p>Followers</p>
                <div class="fourth logo1">
                    <div class="logo">
                        <img src="" alt="Fourth Logo">
                    </div>
                    <div class="logo-part">
                        <h2 class="heading1"><?= htmlspecialchars($user['Name']); ?></h2>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="activity">
        <h2>Activity</h2>
        <p>1000 followers</p>
        <button>Create a post</button>
        <div class="post-buttons">
            <button>Posts</button>
            <button>Comments</button>
            <button>Videos</button>
            <button>Images</button>
            <button>Likes</button>
        </div>
        <div class="post">
            <div class="post-photo">Photo</div>
            <p>Description</p>
        </div>
    </div>
    <div class="experience">
        <h2>Experience</h2>
        <div class="experience-item">
            <div class="company-logo">
                <img src="" alt="Company Logo">
            </div>
            <p><?= htmlspecialchars($user['experience']); ?></p>
        </div>
        <!-- Add more experience items as needed -->
    </div>
    <div class="skills">
        <h2>Skills</h2>
        <div class="skill-item">
            <div class="skill-logo">
                <img src="" alt="Skill Logo">
            </div>
            <h3>Skill Name</h3>
            <p><?= ":-    " . htmlspecialchars($user['skills']); ?></p>
        </div>
        <!-- Add more skill items as needed -->
    </div>
    <div class="interests">
        <h2>Interests</h2>
        <div class="interest-item">
            <div class="interest-logo">
                <img src="" alt="Interest Logo">
            </div>
            <h3>Interest Name</h3>
            <p><?= ":-    " . htmlspecialchars($user['interests']); ?></p>
        </div>
        <!-- Add more interest items as needed -->
    </div>
    <script src="..\JS\script.js"></script>
</body>
</html>