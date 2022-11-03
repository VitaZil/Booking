<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/../resources/style.css">
    <link rel="icon" href="https://cdn4.iconfinder.com/data/icons/real-estate-2-30/48/98-512.png" type="image/icon type">
    <title>Login</title>
</head>
<body>
<nav>
    <?php require(__DIR__ . '/../navigation.php') ?>
</nav>
<div class="fixed-edit card-new">
    <h2>LOGIN</h2>
    <form class="add-form" action="/login/user" method="POST">
        <div class="login-form">
            <label for="username">Full Name</label><br>
            <input class="regitration-input" type="text" name="username" id="username" placeholder="Enter your name"
                   required><br>

            <label for="email">Email</label><br>
            <input class="regitration-input" type="email" name="email" id="email" placeholder="Enter your email"
                   required><br>

            <label for="password">Password</label><br>
            <input class="regitration-input" type="password" name="password" id="password" placeholder="Enter your password"
                   required><br>

            <?php if (isset($message)): ?>
                <span class="error-message">❌<?= $message ?></span><br>
            <?php endif; ?>
        </div>
        <button class="btn btn-login" type="submit">LOGIN</button>

    </form>
</div>
</body>
</html>
