<?php

session_start();
require_once 'connect.php'; // Подключаемся к БД

$full_name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if ($password === $password_confirm) {
    $path = 'uploads/' . time() . $_FILES['avatar']['name']; // Путь до фото профиля
    if (! move_uploaded_file($_FILES['avatar']['tmp_name'], '../'.$path)) { // Перемещение фото в папку uploads
        $_SESSION['message'] = 'Ошибка при загрузке фото';
    }

    $password = password_hash($password, CRYPT_BLOWFISH);

    mysqli_query($c, "INSERT INTO `users` (
	                        `id`, `full_name`, `login`, `email`, `password`, `avatar`
	                        ) VALUES (NULL, '$full_name', '$login', '$email', '$password', '$path')");

    $_SESSION['message'] = '<p class="success">Регистрация прошла успешно</p>';
    header('Location: ../index.php');
} else {
    $_SESSION['fields'] = array(
        'full_name' => $full_name,
        'login' => $login,
        'email' => $email
    );
    $_SESSION['message'] = '<p class="error">Пароли не совпадают</p>';
    header('Location: ../register.php');
}
