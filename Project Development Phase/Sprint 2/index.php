<?php
 session_start();
 if (isset($_SESSION['SESSION_EMAIL'])) {
 header("Location: welcome.php");
 die();
 }
 include 'config.php';
 $msg = "";
 if (isset($_GET['verification'])) {
 if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE
code='{$_GET['verification']}'")) > 0) {
 $query = mysqli_query($conn, "UPDATE users SET code='' WHERE
code='{$_GET['verification']}'");

 if ($query) {
 $msg = "<div class='alert alert-success'>Account verification has been successfully
completed.</div>";
 }
 } else {
 header("Location: index.php");
 }
 }
 if (isset($_POST['submit'])) {
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $password = mysqli_real_escape_string($conn, md5($_POST['password']));
 $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
 $result = mysqli_query($conn, $sql);
 if (mysqli_num_rows($result) === 1) {
 $row = mysqli_fetch_assoc($result);
 if (empty($row['code'])) {
 $_SESSION['SESSION_EMAIL'] = $email;
 header("Location: welcome.php");
 } else {
 $msg = "<div class='alert alert-info'>First verify your account and try again.</div>";
 }
 } else {
 $msg = "<div class='alert alert-danger'>Email or password do not match.</div>";
 }
 }
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
 <title>Smart Road Safety Login</title>
 <!-- Meta tag Keywords -->
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta charset="UTF-8" />
 <meta name="keywords"
 content="Login Form" />
 <!-- //Meta tag Keywords -->
 <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
rel="stylesheet">
 <!--/Style-CSS -->
 <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
 <!--//Style-CSS -->
 <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
</head>
<body>
 <!-- form section start -->
 <section class="w3l-mockup-form">
 <div class="container">
 <!-- /form -->
 <div class="workinghny-form-grid">
 <div class="main-mockup">
 <div class="alert-close">
 <span class="fa fa-close"></span>
 </div>
 <div class="w3l_form align-self">
 <div class="left_grid_info">
 <img src="login1.jpeg" alt="">
 </div>
 </div>
 <div class="content-wthree">
 <h2>Login Now</h2>

 <?php echo $msg; ?>
 <form action="" method="post">
 <input type="email" class="email" name="email" placeholder="Enter Your Email"
required>
 <input type="password" class="password" name="password" placeholder="Enter
Your Password" style="margin-bottom: 2px;" required>
 <p><a href="forgot-password.php" style="margin-bottom: 15px; display: block; textalign: right;">Forgot Password?</a></p>
 <button name="submit" name="submit" class="btn" type="submit">Login</button>
 </form>
 <div class="social-icons">
 <p>Create Account! <a href="register.php">Register</a>.</p>
 </div>
 </div>
 </div>
 </div>
 <!-- //form -->
 </div>
 </section>
 <!-- //form section start -->
 <script src="js/jquery.min.js"></script>
 <script>
 $(document).ready(function (c) {
 $('.alert-close').on('click', function (c) {
 $('.main-mockup').fadeOut('slow', function (c) {
 $('.main-mockup').remove();
 });
 });
 });
 </script>
</body>
</html>
REGISTER.PHP
<?php
 //Import PHPMailer classes into the global namespace
 //These must be at the top of your script, not inside a function
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\SMTP;
 use PHPMailer\PHPMailer\Exception;
 session_start();
 if (isset($_SESSION['SESSION_EMAIL'])) {
 header("Location: welcome.php");
 die();
 }
 //Load Composer's autoloader
 require 'vendor/autoload.php';
 include 'config.php';
 $msg = "";
 if (isset($_POST['submit'])) {
 $name = mysqli_real_escape_string($conn, $_POST['name']);
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $password = mysqli_real_escape_string($conn, md5($_POST['password']));
 $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm-password']));
 $code = mysqli_real_escape_string($conn, md5(rand()));
 if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='{$email}'")) > 0)
{
 $msg = "<div class='alert alert-danger'>{$email} - This email address has been already
exists.</div>";
 } else {
 if ($password === $confirm_password) {
 $sql = "INSERT INTO users (name, email, password, code) VALUES ('{$name}', '{$email}',
'{$password}', '{$code}')";
 $result = mysqli_query($conn, $sql);
 if ($result) {
 echo "<div style='display: none;'>";
 //Create an instance; passing `true` enables exceptions
 $mail = new PHPMailer(true);
 try {
 //Server settings
 $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug
output
 $mail->isSMTP(); //Send using SMTP
 $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
 $mail->SMTPAuth = true; //Enable SMTP authentication
 $mail->Username = 'smartroadsafety247@gmail.com
'; //SMTP username
 $mail->Password = 'uxwlfphdvlzfgebj'; //SMTP password
 $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS
encryption
 $mail->Port = 465; //TCP port to connect to; use 587 if you have
set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
 //Recipients
 $mail->setFrom('smartroadsafety247@gmail.com');
 $mail->addAddress($email);
 //Content
 $mail->isHTML(true); //Set email format to HTML
 $mail->Subject = 'smartroadsafety247 register form';
 $mail->Body = ' click here to login <b><a
href="http://localhost/login/?verification='.$code.'">
http://localhost/login/?verification='.$code.'</a></b>';
 $mail->send();
 echo 'Message has been sent';
 } catch (Exception $e) {
 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
 }
 echo "</div>";
 $msg = "<div class='alert alert-info'>We've send a verification link on your email
address.</div>";
 } else {
 $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
 }
 } else {
 $msg = "<div class='alert alert-danger'>Password and Confirm Password do not
match</div>";
 }
 }
 }
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
 <title>Login Form - Smart Road Safety</title>
 <!-- Meta tag Keywords -->
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta charset="UTF-8" />
 <meta name="keywords"
 content="Login Form" />
 <!-- //Meta tag Keywords -->
 <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap"
rel="stylesheet">
 <!--/Style-CSS -->
 <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
 <!--//Style-CSS -->
 <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
</head>
<body>
 <!-- form section start -->
 <section class="w3l-mockup-form">
 <div class="container">
 <!-- /form -->
 <div class="workinghny-form-grid">
 <div class="main-mockup">
 <div class="alert-close">
 <span class="fa fa-close"></span>
 </div>
 <div class="w3l_form align-self">
 <div class="left_grid_info">
 <img src="reg1.jpeg" alt="">
 </div>
 </div>
 <div class="content-wthree">
 <h2>Register Now</h2>

 <?php echo $msg; ?>
 <form action="" method="post">
 <input type="text" class="name" name="name" placeholder="Enter Your Name"
value="<?php if (isset($_POST['submit'])) { echo $name; } ?>" required>
 <input type="email" class="email" name="email" placeholder="Enter Your Email"
value="<?php if (isset($_POST['submit'])) { echo $email; } ?>" required>
 <input type="password" class="password" name="password" placeholder="Enter
Your Password" required>
 <input type="password" class="confirm-password" name="confirm-password"
placeholder="Enter Your Confirm Password" required>
 <button name="submit" class="btn" type="submit">Register</button>
 </form>
 <div class="social-icons">
 <p>Have an account! <a href="index.php">Login</a>.</p>
 </div>
 </div>
 </div>
 </div>
 <!-- //form -->
 </div>
 </section>
 <!-- //form section start -->
 <script src="js/jquery.min.js"></script>
 <script>
 $(document).ready(function (c) {
 $('.alert-close').on('click', function (c) {
 $('.main-mockup').fadeOut('slow', function (c) {
 $('.main-mockup').remove();
 });
 });
 });
 </script>
</body>
</html>