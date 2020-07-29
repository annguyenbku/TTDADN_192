<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
	session_start();
	if(!isset($_SESSION['id']))
		{
			header('Location: login.php');
		}
		else {
			$id = $_SESSION['id'] ;
			$username = $_SESSION['username'];
		}
?>
<?php
	require_once("connection.php");
	$query_select="SELECT firstname,lastname,birthday,address,email,phonenumber,idcard,license_number FROM users WHERE id={$id}";
	$result_select=mysqli_query($conn,$query_select) or die("Query {$query_select} \n <br/> Mysql errors:".mysqli_error($conn));
	//Kiểm tra ID có tồn tại không
	if(mysqli_num_rows($result_select)==1)
	{
		list($firstname,$lastname,$birthday,$address,$email,$phonenumber,$idcard,$licensenumber) = mysqli_fetch_array($result_select,MYSQLI_NUM);
	}
?>
<?php
	 if (isset($_POST["update_info"]))
     {
        //lấy thông tin từ form
		$firstname_up=$_POST["firstname_up"];
        $lastname_up=$_POST["lastname_up"];
        $username_up=$_POST["username_up"];
        $birthday_up=$_POST["birthday_up"];
		$address_up=$_POST["address_up"];
		$email_up=$_POST["email_up"];
		$phonenumber_up=$_POST["phonenumber_up"];
		$idcard_up=$_POST["idcard_up"];
		$licensenumber_up=$_POST["licensenumber_up"];

            $sql = "UPDATE users SET 
                username = '$username_up',   
                firstname = '$firstname_up', 
                lastname = '$lastname_up', 
                birthday = '$birthday_up', 
                address = '$address_up', 
                email = '$email_up', 
                phonenumber = '$phonenumber_up', 
                idcard = '$idcard_up',
				license_number = '$licensenumber_up'
				WHERE id = '$id'
				";
			$result = mysqli_query($conn,$sql);
			kt_query($result,$sql);
			header('Location: info_user.php');
        //    $mess_result= "Bạn đã cập nhật thông tin thành công!!";
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
<title>Register device</title>
<!-- Meta tag Keywords -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Sales Inquiry Form Responsive Widget Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- Meta tag Keywords -->
<!-- css files -->
<link href="css/style_info.css" rel="stylesheet" type="text/css" media="all">
<!-- //css files -->
<!-- online-fonts -->
</head>
<body>
	<!--header-->
	<div class="agile-header">
		<h1>User information</h1>
		<p>See, update information</p>
	</div>
	<!--//header-->
	<!--main-->
	<div class="agileits-main">
		<div class="wrap">
			

		<form action="#" method="post">
			<ul>
				<li class="text">First name: </li>
				<li><input name="firstname_up" value = "<?php if(isset($firstname)) {echo $firstname;}   ?>" type="text"></li>
			</ul>
			<ul>
				<li class="text">Last name: </li>
				<li><input name="lastname_up" value = "<?php if(isset($lastname)) {echo $lastname;}   ?>" type="text"></li>
			</ul>
			<ul>
				<li class="text">User name  :  </li>
				<li><input name="username_up" value = "<?php echo $username;  ?>" type="text"></li>
			</ul>
			<ul>
				<li class="text">Birth day :  </li>
				<li><input name="birthday_up" value = "<?php if(isset($birthday)) {echo $birthday;}   ?>" type="text"></li>
			</ul>
			<ul>
				<li class="text">Address :  </li>
				<li><input name="address_up" value = "<?php if(isset($address)) {echo $address;}   ?>" type="text"></li>
			</ul>
			<ul>
				<li class="text">E-mail :  </li>
				<li><input name="email_up" value = "<?php if(isset($email)) {echo $email;}   ?>" type="text"></li>
			</ul>
			<ul>
				<li class="text">Phone number :  </li>
				<li><input name="phonenumber_up" value = "<?php if(isset($phonenumber)) {echo $phonenumber;}   ?>" type="text"></li>
			</ul>
			<ul>
				<li class="text">Identity card :  </li>
				<li><input name="idcard_up" value = "<?php if(isset($idcard)) {echo $idcard;}   ?>" type="text"></li>
			</ul>
			<ul>
				<li class="text">License number:  </li>
				<li><input name="licensenumber_up" value = "<?php if(isset($licensenumber)) {echo $licensenumber;}   ?>" type="text"></li>
			</ul>
			<div class="clear"></div>
			<div class="agile-submit">
				<input type="submit" name = "update_info" value="Update">
				<input type="reset" value="reset">
			</div>
			</form>
		</div>	
	</div>
</body>
</html>