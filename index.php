<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<h2>Список Абитируентов</h2>
<a href="register.php">Регистрация</a>
<form action="search.php" method="get" class="search-form">
    <input type="text" name="search" placeholder="Поиск по имени или фамилии">
    <input type="submit" value="Найти">
</form>

<table width="100%" border="1" cellpadding="4" cellspacing="0">
    <tr>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>номер группы</th>
        <th>баллы ЕГЭ</th>
    </tr>
    <?php
    include "connect.php";
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 50;
    $offset = ($page - 1) * $limit;
    $student = mysqli_query($con, "SELECT * FROM `students` LIMIT $limit OFFSET $offset");
    $students = mysqli_fetch_all($student, MYSQLI_ASSOC);
    foreach ($students as $student) {
        ?>
        <tr>
            <td><?php echo $student['name']; ?></td>
            <td><?php echo $student['second_name']; ?></td>
            <td><?php echo $student['group_name']; ?></td>
            <td><?php echo $student['ege_score']; ?></td>
        </tr>
        <?php
    }
    ?>
</table>

<!-- Пагинация -->
<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>">Предыдущая</a>
    <?php endif; ?>
    <span>Страница <?php echo $page; ?></span>
    <?php
    $total_students = mysqli_query($con, "SELECT COUNT(*) FROM `students`");
    $total_students = mysqli_fetch_row($total_students)[0];
    $total_pages = ceil($total_students / $limit);
    if ($page < $total_pages): ?>
        <a href="?page=<?php echo $page + 1; ?>">Следующая</a>
    <?php endif; ?>
</div>

</body>
</html>
