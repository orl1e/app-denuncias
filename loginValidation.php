<!DOCTYPE html>
<html>
<head>
	<title>Denuncias Ciudadanas</title>
	<link rel="stylesheet" type="text/css" href="estilo.css">
	<meta charset="utf-8">
</head>

<?php
			//Verificación SMS
			require 'vendor/autoload.php';
		try{
			$base=new PDO('mysql:host=localhost; dbname=clinica', 'root', '');
			$base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
			$sql="Select * from usuarios where nombre_usuario=? and apellido_usuario=? and password = ?";	
		
			$resultado=$base->prepare($sql);
			$nombre=$_POST["nombre"];
			$apellido=$_POST["apellido"];
			$password=$_POST["password"];
			$resultado->execute([$nombre,$apellido,$password]);
			$numero_registro=$resultado->rowCount();






			if ($numero_registro!=0){
				session_start();
				$_SESSION["usuario"] =$_POST["nombre"];

				// Configurar el cliente Twilio (o el servicio SMS que estés utilizando)
				$twilio = new Twilio\Rest\Client('ACa127815fc0cad65a95743dbf557bbb92', '8f1a2ab8fefaa555307a8645ff3d268d');

				// Generar un código único
				$codigo2FA = mt_rand(100000, 999999);

				// Almacenar el código temporalmente
				$_SESSION['codigo2FA'] = $codigo2FA;

				$_SESSION['codigoValido'];

				// Enviar el código por SMS
				$numeroDeTelefono = '+50766049897'; // El número de teléfono del usuario
				$mensaje = "Tu código de verificación 2FA es: $codigo2FA";

				$twilio->messages->create(
					$numeroDeTelefono,
					[
						'from' => '+16173338943',
						'body' => $mensaje,
					]
				);
				print($message->sid);
				header("location:multifactor.php");


			}
			else{
				header("location:login.php");
			}
		}catch(Exception $e){
			die("Error ".$e->getMessage());
		}

?>

</html>