<?php
require_once 'connect.php';
session_start();

$login = $_POST['login'];
$password = $_POST['password'];

$check_user = mysqli_query($c, "SELECT * FROM `users` WHERE login = '$login'");
$user = mysqli_fetch_assoc($check_user);

if ($login == $user['login'] && password_verify($password, $user['password'])) {
    $_SESSION['user'] = array(
        'id' => $user['id'],
        'full_name' => $user['full_name'],
        'avatar' => $user['avatar'],
        'email' => $user['email']
    );

    $_SESSION['message'][] .= '<p class="success">Вход прошёл успешно</p>';
    header('Location: ../profile.php');
} else {
    $_SESSION['message'][] .= '<p class="error">Неверный логин или пароль</p>';
    header('Location: ../index.php');
}