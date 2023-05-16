<?php 
    $UTENTE = "chiacchiere"; //utente
    $PASSWORD = "segreta";
    $BLOGFILE = "db/blog.txt"; // memorizzazione dei post

    require_once("key.php");
    require 'aws/vendor/autoload.php';
    use Aws\DynamoDb\DynamoDbClient;
    use Aws\Exception\AwsException;
    $credentials = new Aws\Credentials\Credentials($key, $secretKey);
    //Crea un client per DynamoDb
    $s3 = new Aws\DynamoDb\DynamoDbClient([
        'version' => 'latest',
        'region' => 'eu-west-3',
        'credentials' => $credentials ]);

    $TITOLO = "Quattro chiacchiere";
    $URL = "http://latoserver.dimi.uniud.it/~username/blog/";

    $POSTPERPAGINA = 5;
    
    // colori
    $COLSFONDO = "white";
    $COLTESTO = "black";
    $COLINTESTAZIONE = "#99C1FF";
    $COLMENU = "#99C1FF";
    // font
    $FONT = "Arial";?>