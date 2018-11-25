<?php

try {
  // Usando Composer (o puedes incluir las dependencias manualmente)
  //require 'request/library/Requests.php';
 // Requests::register_autoloader();
  require 'culqi/vendor/autoload.php';
  require 'culqi/lib/culqi.php';

  // Configurar tu API Key y autenticación
  $SECRET_API_KEY = "sk_test_fJxsdAHTwgAIZQa2";
  $culqi = new Culqi\Culqi(array('api_key' => $SECRET_API_KEY));

  // Creando Cargo a una tarjeta
  $charge = $culqi->Charges->create(
      array(
        "amount" => $_POST['monto'],
        "capture" => true,
        "currency_code" => "PEN",
		"email" => $_POST['email'],
        "description" => "Venta de prueba",
        "installments" => 0,
        "metadata" => array("test"=>"test"),
        "source_id" => $_POST['token'],
		"antifraud_details" => array(
			"first_name" => $_POST['fname'],
			"last_name" => $_POST['lname'],
			"address" => $_POST['address'],
			"address_city" => $_POST['city'],
			"country_code" => $_POST['country'],
			"phone_number" => $_POST['phone']
		)
	)	
  );
 
 
  // Respuesta
  echo json_encode($charge);
} catch (Exception $e) {
  echo json_encode($e->getMessage());
 
}

?>
