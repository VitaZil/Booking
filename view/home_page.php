<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/../resources/style.css">
    <link rel="icon" href="https://cdn4.iconfinder.com/data/icons/real-estate-2-30/48/98-512.png" type="image/icon type">
    <title>Booking</title>
</head>
<body id="home">
<nav>
    <?php require (__DIR__ . '/navigation.php')?>
</nav>
<main class="home-form">
    <h2>HOTELS, RESORTS, HOSTELS & MORE?</h2>
    <form method="POST" action="/apartments/availabledates">
        <select name="city" id="city">
            <option value="">--------- Choose city ---------</option>
            <?php foreach ($cities as $city): ?>
                <option value="<?= $city?>"> <?= $city ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label for="start_date">Check-in: </label>
        <input class="home-input" type="date" id="start_date" name="start_date" required>
        <br>
        <label for="end_date">Check-out: </label>
        <input class="home-input" type="date" id="end_date" name="end_date" required>
        <br>
        <input type="submit" name="check-btn" class="btn" value="BOOK NOW" />
    </form>
</main>
</body>
</html>