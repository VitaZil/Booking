<!DOCTYPE html>
<html>
<body>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rent Apartment</title>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="stylesheet" href="/../../style.css">
</head>
<nav>
    <?php require (__DIR__ . './navigation.php')?>
</nav>
<div class="apartments">
    <div class="card card-choise">
        <p class="apartment-city"><ion-icon name="pin"></ion-icon>
            <?php echo $apartment['city']; ?></p>
        <h2><span class="apartment-number "><?php echo $apartment['apartment_id']; ?></span>
            <span  class="apartment-name"><?php echo $apartment['name']; ?></span></h2>
        <img src="<?='/../database/images/' . $apartment['apartment_id'].'.jpg'; ?>"/>
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
        <?php if(isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['city'])): ?>
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
        <button class="btn">Book</button>
        </form>
    </div>
</div>
</form>
</body>
</html>