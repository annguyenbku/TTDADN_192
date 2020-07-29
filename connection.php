<?php 
// Kiểm tra xem kết quả trả về có đúng hay không
function kt_query($result,$query)
{
	global $conn;	
	if(!$result)
	{
		die("Query {$query} \n <br/> MYSQL Error:".mysqli_error($conn));
	}
}
 ?>
<?php 
$server_username = "root";
$server_password = "";
$server_host = "localhost";
$database = 'ttdadn_gps';
$conn= mysqli_connect($server_host,$server_username,$server_password,$database);
if(!$conn)
{
	die("Lỗi kết nối dữ liệu");
	exit();
}
mysqli_query($conn,"SET NAMES 'UTF8'");