<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Traspasos</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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
    

    ?>
 <center><h2>Traspasos entre almacenes</h2></center>

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
               
                '.$row["description"]. " | " . $row["date"]. " | " . $row["warehouse_origin"].' | '.$row["warehouse_destination"].' | '.$status.
            '</a>
          </div>
          <div id="collapse'.$cont.'" class="collapse" data-parent="#accordion">
            <div class="card-body">

            <table class="table">
            <thead>
              <tr>
                <th scope="col">#Producto</th>
                <th scope="col">Producto</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
              </tr>
            </thead>
            <tbody>  
            ';
             
             
          $sql2 = "SELECT no_producto, producto, precio, cantidad, no_transferencia 
              FROM inventory.vw_transfer_details";
              $result2 = $conn->query($sql2);

              if ($result2->num_rows > 0) {
                // output data of each row

                while($row2 = $result2->fetch_assoc()) {
                  if ($row['id'] == $row2['no_transferencia']) {
                    echo '<tr>';
                    echo  '<td>'.$row2["no_producto"]. "</td><td>" .$row2["producto"]. "</td><td>" . $row2["precio"]. "</td><td>" . $row2["cantidad"].'</td></tr>';    
                  }
                }
                
              } else {
                echo "0 results";
              }

            echo '
            </tbody>
            </table>
            </div>
          </div>
        </div>

          ';
      $cont++;
    }
    } else {
      echo "0 results";
    }

    $conn->close();
    ?>
</div>
</body>
</html>