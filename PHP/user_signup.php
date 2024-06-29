<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    if(empty($username) || empty($pwd) || empty($fullname) || empty($email)){
        echo "Please fill all the fields";
    }
    else{
        require_once "db.php";
        $query="INSERT INTO users (username, pwd, email, name) VALUES (?, ?, ?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $pwd, $email, $fullname]);

        $pdo = null;
        $stmt = null;
        header("Location:../HTML/login.html");

        exit();
    }
}
else{
    header("location:../HTML/user_signup.html");
}