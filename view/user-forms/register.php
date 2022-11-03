<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/../resources/style.css">
    <link rel="icon" href="https://cdn4.iconfinder.com/data/icons/real-estate-2-30/48/98-512.png" type="image/icon type">
    <title>Registration</title>
</head>
<body>
<nav>
    <?php require(__DIR__ . '/../navigation.php') ?>
</nav>
<div class="fixed-edit card-new">
    <h2>REGISTRATION</h2>
    <form class="add-form" action="/login" method="POST">

        <div class="radio-input">
            <input type="radio" id="user" name="type" value="User"
                <?php if (isset($_POST['type'])): ?>
                <?php echo $_POST['type'] == 'User' ? "checked" : ''; ?> required>
            <?php endif; ?>
            <label for="user">Regular User</label>

            <input type="radio" id="admin" name="type" value="Admin"
                <?php if (isset($_POST['type'])): ?>
                <?php echo $_POST['type'] == 'Admin' ? "checked" : ''; ?> required>
        <?php endif; ?>
            <label for="admin">Admin</label><br>
        </div>
        <div class="register-container">
            <div class="column">
                <label for="username">User Name</label><br>
                <input class="regitration-input" type="text" name="username" id="username" placeholder="Enter your name"
                       value="<?= $_POST['username'] ?? '' ?>" required><br>

                <label for="email">Email</label><br>
                <input class="regitration-input" type="email" name="email" id="email" placeholder="Enter your email"
                       value="<?= $_POST['email'] ?? '' ?>" required><br>

                <label for="mobile_number">Phone Number</label><br>
                <input class="regitration-input" type="number" name="mobile_number" id="mobile_number"
                       placeholder="Enter your number" value="<?= $_POST['mobile_number'] ?? '' ?>"
                       required><br>
            </div>
            <div class="column">
                <label for="password">Password</label><br>
                <input class="regitration-input" type="password" name="password" id="password"
                       placeholder="Enter your password" value="<?= $_POST['password'] ?? '' ?>"
                       required><br>

                <label for="confirm_password">Confirm Password</label><br>
                <input class="regitration-input" type="password" name="confirm_password" id="confirm_password"
                       placeholder="Confirm your password" value="<?= $_POST['confirm_password'] ?? '' ?>" required><br>
            </div>
            <?php if (isset($message)): ?>
                <span class="error-message">❌<?= $message ?></span><br>
            <?php endif; ?>
        </div>

        <button class="btn btn-login" type="submit">REGISTER</button>

    </form>
</div>
</body>
</html>
