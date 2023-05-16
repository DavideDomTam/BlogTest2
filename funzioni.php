<?php
require_once("config.php");

function registra($titolo,$testo) {
    global $s3;
    $table = 'Blog-Archive';
    date_default_timezone_set('Europe/Rome');
    $Commento=array(
        'Titolo' => array('S'=>$titolo),
        'contenuto' => array('S'=>$testo),
        'date' => array('S'=>date("Y-m-d, G:i"))
        );

    $rs = $s3->putItem(array(
        'TableName' => $table,
        'Item' => $Commento));
}

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

 function utenteValido($utente, $password) {
    global $UTENTE, $PASSWORD;
    return ($utente == $UTENTE && $password == $PASSWORD);
}

?>