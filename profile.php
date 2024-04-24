<?php
session_start();

if (isset($_SESSION['registration_success'])) {
    echo $_SESSION['registration_success'];
    // Очистка сообщения об успешной регистрации из сессии
    unset($_SESSION['registration_success']);
}

// Извлечение всех кук
$cookies = $_COOKIE;
$secretCode = isset($_COOKIE['user_secret_code']) ? $_COOKIE['user_secret_code'] : null;
if (!$secretCode) {
    // Кука не установлена или пуста
    header('Location: register.php');
    exit; // Добавлено для предотвращения дальнейшего выполнения кода
}

include "connect.php";

// Запрос к базе данных для получения данных пользователя по секретному коду
$query = "SELECT * FROM students WHERE secret_code = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $secretCode); // Предполагается, что $secretCode содержит секретный код пользователя
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    // Функция для валидации имени и фамилии
    function validateName(input, errorId, regex) {
        var errorElement = document.getElementById(errorId);
        if (!regex.test(input.value)) {
            errorElement.textContent = 'Должно состоять только из русских букв';
            input.classList.add('invalid');
        } else {
            errorElement.textContent = '';
            input.classList.remove('invalid');
        }
    }

    // Функция для валидации номера группы, баллов на ЕГЭ и года рождения
    function validateField(input, errorId, regex) {
        var errorElement = document.getElementById(errorId);
        if (!regex.test(input.value)) {
            errorElement.textContent = 'Неверный формат';
            input.classList.add('invalid');
        } else {
            errorElement.textContent = '';
            input.classList.remove('invalid');
        }
    }

    // Привязка обработчиков событий к полям ввода
    document.getElementsByName('name')[0].addEventListener('input', function() {
        validateName(this, 'nameError', /^[а-яА-ЯёЁ]+$/);
    });

    document.getElementsByName('second_name')[0].addEventListener('input', function() {
        validateName(this, 'second_nameError', /^[а-яА-ЯёЁ]+$/);
    });

    document.getElementsByName('group')[0].addEventListener('input', function() {
        validateField(this, 'groupError', /^[0-9a-zA-Z]{2,5}$/);
    });

    document.getElementsByName('ege_score')[0].addEventListener('input', function() {
        validateField(this, 'ege_scoreError', /^(3[0-9]|[4-9][0-9]|100)$/);
    });

    document.getElementsByName('birth_year')[0].addEventListener('input', function() {
        validateField(this, 'birth_yearError', /^\d{4}$/);
    });

    // Функция для валидации формы перед отправкой
    function validateForm(event) {
        var isValid = true;
        var inputs = document.querySelectorAll('input[type="text"], input[type="number"]');
        inputs.forEach(function(input) {
            if (input.classList.contains('invalid')) {
                isValid = false;
            }
        });

        if (!isValid) {
            event.preventDefault();
            alert('Пожалуйста, исправьте ошибки в форме перед отправкой.');
        }
    }

    // Привязка обработчика события к форме
    document.getElementById('editForm').addEventListener('submit', validateForm);
});
</script>


    </script>
    <title>Профиль</title>
</head>
<body>
<br>
<a href="index.php">Главная</a>
<br>
<form id="editForm" name="editForm" action="edit.php" method="post">
    <label>Ваше имя:</label>
    <span class="error-message" id="nameError"></span>
    <input name="name" type="text" required value="<?php echo htmlspecialchars($userData['name']); ?>">

    <label>Ваша фамилия:</label>
    <span class="error-message" id="second_nameError"></span>
    <input name="second_name" type="text" required value="<?php echo htmlspecialchars($userData['second_name']); ?>">

    <fieldset>
        <legend>Ваш пол:</legend>
        <select name="gender" id="gender">
            <option value="мужской" <?php echo $userData['gender'] == 'мужской' ? 'selected' : ''; ?>>мужской</option>
            <option value="женский" <?php echo $userData['gender'] == 'женский' ? 'selected' : ''; ?>>женский</option>
        </select>
    </fieldset>

    <label>Номер группы:</label>
    <span class="error-message" id="groupError"></span>
    <input name="group" type="text" required value="<?php echo htmlspecialchars($userData['group_name']); ?>">

    <label>Баллы на ЕГЭ:</label>
    <span class="error-message" id="ege_scoreError"></span>
    <input name="ege_score" type="number" required value="<?php echo htmlspecialchars($userData['ege_score']); ?>">

    <label>Год рождения:</label>
    <span class="error-message" id="birth_yearError"></span>
    <input name="birth_year" type="number" required value="<?php echo htmlspecialchars($userData['birth_year']); ?>">

    <p>Вы местный или иногородний:</p>
    <div>
        <input type="radio" name="locate" value="Местный" <?php echo $userData['locate'] == 'Местный' ? 'checked' : ''; ?>>
        <label>Местный</label>

        <input type="radio" name="locate" value="Иногородний" <?php echo $userData['locate'] == 'Иногородний' ? 'checked' : ''; ?>>
        <label>Иногородний</label>
    </div>

    <button type="submit" value="Edit">Редактировать</button>
</form>

<footer>
    <div class="cookies-container">
        <ul>
            <?php foreach ($cookies as $name => $value): ?>
                <li><strong><?php echo htmlspecialchars($name); ?>:</strong> <?php echo htmlspecialchars($value); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</footer>
</body>
</html>
