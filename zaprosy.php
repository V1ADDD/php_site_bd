<!DOCTYPE html>
<html>
<head>
	<title>Result</title>
</head>
<body class='b1'>
<?php
   echo "<link rel='stylesheet' href='style.css'><center><div>";
   $zprs = $_POST['zaprosy'];
   $tvr = $_POST['tovar'];
   $conn = new mysqli("localhost", "root", "", "torg");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
	if($zprs==1){
	$sql = "SELECT FIO FROM worker where pay<1000 and work='b'";
    if($result = $conn->query($sql)){
        echo "<table name='zapros1' border=1px><tr><th>Фамилия</th></tr>";
        foreach($result as $row){
            echo "<tr>";
                echo "<td>" . $row["FIO"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        $result->free();
    } else{
        echo "Ошибка: " . $conn->error;
        }
}
if($zprs==2){

    $sql = "SELECT * from worker where month(date_)=month(now()) and year(date_)=year(now())";
    if($result = $conn->query($sql)){
        echo "<table name='zapros2' border=1px><tr><th>ФИО</th><th>Должность</th><th>Дата</th><th>Зарплата</th></tr>";
        foreach($result as $row){
            echo "<tr>";
                echo "<td>" . $row["FIO"] . "</td>";
                echo "<td>" . $row["work"] . "</td>";
                echo "<td>" . $row["date_"] . "</td>";
                echo "<td>" . $row["pay"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        $result->free();
    } else{
        echo "Ошибка: " . $conn->error;
        }
}
if($zprs==3){
    $sql = "SELECT min(limitk) as m FROM zakazch";
    if($result = $conn->query($sql)){
        echo "<table name='zapros3' border=1px><tr><th>Лимит</th></tr>";
        foreach($result as $row){
            echo "<tr>";
                echo "<td>" . $row["m"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        $result->free();
    } else{
        echo "Ошибка: " . $conn->error;
        }
}
if($zprs==4){
	 $sql = "SELECT * FROM tovary where name_='$tvr'";
    if($result = $conn->query($sql)){
        echo "<table name='zapros4' border=1px><tr><th>Название</th><th>Цена</th><th>На складе</th></tr>";
        foreach($result as $row){
            echo "<tr>";
                echo "<td>" . $row["name_"] . "</td>";
                echo "<td>" . $row["prc"] . "</td>";
                echo "<td>" . $row["sklad"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        $result->free();
    } else{
        echo "Ошибка: " . $conn->error;
        }
}
if($zprs==5){
    $sql = "SELECT sum(count_) as Total FROM zakaz";
    if($result = $conn->query($sql)){
        echo "<table name='zapros5' border=1px><tr><th>Заказов</th></tr>";
        foreach($result as $row){
            echo "<tr>";
                echo "<td>" . $row["Total"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        $result->free();
    } else{
        echo "Ошибка: " . $conn->error;
        }
}
    $conn->close();
?>
</body>
<html>