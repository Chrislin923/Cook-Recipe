<?php
include 'DatabaseAdapter.php';
$method = $_GET['method'];
$theDBA = new DatabaseAdapter();
if($method === 'addRecipe'){
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
if($method === 'addFavorite'){
    $id = $_GET['id'];
    $user = $_GET['user'];
    $in = 0;
    $list = $theDBA->countFavorites($user, $id);
    $in = $list[0]["count(recipeID)"];
    if($in === '0'){
        $theDBA->addFavorite($user, $id);
        echo "Added!";
    }
    else{
        echo "This dish is already in your favorites";
    }
}
?>