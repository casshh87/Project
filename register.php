<?php

if (!isset($_COOKIE['user_secret_code']) || empty($_COOKIE['user_secret_code'])) {
    // Кука не установлена или пуста
} else {
    header('Location: profile.php');
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Document</title>
</head>
<body>

<a href="index.php">Главная</a>

<form id="registrationForm" name="myForm" action="add_user.php" method="post" onsubmit="return validateForm()">

    <label>Ваше имя:</label>
    <span class="error-message" id="nameError"></span>
    <input name="name" type="text" required>


    <label>Ваша фамилия:</label>
    <span class="error-message" id="second_nameError"></span>
    <input name="second_name" type="text" required>

    <fieldset>
        <legend>Ваш пол:</legend>

        <div>
            <input type="radio" name="gender" value="мужской" checked/>
            <label>мужской</label>
        </div>

        <div>
            <input type="radio" name="gender" value="женский"/>
            <label>женский</label>
        </div>

    </fieldset>

    <label>Номер группы:</label>
    <span class="error-message" id="groupError"></span>
    <input name="group" type="text" required>


    <label>Ваш email:</label>
    <span class="error-message" id="emailError"></span>
    <input type="email" id="emailForm" name="email" required>


    <label>Баллы на ЕГЭ:</label>
    <span class="error-message" id="ege_scoreError"></span>
    <input name="ege_score" type="number" required>

    <label>Год рождения:</label>
    <span class="error-message" id="birth_yearError"></span>
    <input name="birth_year" type="number" required>

    <p>Вы местный или иногородний:</p>
    <div>
        <input type="radio" name="locate" value="Местный" checked/>
        <label>Местный</label>

        <input type="radio" name="locate" value="Иногородний"/>
        <label>Иногородний</label>

    </div>

    <button type="submit" value="Register">Отправить</button>
</form>
</body>
</html>






