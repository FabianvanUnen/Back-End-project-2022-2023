<?php
include_once('app/header.php');
$pagina = "Register";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO user (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->execute();

    echo "Registration successful. You can now <a href='login.php'>login</a>.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" action="">
            <label class="form-label">Username:</label>
            <input class="form-control" type="text" name="username" required>
            <label class="form-label">Password:</label>
            <input class="form-control" type="password" name="password" required>
            <input class="btn btn-outline-light my-3" type="submit" value="Register">
        </form>
    </div>
    <?php
    include_once('app/footer.php');
    ?>
</body>

</html>
