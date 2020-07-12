<?php
	function getStrDetail($iProd, $iCant){
		$sDetail="CALL `inventory`.`new_transfer_detail`(
			(select id from transfer
			ORDER BY id desc LIMIT 1), 
			".$iProd.",
			".$iCant.");\n";
		return $sDetail;
	}
	$sql="CALL `inventory`.`new_transfer`(
			'Traspaso automatico',
 			".$_POST['niWHO'].", ".$_POST['niWHD'].");\n";
 	$cont=1;
 	$cantidad=0;
 	$producto=0;		
 	foreach($_POST as $key => $value){
 		$producto=$_POST["idProd".$cont];
 		$cantidad=$_POST["Cantidad".$cont];
	    if ($producto>0 and $cantidad>0) {
	    	$sql.=getStrDetail($producto, $cantidad);
	    }
	    $cont++;
	}	      	
	//echo $sql;


	try {
            $pdo = new PDO("mysql:host=localhost;dbname=inventory", 'root', '0sh030sh0');



	$q = $pdo->query($sql);
	    $q->setFetchMode(PDO::FETCH_ASSOC);
	} catch (PDOException $e) {
	    die("Error occurred:" . $e->getMessage());
	}
?>
