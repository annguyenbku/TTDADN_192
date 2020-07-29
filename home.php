<?php 
    session_start();
    require_once("connection.php"); 
    $latitude = [];
    $longitude = [];
    $date_device = [];
    if(!isset($_SESSION['id']))
    {
        header('Location: login.php');
	}
	else {
		$id = $_SESSION['id'] ;
	}
    $query = "SELECT * FROM devices WHERE user_id='{$id}'";
    $result = mysqli_query($conn,$query);
    kt_query($result,$query); 
    $name_device = "";
    if (isset($_POST["submit_result"]))
     {
        $id_device = $_POST['id_device'];
        $date_from = $_POST['date_from'];
        $date_to = $_POST['date_to'];
        //select name xe
        $query_name_moto = "SELECT name FROM devices WHERE id='{$id_device}'";
        $result_name_moto = mysqli_query($conn,$query_name_moto);
        kt_query($result_name_moto,$query_name_moto);
        while($a=mysqli_fetch_array($result_name_moto,MYSQLI_ASSOC))
        {
            $name_device = $a['name'];
        }

        $query_router = "SELECT * FROM deviceroute WHERE id_device='{$id_device}' AND (date_update < '{$date_to}') AND (date_update) > '{$date_from}' ";
        $result_router = mysqli_query($conn,$query_router);
        kt_query($result_router,$query_router);
        while($router_item=mysqli_fetch_array($result_router,MYSQLI_ASSOC))
        {
            array_push($latitude,$router_item['latitude']);
            array_push($longitude,$router_item['longitude']);
            array_push($date_device,$router_item['date_update']);
        }
     }
?>
<?php 
    function ComputeTheDistance($latitude1, $latitude2, $longitude1, $longitude2)
    {
        //Converting to radians
        $longi1 = deg2rad($longitude1); 
        $longi2 = deg2rad($longitude2); 
        $lati1 = deg2rad($latitude1); 
        $lati2 = deg2rad($latitude2); 
    
        //Haversine Formula 
        $difflong = $longi2 - $longi1; 
        $difflat = $lati2 - $lati1; 
    
        $val = pow(sin($difflat/2),2)+cos($lati1)*cos($lati2)*pow(sin($difflong/2),2); 
        $res2 = 6378.8 * (2 * asin(sqrt($val))); //for kilometers
        
        return $res2;
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

    
    <script src='https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v1.11.0/mapbox-gl.css' rel='stylesheet' />

    <title>Trang chủ</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home.php">GPS Website </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="control_outputDevice.php"><i class="fa fa-home"></i> Đèn <span class="sr-only">(current)</span></a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-cog"></i>Cài đặt</a>
                </li> -->
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
    <div class="container-fluid main-content">
        <div class="row">
            <div class="col-md-3">
                <h2 class="title">HÀNH TRÌNH</h2>
                <form method="POST">
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Thiết bị</label>
                        <div class="col-sm-8">
                            <select class="custom-select form-control form-control-sm" id="colFormLabelSm" name="id_device" placeholder="Tên thiết bị" style="height: 31px;font-size: .875rem;"> 
                            <option selected>Choose...</option>
                                <?php 
                                    while($result_user=mysqli_fetch_array($result,MYSQLI_ASSOC))
                                    {
                                        ?>
                                        <option <?php if(isset($_POST['id_device'])) { if($result_user['id'] == $_POST['id_device']) echo "selected"; }?> value=<?php echo($result_user['id'])?>><?php echo($result_user['name']);?></option> 
                                    <?php
                                    };
                                ?>                             
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Từ ngày</label>
                        <div class="col-sm-8">
                        <input type="datetime-local" value ="<?php if(isset($_POST['date_from'])) {echo $_POST['date_from'];}   ?>" name="date_from" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm text-right">Đến ngày</label>
                        <div class="col-sm-8">
                        <input type="datetime-local" value ="<?php if(isset($_POST['date_to'])) {echo $_POST['date_to'];}   ?>" name="date_to" class="form-control form-control-sm" id="colFormLabelSm" placeholder="col-form-label-sm">
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary btn-sm" name="submit_result" style="margin-left : 30px;width: 75.75px; height: 30.8px;" value="Thống kê"></input>
                </form>
                
                <?php
                    $sum_of_distance = 0
                ?>
                <div class="result">
                    <?php  
                        $l = count($latitude);
                        $distance = 0;
                        for($i = 0; $i < $l - 1; $i++)
                        {  
                            $distance = ComputeTheDistance($latitude[$i], $latitude[$i + 1], $longitude[$i], $longitude[$i + 1]);
                            $sum_of_distance = $sum_of_distance + $distance
                    ?>
                            <div id="hello"> Quảng đường thứ <?php echo ($i + 1); ?> từ [<?php echo $latitude[$i]; ?> ; <?php echo $longitude[$i]; ?>]
                                <br/>
                                tới [<?php echo $latitude[$i + 1]; ?> ; <?php echo $longitude[$i + 1]; ?>] là: <?php echo $distance ?> km      
                            </div>   
                            
                            
                    <?php
                        } 
                    ?>
                </div>
                <h6 class="mt-2 text-danger">Tổng quãng đường : <?php echo $sum_of_distance; ?> km </h6>
            </div>
                <div class="col-md-9">
                    <!-- <button type="button" class="btn btn-secondary btn-sm" style="width: 75.75px; height: 30.8px;">Xem</button> -->
                    <div id='map' style='width: 100%; height: 100%;margin-top: 58.4px'></div>
                
                </div>
            </div>
        </div>
    
    <script>
            // TO MAKE THE MAP APPEAR YOU MUST
            // ADD YOUR ACCESS TOKEN FROM
            // https://account.mapbox.com
            mapboxgl.accessToken = 'pk.eyJ1IjoiaGlldXF1YW5nMjIxMiIsImEiOiJja2JnNmtvczQwdWVpMm9uNDFxaDJvZnh0In0.vLKfk-_0NHBqOJ9XE29qfQ';
            var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [108,14],
            zoom: 5
        });

        var lat = <?php echo json_encode($latitude)?>;
        var long = <?php echo json_encode($longitude)?>;
        var date = <?php echo json_encode($date_device)?>;
        console.log(lat);
        console.log(long);
        for(var i = 0; i < lat.length; i++)
        {
            var name_device = <?php echo json_encode($name_device) ?>;
            var marker = new mapboxgl.Marker()
                .setLngLat([lat[i], long[i]])
                .setPopup(new mapboxgl.Popup().setHTML("Tên: "+ name_device + "</br>" + "Vị trí: " + lat[i] + "," +long[i] + "</br>"+"Ngày: "+date[i] ))
                .addTo(map);
        }
        window.coordinates = [];
        var lat_temp = 0;
        var long_temp = 0;
        var coor = [];
        for(var j = 0; j < lat.length; j++)
        {
            coor.push(lat[j]);
            coor.push(long[j]);
            window.coordinates.push(coor);
            coor = [];
        }    
        function distance(lat1, lon1, lat2, lon2) {
            var p = 0.017453292519943295;    // Math.PI / 180
            var c = Math.cos;
            var a = 0.5 - c((lat2 - lat1) * p)/2 + 
                    c(lat1 * p) * c(lat2 * p) * 
                    (1 - c((lon2 - lon1) * p))/2;
            
            return 12742 * Math.asin(Math.sqrt(a)); // 2 * R; R = 6371 km
        }
        

        var arr = [];
        for(var i = 0; i < lat.length - 1; i++)
        {
            lat1 = lat[i];
            lat2 = lat[i+1];
            long1 = long[i];
            long2 = long[i+1];
            arr.push(distance(long1, lat1,long2,lat2));
        }
        console.log(arr);



        map.on('load', drawRoutes);
        function drawRoutes() {
            map.addSource('route', {
                'type': 'geojson',
                'data': {
                'type': 'Feature',
                'properties': {},
                'geometry': {
                    'type': 'LineString',
                    'coordinates': window.coordinates
                    }
                }
            });
            map.addLayer({
                'id': 'route',
                'type': 'line',
                'source': 'route',
                'layout': {
                    'line-join': 'round',
                    'line-cap': 'round'
                },
                'paint': {
                    'line-color': '#888',
                    'line-width': 8
                }
            });
        }
    
    </script>
</body>
</html>