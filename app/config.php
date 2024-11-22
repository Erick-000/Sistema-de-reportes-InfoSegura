<?php 

define('SERVIDOR','localhost');
define('USUARIO','root');
define('PASSWORD','');
define('BD','infosegura');

$servidor = "mysql:dbname=".BD.";host=".SERVIDOR;

try {
    $pdo = new PDO($servidor,USUARIO,PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8"));
   // echo "Conexión";
} catch (PDOException $e) {
    //echo "Error al conectar";
}

$URL = "http://localhost/www.infosegura.com";

date_default_timezone_set("America/Bogota");
$fechaHora = date("Y-m-d H:i:s");
