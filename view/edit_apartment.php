<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rent Apartment</title>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<nav>
    <?php require (__DIR__ . './navigation.php')?>
</nav>
<main>
    <h2>ALL OUR APARTMENTS:</h2>
    <div class="apartments">
        <?php foreach ($apartments as $apartment): ?>
            <div class="card">
                <a href="apartments/<?=$apartment['apartment_id'];?>">
                    <h2><span class="apartment-number"><?php echo $apartment['apartment_id']; ?></span>
                        <span  class="apartment-name"><?php echo $apartment['name']; ?></span></h2>
                    <p class="apartment-city"><ion-icon name="pin"></ion-icon>
                        <?php echo $apartment['city']; ?></p>
                    <img src="<?='/../database/images/' . $apartment['apartment_id'].'.jpg'; ?>"
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
