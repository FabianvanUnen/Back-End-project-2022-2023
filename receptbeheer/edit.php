<?php
$pagina = 'edit';
include_once('app/header.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $recipeID = $_POST['recipe_id'];
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $cookingTime = $_POST['cooking_time'];
    $categoryId = $_POST['category_id'];
    $userID = $_SESSION['user_id'];

    $stmt = $pdo->prepare("UPDATE recipe SET title = :title, userID = :userID, ingredients = :ingredients, instructions = :instructions, cooking_time = :cookingTime, category_id = :categoryId WHERE id = :recipeID");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':ingredients', $ingredients);
    $stmt->bindParam(':instructions', $instructions);
    $stmt->bindParam(':cookingTime', $cookingTime);
    $stmt->bindParam(':categoryId', $categoryId);
    $stmt->bindParam(':recipeID', $recipeID);

    if ($stmt->execute()) {
        echo "Recipe updated successfully.";
    } else {
        echo "Error updating recipe.";
    }
} else {
    if (!isset($_GET['id'])) {
        header('Location: index.php');
        exit();
    }
    $recipeID = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM recipe WHERE id = :recipeID");
    $stmt->bindParam(':recipeID', $recipeID);
    $stmt->execute();
    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$recipe) {
        echo "Recipe not found.";
        exit();
    }

    if ($recipe['userID'] !== $_SESSION['user_id']) {
        echo "You don't have permission to edit this recipe.";
        exit();
    }
}

$stmt = $pdo->prepare("SELECT id, name FROM category");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
<h2>Edit Recipe</h2>
<form method="POST" action="">
    <input type="hidden" name="recipe_id" value="<?php echo $recipe['id']; ?>">
    <label class="form-label">Title:</label>
    <input class="form-control" type="text" name="title" value="<?php echo $recipe['title']; ?>" required>
    <div class="row">
        <div class="col">
            <label class="form-label">Ingredients:</label>
            <textarea class="form-control" name="ingredients" required><?php echo $recipe['ingredients']; ?></textarea>
        </div>
        <div class="col">
            <label class="form-label">Instructions:</label>
            <textarea class="form-control" name="instructions" required><?php echo $recipe['instructions']; ?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label class="form-label">Cooking Time (minutes):</label>
            <input class="form-control" type="number" name="cooking_time" value="<?php echo $recipe['cooking_time']; ?>" required>
        </div>
        <div class="col">
            <label class="form-label">Category:</label>
            <select class="form-select" name="category_id" required>
                <?php foreach ($categories as $category) { ?>
                    <option value="<?php echo $category['id']; ?>" <?php if ($category['id'] == $recipe['category_id']) echo 'selected'; ?>><?php echo $category['name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <input class="btn btn-outline-light my-3" type="submit" value="Update Recipe">
</form>

<form method="POST" action="delete.php" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
    <input type="hidden" name="recipe_id" value="<?php echo $recipe['id']; ?>">
    <input class="btn btn-outline-danger" type="submit" value="Delete Recipe">
</form>
</div>
<?php
include_once('app/footer.php');
?>
