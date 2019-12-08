<?php
if (isset ( $_GET ['command'] ) && $_GET ['command'] === "showAll") {
    $recipesArray = glob ( 'rImages/*' );
    echo json_encode ( $recipesArray );
}
if (isset($_GET['text'])){
    $path = "rText/".$_GET['text']. '.txt';
    $info = file_get_contents($path);
    echo ( $info );
}
?>