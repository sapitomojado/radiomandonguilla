 <?php
	if (!isset($_SESSION)) {session_start();}
	$hostname_Conexion = "localhost";
	$database_Conexion = "radiomandonguilla";
	$username_Conexion = "root";
	$password_Conexion = "vertrigo";
	$Conexion = mysqli_connect($hostname_Conexion, $username_Conexion, $password_Conexion, $database_Conexion);
	mysqli_set_charset($Conexion, 'utf8');
	if (is_file("ctrl/includes/funciones.php")){
		require_once("ctrl/includes/funciones.php");
	}
	if (is_file("../ctrl/includes/funciones.php")){
		require_once("../ctrl/includes/funciones.php");
	}
?>