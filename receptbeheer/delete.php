<?php
include_once('app/classes/config.php');
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recipe_id'])) {
  $recipeId = $_POST['recipe_id'];
  $userId = $_SESSION['user_id'];

  $stmt = $pdo->prepare("SELECT * FROM recipe WHERE id = :recipeId AND userID = :userId");
  $stmt->bindParam(':recipeId', $recipeId);
  $stmt->bindParam(':userId', $userId);
  $stmt->execute();
  $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($recipe) {
    $deleteStmt = $pdo->prepare("DELETE FROM recipe WHERE id = :recipeId");
    $deleteStmt->bindParam(':recipeId', $recipeId);
    $deleteStmt->execute();

    header('Location: index.php');
    exit();
  } else {
    echo "You do not have permission to delete this recipe.";
  }
} else {
  echo "Invalid request.";
}
?>
