<!DOCTYPE html>
<html>
<head>
	<title>TORG_Co</title>
</head>
<body>
<?php
	echo "<link rel='stylesheet' href='style.css'>";
    $conn = new mysqli("localhost", "root", "", "torg");
    if($conn->connect_error){
        die("Ошибка: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM tovary";
    if($result = $conn->query($sql)){
	  echo "<center><datalist id='tovary'>";
        foreach($result as $row){
		echo "<option value='".$row["name_"]."'>";
        }
	  echo "</datalist>";
        echo "<div><h1>Товары</h1>";
        echo "<table border=1px><tr><th>Название</th><th>Цена</th><th>На складе</th></tr>";
        foreach($result as $row){
            echo "<tr>";
                echo "<td>" . $row["name_"] . "</td>";
                echo "<td>" . $row["prc"] . "</td>";
                echo "<td>" . $row["sklad"] . "</td>";
                echo "<td><form action='delete1.php' method='post'>
                <input type='hidden' name='id' value='" . $row["id"] . "' />
                <input type='submit' value='Удалить'>
                </form></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br><form action='create1.php' method='post'>
            <input type='text' name='name_' autocomplete='off' required/>
            <input type='number' name='prc' autocomplete='off' required/>
            <input type='number' name='sklad' autocomplete='off' required/>
            <input type='submit' value='Добавить'>
        </form><hr>";
        $result->free();
    } else{
        echo "Ошибка: " . $conn->error;
        }
    $sql = "SELECT * FROM worker";
    if($result = $conn->query($sql)){
	  echo "<datalist id='rabotniki'>";
        foreach($result as $row){
		echo "<option value='".$row["FIO"]."'>";
        }
	  echo "</datalist>";
        echo "<h1>Работники</h1>";
        echo "<table border=1px><tr><th>ФИО</th><th>Должность</th><th>Дата</th><th>Зарплата</th></tr>";
        foreach($result as $row){
            echo "<tr>";
                echo "<td>" . $row["FIO"] . "</td>";
                echo "<td>" . $row["work"] . "</td>";
                echo "<td>" . $row["date_"] . "</td>";
                echo "<td>" . $row["pay"] . "</td>";
                echo "<td><form action='delete2.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "' />
                        <input type='submit' value='Удалить'>
                </form></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br><form action='create2.php' method='post'>
            <input type='text' name='FIO' autocomplete='off' required/>
            <input type='text' name='work' autocomplete='off' required/>
            <input type='date' name='date_' autocomplete='off' required/>
            <input type='number' name='pay' autocomplete='off' required/>
            <input type='submit' value='Добавить'>
        </form><hr>";
        $result->free();
    } else{
        echo "Ошибка: " . $conn->error;
    }
    $sql = "SELECT * FROM zakazch";
    if($result = $conn->query($sql)){
	  echo "<datalist id='zkzchiki'>";
        foreach($result as $row){
		echo "<option value='".$row["name_"]."'>";
        }
	  echo "</datalist>";
        echo "<h1>Заказчики</h1>";
        echo "<table border=1px><tr><th>Компания</th><th>Телефон</th><th>Лимит кредита</th></tr>";
        foreach($result as $row){
            echo "<tr>";
                echo "<td>" . $row["name_"] . "</td>";
                echo "<td>" . $row["phone"] . "</td>";
                echo "<td>" . $row["limitk"] . "</td>";
                echo "<td><form action='delete3.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "' />
                        <input type='submit' value='Удалить'>
                </form></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br><form action='create3.php' method='post'>
            <input type='text' name='name_' autocomplete='off' required/>
            <input type='text' name='phone' autocomplete='off' required/>
            <input type='number' name='limitk' autocomplete='off' required/>
            <input type='submit' value='Добавить'>
        </form><hr>";
        $result->free();
    } else{
        echo "Ошибка: " . $conn->error;
        }
	$sql = "SELECT zakaz.id, zakaz.date_pr, zakaz.count_, tovary.name_ as tovar, zakazch.name_ as zakazchik, worker.FIO FROM zakaz inner join tovary on zakaz.id_tov=tovary.id inner join worker on zakaz.id_pass=worker.id inner join zakazch on zakaz.id_zkzch=zakazch.id";
    if($result = $conn->query($sql)){
        echo "<h1>Заказы</h1>";
        echo "<table border=1px><tr><th>Дата</th><th>Количество</th><th>Товар</th><th>Заказчик</th><th>Оформил</th></tr>";
        foreach($result as $row){
            echo "<tr>";
                echo "<td>" . $row["date_pr"] . "</td>";
                echo "<td>" . $row["count_"] . "</td>";
                echo "<td>" . $row["tovar"] . "</td>";
		    echo "<td>" . $row["zakazchik"] . "</td>";
		    echo "<td>" . $row["FIO"] . "</td>";
                echo "<td><form action='delete4.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "' />
                        <input type='submit' value='Удалить'>
                </form></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br><form action='create4.php' method='post'>
            <input type='date' name='date_pr' autocomplete='off' required />
            <input type='number' name='count_' autocomplete='off' required/>
		<input type='text' name='tovar' list='tovary' autocomplete='off' required/>
		<input type='text' name='zakazchik' list='zkzchiki' autocomplete='off' required/>
		<input type='text' name='FIO' list='rabotniki' autocomplete='off' required/>
            <input type='submit' value='Добавить'>
        </form><hr>";
        $result->free();
    } else{
        echo "Ошибка: " . $conn->error;
        }
    echo "<h1>Запросы:</h1>";
    echo "<form action='zaprosy.php' method='post'>";
    echo "<select onchange='func(this);' name='zaprosy'>";
    echo "<option value=1>Фамилии «Менеджеров» с окладом меньше 1000.</option>";
    echo "<option value=2>Информацию о сотрудниках, принятых на работу в текущем месяце.</option>";
    echo "<option value=3>Выведите минимальный лимит кредита.</option>";
    echo "<option value=4>Выведите всю информацию о заданном товаре (название товара вводит пользователь).</option>";
    echo "<option value=5>Посчитайте общее количество заказанного товара.</option>";
    echo "</select>";
    echo "<input type='text' name='tovar' list='tovary' autocomplete='off' /><input type='submit' value='Выполнить'>";
    echo "</form></div></center>";
    $conn->close();
?>
</body>
<html>