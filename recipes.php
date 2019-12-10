<?php
if (isset ( $_GET ['command'] ) && $_GET ['command'] === "showAll") {
    $recipesArray = glob ( 'rImages/*' );
    echo json_encode ( $recipesArray );
}
if (isset($_GET['text'])){
    $id = $_GET['text'];
    $path = "rText/".$_GET['text']. '.txt';
    $output = "<div class = 'onereview'> <img src = rImages/". $id . ".jpg>
     <p class = 'thedetails' >";
    $file = fopen($path,"r");
    while(! feof($file))  {
        $output .= fgets($file)."<br>";
    }
    $output .= "</p></div><button class = 'back' onclick='showAll()'>Back</button>";
    fclose($file);
    echo ( $output );
}
if (isset($_GET['pop'])){
    $id = $_GET['pop'];
    $path = "rText/".$_GET['pop']. '.txt';
    $output = "<div class = 'onereview'> <img src = rImages/". $id . ".jpg>
     <div class = 'thedetails' >";
    $file = fopen($path,"r");
    while(! feof($file))  {
        $output .= fgets($file)."<br>";
    }
    fclose($file);
    $output .= "</div></div>";
    echo ( $output );
}
?>