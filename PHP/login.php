<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST["login_as"];
    $username = $_POST["username"];
    $pwd = $_POST["password"];

    if (empty($username) || empty($pwd)) {
        echo "Username or Password is not filled.";
        header("Location: ../HTML/login.html");
        exit;
    } else {
        require_once "db.php";

        // Validate the table name to avoid SQL injection
        $validTables = ['users', 'company']; 
        if (!in_array($table, $validTables)) {
            echo "Invalid table selected.";
            header("Location: ../HTML/login.html");
            exit;
        }

        if($table == "users"){
        $query = "SELECT * FROM `$table` WHERE username = :username AND pwd = :pwd";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':pwd', $pwd);
        $stmt->execute();
        $results = $stmt->fetchAll();

        if (empty($results)) {
            echo "Username or Password is not correct.";
            header("Location: ../HTML/login.html");
            exit;
        } else {
            $_SESSION["username"] = $username;
            $_SESSION["login_as"] = $table;
            header("Location: ../HTML/dashboard.html"); 
            exit;
        }
    }

    if($table == "company"){
        $query = "SELECT * FROM `$table` WHERE c_name = :username AND pwd = :pwd";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':pwd', $pwd);
        $stmt->execute();
        $results = $stmt->fetchAll();

        if (empty($results)) {
            echo "Username or Password is not correct.";
            header("Location: ../HTML/login.html");
            exit;
        } else {
            $_SESSION["username"] = $username;
            $_SESSION["login_as"] = $table;
            header("Location: ../HTML/dashboard.html"); 
            exit;
        }
    }
    }
} else {
    header("Location: ../HTML/login.html");
    exit;
}
?>
