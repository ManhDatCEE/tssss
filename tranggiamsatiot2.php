<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta http-equiv="refresh" content="60">
        <link rel="shortcut icon" href="dd.jpg" />
        <title>Tracking IOTs system</title>
        <link rel="stylesheet" href="tranggiamsatiot (1).css"/>
      <?php  /*== bỏ dòng bootrap   trên server k thay đổi css k dc==*/ ?>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
    </head>
<body>
    
    
    <?php
 
$servername = "localhost";
 
// REPLACE with your Database name
$dbname = "id12967776_manhdat";
// REPLACE with Database user
$username = "id12967776_manhdat12";
// REPLACE with Database user password
$password = "Manhdat2000-";
 
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql3 = "SELECT id, sensor, location, value1, value2, time_act, Date, time FROM SensorData ORDER BY id DESC LIMIT 1";

$sql2 = "SELECT time, MIN(value1) AS Min FROM SensorData WHERE value1 = (SELECT MIN(value1) FROM SensorData WHERE Date = ('2020-05-16')) ";

$sql4 = "SELECT time, MAX(value1) AS Max FROM SensorData WHERE `value1`=(SELECT MAX(value1) FROM SensorData WHERE Date = ('2020-05-16')) ";

$sql = "SELECT value1, time_act FROM SensorData ORDER BY id DESC LIMIT 30";

$sql5= "SELECT ROUND(AVG(value1), 2) AS AVG FROM SensorData WHERE Date = ('2020-05-16') "; // hàm round làm tròn 2 chữ số

if ($result = $conn->query($sql)) {
    while ($row = $result->fetch_assoc()) {    
        $row_value1 = $row["value1"];
        $datetime = $row['time_act']; 
   
	 $time= strtotime($row['time_act'])*1000; // chuyển sang dạng format unix  *1000
	 
	 $data[] = "[$time,$row_value1]";
	
    }
    $result->free();
}


if ($result2 = $conn->query($sql2)) {
    while ($row2 = $result2->fetch_assoc()) {
           $row2_min = $row2["Min"];
           $row2_timemin = $row2["time"];
    }
     $result2->free();
}

if ($result4 = $conn->query($sql4)) {
    while ($row4 = $result4->fetch_assoc()) {
           $row4_max = $row4["Max"];
           $row4_timemax = $row4["time"];
    }
     $result4->free();
}

if ($result5 = $conn->query($sql5)) {
    while ($row5 = $result5->fetch_assoc()) {
           $row5_avg = $row5["AVG"];
    }
     $result5->free();
}
        
        
if ($result3 = $conn->query($sql3)) {
    while ($row3 = $result3->fetch_assoc()) {
        $row3_id = $row3["id"];
        $row3_sensor = $row3["sensor"];
        $row3_location = $row3["location"];
        $row3_value1 = $row3["value1"];
        $row3_value2 = $row3["value2"]; 
        $row3_reading_time = $row3["time_act"];
       
        
        // Uncomment to set timezone to - 1 hour (you can change 1 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time - 1 hours"));
      
        // Uncomment to set timezone to + 4 hours (you can change 4 to any number)
        //$row_reading_time = date("Y-m-d H:i:s", strtotime("$row_reading_time + 4 hours"));
      
        
    }
    $result3->free();
}
 
$conn->close();
?> 
    
    
    
    <div id="menungang">
        
        <ul>
            <a href="https://www.facebook.com/profile.php?id=100009548693587"><img  class="logo" src="logo1.png" style="width: 190px; height: 50px;"></a>
            <li> <a href="index.php">Trang chủ</a></li>
            <li> <a href="#">Kiến thức</a>
                <ul class="sub-menu">
                    <li> <a href="#">IOTs</a></li>
                    <li> <a href="#">Lập trình</a></li>
                    <li> <a href="#">Web</a></li>
                    <li> <a href="#">Điện Tử</a></li>
                    <li> <a href="https://www.postscapes.com/internet-of-things-protocols/">Protocal Iots</a></li>
                </ul>
            </li>
            <li> <a href="#">IOTs</a></li>
            <li> <a href="#">Liên hệ</a></li>
            <li><a href="https://www.facebook.com/profile.php?id=100009548693587"><img src="fb.png" style="width: 53px; height: 53px;"></li></a></li>
            <li><a href="https://github.com/nuytapro20126?tab=repositories"><img src="gith.png" style="width: 53px; height: 53px;"></li></a></li>
        </ul>   
    
    </div>
<div id="container">
    <div id="menu">
        <ul>
            <li> <a href="#">Dữ liệu</a></li>
            <li> <a href="#">Thông số</a></li>
            <li> <a href="bieudo.php">Biểu đồ</a></li>
            <li> <a href="#">Điều khiển</a></li>
        </ul>
    
    </div>
<div id="noidung">
    <div id="header">
        <a href="https://www.facebook.com/profile.php?id=100009548693587"><img  class="logo" src="Logo2_IUH.jpg" style="width: 100px; height: 70px;"></a>
        <h2>Tracking IOT system</h2>
        <p>Hệ thống giám sát IOTs</p>
        <div style="text-align: right; font-size: 13px ">
        <?php
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $timestamp = time();
                echo(date("F d, Y h:i:s A", $timestamp));
        ?> </div>
    </div>
    <div id="content">
        <H3> Thống kê</H3><br> 
             <p>
                 <li>Nhiệt độ thấp nhất trong ngày <input style="text-align: center" type="text" value="<?php echo ( isset ( $row2_min ) ? $row2_min : '' ); ?>" size="6" >&#176;C <b>vào lúc</b> <input style="text-align: center" type="text" value="<?php echo ( isset ( $row2_timemin ) ? $row2_timemin : '' ); ?>" size="6" >
                 </li> <br> 
            </p>
             <p>
                 <li>Nhiệt độ cao nhất trong ngày <input style="text-align: center" type="text" value="<?php echo ( isset ( $row4_max ) ? $row4_max : '' ); ?>" size="6" >&#176;C <b>vào lúc</b> <input  style="text-align: center" type="text" value="<?php echo ( isset ( $row4_timemax) ? $row4_timemax : '' ); ?>" size="6" >  
                 </li><br> 
            </p>
            
             <p>
                 <li>Nhiệt độ trung bình ngày <input style="text-align: center" type="text" value="<?php echo ( isset ( $row5_avg ) ? $row5_avg : '' ); ?>" size="6" >&#176;C<br>  
                 </li>
            </p>

    </div>
    <div id="sildebar">
                 <h3>Thông số</h3><br> 
                 <p><img src="temperature.png" style="width: 73px; height: 73px;"><br> <input style="text-align: center" type="text" value="<?php echo ( isset ( $row3_value1 ) ? $row3_value1 : '' ); ?>" size="6" >&#176;C 
                </p> <br>
                 
                 <p><img src="humidity.png" style="width: 73px; height: 73px;"><br> <input style="text-align: center" type="text" value="<?php echo ( isset ( $row3_value2) ? $row3_value2 : '' ); ?>" size="6" >%
                 </p>
        
            <br> 
             <p>
                <img src="Soil_Humidity-512.png" style="width: 73px; height: 73px;">    <img src="water-qua.png" style="width: 73px; height: 73px;"> <br> Độ ẩm đất     Chất lượng nước
            </p><br> 
             
            
    </div>
    <div style="font-size: 13px; border-top: 1px solid #E6E6E6;color: #838383;padding: 1em 3em;" id="footer">
        <p>&copy; Manh Dat blog Copyright <?php echo date("Y")?> </p>
    </div>
</div>  
</div>           
</body>
</html>