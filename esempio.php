<?php
// Connessione al database

require_once("key.php");
require 'aws/vendor/autoload.php';
use Aws\DynamoDb\DynamoDbClient;
use Aws\Exception\AwsException;
$credentials = new Aws\Credentials\Credentials($key, $secretKey);
//Crea un client per DynamoDb
$s3 = new Aws\DynamoDb\DynamoDbClient([
'version' => 'latest', 'region' => 'eu-west-3',
'credentials' => $credentials ]);


$table = 'Esempio';
$ciao=array(
    'Utente-Autore' => array('S'=>'Homer'),
    'Titolo' => array('S'=>'Ciao'),
    'contenuto' => array('S'=>'Hello world'),
    'date' => array('S'=>'2023-05-15, 12:09')
    );

$rs = $s3->putItem(array(
        'TableName' => $table,
        'Item' => $ciao));


function leggi($da, $quanti = NULL) {
    global $BLOGFILE;
    $risultato = array();
    $contenuto = file($BLOGFILE); // leggo il contenuto
    if(is_null($quanti)) 
        $quanti = count($contenuto);
        for ($i = $da; ($i -$da < $quanti) && ($i <= count($contenuto)); $i++) {
            // estraggo un post dal file e lo aggiungo all'array $risultato
            $post = explode("#", $contenuto[$i -1]);
                $risultato[] = $post;
            }
            return $risultato;
        }

/*
$result = $s3->scan($params);

foreach ($result['Items'] as $item) {
    echo $item['Password']['S'] . "\n";
}


$lista=$s3->scan(array('TableName'=>$table));
foreach($lista['Items'] as $i) print_r($i);
*/
?>