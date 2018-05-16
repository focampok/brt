<?php 

require_once 'core.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());
	$currentPassword = $_POST['password'];
	$newPassword = $_POST['npassword'];
	$conformPassword = $_POST['cpassword'];
	$username = $_SESSION['username'];

	$sql ="SELECT * FROM USUARIO WHERE username = $username";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();

	if($currentPassword == $result['password']) {

		if($newPassword == $conformPassword) {

			$updateSql = "UPDATE USUARIO SET password = '$newPassword' WHERE username = '$username'";
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