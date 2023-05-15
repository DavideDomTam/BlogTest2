<html><head><title>Rubrica DynamoDB</title></head>
<body>
<?php
$table="TabDDT01";
$lista = $client->listTables();
//print_r($lista);
foreach ($lista['TableNames'] as $t) {
echo $t . "\n";
}
$homer=array(
    'nome' => array('S'=>'Homer'),
    'cognome' => array('S'=>'Simpson'),
    'indirizzo' => array('S'=>'742 Evergreen Terrace'),
    'luogo' => array('S'=>'Springfield'),
    'telefono' => array('N'=>'123456789')
    );
    $rs = $client->putItem(array(
    'TableName' => $table,
    'Item' => $homer));
    var_dump($rs);
$marge=array(
    'nome' => array('S'=>'Marge'),
    'cognome' => array('S'=>'Bouvier'),
    'indirizzo' => array('S'=>'742 Evergreen Terrace'),
    'luogo' => array('S'=>'Springfield'),
    'cellulare' => array('N'=>'456789'),
    'email' => array('S'=>'marge@mail.com')
    );
$rs = $client->putItem(array(
    'TableName' => $table,
    'Item' => $marge));
$iterator = $client->getIterator('Query', array(
    'TableName' => $table,
    'KeyConditions' => array(
    'nome' => array(
    'AttributeValueList' => array(array('S' => 'Homer')),
    'ComparisonOperator' => 'EQ' )
    )
    ));
        // ComparisonOperator: EQ|NE|IN|LE|LT|GE|GT|BETWEEN|NOT_NULL|NULL| CONTAINS| NOT_CONTAINS|BEGINS_WITH', // REQUIRED ],
    /*foreach ($iterator as $item) {
        echo $item['nome']['S'] . "\n";
        echo $item['cognome']['S'] . "\n";
        echo $item['indirizzo']['S'] . "\n";
    }*/
    
    try {
        $client->createTable(array(
            'TableName' => "nuovatabella",
            'AttributeDefinitions' => array(
            array( 'AttributeName' => 'nome', 'AttributeType' => 'S' ),
            array( 'AttributeName' => 'cognome', 'AttributeType' => 'S' )
        ),
        'KeySchema' => array(
        array( 'AttributeName' => 'nome', 'KeyType' => 'HASH' ),
        array( 'AttributeName' => 'cognome', 'KeyType' => 'RANGE' )
        ),
        'ProvisionedThroughput' => array( 'ReadCapacityUnits' =>5, 'WriteCapacityUnits' => 5 )
        ));
        // NB si può modificare a posteriori
    } catch
    (Aws\DynamoDb\Execption\DynamoDbException $e) {
        echo "Non posso creare la tabella : <br />";
        echo $e->getMessage() . "<br />";
    }
    $table="TabDDT01";

     ?>
    </body>
</html>
