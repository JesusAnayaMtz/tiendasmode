<?php 
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
//require 'vendor/autoload.php';
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

if (isset($_GET['accion'])) {
    ## Se recibe la accion deseada
    $accion = $_GET['accion'];
    switch ($accion) {
        case 'ajaxUploadImagesMainBanner':
            uploadImagesMainBanner();
            break;
        case 'sendReport':
            sendReportEmail();
            break;
        case 'deleteImages';
            deleteImages();
            break;
        default:
            ## Accion no reconocida
            $jresponse['message'] = 'No se recibio una acción válida, revise su petición.';
            break;
    }
}

header('Content-type: application/json');
echo json_encode($jresponse);

## Proceso de carga de imagenes para el banner principal  
function uploadImagesMainBanner() {
    global $jresponse;
    if (isset($_FILES['archivo0'])) {
        ## Procesar imagenes cargadas
        $i = 0;
        $directorio = 'assets/images/main-banner';
        $exito = 0;
        while (!empty($_FILES["archivo".$i])) {
            $archivo = $_FILES["archivo".$i];
            if (in_array(array('image/png','image/jpeg'),$archivo["type"])) {
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
    global $jresponse;

    $cuerpo = '<div style="width: 700px;text-align: center;background-color: #f4f4f4;"><img src="https://jesusanayamtz.github.io/tiendasmode/assets/images/logo.png" width="300px"><br><span style="font-weight: bold;">MODETIENDAS.MX</span>';
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
            $cuerpo .= '<h2 style="padding-bottom: 13px;">Recibiste la siguiente QUEJA</h2></div>';
            $cuerpo .= '<div style="width: 700px;display: flex;"><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;"><strong>NOMBRE:</strong></div><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;width: 100%;text-align: left;">'.$_POST['nombre-rep'].'</div></div>';
            $cuerpo .= '<div style="width: 700px;display: flex;"><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;"><strong>TELEFONO:</strong></div><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;width: 100%;text-align: left;">'.$_POST['tel-rep'].'</div></div>';
            $cuerpo .= '<div style="width: 700px;display: flex;"><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;"><strong>TIENDA:</strong></div><div style="margin: 5px;padding: 7px;background-color: #c3d9f8;width: 100%;text-align: left;">'.$_POST['tienda-rep'].'</div></div>';
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
        $mail->Host       = 'mail.modetiendas.mx';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'informacion@modetiendas.mx';                     //SMTP username
        $mail->Password   = '#InformaHGP.123';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('informacion@modetiendas.mx', 'Reportes Portal');
        $mail->addAddress('jesusanaya@modetiendas.mx', 'Chucho Ibanez');     //Add a recipient
        $mail->addCC('arturoibanez@modetiendas.mx', 'Information');
        //$mail->addBCC('bcc@example.com');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Sugerencia - Queja portal Web';
        $mail->Body    =  $cuerpo;
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

## Elimiar una o mas imagenes del banner principal o de promociones
function deleteImages() {
    global $jresponse;

    $elements = json_decode(file_get_contents('php://input'),true);
    $hits = 0;
    $failures = 0;
    if (!empty($elements['typedel'])) {
        ## Obtener imagenes del tipo solicitado
        $files = getFiles($elements['typedel']);
        $deletefiles = $elements['elements'];
        foreach ($deletefiles as $item) {
            # Se recorren el arreglo de archivos  
            if (array_key_exists($item,$files)) {
                ## el archivo se encuentra, es valido se elimina
                if(unlink($files[$item])) {
                    $hits++;
                } else {
                    $failures++;
                }
                    
            }
        }
    } else {
        $jresponse['success'] = false;
        $jresponse['message'] = 'No se recibieron los parametros para .';
    }
}

function getFiles($typef) {
    $route = ($typef=='mainBanner')? "assets/images/main-banner/":"assets/images/promos/".$typef;

    $arryFiles = array();
    $iterator = new FilesystemIterator($route);
    foreach($iterator as $entry) {
        $arryFiles[$entry->getFilename()] = $route."/".$entry->getFilename();
    }
    return $arryFiles;
}