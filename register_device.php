<?php
require_once("connection.php"); 
// unset($_SESSION['id']); 
$mess="";
session_start();
if(!isset($_SESSION['id']))
    {
        header('Location: login.php');
	}
	else {
		$id = $_SESSION['id'] ;
	}
if (isset($_POST["submit_device"]))
{
  //Kiểm tra người dung có nhập đầy đủ thông tin không
  $name_device=$_POST["name_device"];
  $brand_device=$_POST["brand_device"];
  $code_device=$_POST["code_device"];  
  $description_device = $_POST["description_device"];  
  $color_device=$_POST["color_device"];  
  $select_sql="SELECT modecode FROM devices WHERE modecode='".$code_device."' ";    
  if($name_device==""||$brand_device==""||$code_device==""||$color_device=="")
  {
	  $mess= "Vui lòng nhập đầy đủ thông tin!!";
  }
  
  if (mysqli_num_rows(mysqli_query($conn,$select_sql))>0)
  {
	  $mess = "Device code đã tồn tại!!";
  }
  $sql = "INSERT INTO devices (
	user_id, 
	name, 
	brand, 
	modecode, 
	color, 
	description_device,
	dateregister, 
	licensePlate,
	created_at) 
	VALUES ( 
	'$id', 
	'$name_device',
	'$brand_device',
	'$code_device', 
	'$color_device', 
	'$description_device',
	now(), 
	NULL, 
	now()
	)";
	$result =  mysqli_query($conn,$sql);
	 kt_query($result,$sql);
	$result_submit = "Bạn đã nhập thông tin!!";
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
		<h1>Register device</h1>
		<p>Register to track the device</p>
	</div>
	<!--//header-->
	<!--main-->
	<div class="agileits-main">
		<div class="wrap">
		<form action="#" method="post">
			<ul>
				<li class="text">Name device:  </li>
				<li><input name="name_device" type="text" required></li>
			</ul>
			<ul>
				<li class="text">Brand  :  </li>
				<li><input name="brand_device" type="text" required></li>
			</ul>
			<ul>
				<li class="text">Device code  :  </li>
				<li><input name="code_device" type="text" required></li>
			</ul>
			<ul>
				<li class="text">Description  :  </li>
				<li><input name="description_device" type="text" required></li>
			</ul>
			<ul>
				<li class="text">Color :  </li>
				<li><input name="color_device" type="text" required></li>
			</ul>
			<div class="clear"></div>
			<div class="agile-submit">
				<input type="submit" name="submit_device" value="Register">
				<input type="reset" value="reset">
			</div>
			<h2><?php echo $mess ?></h2>
			<h2></h2>
			</form>
		</div>	
	</div>
</body>
<script>
	console.log(<?php echo $_SESSION['id'];?>)
</script>>
</html>