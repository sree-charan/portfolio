<html>
<body>
<style>
h1{
    margin-top:50px;
    font-size: 100px;
    color:white;
}
body{
    background-color: #114D61;
    margin: 0px;
    padding: 0px;

}

</style>
<center>
<h1>
<?php
$ipAddress = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
$browser = $_SERVER['HTTP_USER_AGENT'];
$servername = "sql312.byetcluster.com:3306";
$username = "ltm_28275091";
$password = "12345678";
$dbname = "ltm_28275091_learn";
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "INSERT INTO user(ip,address) VALUES ('".$ipAddress."','".$browser."')";
$conn->query($sql);


$sql = "SELECT ip, name, address FROM user";
$result = $conn->query($sql);
  // output data of each row
  while($row = $result->fetch_assoc()) {
      
     if($row["ip"]==$ipAddress){
         if($row["name"]!=''){
             echo "Hi " .$row["name"]."<br>Your IP is " .$row["ip"]. "<br>";
              $upd = "UPDATE user SET address = '".$browser."' WHERE ip='".$ipAddress."'";
            $conn->query($upd);
          break;
         }
          //echo "ip: " . $row["ip"]. " - Name: " . $row["name"]. " " . $row["address"]. "<br>";
        else{
            $upd = "UPDATE user SET address = '".$browser."' WHERE ip='".$ipAddress."'";
            $conn->query($upd);
            echo "Hi user! Your IP is " .$row["ip"]. "<br>";
        }
      }
    
 }
$conn->close();

?>
</h1>
</center>
</body>
</html>
