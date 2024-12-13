<?php 
session_start(); 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

require_once "assets/config/DbWork.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/*Clase para tratar con excepciones y errores*/
require 'PHPMailer/src/Exception.php';
/*Clase PHPMailer*/
require 'PHPMailer/src/PHPMailer.php';
/*Clase SMTP necesaria para la conexión con un servidor SMTP*/
require 'PHPMailer/src/SMTP.php';

$jresponse = array(
    'success'=> false,
    'message'=>'Error al procesar. Faltan datos para poder procesar su peticion'
);
$conexion = null;

if (isset($_GET['accion'])) {
    ## Se recibe la accion deseada
    $accion = $_GET['accion'];
    switch ($accion) {
        case 'fetchUploadImagesMainBanner':
            ## Carga imagenes para el banner principal
            uploadImagesMainBanner();
            break;
        case 'fetchGetImagesMainBanner':
            ## Obtiene las imagenes del banner principal
            getImagesMainBanner();
            break;
        case 'fetchUploadImagesPromotional':
            ## Carga imagenes promocionales de un grupo/familia
            uploadImagesPromotional();
            break;
        case 'sendReport':
            ## Envia correo quejas/sugerencias desde el portal
            sendReportEmail();
            break;
        case 'deleteImages':
            ## Elimina imagenes publicadas
            deleteImages();
            break;
        case 'login':
            ## Validacion de usuario
            loginValidate();
            break;
        case 'getPromotions':
            ## Obtiene las imagenes de un grupo/familia promocional
            getImagesByGroup();
            break;
        case 'logout':
            ## Cerrar sesion admin
            logout();
            break;
        default:
            ## Accion no reconocida
            $jresponse['message'] = 'No se recibio una acción válida, revise su petición.';
            break;
    }
}

header('Content-type: application/json');
echo json_encode($jresponse);

## Obtener listado de imagenes de imagenes principal para admin
function getImagesMainBanner() {
    global $jresponse;

    $jresponse['data'] = readFilesMainBanner();
    $jresponse['success'] = true;
    $jresponse['message'] = 'Archivos encontrados.';
}

## Proceso de carga de imagenes de promociones por grupo/familia
function uploadImagesPromotional() {
    global $jresponse;

    validateSession();
    if (isset($_FILES['archivo0']) && isset($_POST['category'])) {
        ## Procesar imagenes cargadas
        $i = 0;
        $fam = $_POST['category'];
        $directorio = 'assets/images/promos/'.$fam;
        $exito = 0;
        
        
        while (!empty($_FILES["archivo".$i])) {
            $archivo = $_FILES["archivo".$i];
            if (in_array($archivo["type"],array('image/png','image/jpeg'))) {
                ## Se verifico que sen formatos de imagen validos
                $target_path = $directorio.'/'.$archivo["name"];
                if(move_uploaded_file($archivo["tmp_name"], $target_path)) {	
                    $exito++;
                }
            }
            $i++;
        }
        if ($exito>0) {
            $jresponse['data'] = getFiles($fam);
            $jresponse['success'] = true;
            $jresponse['message'] = 'Se procesaron '.$exito.' imagenes de '.$i.' archivos cargados.';
        } else {
            $jresponse['success'] = false;
            $jresponse['message'] = 'Error, no se procesaron los archivos cargados.';
        }

    }
}

## Proceso de carga de imagenes para el banner principal  
function uploadImagesMainBanner() {
    global $jresponse;

    validateSession();
    if (isset($_FILES['archivo0'])) {
        ## Procesar imagenes cargadas
        $i = 0;
        $directorio = 'assets/images/main-banner';
        $exito = 0;
        while (!empty($_FILES["archivo".$i])) {
            $archivo = $_FILES["archivo".$i];
            if (in_array($archivo["type"],array('image/png','image/jpeg'))) {
                ## Se verifico que sen formatos de imagen validos
                $target_path = $directorio.'/'.$archivo["name"];
                if(move_uploaded_file($archivo["tmp_name"], $target_path)) {	
                    $exito++;
                }
            }
            $i++;
        }
        if ($exito>0) {
            $jresponse['data'] = readFilesMainBanner();
            $jresponse['success'] = true;
            $jresponse['message'] = 'Se procesaron '.$exito.' imagenes de '.$i.' archivos cargados.';
        } else {
            $jresponse['success'] = false;
            $jresponse['message'] = 'Error, no se procesaron los archivos cargados.';
        }
    }
}

function sendReportEmail() {
    global $jresponse, $conexion;

    $cuerpo = '<div style="width: 700px;text-align: center;background-color: #f4f4f4;"><img src="https://modetiendas.mx/assets/images/logo.png" width="300px"><br><span style="font-weight: bold;">MODETIENDAS.MX</span>';
    if (isset($_POST['tipoContacto'])) {
        # code...
        $tipoContacto = $_POST['tipoContacto'];
        if ($tipoContacto=='sugerencia') {
            ## Se procesara una sugerencia
            $cuerpo .= '<h2 style="padding-bottom: 13px;">Recibiste la siguiente SUGERENCIA</h2></div>';
            $cuerpo .= '<div style="width: 700px;display: flex;"><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;"><strong>NOMBRE:</strong></div><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;width: 100%;text-align: left;">'.$_POST['nombre-rep'].'</div></div>';
            $cuerpo .= '<div style="width: 700px;display: flex;"><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;"><strong>EMAIL:</strong></div><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;width: 100%;text-align: left;">'.$_POST['email-rep'].'</div></div>';
            $cuerpo .= '<div style="width: 700px;display: flex;"><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;"><strong>MENSAJE:</strong></div><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;width: 100%;text-align: left;">'.$_POST['message-rep'].'</div></div>';
        } else {
            ## Se procesa una Queja
            ## Se obtienen datos de la tienda
            validateConexionDB();
            $sql = "SELECT CONCAT_WS(' ','Mode',cnombempr,cdir,'Mpio.', cmpio) AS direccion FROM `store_address` WHERE cclavempr = ".$_POST['tienda-rep'];
            $result = $conexion->execute($sql);
            $branch = $result->fetch(PDO::FETCH_ASSOC);

            $cuerpo .= '<h2 style="padding-bottom: 13px;">Recibiste la siguiente QUEJA</h2></div>';
            $cuerpo .= '<div style="width: 700px;display: flex;"><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;"><strong>NOMBRE:</strong></div><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;width: 100%;text-align: left;">'.$_POST['nombre-rep'].'</div></div>';
            $cuerpo .= '<div style="width: 700px;display: flex;"><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;"><strong>TELEFONO:</strong></div><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;width: 100%;text-align: left;">'.$_POST['tel-rep'].'</div></div>';
            $cuerpo .= '<div style="width: 700px;display: flex;"><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;"><strong>TIENDA:</strong></div><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;width: 100%;text-align: left;">'.$branch['direccion'].'</div></div>';
            $cuerpo .= '<div style="width: 700px;display: flex;"><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;"><strong>FECHA:</strong></div><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;width: 100%;text-align: left;">'.$_POST['fecha-rep'].'</div></div>';
            $cuerpo .= '<div style="width: 700px;display: flex;"><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;"><strong>HORA:</strong></div><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;width: 100%;text-align: left;">'.$_POST['hora-rep'].'  hrs</div></div>';
            $cuerpo .= '<div style="width: 700px;display: flex;"><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;"><strong>MENSAJE:</strong></div><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;width: 100%;text-align: left;">'.$_POST['message-rep'].'</div></div>';
        }
    }
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
        //Server settings
        ///$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'mail.modetiendas.mx';                     //Set the SMTP server to send through
        $mail->SMTPAuth = true;                                   //Enable SMTP authentication
        $mail->Username = 'informacion@modetiendas.mx';                     //SMTP username
        $mail->Password = '#InformaHGP.123';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('informacion@modetiendas.mx', 'Reportes Portal');
        $mail->addAddress('contactoclientes@modetiendas.mx', 'Contacto Clientes');     //Add a recipient
        $mail->addCC('juliolopez@modetiendas.mx', 'Julio Lopez');
        //$mail->addBCC('bcc@example.com');

        //Content
        $mail->isHTML(true);                                 
        $mail->Subject = ucfirst($tipoContacto).' portal Web'; 
        $mail->Body = $cuerpo;
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->send();

        $jresponse['success'] = true;
        $jresponse['message'] = 'Se envio su mensaje correctamente.';
    } catch (Exception $e) {
        $jresponse['success'] = false;
        $jresponse['message'] = "No se envio el correo electronico: {$mail->ErrorInfo}";
    }
}

function readFilesMainBanner() {
    $arrayFiles = array('movil'=>array(),'web'=>array());
    $iterator = new FilesystemIterator("assets/images/main-banner/");
    foreach($iterator as $entry) {
        if (strpos($entry->getFilename(),'movil')===false) {
            array_push($arrayFiles['web'], $entry->getFilename());
        } else {
            array_push($arrayFiles['movil'], $entry->getFilename());
        }
    }
    return $arrayFiles;
}

## Proporciona el nombre de los archivos de promociones por tipo
function getImagesByGroup() {
    global $jresponse;

    validateSession();
    $parameters = json_decode(file_get_contents('php://input'),true);
    $hits = 0;
    $failures = 0;
    if (!empty($parameters['category'])) {
        ## Obtener imagenes del tipo solicitado
        $files = getFiles($parameters['category']);
        if (count($files)>0) {
            $jresponse['success'] = true;
            $jresponse['data'] = $files;
            $jresponse['message'] = 'Archivos encontrados.';
        } else {
            $jresponse['success'] = false;
            $jresponse['message'] = 'No se encontraron archivos.';
        }
    } else {
        $jresponse['success'] = false;
        $jresponse['message'] = 'No se recibio el parámetro de filtrado de imagen.';
    }
}

## Elimiar una o mas imagenes del banner principal o de promociones
function deleteImages() {
    global $jresponse;

    validateSession();
    $elements = json_decode(file_get_contents('php://input'),true);
    $hits = 0;
    $failures = 0;
    if (!empty($elements['typedel'])) {
        $typedel = $elements['typedel'];
        $route = ($typedel=='mainBanner')? "assets/images/main-banner/":"assets/images/promos/".$typedel;
        $deletefiles = $elements['elements'];
        foreach ($deletefiles as $item) {
            if(unlink($route.'/'.$item)) {
                $hits++;
            } else {
                $failures++;
            }
        }
        if ($hits==0) {
            ## No se elimino ningun archivo
            $jresponse['success'] = false;
            $jresponse['message'] = 'No se eliminaron '.$failures.' archivos. Error en el proceso.';
        } else {
            $jresponse['success'] = true;
            $jresponse['data'] = ($typedel=='mainBanner')? readFilesMainBanner():getFiles($typedel);
            $jresponse['message'] = 'Se eliminaron '.$hits.' archivos.';
        }
    } else {
        $jresponse['success'] = false;
        $jresponse['message'] = 'No se recibieron los parametros para poder eliminar archivos.';
    }
}

function getFiles($typef) {
    $route = ($typef=='mainBanner')? "assets/images/main-banner/":"assets/images/promos/".$typef;

    $arryFiles = array();
    $iterator = new FilesystemIterator($route);
    foreach($iterator as $entry) {
        $arryFiles[] = $route."/".$entry->getFilename();
    }
    return $arryFiles;
}

function loginValidate() {
    global $jresponse, $conexion;

    $jresponse['success'] = false;
    $jresponse['message'] = 'Usuario o Password Inválidos.';
    if (isset($_POST['user']) && isset($_POST['password'])) {
        validateConexionDB();
        ## se valida usuario y contraseña
        $sql = "SELECT password, name FROM user_account WHERE user = '".$_POST['user']."'";
        $result = $conexion->execute($sql);
        if ($conexion->numrows > 0) {
            $data = $result->fetch(PDO::FETCH_ASSOC);
            if (password_verify($_POST['password'], $data['password'])) {
                $_SESSION['usuario'] = $data['name'];
                $jresponse['success'] = true;
                $jresponse['message'] = 'Verificacion exitosa.';
            }
        }
    }
}

function logout() {
    global $jresponse;

    unset($_SESSION['usuario']);
    session_destroy();
    header("Location: https://".$_SERVER['HTTP_HOST']."/index.php");
    die();
}

function validateSession() {
    global $jresponse;

    if (empty($_SESSION['usuario'])) {
        $jresponse['success'] = false;
        $jresponse['message'] = 'Inicie sesión y vuelva a intentarlo.';

        header('Content-type: application/json');
        echo json_encode($jresponse);
        exit();
    }
}

function validateConexionDB() {
    global $jresponse, $conexion;

    $conexion = new DbWork();
    if ($conexion->connect()) {
        return true;
    } else {
        $jresponse['success'] = false;
        $jresponse['message'] = 'No se pudo consultar la base de datos. Error: Cnx-DB';
        header('Content-type: application/json');
        echo json_encode($jresponse);
        exit();
    }
            
}