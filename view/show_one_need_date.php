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
<main class="fixed-edit">
    <div class="apartments ">
        <div class="card card-choise">
            <p style="padding: 15px" class="apartment-city">
                <ion-icon name="pin"></ion-icon>
                <?php echo $apartment['city']; ?></p>
            <h2 class="apartment-name"><?php echo $apartment['name']; ?></h2>
            <img alt="Apartment Photo" class="img-one"
                 src="<?= '/../resources/images/' . $apartment['photo_name']; ?>"/>
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
</main>
</body>
</html>
