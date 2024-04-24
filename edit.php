<?php

include "connect.php";

$name = $_POST['name'];
$second_name = $_POST['second_name'];
$gender = $_POST['gender'];
$group = $_POST['group'];
$ege_score = $_POST['ege_score'];
$birth_year = $_POST['birth_year'];
$locate = $_POST['locate'];

// Идентификация пользователя по секретному коду из куки
$secret_code = $_COOKIE['user_secret_code'];

// Обновление данных пользователя
$sql = "UPDATE students SET name = ?, second_name = ?, gender = ?, group_name = ?, ege_score = ?, birth_year = ?, locate = ? WHERE secret_code = ?";
$stmt = mysqli_prepare($con, $sql);

mysqli_stmt_bind_param($stmt, "ssssssss", $name, $second_name, $gender, $group, $ege_score, $birth_year, $locate, $secret_code);

if (mysqli_stmt_execute($stmt)) {
    header('Location: profile.php');
    exit;
} else {
    echo "Ошибка выполнения запроса: " . mysqli_error($con);
}

mysqli_stmt_close($stmt);
mysqli_close($con);
?>

