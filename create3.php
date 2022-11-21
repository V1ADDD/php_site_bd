<?php
if (isset($_POST["name_"]) && isset($_POST["phone"]) && isset($_POST["limitk"])) {

    $conn = new mysqli("localhost", "root", "", "torg");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
    $name_ = $conn->real_escape_string($_POST["name_"]);
    $phone = $conn->real_escape_string($_POST["phone"]);
    $limitk = $conn->real_escape_string($_POST["limitk"]);
    $sql = "INSERT INTO zakazch (name_, phone, limitk) VALUES ('$name_', '$phone', $limitk)";
    if($conn->query($sql)){
        header("Location: 1.php");
    } else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();
}
?>