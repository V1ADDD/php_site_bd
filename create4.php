<?php
if (isset($_POST["date_pr"]) && isset($_POST["count_"]) && isset($_POST["tovar"]) && isset($_POST["zakazchik"]) && isset($_POST["FIO"])) {

    $conn = new mysqli("localhost", "root", "", "torg");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
    $date_pr = $conn->real_escape_string($_POST["date_pr"]);
    $count_ = $conn->real_escape_string($_POST["count_"]);
    if($result=$conn->query("select id from tovary where name_ = '".$conn->real_escape_string($_POST["tovar"])."'")){
    foreach($result as $row){
        $id_tov = $row["id"];
    }
    }
    if($result=$conn->query("select id from zakazch where name_ = '".$conn->real_escape_string($_POST["zakazchik"])."'")){
    foreach($result as $row){
        $id_zkzch = $row["id"];
    }
    }
    if($result=$conn->query("select id from worker where FIO = '".$conn->real_escape_string($_POST["FIO"])."'")){
    foreach($result as $row){
        $id_pass = $row["id"];
    }
    }
    $sql = "INSERT INTO zakaz (date_pr, count_, id_tov, id_zkzch, id_pass) VALUES ('$date_pr', $count_, $id_tov, $id_zkzch, $id_pass)";
    if($conn->query($sql)){
        header("Location: 1.php");
    } else{
        echo "Ошибка: " . $conn->error;
    }
    $conn->close();
}
?>