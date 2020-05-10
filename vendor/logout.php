<?php
session_start();
unset($_SESSION['user']);
header('Location: ../index.php');
$_SESSION['message'][] .= '<p class="success">Вы вышли их аккаунта</p>';