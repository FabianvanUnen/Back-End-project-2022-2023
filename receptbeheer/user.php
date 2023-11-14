<?php
include_once('app/header.php');

if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
  exit();
}

$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM recipe WHERE userID = :userId");
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

function getCategoryName($categoryId)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT name FROM category WHERE id = :categoryId");
  $stmt->bindParam(':categoryId', $categoryId);
  $stmt->execute();
  $category = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($category) {
    return $category['name'];
  } else {
    return 'Unknown';
  }
}
?>

<div class="container">
    <h1> You are <?php echo $_SESSION['username']; ?></h1>
  <h2>Your Recipes</h2>
  <?php if (count($recipes) > 0) { ?>
    <table class="table">
      <thead>
        <tr>
          <th>Title</th>
          <th>Category</th>
          <th>Cooking Time</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($recipes as $recipe) { ?>
          <tr>
            <td><?php echo $recipe['title']; ?></td>
            <td><?php echo getCategoryName($recipe['category_id']); ?></td>
            <td><?php echo $recipe['cooking_time']; ?> minutes</td>
            <td>
              <a href="edit.php?id=<?php echo $recipe['id']; ?>">Edit</a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  <?php } else { ?>
    <p>No recipes found.</p>
  <?php } ?>
</div>

<?php
include_once('app/footer.php');
?>
