<?php
include 'DatabaseAdapter.php';
$method = $_GET['method'];
if($method === 'matchName'){//currently creates a table printing out user found as a template
    $theDBA = new DatabaseAdapter();
    $array = $theDBA->getAllUsers();
    if(empty($array)){
        echo "No users in database";
    }
    else{
        echo "<table>";
        foreach ($array as $arr){
            echo "user found, ". $arr[0] ."\n";
        }
        echo "</table>";
    }
}
if($method === 'addRecipe'){
    $theDBA = new DatabaseAdapter();
    $name = $_GET['name'];
    $servings = $_GET['servings'];
    $image = $_GET['image'];
    $ingred = $_GET['ingredients'];
    $steps = $_GET['steps'];
    $numHolder = $theDBA->numRecipes();
    $num = $numHolder[0]['COUNT(*)'];
    $theDBA->addRecipe((int)$num, $name);
    
    copy($image, 'rImages/' . $num . '.jpg');
    
    $newFile = "rText/" . $num . ".txt";
    $fh = fopen($newFile, 'w');
    fwrite($fh, $name . "\n");
    fwrite($fh, $servings . "\n\n");
    $ingred = str_replace('|', PHP_EOL, $ingred);
    fwrite($fh, $ingred . "\n\n");
    $steps = str_replace('|', PHP_EOL, $steps);
    fwrite($fh, $steps);
    fclose($fh);
    
    echo $num;
    //alert("creating recipe:" . $name . ", with id: " . $num);
}
?>