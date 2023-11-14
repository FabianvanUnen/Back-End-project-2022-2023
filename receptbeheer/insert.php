<?php
include_once('app/header.php');
$pagina = "Insert";


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
$stmt = $pdo->prepare("SELECT id, name FROM category");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $cookingTime = $_POST['cooking_time'];
    $categoryId = $_POST['category_id'];
    $userID = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO recipe (title, userID, ingredients, instructions, cooking_time, category_id) VALUES (:title, :userID, :ingredients, :instructions, :cookingTime, :categoryId)");
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':ingredients', $ingredients);
    $stmt->bindParam(':instructions', $instructions);
    $stmt->bindParam(':cookingTime', $cookingTime);
    $stmt->bindParam(':categoryId', $categoryId);

    if ($stmt->execute()) {
        echo "Recipe added successfully.";
    } else {
        echo "Error adding recipe.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Recipe</title>
</head>

<body>
    <div class="container">
        <h2>Add Recipe</h2>
        <form method="POST" action="">
            <label class="form-label">Title:</label>
            <input class="form-control" type="text" name="title" required>
            <div class="row">
                <div class="col">
                    <label class="form-label">Ingredients:</label>
                    <textarea class="form-control" name="ingredients" required></textarea>
                </div>
                <div class="col">
                    <label class="form-label">Instructions:</label>
                    <textarea class="form-control" name="instructions" required></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label class="form-label">Cooking Time (minutes):</label>
                    <input class="form-control" type="number" name="cooking_time" required>
                </div>
                <div class="col">
                    <label class="form-label">Category:</label>
                    <select class="form-select" name="category_id" required>
                        <?php foreach ($categories as $category) { ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>


            <input class="btn btn-outline-light my-3" type="submit" value="Add Recipe">
        </form>
    </div>
    <?php
    include_once('app/footer.php');
    ?>