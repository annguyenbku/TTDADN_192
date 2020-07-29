<?php require_once("connection.php"); 
 
     if (isset($_POST["btn-signup"]))
     {
        // $select_sql="SELECT username FROM users";
        // $a=mysqli_query($conn,$select_sql);
        // $b=mysqli_fetch_array($a,MYSQLI_ASSOC);
        // var_dump($b);
        //lấy thông tin từ form
        $username=$_POST["username"];
        $email=$_POST["email"];
        $password=$_POST["password"];  
        $re_password = $_POST["re_password"];  
        $select_sql="SELECT username FROM users WHERE username='".$username."' ";    
        if($username==""||$password==""||$re_password=="")
        {
           $message = "<p style = 'color:red'>Vui lòng nhập đầy đủ thông tin!!</p>";
        }
        
         else if (mysqli_num_rows(mysqli_query($conn,$select_sql))>0)
        {
            $message = "<p style = 'color:red'>Tên đăng nhập đã tồn tại!! </p>";
        }
         else if($password!=$re_password) 
        {
            $message = "<p style = 'color:red'>Mật khẩu không trùng nhau!! </p>";
        }
        else
        {
            $password = md5($password);
            $sql = "INSERT INTO users (
                username, 
                password, 
                firstname, 
                lastname, 
                birthday, 
                address, 
                email, 
                phonenumber, 
                idcard, 
                gender,
                created_at) 
                VALUES ( 
                '$username', 
                '$password',
                NULL, 
                NULL, 
                NULL, 
                NULL, 
                '$email',
                NULL, 
                NULL, 
                NULL,
                now()
                )";
             mysqli_query($conn,$sql);
            $message = "<p>style = 'color:green'>chúc mừng bạn đã đăng kí thành công!!</p>";

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
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_password" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div>
                                <?php  if (isset($message))
                                {
                                    echo $message;
                                }
                                ?>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="btn-signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/gps_logout.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link">I am already member</a>
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