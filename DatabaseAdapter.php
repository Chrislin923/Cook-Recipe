
<?php

class DatabaseAdapter
{

    private $DB;

    // The instance variable used in every method
    // Connect to an existing data based named 'first'
    public function __construct()
    {
        // $dataBase = 'mysql:dbname=imdb_small;charset=utf8;host=127.0.0.1';
        $dataBase = 'mysql:dbname=online_recipes;charset=utf8;host=127.0.0.1';
        $user = 'root';
        $password = ''; // Empty string with XAMPP install
        try {
            $this->DB = new PDO($dataBase, $user, $password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo ('Error establishing Connection');
            exit();
        }
    }

    // . . . continued
    public function getAllUsers()
    {
        $stmt = $this->DB->prepare("SELECT * FROM customers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllRecipes()
    {
        $stmt = $this->DB->prepare("SELECT * FROM recipes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserID($Name)
    {
        $stmt = $this->DB->prepare("SELECT ID FROM customers WHERE Username = '" . $Name . "'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecipeID($Name)
    {
        $stmt = $this->DB->prepare("SELECT ID FROM recipes WHERE Name = '" . $Name . "'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addRecipe($ID, $Name)
    {
        $stmt = $this->DB->prepare("INSERT INTO recipes values(" . $ID . ", '" . $Name . "', 0)");
        $stmt->execute();
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFavorite($CustomerID, $RecipeID)
    {
        $stmt = $this->DB->prepare("UPDATE recipes SET Favorited = Favorited+1 WHERE ID = " . $RecipeID . "");
        $stmt->execute();
        $stmt = $this->DB->prepare("UPDATE recipes SET Favorited = Favorited+1 WHERE ID = " . $RecipeID . ";INSERT INTO favorites values (" . $CustomerID . ", " . $RecipeID . ")");
        $stmt->execute();
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeFavorite($CustomerID, $RecipeID)
    {
        $stmt = $this->DB->prepare("UPDATE recipes SET Favorited = Favorited-1 WHERE ID = " . $RecipeID . "");
        $stmt->execute();
        $stmt = $this->DB->prepare("DELETE FROM favorites WHERE customerID = " . $CustomerID . " AND recipeID = " . $RecipeID . "");
        $stmt->execute();
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFavorites($ID)
    {
        $stmt = $this->DB->prepare("SELECT recipes.Name FROM recipes JOIN favorites ON favorites.recipeID = recipes.ID JOIN customers on customers.ID = favorites.customerID WHERE customers.ID = " . $ID . "");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function countFavorites ($ID, $RecipeID){
        $stmt = $this->DB->prepare( "select count(recipeID) from favorites where recipeID = ". $RecipeID ." AND customerID = ". $ID .";");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function FavoriteList()
    { // returns a list of recipes ordered by favorited
        $stmt = $this->DB->prepare("SELECT * FROM recipes ORDER BY Favorited DESC;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function numRecipes()
    {
        $stmt = $this->DB->prepare("select COUNT(*) FROM recipes;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function logIn($email, $password)
    {
        $stmt = $this->DB->prepare("SELECT * FROM accounts WHERE email = '$email'");
        $stmt->execute();
        $stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (password_verify($password, $stmt[0]['password']) == 1) {
            $_SESSION['firstName'] = $stmt[0]['firstName'];
            $_SESSION['lastName'] = $stmt[0]['lastName'];
            $_SESSION['email'] = $stmt[0]['email'];
            return TRUE;
        } else {
            session_destroy();
            session_unset();
            return FALSE;
        }
    }

    // ????
    public function validUser($userName)
    {
        $stmt = $this->DB->prepare("SELECT email FROM accounts WHERE email = :user ;");
        $stmt->bindParam('user', $userName);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($row) == 0)
            return "true";
        return "false";
    }

    public function numUsers()
    {
        $stmt = $this->DB->prepare("select COUNT(*) FROM customers;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUser($first, $last, $user, $pass)
    {
        $stmt = $this->DB->prepare("select COUNT(*) FROM customers;");
        $stmt->execute();
        $ID = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $ID = $ID[0]['COUNT(*)'];
        $hashed_pwd = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $this->DB->prepare("INSERT INTO customers VALUES (" . $ID . ", '" . $user . "', '" . $hashed_pwd . "')");
        $stmt->execute();
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}

// $theDBA = new DatabaseAdapter();
// $arr = $theDBA->FavoriteList();
// print_r($arr);
?>