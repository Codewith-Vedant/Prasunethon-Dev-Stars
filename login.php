<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST["login_as"];
    $username = $_POST["username"];
    $pwd = $_POST["password"];

    if (empty($username) || empty($pwd)) {
        echo "Username or Password is not filled.";
    } else {
        require_once "db.php";

        // Validate the table name to avoid SQL injection
        $validTables = ['users', 'company']; 
        if (!in_array($table, $validTables)) {
            echo "Invalid table selected.";
            exit;
        }

        $query = "SELECT * FROM `$table` WHERE username = :username AND pwd = :pwd";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':pwd', $pwd);
        $stmt->execute();
        $results = $stmt->fetchAll();

        if (empty($results)) {
            echo "Username or Password is not correct.";
        } else {
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["login_as"] = $table;
            header("Location: ../html/dashboard.html"); 
            exit;
        }
    }
} else {
    header("Location: ../html/login.html");
    exit;
}
?>