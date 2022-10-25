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
    <title>Booking</title>
</head>
<body>
<nav>
    <?php require(__DIR__ . '/navigation.php') ?>
</nav>
<main class="fixed-edit">
<div class="apartments ">
    <div class="card card-choise">
        <p style="padding: 15px" class="apartment-city">
            <ion-icon name="pin"></ion-icon>
            <?php echo $apartment['city']; ?></p>
        <h2><span class="apartment-name"><?php echo $apartment['name']; ?></span></h2>
        <img alt="Apartment Photo" class="img-one"
             src="<?= '/../database/images/' . $apartment['photo_name']; ?>"/>
        <div class="price-container">
            <div class="price">
                <ion-icon name="cash"></ion-icon>
                <?php echo $apartment['daily_price'] . ' €/ night'; ?>
            </div>
            <div class="price">
                <ion-icon name="cash"></ion-icon>
                <?php echo $apartment['weekly_price'] . ' €/ week'; ?>
            </div>
        </div>
        <p class="apartment-description"><?php echo $apartment['description']; ?></p>
        <form action="/apartments/<?= $apartment['apartment_id'] ?>/book" method="post">
            <label for="start_date">Check-in: </label>
            <input required type="date" id="start_date" name="start_date"><br>
            <label for="end_date">Check-out: </label>
            <input required type="date" id="end_date" name="end_date">
            <br>
            <button class="btn" style="width: 200px;">BOOK NOW</button>
        </form>
    </div>
</div>
</main>
</body>
</html>