<?php


	$rut = $_GET["rut"];
 	$direccion = str_replace(",", ".", $_GET["dn"]);
 	$audiencia = $_GET["iss"]; 
 	$geo = $_GET["Geoloc"]; 
 	$nombre = $_GET["Nombre"];
 	$apellidoM =$_GET["appm"];
 	$apellidoP = $_GET["appp"];
 	$tipo = $_GET["tipo"];
 	$date = $_GET['date'];
 	$date_limit = date('Y-m-d', strtotime(substr($_GET['fecha_limit'], 0, 10)));
 	$charge = $_GET['charge'];
 	$tel = $_GET['tel'];
 	$days = $_GET['days'];
 	$exist = $_GET['exist'];
 	$fac = $_GET['fac'];
 	$mail = $_GET['email'];
    $subject = $_GET['subject'];
    $argument = $_GET['argument'];

$datos = mysqli_connect('localhost', "root", "MoNoCeRoS", "K_usr10000");
//check usuario
$clean_rut = substr($rut , 0, (strlen($rut) - 1));

$checkin = mysqli_query($datos, "SELECT CTZ_NAMES FROM CITIZENS WHERE CTZ_RUT = " . $clean_rut );

if(mysqli_num_rows($checkin) === 0){
                  
$insertar_ciudadano1 = "INSERT INTO CITIZENS (CTZ_NAMES, CTZ_SURNAME1, CTZ_SURNAME2, CTZ_ADDRESS, CTZ_GEOLOC, CTZ_RUT, CTZ_DVF, CTZ_DATE_ING, CTZ_TEL, CTZ_MAIL, CTZ_FAC_ENTER) ";
$insertar_ciudadano2 = " VALUES ('" . $nombre . "', '" . $apellidoP . "', '" . $apellidoM .  "' , '" . $direccion . "', '" . $geo . "' , " . $clean_rut . " , '" . substr($rut,-1,1) . "', '" . $date . "', " . $tel ." ,'" . $mail . "', " . $fac . ")";
$insertar_ciudadano  = $insertar_ciudadano1 . $insertar_ciudadano2;


if(!mysqli_query($datos, $insertar_ciudadano)){
     echo (mysqli_error($datos));
   exit;
  } 

} else if(mysqli_num_rows($checkin) !== 0 && $argument == 1){

if(!mysqli_query($datos, "UPDATE CITIZENS SET CTZ_NAMES = '" . $nombre . "' WHERE CTZ_RUT= " . $clean_rut . " AND CTZ_FAC_ENTER= " . $fac . ");")){
	echo "nombre " .  mysqli_errno($datos);
	exit;
}
if(!mysqli_query($datos, "UPDATE CITIZENS SET CTZ_SURNAME1 = '" . $apellidoP . "' WHERE CTZ_RUT=" . $clean_rut . " AND CTZ_FAC_ENTER= " . $fac . ");")){
	echo "appp " . mysqli_errno($datos);
	exit;
}
if(!mysqli_query($datos, "UPDATE CITIZENS SET CTZ_SURNAME2 = '" . $apellidoM . "' WHERE CTZ_RUT=" . $clean_rut . " AND CTZ_FAC_ENTER= " . $fac . ");")){
	echo "appm " . mysqli_errno($datos);
	exit;
}
if(!mysqli_query($datos, "UPDATE CITIZENS SET CTZ_ADDRESS = '" . $direccion . "' WHERE CTZ_RUT=" . $clean_rut . " AND CTZ_FAC_ENTER= " . $fac . ");")){
	echo "direccion " . mysqli_errno($datos);
	exit;
}
if(!mysqli_query($datos, "UPDATE CITIZENS SET CTZ_GEOLOC = '" . $geo . "' WHERE CTZ_RUT=" . $clean_rut . " AND CTZ_FAC_ENTER= " . $fac . ");")){
	echo "geo " . mysqli_errno($datos);
	exit;
}
if(!mysqli_query($datos, "UPDATE CITIZENS SET CTZ_TEL = " . $tel . " WHERE CTZ_RUT = " . $clean_rut . " AND CTZ_FAC_ENTER= " . $fac . ");")){
	echo "tel " . mysqli_errno($datos);
	exit;
}
if(!mysqli_query($datos, "UPDATE CITIZENS SET CTZ_MAIL = '" . $mail . "' WHERE CTZ_RUT=" . $clean_rut . " AND CTZ_FAC_ENTER= " . $fac . ");")){
	echo "mail " . mysqli_errno($datos);
	exit;
}


} else {


} 


if ($days == 'NaN'){
   $diff = 999;
   $state = 1;
   
} else {

$date1 = strtotime($date);
$date2 = strtotime($date_limit);
$diff = round(($date2 - $date1)/86400);

if($diff <= 3){

$state = 4;	

} else if($diff <= 0){

$state = 3;
} else {
$state = 2;
}

}

$insertar_audi1 = "INSERT INTO ISSUES(ISS_DATE_ING, ISS_DESCRIP, ISS_CHARGE_USR, ISS_DEADLINE, ISS_DAYS , ISS_STATE, ISS_FINISH_DATE , ISS_TYPE, ISS_CTZ, ISS_FAC_CODE, ISS_SUBJECT, ISS_PROGRESS) ";
$insertar_audi2 = "VALUES ('" . $date . "', '" . $audiencia . "', '" . $charge . "', '" . $date_limit . "', " . $diff . " , " . $state . ", '" . $date_limit . "', " . $tipo . " , " . $clean_rut . ", " . $fac . " , '" . $subject . "', 0);";

$insertar_audi = $insertar_audi1 . $insertar_audi2;

if(!mysqli_query($datos, $insertar_audi)){
	echo (mysqli_error($datos));
} else {

$iss_call = mysqli_fetch_assoc(mysqli_query($datos, "SELECT ISS_ID FROM ISSUES WHERE ISS_FAC_CODE = " . $fac . " ORDER BY ISS_ID DESC LIMIT 1"));

echo  $iss_call['ISS_ID'];
}



?>