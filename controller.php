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
    $numHolder = $theDBA->numRecipes();
    $num = $numHolder[0]['COUNT(*)'];
    $theDBA->addRecipe((int)$num, $name);
    echo "submitted";
    //alert("creating recipe:" . $name . ", with id: " . $num);
}
?>