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
<?php
include "connect.php";

$search = isset($_GET['search']) ? $_GET['search'] : '';
$search = mysqli_real_escape_string($con, $search);
?>
<h2>Результаты поиска по запросу <?php echo htmlspecialchars($search ?? ''); ?></h2>
<a href="index.php">Главная</a>

<table width="100%" border="1" cellpadding="4" cellspacing="0">
    <tr>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>номер группы</th>
        <th>баллы ЕГЭ</th>
    </tr>
    <?php
    if ($search) {
        $search = strtolower($search); // Преобразование в нижний регистр для регистронезависимого поиска
        $student = mysqli_query($con, "SELECT * FROM `students` WHERE LOWER(`name`) LIKE '%$search%' OR LOWER(`second_name`) LIKE '%$search%' OR LOWER(`group_name`) LIKE '%$search%' OR LOWER(`ege_score`) LIKE '%$search%'");
    } else {
        $student = mysqli_query($con, "SELECT * FROM `students`");
    }
    
    $students = mysqli_fetch_all($student, MYSQLI_ASSOC);
    
    function highlightWords($string, $word) {
        $string = str_replace($word, "<span class='highlight'>".$word."</span>", $string);
        return $string;
    }
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
</body>
</html>
