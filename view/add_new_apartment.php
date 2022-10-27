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
    <title>Add new apartment</title>
</head>
<body>
<nav>
    <?php require(__DIR__ . '/navigation.php') ?>
</nav>
<div class="fixed-edit card-new">
    <h2>ADD YOUR OWN APARTMENT FOR RENT</h2>
    <form class="add-form" method="POST" action="/apartments/new" enctype="multipart/form-data">
        <div class="register-container">
            <div class="column">
                <label class="regitration-label" for="name">Apartments name: </label><br>
                <input class="regitration-input" id="name" type="text" name="name" placeholder="Enter apartment name"
                       required><br>
                <label class="regitration-label" for="city">City: </label><br>
                <input class="regitration-input" type="text" id="city" name="city" placeholder="Enter apartment city"
                       required><br>
                <label class="regitration-label" for="description">Description: </label><br>
                <textarea class="regitration-input" name="description" id="description" cols="25" rows="4"
                          placeholder="Enter apartment description"></textarea><br>
            </div>
            <div class="column">
                <label class="regitration-label" for="daily_price">Daily price (€): </label><br>
                <input class="regitration-input" type="number" id="daily_price" name="daily_price"
                       placeholder="Enter apartment daily price" required><br>
                <label class="regitration-label" for="deposit">Deposit (%): </label><br>
                <input class="regitration-input" type="number" id="deposit" name="deposit" step="0.1"
                       placeholder="Enter apartment deposit" required><br>
                <input class="regitration-input" type="file" id="image" name="image" required><br>
                <?php if (isset($message)): ?>
                    <span class="error-message">❌<?= $message ?></span>
                <?php endif; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-add">SUBMIT</button>
    </form>
</div>
</body>
</html>
