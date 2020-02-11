<?php

  $db_servername = "localhost";
  $db_username = "root";
  $db_password = "";

  $connection = new PDO("mysql:host=$db_servername;dbname=php-sandbox", $db_username, $db_password);

  $user_email = $_POST["email"];
  $user_name = $_POST["name"];
  $user_last_name = $_POST["lastname"];
  $user_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $statement = $connection->prepare("INSERT INTO persons (email, name, lastname, password) VALUES (?, ?, ?, ?)");
  $result = $statement->execute([$user_email, $user_name, $user_last_name, $user_password]);

?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles/index.css">
  </head>
  <body>
    <div class="main">
      <div class="actions-box actions-box__register">
        Your email address is: <?php echo ($user_email); ?><br>
        Your name is: <?php echo ($user_name); ?><br>
        Your last_name is: <?php echo ($user_last_name); ?><br>
        Your password is: <?php echo ($user_password); ?>
      </div>
    </div>
  </body>
</html>