<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/../../style.css">
    <title>Booking</title>
</head>
<body>
    <nav>
        <?php require (__DIR__ . './navigation.php')?>
    </nav>
    <main>
<h1 class="fixed-edit">Your reservation</h1>
<?php if ($apartment === null):?>
    <p class="message">Sorry, these dates are already booked. Please, choose another dates.</p>
    <?php endif;?>
    <?php if ($apartment !== null):?>
    <div class="card card-edit" >
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
        <form method="post" action="book/confirm">
            <button class="btn">CONFIRM</button>
        </form>
        </div>
    </div>
        <div class="card card-choise">
            <p class="apartment-city"><ion-icon name="pin"></ion-icon>
                <?php echo $apartment['city']; ?></p>
            <h2><span class="apartment-number"><?php echo $apartment['apartment_id']; ?></span>
                <span  class="apartment-name"><?php echo $apartment['name']; ?></span></h2>
            <img alt="Apartment Photo" class="img-one" src="<?='/../database/images/' . $apartment['apartment_id'].'.jpg'; ?>"/>
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
            <?php endif;?>
    </main>
</body>
</html>