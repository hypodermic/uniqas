<div id="comprar">
<div class="row">
<div class="col-1"></div>
<div class="col-5">
<h1>pack de</h1>
<h2>3 bases y 5 toallitas</h2>
<img id="imgcomprar" src="images/3pack.png" alt="pic3pack">
<h2>+ envio a domicilio</h2>
<h1>60 soles</h1>
</div>
<div class="col-5">
<div id="myDIV">
<h1>completa todos los datos</h1></br>
<form method="POST" id="culqi-card-form">
  <div>
    <label>
      <span>Nombre</span>
      <input type="text" size="50" name="first_name" data-culqi="card[first_name]" id="card[first_name]">
    </label>
  </div>
  <div>
    <label>
      <span>Apellido</span>
      <input type="text" size="50" name="last_name" data-culqi="card[last_name]" id="card[last_name]">
    </label>
  </div>
  <div>
    <label>
      <span>Direccion</span>
      <input type="text" size="80" name="address" data-culqi="card[address]" id="card[address]">
    </label>
  </div>
  <div>
    <label>
      <span>Ciudad</span></br>
      <input type="text" size="30" name="address_city" data-culqi="card[address_city]" id="card[address_city]">
    </label>
  </div>
  <div>
    <label>
      <span>Telefono</span></br>
      <input type="text" size="15" name="phone_number" data-culqi="card[phone_number]" id="card[phone_number]">
    </label>
  </div>
  <div>
    <label>
      <span>Correo Electrónico</span>
      <input type="text" size="50" data-culqi="card[email]" id="card[email]">
    </label>
  </div>
  <div>
    <label>
      <span>Número de tarjeta</span>
      <input type="text" size="20" data-culqi="card[number]" id="card[number]">
    </label>
  </div>
  <div>
    <label>
      <span>CVV</span>
      <input type="text" size="4" data-culqi="card[cvv]" id="card[cvv]">
    </label>
  </div>
  <div>
    <label>
      <span>Fecha expiración (MM/YYYY)</span>
      <input size="2" data-culqi="card[exp_month]" id="card[exp_month]">
      <span>/</span>
      <input size="4" data-culqi="card[exp_year]" id="card[exp_year]">
    </label>
  </div>
  <div>
  <button class="button" type="submit" name="enviar">comprar</button>
  </div>
</form>
</div>
<div id="wait"><h1>espere por favor</h1></div>
<div id="successMessage"><h1>su compra fue realizada con exito, se le enviara un email</h1></div>
</div>
<div class="col-1"></div>
</div>
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
      Culqi.createToken();
      e.preventDefault();
	  toggleDiv();
	  //send message to fill every box if pressed without filling everything
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
  Culqi.settings({
    title: 'uniqas store',
    currency: 'PEN',
    description: 'pack y envio',
    amount: 6000
  });
</script>
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
			  addMessage();
			  console.log(data);
			  
		  },
		  error: function(error_data){
			  console.log(error_data);
			  //add message if transaction fails
		  }
	  })
  } else { // ¡Hubo algún problema!
      // Mostramos JSON de objeto error en consola
      console.log(Culqi.error);
      alert(Culqi.error.user_message);
  }
};

</script>