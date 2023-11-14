<?php
$pagina = 'home';
include_once('app/header.php');

$stmt = $pdo->query("SELECT * FROM recipe");
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($recipes)) {
  $randomRecipe = $recipes[array_rand($recipes)];

  $backgroundImage = '';
  if ($randomRecipe['category_id'] == 1) {
    $backgroundImage = 'https://picsum.photos/id/493/4000';
  } else if ($randomRecipe['category_id'] == 2) {
    $backgroundImage = 'https://picsum.photos/id/292/4000';
  } else if ($randomRecipe['category_id'] == 3) {
    $backgroundImage = 'https://picsum.photos/id/163/4000';
  } else {
    $backgroundImage = "https://picsum.photos/id/835/4000";
  }
  ?>

  <div class="p-3 p-md-5 text-white"
    style="background-image: url('<?php echo $backgroundImage; ?>'); background-size: cover;">
    <div class="col-md-6 p-3 bg-dark bg-opacity-50 rounded">
      <h1 class="display-4 font-italic">
        <?php echo $randomRecipe['title']; ?>
      </h1>
      <h4>
        <?php if ($randomRecipe['category_id'] == 1) {
          echo "Breakfast";
        } else if ($randomRecipe['category_id'] == 2) {
          echo "Lunch";
        } else if ($randomRecipe['category_id'] == 3) {
          echo "Dinner";
        } else {
          echo "Dessert";
        }
        ?>
      </h4>
      <h3 class="mb-1 text-muted">
        <?php echo $randomRecipe['cooking_time']; ?> minutes
      </h3>
      <p class="lead my-3">
        <?php echo $randomRecipe['ingredients']; ?>
      </p>
      <p class="lead mb-0"><a href="details.php?id=<?php echo $randomRecipe['id']; ?>"
          class="text-white font-weight-bold">Continue reading...</a></p>
      <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $randomRecipe['userID']) { ?>
        <a class="btn btn-primary mt-2" href="edit.php?id=<?php echo $randomRecipe['id']; ?>">Edit</a>
      <?php } ?>
    </div>
  </div>

  <div class="row mb-2">
    <?php foreach ($recipes as $recipe) { ?>
      <?php if ($recipe !== $randomRecipe) { ?>
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 box-shadow h-md-250 my-2">
            <div class="card-body d-flex flex-column align-items-start">
              <h3 class="mb-0 text-white">
                <?php echo $recipe['title']; ?>
              </h3>

              <div class="mb-1 text-muted">
                <?php echo $recipe['cooking_time']; ?> minutes
              </div>
              <p class="card-text mb-auto">
                <?php echo $recipe['ingredients']; ?>
              </p>
              <a class="link-light" href="details.php?id=<?php echo $recipe['id']; ?>">Continue reading...</a>
              <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === $recipe['userID']) { ?>
                <a class="btn btn-primary mt-2" href="edit.php?id=<?php echo $recipe['id']; ?>">Edit</a>
              <?php } ?>
            </div>
            <div class="card-footer">
              <h4 class="my-4">
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
            </div>
            <img class="card-img-right flex-auto d-none d-md-block rounded" alt="category picsum"
              style="width: 200px; height: 250px;" src="<?php if ($recipe['category_id'] == 1) {
                echo 'https://picsum.photos/id/493/1920';
              } else if ($recipe['category_id'] == 2) {
                echo 'https://picsum.photos/id/292/1920';
              } else if ($recipe['category_id'] == 3) {
                echo 'https://picsum.photos/id/163/1920';
              } else {
                echo "https://picsum.photos/id/835/1920";
              } ?>">

          </div>
        </div>
      <?php } ?>
    <?php }
} else {
  echo "<div class='container'><h1>No recipes found. Be the first person to add a recipe.</h1></div>";
}
?>
</div>

<?php
include_once('app/footer.php');
?>