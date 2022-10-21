<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Booking</title>
    <style>
        body {
        background: url("https://ee.balticsothebysrealty.com/wp-content/uploads/2020/03/Screenshot-2020-03-17-at-14.23.59.png") no-repeat;
        background-position: 0 150px;
        background-size: cover;
        height: 70vh;
        }
    </style>
</head>
<body>
<nav>
    <?php require (__DIR__ . './navigation.php')?>
</nav>
<main id="home-form">
<!--    <img id="home-image">-->
    <h2>HOTELS, RESORTS, HOSTELS & MORE?</h2>

    <form method="POST" action="/apartments/availabledates">

        <!--    <input type="search" name="search" id="search" placeholder="Search"><br>-->
        <!--    <div class="rangeslider">-->
        <!--        <label for="price-min">Min-price:</label>-->
        <!--        <input type="range" name="price-min" id="price-min" value="200" min="0" max="1000">-->
        <!--        <label for="price-max">Max-price:</label>-->
        <!--        <input type="range" name="price-max" id="price-max" value="800" min="0" max="1000">-->
        <!--    </div>-->
        <select name="city" id="city">
            <option value="">--------- Choose city ---------</option>
            <?php foreach ($cities as $city): ?>
                <option value="<?= $city?>"> <?= $city ?></option>
            <?php endforeach; ?>
        </select>
        <br>

        <label for="start_date">Check-in: </label>
        <input type="date" name="start_date" required>
        <br>
        <label for="end_date">Check-out: </label>
        <input type="date" name="end_date" required>
        <br>
        <input type="submit" name="check-btn" class="btn" value="BOOK NOW" />
    </form>

</main>
</body>
</html>