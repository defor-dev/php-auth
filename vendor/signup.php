<?php

session_start();
require_once 'connect.php'; // Подключаемся к БД

$full_name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if (is_null($full_name) || count(explode(' ', $full_name)) < 2) {
    $_SESSION['message'][] .= '<p class="error">Введите имя и фамилию</p>';
}

if (empty($login) || strlen($login) < 3) {
    $_SESSION['message'][] .= '<p class="error">Введите логин(не меньше 3 символов)</p>';
}

if (empty($email) || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'][] .= '<p class="error">Введите почту</p>';

}

if (strlen($password) >= 6) {
    $patternNum = '/[0-9]/';
    $patternChar = '/[a-zA-Z]/';

    preg_match($patternNum, $password, $matchesNum);
    preg_match($patternChar, $password, $matchesChar);

    if (empty($matchesNum) || empty($matchesChar)) { // Поиск чисел И букв в пароле
        $_SESSION['message'][] .= '<p class="error">Пароль должен содержать больше 6 букв и цифр</p>';
    }

} else {
    $_SESSION['message'][] .= '<p class="error">Пароль должен содержать больше 6 букв и цифр</p>';

}

if ($password !== $password_confirm) {
    $_SESSION['message'][] .= '<p class="error">Пароли не совпадают</p>';
}

if (isset($_SESSION['message'])) {
    $_SESSION['fields'] = array(
        'full_name' => $full_name,
        'login' => $login,
        'email' => $email
    );

    header('Location: ../register.php');

} else {
    $path = 'uploads/' . time() . $_FILES['avatar']['name']; // Путь до фото профиля
    if (! move_uploaded_file($_FILES['avatar']['tmp_name'], '../'.$path)) { // Перемещение фото в папку uploads
        $_SESSION['message'][] .= '<p class="error">Ошибка при загрузке фото</p>';
        header('Location: ../register.php');
    } else {
        $password = password_hash($password, CRYPT_BLOWFISH);

        mysqli_query($c, "INSERT INTO `users` (
	                        `id`, `full_name`, `login`, `email`, `password`, `avatar`
	                        ) VALUES (NULL, '$full_name', '$login', '$email', '$password', '$path')");

        $_SESSION['message'][] .= '<p class="success">Регистрация прошла успешно</p>';
        unset($_SESSION['fields']);
        header('Location: ../index.php');
    }
}