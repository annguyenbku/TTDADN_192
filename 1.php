<!-- [{"device_id": "GPS","values":["109","12"]}] -->

<?php
    $string =  '[{"device_id": "GPS",
                "values":["109","12"]}]';
    $string = substr($string,1,-1);
    $str = json_decode($string,true);
    
    $latitude = $str['values'][0];
    $longitude = $str['values'][1];
    echo("kinh do: "); echo($latitude);
    echo("vi do: ");
    echo($longitude);
?>