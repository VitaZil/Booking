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
    <title>Booking</title>
</head>
<body>
<nav>
    <?php require(__DIR__ . '/navigation.php') ?>
</nav>
<main>
    <h1 class="fixed-edit">Your reservation</h1>
    <?php if ($apartment === null): ?>
        <p class="message">Sorry, these dates are already booked. Please, choose another dates.</p>
    <?php endif; ?>
    <?php if ($apartment !== null): ?>
    <div class="card card-edit">
        <div class="card-edit">
            <div class="price">
                <ion-icon name="calendar"></ion-icon>
                <?php echo $apartment['days'] . ' nights'; ?>
            </div>
            <div class="price">
                <ion-icon name="cash"></ion-icon>
                <?php echo $apartment['full_price'] . ' €/' . $apartment['days'] . ' nights'; ?>
            </div>
            <div class="price">
                <ion-icon name="alert"></ion-icon>
                <?php echo $apartment['full_deposit'] . ' € deposit'; ?>
            </div>
            <form method="post" action="/apartments/<?= $apartment['apartment_id']; ?>/book/confirm">
                <input type="hidden" name="start_date" value="<?= $_POST['start_date'] ?? $startDate ?>">
                <input type="hidden" name="end_date" value="<?= $_POST['end_date'] ?? $endDate ?>">
                <button class="btn">CONFIRM</button>
            </form>
        </div>
    </div>
    <div class="card card-choise">
        <p class="apartment-city">
            <ion-icon name="pin"></ion-icon>
            <?php echo $apartment['city']; ?></p>
        <h2><span class="apartment-number"><?php echo $apartment['apartment_id']; ?></span>
            <span class="apartment-name"><?php echo $apartment['name']; ?></span></h2>
        <img alt="Apartment Photo" class="img-one" src="<?= '/../resources/images/' . $apartment['photo_name']; ?>"/>
        <div class="price-container">
            <div class="price">
                <ion-icon name="cash"></ion-icon>
                <?php echo $apartment['daily_price'] . ' €/ 1 night'; ?>
            </div>
            <div class="price">
                <ion-icon name="cash"></ion-icon>
                <?php echo $apartment['weekly_price'] . ' €/ 1 week'; ?>
            </div>
        </div>
        <p class="apartment-description"><?php echo $apartment['description']; ?></p>
        <?php endif; ?>
</main>
</body>
</html>

