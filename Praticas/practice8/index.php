<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <form action="autentica.php" method="POST">
        <label for="user">Login:</label>
        <input type="text" id="user" name="user" required><br><br>

        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
