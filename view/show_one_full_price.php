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
<main>
<div class="apartments">
    <div class="card card-choise">
        <p class="apartment-city">
            <ion-icon name="pin"></ion-icon>
            <?php echo $apartment['city']; ?></p>
        <h2><span class="apartment-number "><?php echo $apartment['apartment_id']; ?></span>
            <span class="apartment-name"><?php echo $apartment['name']; ?></span></h2>
        <img alt="Apartment Photo" class="img-one" src="<?= '/../database/images/' . $apartment['photo_name']; ?>"/>
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
        <?php if (isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['city'])): ?>
            <div class="price">
                <ion-icon name="calendar"></ion-icon>
                <?php echo $chosenID['days'] . ' nights'; ?>
            </div>
            <div class="price">
                <ion-icon name="cash"></ion-icon>
                <?php echo $chosenID['full_price'] . ' €/' . $chosenID['days'] . ' nights'; ?>
            </div>
            <div class="price">
                <ion-icon name="alert"></ion-icon>
                <?php echo $chosenID['full_deposit'] . ' € deposit'; ?>
            </div>
        <?php endif; ?>
        <form action="./book" method="post">
            <button class="btn">BOOK</button>
        </form>
    </div>
</div>
</main>
</body>
</html>