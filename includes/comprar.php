<div id="comprar">
<div class="row">

<div class="col-6">
<h1>pack de</h1>
<h2>3 bases y 5 toallitas</h2>
<img id="imgcomprar" src="images/3pack.png" alt="pic3pack">
<h2>+ envío a domicilio</h2>
<h1>S/60 soles</h1>
</div>
<div class="col-6">
<div id="myDIV">
<h1>completa todos los datos</h1></br>
<form method="POST" id="culqi-card-form">
  <div>
    <label>
      <span id="inputTitle">Nombre</span></br>
      <input type="text" size="50" name="first_name" data-culqi="card[first_name]" id="card[first_name]" required>
    </label>
  </div>
  <div>
    <label>
      <span id="inputTitle">Apellido</span></br>
      <input type="text" size="50" name="last_name" data-culqi="card[last_name]" id="card[last_name]" required>
    </label>
  </div>
  <div>
    <label>
      <span id="inputTitle">Dirección</span></br>
      <input type="text" size="50" name="address" data-culqi="card[address]" id="card[address]" required>
    </label>
  </div>
  <div>
    <label>
      <span id="inputTitle">Distrito</span></br>
      <input type="text" size="30" name="address_city" data-culqi="card[address_city]" id="card[address_city]" required>
    </label>
  </div>
  <div>
    <label>
      <span id="inputTitle">Provincia</span></br>
      <input type="text" name="provincia" value="Lima" readonly="readonly">
    </label>
  </div>
  <div>
    <label>
      <span id="inputTitle">Departamento</span></br>
      <input type="text" name="departamento" value="Lima" readonly="readonly">
    </label>
  </div>
  <div>
    <label>
      <span id="inputTitle">Teléfono</span></br>
      <input type="text" size="15" name="phone_number" data-culqi="card[phone_number]" id="card[phone_number]" required>
    </label>
  </div>
  
  <div>
  <button class="button" type="submit" name="enviar">comprar</button>
  </div>
</form>
</div>
<div id="wait"><h1>espere por favor</h1></div>
<div id="successMessage"><h1></h1></div>
<div id="errorMessage"></div>
</div>

</div>
<p>*El pack incluye todo lo que muestra la imagen más el envío a domicilio en Lima por Olva Courier. 
Si deseas hacer un pedido llena tus datos y haz click en ’comprar’, aparacerá un formulario para los datos de tu tarjeta.
Una vez realizada la compra se enviará un email con información acerca de tu pedido. Gracias.</p>
</div>




<script>
function addMessage() {
	var y = document.getElementById("wait");
	y.style.opacity = 0;
	var x = document.getElementById("successMessage");
    x.style.opacity = 1;
	var z = document.getElementById("comprar");
	z.style.cursor = "auto";
}
</script>
<script>
function errMessage() {
	var y = document.getElementById("wait");
	y.style.opacity = 0;
	var x = document.getElementById("errorMessage");
    x.style.opacity = 1;
	var z = document.getElementById("comprar");
	z.style.cursor = "auto";
}
</script>
<script>
function toggleDiv() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
	var y = document.getElementById("wait");
	y.style.opacity = 1;
	var z = document.getElementById("comprar");
	z.style.cursor = "wait";
}
</script>
<script>
		Culqi.publicKey = 'pk_test_oJmtho5pPAdOttOk';
		<!--new add 10/30-->
		Culqi.init();
	</script>

<script>
$('#culqi-card-form').on('submit', function(e) {
      //Crea el objeto Token con Culqi JS
	  Culqi.open();
	   e.preventDefault();
	   
	  //send message to fill every box if pressed without filling everything
  });
</script>
<script>
  Culqi.settings({
    title: 'uniqas store',
    currency: 'PEN',
    description: 'pack y envio',
    amount: 6000
  });
</script>
<!--
<a class="button" id="buyButton">comprar</a>
<script>
  $('#buyButton').on('click', function(e) {
      // Crea el objeto Token con Culqi JS
      Culqi.createToken();
      e.preventDefault();
  });
</script>

</div>

<script>
$('#buyButton').on('click', function(e) {
    // Abre el formulario con la configuración en Culqi.settings
    Culqi.open();
    e.preventDefault();
});
</script>
-->
<script>

function culqi() {
	toggleDiv();
  if (Culqi.token) { // ¡Objeto Token creado exitosamente!
      var token = Culqi.token.id;
	  var email = Culqi.token.email;
      //alert('Se ha creado un token:' + token);
	  $.ajax({
		  url: 'includes/servidordepago.php',
		  method: 'post',
		  data: {
			  token: token,
			  monto: 6000,
			  email: email,
			  fname: $('input[name="first_name"]').val(),
			  lname: $('input[name="last_name"]').val(),
			  address: $('input[name="address"]').val(),
			  city: $('input[name="address_city"]').val(),
			  country: 'PE',
			  phone: $('input[name="phone_number"]').val()
			  
		  },
		  dataType: 'JSON',
		  success: function(data){
			  //if ( == true){
			  //addMessage();
			  
			 if (data.object == "charge"){
			 console.log(data.outcome.user_message);
			 addMessage();
			 $('#successMessage').html(data.outcome.user_message);
			  } else {
				  var result = JSON.parse(data);
				  console.log(result.user_message);
				  errMessage();
				  $('#errorMessage').html(result.user_message);
			  }
			 
		  },
		  error: function(error_data){
			  //if object:error dsplay..
			 // if (data.object == "error"){
			  //errMessage();
			  //console.log(error_data);
			  //alert(error_data
			  if (error_data.object == "error") {
				  console.log(error_data.user_message);
			  }
			  //add message if transaction fails
		  }
	  })
  } else { // ¡Hubo algún problema!
      // Mostramos JSON de objeto error en consola
      errMessage();
	  console.log(Culqi.error);
      alert(Culqi.error.user_message);
  }
};

</script>