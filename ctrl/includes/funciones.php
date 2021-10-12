<?php
if ( !function_exists( "GetSQLValueString" ) ) {
  function GetSQLValueString( $theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "" ) {
    if ( PHP_VERSION < 6 ) {
      $theValue = get_magic_quotes_gpc() ? stripslashes( $theValue ) : $theValue;
    }
    global $Conexion;
    $theValue = function_exists( "mysqli_real_escape_string" ) ? mysqli_real_escape_string( $Conexion, $theValue ) : mysqli_escape_string( $Conexion, $theValue );

    switch ( $theType ) {
      case "text":
        $theValue = ( $theValue != "" ) ? "'" . $theValue . "'": "NULL";
        break;
      case "long":
      case "int":
        $theValue = ( $theValue != "" ) ? intval( $theValue ) : "NULL";
        break;
      case "double":
        $theValue = ( $theValue != "" ) ? doubleval( $theValue ) : "NULL";
        break;
      case "date":
        $theValue = ( $theValue != "" ) ? "'" . $theValue . "'": "NULL";
        break;
      case "defined":
        $theValue = ( $theValue != "" ) ? $theDefinedValue : $theNotDefinedValue;
        break;
    }
    return $theValue;
  }
}
//**************************************************************
//*
//* Devuelve el dia de la semana del día en curso.
//*
//***************************************************************
function Fn_DiaDeLaSemana() {
  date_default_timezone_set( "Europe/Madrid" );
  setlocale( LC_ALL, "es_ES" );
  return date( "w" );

}
//**************************************************************
//*
//* Devuelve el Id del Programa que esta online (II VERSION)
//*
//***************************************************************
function Fn_ProgramaOn2() {
  global $Conexion;
  date_default_timezone_set( "Europe/Madrid" );
  setlocale( LC_ALL, "es_ES" );
  $Hora = date('H:i:s');
  $id_devolver = "";
  $query_ConsultaFuncion = "SELECT tblparrilla.intId FROM tblparrilla WHERE (tblparrilla.timeHora <='" . $Hora . "' AND tblparrilla.timeHoraTermina >='" . $Hora . "') AND 
  tblparrilla.intDiaSemana = " . Fn_DiaDeLaSemana();
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return $row_ConsultaFuncion["intId"];
  mysqli_free_result( $ConsultaFuncion );
}


//**************************************************************
//*
//* Devuelve el Id del Programa por el Id de la parrilla 
//*
//***************************************************************
function IdProgramaIdParrilla($identificador) {
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tblparrilla.idPrograma FROM tblparrilla WHERE tblparrilla.intId = %s", $identificador);
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return $row_ConsultaFuncion["idPrograma"];
  mysqli_free_result( $ConsultaFuncion );
}
//**************************************************************
//*
//* Devuelve al HORA DE INICIO del PROGRAMA ACTUAL 
//*
//***************************************************************
function HoraComienzoProgramaOnAir($identificador) { 
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tblparrilla.timeHora FROM tblparrilla WHERE tblparrilla.intId = %s", $identificador);
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return $row_ConsultaFuncion["timeHora"];
  mysqli_free_result( $ConsultaFuncion );
}
//**************************************************************
//*
//* Devuelve al HORA FINALIZACION del PROGRAMA ACTUAL 
//*
//***************************************************************
function HoraFinalizaProgramaOnAir($identificador) { 
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tblparrilla.timeHoraTermina FROM tblparrilla WHERE tblparrilla.intId = %s", $identificador);
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return $row_ConsultaFuncion["timeHoraTermina"];
  mysqli_free_result( $ConsultaFuncion );
}
//**************************************************************
//*
//* Devuelve Nombre de Locutor por su ID
//*
//***************************************************************
function Fn_NombreLocutorId( $identificador ) {
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tbllocutores.strLocutor FROM tbllocutores WHERE tbllocutores.intId = %s", $identificador );
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return $row_ConsultaFuncion[ 'strLocutor'];
  mysqli_free_result( $ConsultaFuncion );
}

//**************************************************************
//*
//* Devuelve Nombre Imagen por Id del Programa
//*
//***************************************************************
function Fn_ImagenIdPrograma( $identificador ) {
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tblprogramas.strImagen FROM tblprogramas WHERE tblprogramas.intId = %s", $identificador );
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return $row_ConsultaFuncion[ 'strImagen' ];
  mysqli_free_result( $ConsultaFuncion );
}
//**************************************************************
//*
//* Devuelve ColorFondo por Id del Programa
//*
//***************************************************************
function Fn_ColorFondoIdPrograma( $identificador ) {
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tblprogramas.strColorFondo FROM tblprogramas WHERE tblprogramas.intId = %s", $identificador );
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return $row_ConsultaFuncion[ 'strColorFondo' ];
  mysqli_free_result( $ConsultaFuncion );
}
//**************************************************************
//*
//* Devuelve DescripcionPrograma por Id del Programa
//*
//***************************************************************
function Fn_DescripcionProgramaIdPrograma( $identificador ) {
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tblprogramas.strDescripcion FROM tblprogramas WHERE tblprogramas.intId = %s", $identificador );
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return $row_ConsultaFuncion[ 'strDescripcion' ];
  mysqli_free_result( $ConsultaFuncion );
}
//**************************************************************
//*
//* Devuelve TipodePrograma  por Id del tipo de Programa
//*
//***************************************************************
function Fn_TipodeProgramaIdtipoPrograma( $identificador ) {
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tbltipoprograma.strTipoPrograma FROM tbltipoprograma WHERE tbltipoprograma.intId = %s", $identificador );
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return $row_ConsultaFuncion[ 'strTipoPrograma' ];
  mysqli_free_result( $ConsultaFuncion );
}
//**************************************************************
//*
//* Devuelve TipodePrograma  por Id del Programa
//*
//***************************************************************
function Fn_TipodeProgramaIdPrograma( $identificador ) {
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tblprogramas.idTipoPrograma FROM tblprogramas WHERE tblprogramas.intId = %s", $identificador );
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return Fn_TipodeProgramaIdtipoPrograma( $row_ConsultaFuncion[ 'idTipoPrograma' ] );
  mysqli_free_result( $ConsultaFuncion );
}
//**************************************************************
//*
//* Devuelve NombrePrograma por Id del Programa
//*
//***************************************************************
function Fn_NombreProgramaIdPrograma( $identificador ) {
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tblprogramas.strPrograma FROM tblprogramas WHERE tblprogramas.intId = %s", $identificador );
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return $row_ConsultaFuncion[ 'strPrograma' ];
  mysqli_free_result( $ConsultaFuncion );
}
//**************************************************************
//*
//* Devuelve NombreLocutor por Id del Locutor
//*
//***************************************************************
function Fn_NombreLocutorIdLocutor( $identificador ) {
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tbllocutores.strLocutor FROM tbllocutores WHERE tbllocutores.intId = %s", $identificador );
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return Fn_NombreLocutorId( $row_ConsultaFuncion[ 'strLocutor' ] );
  mysqli_free_result( $ConsultaFuncion );
}
//**************************************************************
//*
//* Devuelve NombreLocutor/es por Id del Programa
//*
//***************************************************************
function Fn_NombreLocutoresIdPrograma( $identificador ) {
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tblprogramaslocutores.idLocutor FROM tblprogramaslocutores WHERE tblprogramaslocutores.IdPrograma = %s", $identificador );
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  if ( $totalRows_ConsultaFuncion > 0 ) {
    do {
      echo "<div><i  style='color:" . Fn_ColorFondoIdPrograma( $identificador ) . "' class='fas fa-microphone'></i><strong class='fw-bold'> " . Fn_NombreLocutorId( $row_ConsultaFuncion[ 'idLocutor' ] ) . "</strong></div>";
    } while ( $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion ) );
  }
  return
  mysqli_free_result( $ConsultaFuncion );
}
//**************************************************************
//*
//* Devuelve DuracionPrograma por Id del Programa
//*
//***************************************************************
function Fn_DuracionProgramaIdParrilla( $identificador ) { ////// BORRAR
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tblparrilla.timeDuracion FROM tblparrilla WHERE tblparrilla.intId = %s", $identificador );
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return $row_ConsultaFuncion[ 'timeDuracion' ];
  mysqli_free_result( $ConsultaFuncion );
}

//**************************************************************
//*
//* Devuelve % Progreso del Programa
//*
//***************************************************************
function Fn_ProgresoPrograma( $HoraComienzo, $Duracion ) {
  date_default_timezone_set( "Europe/Madrid" );
  setlocale( LC_ALL, "es_ES" );
  $HoraActual = date( "H:i" );
  //echo "hora actual:".$HoraActual."<br>";
  $HoraActual = strtotime( date( "H:i" ) );


  //echo "hora comienzo:".$HoraComienzo."<br>";
  $HoraComienzo = strtotime( $HoraComienzo );


  $HoraFinal = strtotime( '+' . $Duracion . ' minutes', $HoraComienzo );
  $HoraFinal = date( "H:i", $HoraFinal );
  //echo "hora de final:".$HoraFinal."<br>";

  if ( $HoraFinal == "00:00" ) {
    $HoraFinal = "23:59";
  }
  $HoraFinal = strtotime( $HoraFinal );
  $TPC = round( ( intval( $HoraActual - $HoraComienzo ) ) * 100 / ( intval( $HoraFinal - $HoraComienzo ) ) );
  //echo "TPC:".$TPC;
  if ( $TPC < 0 ) {
    $TPC = 0;
  }
  if ( $TPC > 100 ) {
    $TPC = 0;
  }
  //echo  $TPC."%";
  return $TPC;

}
//**************************************************************
//*
//* Devuelve Dia de la Semana en texto por numero de la Semana 0,1,2,  Domingo, Lunes...
//*
//***************************************************************
function Fn_DiaSemana( $i ) {
$dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
	return $dias[$i];
}
//**************************************************************
//*
//* CONVIERTE Y-M-D H:M:S to D-M-Y H:M:S
//* 2021-08-17 15:45:34
//*
//***************************************************************
function Fn_YMDHMStoDMYHMS($fch) {
return substr($fch,8,2)."/".substr($fch,5,2)."/".substr($fch,0,4)." ".substr($fch,11,8);
}
//**************************************************************
//*
//* A LA FECHA QUE SE LE PASA YYYY-MM-DD
//* LE SUMA SUMA 7 DIAS. +7D LO DEVUELVE EN FORMATO DD-MM-YYYY
//* 
//*
//***************************************************************
function Fn_YYYYMMDD7DIAS($fch) {
$fch= date_create($fch);
date_add($fch, date_interval_create_from_date_string("7 days"));
return date_format($fch,"d/m/Y");
}
//**************************************************************
//*
//* A LA FECHA QUE SE LE PASA YYYY-MM-DD
//* LE SUMA SUMA 7 DIAS. +7D LO DEVUELVE EN FORMATO DD-MM-YYYY
//* 
//*
//***************************************************************
function Fn_HoraMinutosAddBORRAR($fch,$duracion) {  //borrar
$fch= date_create($fch);
date_add($fch, date_interval_create_from_date_string($duracion." minutes"));
return date_format($fch,"H:i:s");
}
//**************************************************************
//*
//* Convierte Fecha YYYY-MM-DD a formato normal DD/MM/YYYY
//*
//***************************************************************
function Fn_YMDtoDMY( $fch ) {

	return substr($fch,8,2)."/".substr($fch,5,2)."/".substr($fch,0,4);
}
//**************************************************************
//*
//* Devuelve Poblacion por el ID de la Poblacion
//*
//***************************************************************
function Fn_NombrePoblacionId( $identificador ) {
  global $Conexion;
  $query_ConsultaFuncion = sprintf( "SELECT tblmunicipios.strMunicipio FROM tblmunicipios WHERE tblmunicipios.id = %s", $identificador );
  $ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
  $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
  $totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
  return $row_ConsultaFuncion[ 'strMunicipio' ];
  mysqli_free_result( $ConsultaFuncion );
}
//***************************************************************
//
//
// Función para obtener la IP del usuario
//
//
//***************************************************************
function get_ip_address() {

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

        $ip = $_SERVER['HTTP_CLIENT_IP'];

    } else {

        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

        } else {

            $ip = $_SERVER['REMOTE_ADDR'];
        }
    }
    return $ip;
}



//*******************************************************************************
//
//
// Actualizar Registro Duracion Hora
//
//
//*******************************************************************************
function Fn_ActualizarRegistroDuracion( $min, $id ) {
global $Conexion;
 $updateSQL = sprintf("UPDATE tblparrilla SET timeDuracion=%s  WHERE intId=%s",  
	 				   GetSQLValueString($min, "text"),
             				    GetSQLValueString($id, "int"));

	$Result1 = mysqli_query($Conexion,$updateSQL ) or die(mysqli_error($Conexion));
	return;
}
//*******************************************************************************
//
//
// Función calculo de Hora en segundos
//
//
//*******************************************************************************
function Fn_HoraSegundos($FCH1,$FCH2){
	$totalMinutos1 = substr($FCH1,0,2)*60+substr($FCH1,3,2);
	$totalMinutos2 = substr($FCH2,0,2)*60+substr($FCH2,3,2);
	return $totalMinutos1-$totalMinutos2;


}
//*******************************************************************************
//
//
// Función calculo automático de la duracion de cada programa de la parrilla
//
//
//*******************************************************************************
function fn_calculoAutoDuracion(){
	global $Conexion;
	$HoraAnterior = "";
	$IdAnterior = "";
	$minutos = "";
	$newdate = "";
	for($i=0; $i<7; $i++){ // Para cada dia de la semana // 0 DOMINGO, 1 LUNES, 2 MARTES, 3 MIERCOLES, 4 JUEVES, 5 SABADO, 6 DOMINGO.	
			echo "<strong>". Fn_DiaSemana($i)."</strong> <br>";
			$query_ConsultaFuncion = sprintf( "SELECT * FROM tblparrilla WHERE tblparrilla.intDiaSemana = %s ORDER BY tblparrilla.timeHora ASC", $i );
			$ConsultaFuncion = mysqli_query( $Conexion, $query_ConsultaFuncion )or die( mysqli_error( $Conexion ) );
			$row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion );
			$totalRows_ConsultaFuncion = mysqli_num_rows( $ConsultaFuncion );
			do{
				if($HoraAnterior<>""){// Calculo de la duracion entre $HoraAnterior y $timeHora....
					$Horacomienzo = $row_ConsultaFuncion["timeHora"];
					if($Horacomienzo =="00:00:00"){
						$Horacomienzo = "24:00:00";	
					}
					//$minutos = Fn_HoraSegundos($Horacomienzo)-Fn_HoraSegundos($HoraAnterior);
					$minutos = Fn_HoraSegundos($Horacomienzo,$HoraAnterior);
					
					Fn_ActualizarRegistroDuracion($minutos, $IdAnterior);
					
					$HoraFinalSegundos = strtotime($row_ConsultaFuncion["timeHora"]);
					$newdate = date("H:i:s",$HoraFinalSegundos-1);    
					//Fn_ActualizarRegistroFinalizacion ($newdate,$IdAnterior);
					$query_PActualizar = "UPDATE tblparrilla SET timeHoraTermina= '".$newdate."' WHERE intId=".$IdAnterior;
					//$query_PActualizar = "UPDATE tblparrilla SET timeHoraTermina= '00:00:00' WHERE intId=".$row_ConsultaFuncion["intId"];
					$PActualizar = mysqli_query($Conexion, $query_PActualizar)or die(mysqli_error($Conexion));
					//*****************************************************************************
					//*
					//* Calcular Hora Finalizacion.
					//*
					//*****************************************************************************
					
					
				} else {
					$HCPR =  $row_ConsultaFuncion["timeHora"]; // Guardamos la Hora del Primer Registro.					
				}
					
				
				
				echo " id: ".$row_ConsultaFuncion["intId"]." dia semana: ". Fn_DiaSemana($row_ConsultaFuncion["intDiaSemana"])." Hora Comienzo: ".$row_ConsultaFuncion["timeHora"]." Id Programa: ".$row_ConsultaFuncion["idPrograma"]." MINUTOS DEL PROGRAMA ANTERIOR: ".$minutos." MINUTOS - FIN DEL PROGRAMA ANTERIOR: ".$newdate."<br>";
				$HoraAnterior = $row_ConsultaFuncion["timeHora"];
				$IdAnterior = $row_ConsultaFuncion["intId"];
				
			} while ( $row_ConsultaFuncion = mysqli_fetch_assoc( $ConsultaFuncion )) ;

	}
	if($HCPR<$HoraAnterior){
		$Datt = substr($HCPR,0,2)+24;
		$HCPR = substr_replace($HCPR,$Datt,0,2);
	} 
	//echo "HCPR:" .$HCPR."  HoraAnterior: ".$HoraAnterior." IdAnterior = ".$IdAnterior."<br>";
	$DuracionUltimoRegistro = Fn_HoraSegundos($HCPR,$HoraAnterior);
	//echo "Duracion del ultimo registro:  ".$DuracionUltimoRegistro." MINUTOS<br>";
	Fn_ActualizarRegistroDuracion( $DuracionUltimoRegistro, $IdAnterior);
	$HoraFinalSegundos = strtotime($HCPR);
	$newdate = date("H:i:s",$HoraFinalSegundos-1);  
	$query_PActualizar = "UPDATE tblparrilla SET timeHoraTermina= '".$newdate."' WHERE intId=".$IdAnterior;	
	$PActualizar = mysqli_query($Conexion, $query_PActualizar)or die(mysqli_error($Conexion));
 mysqli_free_result( $ConsultaFuncion );
}
?>