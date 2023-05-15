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

// Ricezione dei dati del form
$username = $_POST['username'];
$password = $_POST['password'];

$table='User-Validation';

$lista=$s3->scan(array('TableName'=>$table));
foreach($lista['Items'] as $i) print_r($i);

$params = [
    'TableName' => 'User-Validation',
];

$result = $s3->scan($params);

foreach ($result['Items'] as $item) {
    if ($item['Password']['S'] === $password && $item['nome']['S'] === $username) {
        echo "Login effettuato con successo! ";
        $loginSuccess=true;
        break;
    } 
}

if (isset($loginSuccess) && $loginSuccess) {
    // esegui azioni di login
} else {
    echo "Username o password non validi.";
}


// Se la query restituisce una riga, l'utente esiste e la password è corretta

?>