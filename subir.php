<?php
$Directorio = "fotos/";
$archivoDestino = $Directorio . basename($_FILES["fotoCargada"]["name"]);
$subirOK = true;
$imageFileType = strtolower(pathinfo($archivoDestino,PATHINFO_EXTENSION));

// Compruebe si el archivo de imagen es una imagen real o una imagen falsa
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fotoCargada"]["tmp_name"]);
  if($check) {
    echo "El archivo es una imagen - " . $check["mime"] . ".";
    $subirOK = true;
  } else {
    echo "el archivo no es una imagen.";
    $subirOK = false;
  }
}

//chequeamos si el archivo existe
if (file_exists($archivoDestino)) {
  echo "Lo sentimos, el archivo ya existe.";
  $subirOK = false;
}

//Comprobar el tamaño del archivo
if ($_FILES["fotoCargada"]["size"] > 500000) {
  echo "Lo sentimos, su archivo es demasiado grande.";
  $subirOK = false;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Lo sentimos, solo se permiten archivos JPG, JPEG, PNG y GIF.";
  $subirOK = false;
}

// Compruebe si $subirOK está establecido en false por algun un error
if (!$subirOK) {
  echo "Lo sentimos, su archivo no fue subido.";
// si todo está bien, intente cargar el archivo
} else {
  if (move_uploaded_file($_FILES["fotoCargada"]["tmp_name"], $archivoDestino)) {
    echo "El archivo ". htmlspecialchars( basename( $_FILES["fotoCargada"]["name"])). " ha sido subido.";
  } else {
    echo "Lo sentimos, hubo un error al cargar su archivo.";
  }
}

?>