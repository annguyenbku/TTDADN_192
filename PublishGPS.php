<?php 
    session_start();
    if (isset($_POST["publishMQTT"]))
    {
        #Process to publish the message
        $Latitude = $_POST["Latitude"];
        $Longitude = $_POST["Longitude"];

        $message = '[{"device_id":"GPS","values":["'.$Latitude.'","'.$Longitude.'"]}]';
        require('phpMQTT.php');

        $server = '13.67.74.76';     // change if necessary
        $port = 1883;                     // change if necessary
        $username = 'BKvm';                   // set your username
        $password = 'Hcmut_CSE_2020';                   // set your password
        $client_id = 'phpMQTT-publisher'; // make sure this is unique for connecting to sever - you could use uniqid()
        $mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

        if ($mqtt->connect(true, NULL, $username, $password)) {
            $mqtt->publish("Topic/GPS", $message,0);
            $mqtt->close();
            echo("Đã publish");
        } else {
            echo "Time out!\n";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/home.css">
    <style>
        #addQuestion{
    width: 100%;
    color: #333333;
    height: 500px;
    margin: 0 auto;
    overflow: hidden;
    padding: 10px 0;
    align-items: center;
    justify-content: space-around;
    display: flex;
    float: none;
    }
    body {
        background-image: url('https://www.androidguys.com/wp-content/uploads/2016/09/iStock_000034930054_Lightbulb.jpg');
        height: 100%;
        background-position: left;

        background-attachment: fixed;
        background-repeat: repeat;
        background-size: cover;
        }
        </style>

    
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css' rel='stylesheet' />

    <script>
        $(function()
        {
            $('.slider').on('input change', function(){
                $(this).next($('.slider_label')).html(this.value);
            });
            $('.slider_label').each(function(){
                var value = $(this).prev().attr('value');
                $(this).html(value);
        });  
})
    </script>
    <title>Điều khiển thiết bị output</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">GPS Website </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item ">
                    <a class="nav-link" href="#"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-motorcycle"></i>Quản lí thết bị</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-history"></i>Lịch sử hành trình</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#"><i class="fa fa-home"></i>Điều khiển đèn</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-cog"></i>Cài đặt</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
            <?php if(isset($_SESSION['username'])) 

            {
                ?>
                <!-- Example single danger button -->
                    <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Xin chào: <?php echo $_SESSION['username'] ?>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="info_user.php">Thông tin cá nhân</a>
                        <a class="dropdown-item" href="register_device.php">Đăng kí thiết bị</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Log out</a>
                    </div>
                    </div>
                <?php
            } 
            else {
            ?> 
                <a href = "login.php" class="link-login">Login</a>
                <a href = "register.php" class="link-login">Sign up</a> 
            <?php
            }
            
            ?>
            </form>
        </div>
    </nav>


    <div id="addQuestion">
        <div class="form-group-lg">
        <form method="POST">
        <p  style="color:#FFFFFF"><label for="range_weight">Latitude: </label> <input type="range" name="Latitude" class="slider" min="0" max="255" value="0">
            <span  class="slider_label"></span></p>
            
            <p  style="color:#FFFFFF"><label for="range_weight">Longitude: </label> <input type="range" name="Longitude" class="slider" min="0" max="255" value="0">
            <span  class="slider_label"></span></p>

            <div class="agile-submit">
                <input type='submit' name="publishMQTT" class='btn-success' value='Publish'/>
            </div>
        </form>
    
        </div>
    </div>


</body>
</html>