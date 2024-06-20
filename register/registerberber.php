<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Berber Kayıt Ol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .register-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .register-container h2 {
            margin-bottom: 30px;
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-floating > .form-control, .form-floating > .form-select {
            height: calc(3.5rem + 2px);
            padding: 1rem .75rem;
        }

        .form-floating label {
            padding: 1rem .75rem;
        }

        .btn-primary, .btn-secondary {
            border: none;
            transition: background-color 0.3s ease-in-out, transform 0.2s;
        }

        .btn-primary:hover, .btn-secondary:hover {
            transform: scale(1.05);
        }

        .btn:active {
            transform: scale(1);
        }

        .btn-primary {
            background-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            margin-top: 10px;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-check {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="register-container">
    <h4>Berber Olarak</h4>
    <h2>Kayıt Ol</h2>
    <form action="register_berber_process.php" method="post">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Ad Soyad" required>
            <label for="fullname">Ad Soyad</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="address" name="address" placeholder="Adres">
            <label for="address">Adres</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="E-posta" required>
            <label for="email">E-posta</label>
        </div>
        <div class="form-floating mb-3">
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Telefon" required>
            <label for="phone">Telefon</label>
        </div>
        <div class="mb-3 text-start">
            <p class="mb-1">Cinsiyet:</p>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="male" value="1" required>
                <label class="form-check-label" for="male">Erkek</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" id="female" value="0" required>
                <label class="form-check-label" for="female">Kadın</label>
            </div>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı Adı" required>
            <label for="username">Kullanıcı Adı</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Şifre" required>
            <label for="password">Şifre</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password_confirm" name="password_confirm" placeholder="Şifre Tekrarı" required>
            <label for="password_confirm">Şifre Tekrarı</label>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button type="submit" name="btnBerberKayit" class="btn btn-primary btn-block" "> Berber Olarak Kayıt Ol</button>
            <a href="../login/login.php" class="btn btn-link">Giriş Yap</a>
        </div>
    </form>
</div>
</body>
</html>
