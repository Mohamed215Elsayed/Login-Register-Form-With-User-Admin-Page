<?php
try {
    $conn = new PDO("mysql:host=127.0.0.1;port=3308;dbname=simple_admin_user_L_R", "root", "");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception
    // echo "Connected successfully"."<br>";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
