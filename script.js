
function validateForm() {
    var name = document.forms["myForm"]["name"].value;
    var second_name = document.forms["myForm"]["second_name"].value;
    var gender = document.forms["myForm"]["gender"].value;
    var group = document.forms["myForm"]["group"].value;
    var email = document.forms["myForm"]["email"].value;
    var ege_score = document.forms["myForm"]["ege_score"].value;
    var birth_year = document.forms["myForm"]["birth_year"].value;
    var locate = document.forms["myForm"]["locate"].value;

    var errors = false;

    if (name == "" || second_name == "" || gender == "" || group == "" || email == "" || ege_score == "" || birth_year == "" || locate == "") {
        document.getElementById('nameError').textContent = "Все поля должны быть заполнены.";
        errors = true;
        return false;
    } else {
        document.getElementById('nameError').textContent = "";
    }

    var nameReg = /^[а-яА-ЯёЁ]{2,60}$/;
    if (!nameReg.test(name)) {
        document.getElementById('nameError').textContent = "Введите имя русскими буквами";
        document.forms["myForm"]["name"].classList.add('error');
        errors = true;
        return false;
    } else {
        document.getElementById('nameError').textContent = "";
        document.forms["myForm"]["name"].classList.remove('error'); // Удаляем класс .error
    }


    var second_nameReg = /^[а-яА-ЯёЁ]{2,60}$/;
    if (!second_nameReg.test(second_name)) {
        document.getElementById('second_nameError').textContent = "Введите фамилию русскими буквами";
        document.forms["myForm"]["second_name"].classList.add('error');// Добавляем класс .error
        errors = true;
        return false;
    }  else {
    document.getElementById('second_nameError').textContent = "";
    document.forms["myForm"]["name"].classList.remove('error'); // Удаляем класс .error
}

    var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailReg.test(email)) {
        document.getElementById('emailError').textContent = "Введите правильно адрес почты";
        document.forms["myForm"]["email"].classList.add('error');
        errors = true;
        return false;
    } else {
        document.getElementById('emailError').textContent = "";
        document.forms["myForm"]["email"].classList.remove('error'); // Удаляем класс .error
    }

    var groupReg = /^[0-9а-яА-Я]{2,5}$/;
    if (!groupReg.test(group)) {
        document.getElementById('groupError').textContent = "Введите правильно номер группы";
        document.forms["myForm"]["group"].classList.add('error');
        errors = true;
        return false;
    } else {
        document.getElementById('groupError').textContent = "";
        document.forms["myForm"]["group"].classList.remove('error'); // Удаляем класс .error
    }

    var egeScoreReg = /^(3[0-9]|[4-9][0-9]|100)$/;
    if (!egeScoreReg.test(ege_score)) {
        document.getElementById('ege_scoreError').textContent = "Введите правильно баллы ЕГЭ";
        document.forms["myForm"]["ege_score"].classList.add('error');
        errors = true;
        return false;
    } else {
        document.getElementById('ege_scoreError').textContent = "";
        document.forms["myForm"]["ege_score"].classList.remove('error'); // Удаляем класс .error
    }

    var birthYearReg = /^\d{4}$/;
    if (!birthYearReg.test(birth_year)) {
        document.getElementById('birth_yearError').textContent = "Введите правильно год рождения";
        document.forms["myForm"]["birth_year"].classList.add('error');
        errors = true;
        return false;
    } else {
        document.getElementById('birth_yearError').textContent = "";
        document.forms["myForm"]["birth_year"].classList.remove('error'); // Удаляем класс .error
    }

    return true;
}




