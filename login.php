<?php 

  $db_servername = "localhost";
  $db_username = "root";
  $db_password = "";

  $connection = new PDO("mysql:host=$db_servername;dbname=php-sandbox", $db_username, $db_password);

  $user_input_email = $_POST["email"];
  $user_input_password = $_POST["password"];

  $std_user_email = $connection->query("SELECT * FROM persons WHERE email = '" . $user_input_email . "' LIMIT 1 ");
  $std_user_email->execute();
  $user_email = $std_user_email->fetch();

  $logged_in = false;

  if (password_verify($user_input_password, $user_email["password"])) {
    session_start();

    $logged_in = true;

    $_SESSION['login_user'] = $user_email;
    $session_email = $_SESSION['login_user']['email'];
    $session_name = $_SESSION['login_user']['name'];
    $session_last_name = $_SESSION['login_user']['lastname'];
    $session_password = $_SESSION['login_user']['password'];
    $session_address = $_SESSION['login_user']['address'];
    $session_age = $_SESSION['login_user']['age'];
    $session_about = $_SESSION['login_user']['about'];

  }

?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="styles/index.css"
  </head>
  <body>
    <div class="main">
      <div class="actions-box">
        <?php if($logged_in) { ?>
          Your email address is: <?php echo ($session_email); ?><br>
          Your name is: <?php echo ($session_name); ?><br>
          Your last_name is: <?php echo ($session_last_name); ?><br>
          Your password is: <?php echo ($session_password); ?><br>
          Your address is: <?php if($session_address) { echo ($session_address); } else { echo('not available'); }?><br>
          Your age is: <?php if($session_age) { echo ($session_age); } else { echo('not available'); }?><br>
          About you: <?php if($session_about) { echo ($session_about); } else { echo('not available'); }?><br>
        <?php } else { ?>
          Your username or password is invalid!
        <?php } ?>
      </div>
    </div>
  </body>
</html>
