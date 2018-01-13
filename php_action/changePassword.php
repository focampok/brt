<?php 

require_once 'core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$currentPassword = $_POST['password'];
	$newPassword = $_POST['npassword'];
	$conformPassword = $_POST['cpassword'];
	$nit = $_POST['nit'];

	$sql ="SELECT * FROM usuario WHERE nit = $nit";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();

	if($currentPassword == $result['password']) {

		if($newPassword == $conformPassword) {

			$updateSql = "UPDATE usuario SET password = '$newPassword' WHERE nit = $nit";
			if($connect->query($updateSql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Contraseña actualizada exitosamente";		
			} else {
				$valid['success'] = false;
				$valid['messages'] = "No se pudo actualizar la contraseña";	
			}

		} else {
			$valid['success'] = false;
			$valid['messages'] = "La contraseña no coincide con la confirmación";
		}

	} else {
		$valid['success'] = false;
		$valid['messages'] = "La contraseña actual es incorrecta";
	}

	$connect->close();

	echo json_encode($valid);

}

?>