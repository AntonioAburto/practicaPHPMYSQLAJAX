<?php  
	ini_set('display_errors', '1');
    $ds = DIRECTORY_SEPARATOR;
	$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds . 'utilities' . $ds;
	#echo $base_dir;die();
	require("{$base_dir}dbFunctions.php");	
	$contIdInputProd=0;

	function getSelect($idSel, $idOpt, $rDescOpt, $lblSel,$result){
		$sResult= '
				<label for="'.$idSel.'">'.$lblSel.'</label>
					<select class="form-control form-control-sm" id="'.$idSel.'">
			';
						if ($result->num_rows >= 0) {					     
					      while($row = $result->fetch_assoc()) {
					      		$sResult.= '      				
									<option id="'.$row[$idOpt].'">'.$row[$rDescOpt].'</option>
					      		';
					  		}
					  	}																			
			$sResult.='
		  			</select>
			';
		echo $sResult;
	}

	function addCtrlsWarehouseTrns(){	
		$result = getQueryData("SELECT id, warehouse FROM inventory.warehouse;");	
		echo '
			<div class="form-row">
	    		<div class="form-group col-md-1">
				<label for="inIdWareHouseOrigin">#Alm</label>
					<input class="form-control" name="niWHO" id="inIdWareHouseOrigin" type="text">
				</div>
				<div class="form-group col-md-3">';		
	    		getSelect('sWareHouseOrigin', 'id', 'warehouse', 'Almacen origen',$result);
		echo	'
				</div>
				<div class="form-group col-md-1">
				<label for="inIdWareHouseDestination">#Alm</label>
					<input class="form-control" name="niWHD" id="inIdWareHouseDestination" type="text">
				</div>		
	    		<div class="form-group col-md-3">';
	    		$result = getQueryData("SELECT * FROM inventory.warehouse;");
				getSelect('sWareHouseDestination', 'id', 'warehouse', 'Almacen destino',$result);																			
			echo '
					</div>
				</div>
				<hr>';	
	}

	function addCtrlsRowTransfer(){
		$result = getQueryData("SELECT id, product FROM inventory.products;");
		echo '
			<div class="form-row">
	    		<div class="form-group col-md-1">
				<label for="inIdProd">#prod</label>
					<input class="form-control form-control-sm" id="inIdProd" type="text" >
				</div>		
	    		<div class="form-group col-md-4">';
				getSelect('sProducts', 'id', 'product', 'Producto',$result);							echo '
		  		</div>
	  			<div class="form-group col-md-1">
					<label for="inCantidad">Cantidad</label>
	  				<input class="form-control form-control-sm" id="inCantidad" type="number">	
	  			</div>
			</div>
	  	';
  	}
	
	?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Nuevo traspaso</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="../js/transfer.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
  		initPage();
	});
</script>

<style type="text/css">
		*, ::after, ::before {
		    box-sizing: border-box;
		    margin: 6px;
		}

</style>
	
</head>
<body>
	<form name="trnsForm" id="idTrnsForm" action="checkPostTransfer.php" method="post" style="border-style: double;" marging="6px;">
		<h3>Nuevo traspaso entre almacenes</h3>
		<?= addCtrlsWarehouseTrns(); ?>	
		<?= addCtrlsRowTransfer();?>
		<button type="button" class="btn btn-outline-dark" onclick="saveTransfer();" style="margin: 6px;">Guardar</button>
		<button type="button" id="add" class="btn btn-outline-primary" style="margin: 6px;" onclick="addRowProduct();">Agregar producto</button>
		<div class="form-row" id="rows"></div>
	</form>
</body>
</html>



