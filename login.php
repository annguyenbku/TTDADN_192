<?php
session_start();
require_once("connection.php"); 
if (isset($_POST["login_submit"]))
{
  //Kiểm tra người dung có nhập đầy đủ thông tin không
   $errors = array();
   if(empty($_POST["login_username"]))
   {
       $errors[]='username';
   }
   else 
   {
      $login_username = $_POST["login_username"];
  }
  if (empty($_POST["login_password"])) 
  {
   $errors[]='password';   
   }
   else 
   {
       $login_password=($_POST["login_password"]);
   }
   
   if (empty($errors))
   {
        $login_password = md5($login_password);
       //------------------------------------------------------//           
       $query = "SELECT id, username, password, firstname,lastname FROM users WHERE username='{$login_username}' AND password='{$login_password}'";
       $result = mysqli_query($conn,$query);
       kt_query($result,$query);
       if(mysqli_num_rows($result)==1)
       {
           list($id,$username,$password) = mysqli_fetch_array($result,MYSQLI_NUM);
           $_SESSION['id']=$id;
           $_SESSION['username']=$username;
           header('Location: home.php');
       }
       else 
       {
           $message="<p style = 'color:red'>Tài khoản hoặc mật khẩu không đúng </p>";
       }
   }
   else 
   {
       $message="<p style = 'color:red'>Bạn hãy nhập đầy đủ thông tin!</p>";
   }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">
        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/gps_background.jpg" alt="sing up image"></figure>
                        <a href="logout.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="login_username" id="login-email-name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="login_password" id="login-email-password" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div> <?php  if (isset($message))
                                {
                                    echo $message;
                                }
                                ?></div> 
                            <div class="form-group form-button">
                                <input type="submit" name="login_submit" id="signin" class="form-submit" value="Log in"/>
                            </div>
                            
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>