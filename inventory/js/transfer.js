var counter = 1;
function addRowProduct(){
  var inIdProd = $('#inIdProd').val();
  var inProducto = $('#sProducts').val();
  var inCant = $('#inCantidad').val();

  var newTextBoxDiv = $(document.createElement('div'))
      .attr("id", 'TextBoxDiv' + counter);
  newTextBoxDiv.after().html('<div class="form-row">' +
        '<div class="form-group col-md-1">' +
        '<label>#Prod' + '</label>' +
        '<input class="form-control form-control-sm" type="text" name="idProd' + counter +
        '" id="txtIdProd' + counter + '" value="' + inIdProd + '" readonly></div>'+
        '<div class="form-group col-md-4">' +
        '<label>Producto' + '</label>' +
        '<input type="text" id="Producto' + counter +
        '" id="txtProd' + counter + '" value="' + inProducto + '" readonly></div>' + 
        '<div class="form-group col-md-1">' +
        '<label>Cantidad' + '</label>' +
        '<input type="text" name="Cantidad' + counter +
        '" id="txtCant' + counter + '" value="' + inCant + '" readonly></div></div>');
        newTextBoxDiv.appendTo("#rows");
      counter++;
      $("#removeButton").click(function () {
      if(counter==1){
          alert("No more textbox to remove");
          return false;
       }
      //counter--;
        $("#TextBoxDiv" + counter).remove();
      });
      $("#getButtonValue").click(function () {
      var msg = '';
      for(i=1; i<counter; i++){
          msg += "\n #prod" +  " : " + $('#prod').val();
      }
            alert(msg);
      });
}

function saveTransfer(){
    $.ajax({
      url:"checkPostTransfer.php",
      type:"post",
      data:$("#idTrnsForm").serialize(),
      success:function(d){
          alert('Traspaso guardado.');
          var url = "addTransfer.php";    
          $(location).attr('href',url);
      }
  });
}


function initPage(argument) {
    
    var idProd = $('#sProducts').find(":selected").attr('id');
    $('#inIdProd').val(idProd); 
    $("#sProducts").change(function(){
        var idProd = $('#sProducts').find(":selected").attr('id');
      $('#inIdProd').val(idProd);
    });
    var idAlmO = $('#sWareHouseOrigin').find(":selected").attr('id');
    $('#inIdWareHouseOrigin').val(idAlmO);  
    $("#sWareHouseOrigin").change(function(){
        var idAlmO = $('#sWareHouseOrigin').find(":selected").attr('id');
      $('#inIdWareHouseOrigin').val(idAlmO);
    });
    var idAlmD = $('#sWareHouseDestination').find(":selected").attr('id');
    $('#inIdWareHouseDestination').val(idAlmD); 
    $("#sWareHouseDestination").change(function(){
        var idAlmD = $('#sWareHouseDestination').find(":selected").attr('id');
      $('#inIdWareHouseDestination').val(idAlmD);
    });
    $('#inCantidad').val(1); 
    jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  });
  $( "#trnsForm" ).validate({
    rules: {
      inCantidad: {
        required: true,
        digits: true
      }
    }
  });
}

