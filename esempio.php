<?php
// Connessione al database







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