<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $table = $_POST['user_type'];
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    if(empty($username) || empty($pwd) || empty($fullname) || empty($email) || empty($table)){
        echo "Please fill all the fields";
    }
    else{
        require_once "db.php";

        $validTables = ['users', 'company']; 
        if (!in_array($table, $validTables)) {
            echo "Invalid table selected.";
            exit;
        }
        if($table === "users"){
        $query="INSERT INTO $table (username, pwd, email, name) VALUES (?, ?, ?, ?);";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username, $pwd, $email, $fullname]);
        }

        if($table === "company"){
            $query="INSERT INTO $table (c_name, pwd, email, type) VALUES (?, ?, ?, ?);";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, $pwd, $email, $fullname]);
        }

        $pdo = null;
        $stmt = null;
        header("Location:../HTML/login.html");

        exit();
    }
}
else{
    header("location:../HTML/user_signup.html");
}