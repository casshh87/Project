<?php
session_start();
include "connect.php";


$name = $_POST['name'];
$second_name = $_POST['second_name'];
$gender = $_POST["gender"];
$group_name = $_POST["group"];
$email = $_POST["email"];
$ege_score = $_POST["ege_score"];
$birth_year = $_POST["birth_year"];
$locate = $_POST["locate"];

//Проверка уникальности почты
$sql = "SELECT * FROM students WHERE email = '$email'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    header('Refresh: 0; register.html');

    echo '<script type="text/javascript">
    alert("Пользователь с таким адресом почты уже существует!");
</script>';
    exit;
}

// Подготовка SQL-запроса
$stmt = $con->prepare("INSERT INTO students (name, second_name, gender, group_name, email, ege_score, birth_year, locate) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

// Привязка параметров к запросу
$stmt->bind_param("ssssssss", $name, $second_name, $gender, $group_name, $email, $ege_score, $birth_year, $locate);

// Выполнение запроса
if ($stmt->execute()) {
// Генерация секретного кода и установка кук
    $secretCode = bin2hex(random_bytes(16));
    $userId = mysqli_insert_id($con);

// Подготовка и выполнение запроса
    $sql = "UPDATE students SET secret_code = ? WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $secretCode, $userId);
    if ($stmt->execute()) {
        setcookie("user_secret_code", $secretCode, time() + (10 * 365 * 24 * 60 * 60), "/"); // Куки на 10 лет
        // Выводим уведомление о успешной регистрации
        $_SESSION['registration_success'] = "спасибо, данные сохранены, вы можете при желании их отредактировать";
        header("Location: profile.php");
    } else {
        // Обработка ошибок
        echo "Ошибка при добавлении пользователя: " . $stmt->error;
    }
}


// Закрытие соединения
$stmt->close();
$con->close();


?>






