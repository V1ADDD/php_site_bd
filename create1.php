<?php
if (isset($_POST["name_"]) && isset($_POST["prc"]) && isset($_POST["sklad"])) {

    $conn = new mysqli("localhost", "root", "", "torg");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
    $name_ = $conn->real_escape_string($_POST["name_"]);
    $prc = $conn->real_escape_string($_POST["prc"]);
    $sklad = $conn->real_escape_string($_POST["sklad"]);
    $sql = "INSERT INTO tovary (name_, prc, sklad) VALUES ('$name_', $prc, $sklad)";
    if($conn->query($sql)){
        header("Location: 1.php");
    } else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();
}
?>