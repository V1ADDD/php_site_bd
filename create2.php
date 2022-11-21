<?php
if (isset($_POST["FIO"]) && isset($_POST["work"]) && isset($_POST["date_"]) && isset($_POST["pay"])) {

    $conn = new mysqli("localhost", "root", "", "torg");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
    $FIO = $conn->real_escape_string($_POST["FIO"]);
    $work = $conn->real_escape_string($_POST["work"]);
    $date_ = $conn->real_escape_string($_POST["date_"]);
    $pay = $conn->real_escape_string($_POST["pay"]);
    $sql = "INSERT INTO worker (FIO, work, date_, pay) VALUES ('$FIO', '$work', '$date_', $pay)";
    if($conn->query($sql)){
        header("Location: 1.php");
    } else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();
}
?>