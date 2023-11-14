<?php
include_once('app/header.php');
$pagina = "Login";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, username, password FROM user WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: index.php');
        exit();
    } else {
        echo "Invalid username or password.";
    }
}
?>
<div class="container">
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <label class="form-label">Username:</label>
        <input class="form-control" type="text" name="username" required>
        <label class="form-label">Password:</label>
        <input class="form-control" type="password" name="password" required>
        <input class="btn btn-outline-light my-3" type="submit" value="Login">
    </form>
</div>
<?php
include_once('app/footer.php');
?>