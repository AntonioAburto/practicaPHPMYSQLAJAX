<!DOCTYPE html> 
<head> 
   <title>PHP MySQL</title> 
   <style type="text/css">
    body{
      font-family: Verdana, Geneva, sans-serif;
    }
  .container{
      width: 50%;
      margin: 0 auto;
  } 
 
 table, tr, th, td {
    border: 1px solid #e3e3e3;
    padding: 10px;
 }
 
</style> 

</head> 

<body>

  <?php  
    ini_set('display_errors', '1');
    $servername = "localhost";
    $username = "root";
    $password = "0sh030sh0";
    $dbname = "inventory";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT no_producto, producto, precio, cantidad, no_transferencia FROM inventory.vw_transfer_details";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {

        echo  $row["no_producto"]. "      " .$row["producto"]. "      " . $row["precio"]. "      " . $row["cantidad"]. $row["no_transferencia"]."<br>";
      }
    } else {
      echo "0 results";
    }
    $conn->close();



  ?>
  
  
</body>
</html>