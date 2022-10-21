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

        <form action="/apartments/<?= $apartment['apartment_id']?>/book" method="post">
            <label for="start_date">Check-in: </label>
            <input required type="date" name="start_date">

            <label for="end_date">Check-out: </label>
            <input required type="date" name="end_date">
            <br>
        <button class="btn" style="width: 200px;">BOOK NOW</button>
        </form>
    </div>
</div>
</form>
</body>
</html>