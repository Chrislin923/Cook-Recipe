
<?php

class DatabaseAdapter {
    private $DB; // The instance variable used in every method
    // Connect to an existing data based named 'first'
    public function __construct() {
        //$dataBase = 'mysql:dbname=imdb_small;charset=utf8;host=127.0.0.1';
        $dataBase = 'mysql:dbname=online_recipes;charset=utf8;host=127.0.0.1';
        $user = 'root';
        $password = ''; // Empty string with XAMPP install
        try {
            $this->DB = new PDO ( $dataBase, $user, $password );
            $this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch ( PDOException $e ) {
            echo ('Error establishing Connection');
            exit ();
        }
    }// . . .  continued
    
    public function getAllUsers () {
        $stmt = $this->DB->prepare( "SELECT * FROM customers" );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllRecipes () {
        $stmt = $this->DB->prepare( "SELECT * FROM recipes" );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getUserID ($Name) {
        $stmt = $this->DB->prepare( "SELECT ID FROM customers WHERE Username = '". $Name ."'" );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getRecipeID ($Name) {
        $stmt = $this->DB->prepare( "SELECT ID FROM recipes WHERE Name = '". $Name ."'" );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addUser ($ID, $Name, $Password) {
        $stmt = $this->DB->prepare( "INSERT INTO customers values (". $ID .", ". $Name .", ". $Password .")" );
        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addRecipe ($ID, $Name) {
        $stmt = $this->DB->prepare( "INSERT INTO recipes values(". $ID .", '". $Name ."', 0)" );
        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addFavorite ($CustomerID, $RecipeID) {
        $stmt = $this->DB->prepare( "UPDATE recipes SET Favorited = Favorited+1 WHERE ID = ". $RecipeID ."" );
        $stmt->execute();
        $stmt = $this->DB->prepare( "UPDATE recipes SET Favorited = Favorited+1 WHERE ID = ". $RecipeID .";INSERT INTO favorites values (". $CustomerID .", ". $RecipeID .")" );
        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function removeFavorite ($CustomerID, $RecipeID) {
        $stmt = $this->DB->prepare( "UPDATE recipes SET Favorited = Favorited-1 WHERE ID = ". $RecipeID ."" );
        $stmt->execute();
        $stmt = $this->DB->prepare( "DELETE FROM favorites WHERE customerID = ". $CustomerID ." AND recipeID = ". $RecipeID ."" );
        $stmt->execute();
        //return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFavorites ($ID) {
        $stmt = $this->DB->prepare( "SELECT recipes.Name, recipes.ID FROM recipes JOIN favorites ON favorites.recipeID = recipes.ID JOIN customers on customers.ID = favorites.customerID WHERE customers.ID = ". $ID ."");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countFavorites ($ID, $RecipeID){
        $stmt = $this->DB->prepare( "select count(recipeID) from favorites where recipeID = ". $RecipeID ." AND customerID = ". $ID .";");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function FavoriteList(){//returns a list of recipes ordered by favorited
        $stmt = $this->DB->prepare( "SELECT * FROM recipes ORDER BY Favorited DESC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function numRecipes(){
        $stmt = $this->DB->prepare( "select COUNT(*) FROM recipes;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
/*
$theDBA = new DatabaseAdapter ();
$arr = $theDBA->countFavorites(0, 4);
print_r ($arr);*/
?>