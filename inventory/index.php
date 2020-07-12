<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap Simple Modal Login Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
  font-family: 'Varela Round', sans-serif;
}
.modal-login {
  width: 320px;
}
.modal-login .modal-content {
  border-radius: 1px;
  border: none;
}
.modal-login .modal-header {
  position: relative;
  justify-content: center;
  background: #f2f2f2;
}
.modal-login .modal-body {
  padding: 30px;
}
.modal-login .modal-footer {
  background: #f2f2f2;
}
.modal-login h4 {
  text-align: center;
  font-size: 26px;
}
.modal-login label {
  font-weight: normal;
  font-size: 13px;
}
.modal-login .form-control, .modal-login .btn {
  min-height: 38px;
  border-radius: 2px; 
}
.modal-login .hint-text {
  text-align: center;
}
.modal-login .close {
  position: absolute;
  top: 15px;
  right: 15px;
}
.modal-login .checkbox-inline {
  margin-top: 12px;
}
.modal-login input[type="checkbox"] {
  position: relative;
  top: 1px;
}
.modal-login .btn {
  min-width: 100px;
  background: #3498db;
  border: none;
  line-height: normal;
}
.modal-login .btn:hover, .modal-login .btn:focus {
  background: #248bd0;
}
.modal-login .hint-text a {
  color: #999;
}
.trigger-btn {
  display: inline-block;
  margin: 100px auto;
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
    $arStatus = array(
                0 => "Pendiente",
                1 => "Enviado",
                2 => "Entregado"      
              );
    /*
    $sql = "SELECT no_producto, producto, precio, cantidad, no_transferencia 
            FROM inventory.vw_transfer_details";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row

      while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo  '<td>'.$row["no_producto"]. "</td><td>" .$row["producto"]. "</td><td>" . $row["precio"]. "</td><td>" . $row["cantidad"].'</td><td>'.$row["no_transferencia"]."<td></tr>";
      }
    } else {
      echo "0 results";
    }*/
    #$conn->close();

    ?>
 <div id="accordion">
    <?php

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $cont=1;

      $sql = "SELECT * FROM inventory.vw_transfer;";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
      // output data of each row

      while($row = $result->fetch_assoc()) {        
        $status=$arStatus[$row["status"]];
            
    
        echo '<div class="card">
          <div class="card-header">
            <a class="card-link" data-toggle="collapse" href="#collapse'.$cont.'">
               
                '.$row["id"]. " " .$row["description"]. " " . $row["date"]. " " . $row["warehouse_origin"].' '.$row["warehouse_destination"].' '.$status.
            '</a>
          </div>
          <div id="collapse'.$cont.'" class="collapse show" data-parent="#accordion">
            <div class="card-body">
              Lorem ipsum..
            </div>
          </div>
        </div>

          ';
      $cont++;
    }
    } else {
      echo "0 results";
    }
    ?>
</div>
</body>
</html>