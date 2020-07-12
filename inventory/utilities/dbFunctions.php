<?php  
      
    function getQueryData($sql){          
      $servername = "localhost";
      $username = "root";
      $password = "0sh030sh0";
      $dbname = "inventory";
      
      $conn = new mysqli($servername, $username, $password, $dbname);
      
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }        
        
        $result = $conn->query($sql);
        return($result);         
        
  }     




?>