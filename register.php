<?php
  session_start();

  if (isset($_SESSION['user'])) {
    header('Location: profile.php');
  }
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="assets/css/main.css">
  <title>Регистрация</title>
</head>
<body>

  <!-- Форма регистрации -->
  <!-- TODO: Сделать проверку полей, чтобы ФИО содержало три слова, логин был не меньше 3х символов, почта была корректной -->

  <form action="vendor/signup.php" method="post" enctype="multipart/form-data">
    <label>ФИО</label>
    <input type="text" name="full_name" value="<?= $_SESSION['fields']['full_name'] ?? '' ?>" placeholder="Введите полное имя">
    <label>Логин</label>
    <input type="text" name="login" value="<?= $_SESSION['fields']['login'] ?? '' ?>" placeholder="Введите логин">
    <label>Почта</label>
    <input type="email" name="email" value="<?= $_SESSION['fields']['email'] ?? '' ?>" placeholder="Введите почту">
    <label>Фото профиля</label>
    <input type="file" name="avatar">
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите пароль">
    <label>Подтверждение пароля</label>
    <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
    <button type="submit">Регистрация</button>

    <p>
      У вас уже есть аккаунт? - <a href="index.php">Авторизируйтесь</a>
    </p>
      <?php
        if (isset($_SESSION['message'])) {
          echo $_SESSION['message'];
        }
        unset($_SESSION['message']);
      ?>
  </form>
</body>
</html>