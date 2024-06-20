<?php
require_once '../src/DB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['txtLoginEmail'];
    $password = $_POST['txtLoginPassword'];

    $conn = DB::connect();

    $query = "SELECT * FROM TBLUSER WHERE UserMail = ? AND UserPassword = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$email, $password]);
    $user = $stmt->fetch();

    if ($user) {
        session_start();
        $_SESSION['UserId'] = $user['USER_ID'];
        $_SESSION['UserFullName'] = $user['UserFullName'];
        $_SESSION['UserAddress'] = $user['UserAdres'];
        $_SESSION['UserMail'] = $user['UserMail'];
        $_SESSION['UserPhone'] = $user['UserTelefon'];
        $_SESSION['UserGender'] = $user['UserGender'];
        $_SESSION['UserName'] = $user['UserName'];
        $_SESSION['UserPassword'] = $user['UserPassword'];
        $_SESSION['GirisYapan'] = $user['UserFullName'];
        $_SESSION['Perm'] = "User";

        header('Location: _default/default.php');
        exit;
    }

    $query = "SELECT * FROM TBLADMIN WHERE BerberMail = ? AND BerberPassword = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$email, $password]);
    $berber = $stmt->fetch();

    if ($berber) {
        session_start();
        $_SESSION['BerberId'] = $berber['BerberID'];
        $_SESSION['BerberFullName'] = $berber['FullName'];
        $_SESSION['BerberAddress'] = $berber['BerberAdres'];
        $_SESSION['BerberMail'] = $berber['BerberMail'];
        $_SESSION['BerberTelefon'] = $berber['BerberTelefon'];
        $_SESSION['BerberGender'] = $berber['BerberGender'];
        $_SESSION['BerberUsername'] = $berber['BerberUsername'];
        $_SESSION['BerberPassword'] = $berber['BerberPassword'];
        $_SESSION['GirisYapan'] = $berber['FullName'];
        $_SESSION['Perm'] = "Berber";

        header('Location: /default.php');
        exit;
    }

    $error = "Invalid email or password";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>
    

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <label for="txtLoginEmail">Email:</label>
        <input type="email" name="txtLoginEmail" id="txtLoginEmail" required><br>

        <label for="txtLoginPassword">Password:</label>
        <input type="password" name="txtLoginPassword" id="txtLoginPassword" required><br>

        <input type="submit" name="btnLogin2" value="Login">
    </form>
</body>
</html>