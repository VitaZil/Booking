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
    <h1 class="fixed-edit">All available apartments: </h1>
    <?php if (!empty($_POST['end_date']) && !empty($_POST['start_date'])): ?>
        <h2 id="dates"><?= $_POST['start_date'] . ' - ' . $_POST['end_date']; ?></h2>
    <?php endif; ?>
    <?php if (!empty($_POST['city'])): ?>
        <h2 id="dates"><?= $_POST['city']; ?></h2>
    <?php endif; ?>
    <div class="apartments">
        <?php foreach ($availableApartments as $apartment): ?>
            <div class="card card-availabledates">
                <a href="/apartments/<?= $apartment['apartment_id']; ?>/book/<?= $_POST['start_date'] ?>/<?= $_POST['end_date'] ?>">
                    <h2><span class="apartment-number"><?php echo $apartment['apartment_id']; ?></span>
                        <span class="apartment-name"><?php echo $apartment['name']; ?></span></h2>
                    <p class="apartment-city">
                        <ion-icon name="pin"></ion-icon>
                        <?php echo $apartment['city']; ?></p>
                    <img alt="Apartment Photo" class="img-all"
                         src="<?= '/../resources/images/' . $apartment['photo_name']; ?>"
                </a>
                <div class="price">
                    <ion-icon name="cash"></ion-icon>
                    <?php echo $apartment['daily_price'] . ' €/ night'; ?>
                </div>
                <div class="price">
                    <ion-icon name="cash"></ion-icon>
                    <?php echo $apartment['weekly_price'] . ' €/ week'; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>

