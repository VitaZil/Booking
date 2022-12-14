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
            <img alt="Apartment Photo" class="img-one" src="<?= '/../resources/images/' . $apartment['photo_name']; ?>"/>
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
