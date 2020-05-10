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
  <title>Авторизация</title>
</head>
<body>

  <!-- Форма авторизации -->

  <form action="vendor/signin.php" method="post">
    <label>Логин</label>
    <input type="text" name="login" placeholder="Введите логин">
    <label>Пароль</label>
    <input type="password" name="password" placeholder="Введите пароль">
    <button type="submit">Войти</button>
    <p>
      У вас нет аккаунта? - <a href="register.php">Зарегистрируйтесь</a>
    </p>
    <div class="msg">
      <?php
        if (isset($_SESSION['message'])) {
          foreach ($_SESSION['message'] as $msg)
            echo $msg;
        }
        unset($_SESSION['message']);
        ?>
    </div>
  </form>

</body>
</html>