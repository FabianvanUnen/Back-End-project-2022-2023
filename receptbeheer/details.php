<?php
include_once('app/header.php');

if (isset($_GET['id'])) {
    $recipeId = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM recipe WHERE id = :id");
    $stmt->bindParam(':id', $recipeId);
    $stmt->execute();
    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

    $backgroundImage = '';
    if ($recipe['category_id'] == 1) {
        $backgroundImage = 'https://picsum.photos/id/493/4000';
    } else if ($recipe['category_id'] == 2) {
        $backgroundImage = 'https://picsum.photos/id/292/4000';
    } else if ($recipe['category_id'] == 3) {
        $backgroundImage = 'https://picsum.photos/id/163/4000';
    } else {
        $backgroundImage = "https://picsum.photos/id/835/1920";
    }

    if (!$recipe) {
        echo "Recipe not found.";
    } else {

        ?>
        <div class="container pt-5">
            <h1 class="fs-1">
                <?php echo $recipe['title']; ?>
            </h1>
            <h4>
                <?php if ($recipe['category_id'] == 1) {
                    echo "Breakfast";
                } else if ($recipe['category_id'] == 2) {
                    echo "Lunch";
                } else if ($recipe['category_id'] == 3) {
                    echo "Dinner";
                } else {
                    echo "Dessert";
                }
                ?>
            </h4>
            <hr>
            <small>Ingredients:
                <?php echo $recipe['ingredients']; ?>
            </small>
            <p>Cooking Time:
                <?php echo $recipe['cooking_time']; ?> minutes
            </p>
            <p>
            <p class="lead">Instructions:
                <?php echo $recipe['instructions']; ?>
            </p>

        </div>
        <?php
    }
} else {
    echo "Invalid recipe ID.";
}

include_once('app/footer.php');
?>