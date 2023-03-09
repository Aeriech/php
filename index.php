<?php
$valid_username = "Aeriech";
$valid_password = "12345";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  if ($username == $valid_username && $password == $valid_password) {
    // Redirect to the game page
    header("Location: MyDiary.php");
    exit();
  } else {
    $error_message = "Invalid username or password";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login Form</title>
</head>
<body>
  <h1>Login Form</h1>

  <?php if (!empty($error_message)): ?>
    <p style="color: red;"><?php echo $error_message; ?></p>
  <?php endif; ?>

  <form method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Log in">
  </form>
</body>
</html>
