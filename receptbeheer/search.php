<?php
include_once('app/header.php');
$pagina = "Search";
?>

<div class="container">
    <?php

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $category = $_GET['category'];

        $stmt = $pdo->prepare("SELECT recipe.id, recipe.title, recipe.ingredients, recipe.instructions, recipe.cooking_time, category.name AS category_name, category.id AS category_id
                           FROM recipe
                           INNER JOIN category ON recipe.category_id = category.id
                           WHERE category.name LIKE :category");
        $stmt->bindValue(':category', "%{$category}%");
        $stmt->execute();
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($recipes as $recipe) {
            echo '<div class="card flex-md-row mb-4 box-shadow h-md-250 my-2">';
            echo '<div class="card-body d-flex flex-column align-items-start">';
            echo '<h3 class="mb-0 text-white">' . $recipe['title'] . '</h3>';
            echo '<div class="mb-1 text-muted">' . $recipe['cooking_time'] . ' minutes</div>';
            echo '<p class="card-text mb-auto">' . $recipe['ingredients'] . '</p>';
            echo '<a class="link-light" href="details.php?id=' . $recipe['id'] . '">Continue reading...</a>';
            echo '</div>';
            echo '<div class="card-footer">';

            $categoryName = "";
            $imageUrl = "";

            if ($recipe['category_id'] == 1) {
                $categoryName = "Breakfast";
                $imageUrl = "https://picsum.photos/id/493/1920";
            } else if ($recipe['category_id'] == 2) {
                $categoryName = "Lunch";
                $imageUrl = "https://picsum.photos/id/292/1920";
            } else if ($recipe['category_id'] == 3) {
                $categoryName = "Dinner";
                $imageUrl = "https://picsum.photos/id/163/1920";
            } else {
                $categoryName = "Dessert";
                $imageUrl = "https://picsum.photos/id/835/1920";
            }

            echo '<h4 class="my-4">' . $categoryName . '</h4>';
            echo '</div>';

            if (!empty($imageUrl)) {
                echo '<img class="card-img-right flex-auto d-none d-md-block rounded" alt="category picsum" style="width: 200px; height: 250px;" src="' . $imageUrl . '">';
            }

            echo '</div>';
        }
    }

    include_once('app/footer.php');
    ?>