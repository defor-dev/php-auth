<?php
  session_start();
  if (! isset($_SESSION['user'])) {
      header('Location: index.php');
  }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Профиль</title>
</head>
<body>

<!-- Профиль -->

<form>
  <img src="<?= $_SESSION['user']['avatar'] ?>" width="100" alt="avatar">
  <h2><?= $_SESSION['user']['full_name'] ?></h2>
  <a href="mailto:<?= $_SESSION['user']['email'] ?>"><?= $_SESSION['user']['email'] ?></a>
  <a href="vendor/logout.php" class="logout">Выход</a>
    <?php
      if (isset($_SESSION['message'])) {
          foreach ($_SESSION['message'] as $msg)
              echo $msg;
      }
      unset($_SESSION['message']);
    ?>
</form>

</body>
</html>