<?php
include "DatabaseAdapter.php"; // Make theDBA available in this PHP file
$theDBA = new DatabaseAdapter();
echo json_encode($theDBA->FavoriteList());
?>