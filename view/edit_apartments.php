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
    <title>Edit Apartment</title>
</head>
<body>
<nav>
    <?php require(__DIR__ . '/navigation.php') ?>
</nav>
<main>
    <h1 class="basic-heading fixed-edit">ALL OUR APARTMENTS:</h1>
    <div class="apartments">
        <?php foreach ($apartments as $apartment): ?>
            <div class="card card-edit-all">
                <a href="#">
                    <h2><span class="apartment-number"><?php echo $apartment['apartment_id']; ?></span>
                        <span class="apartment-name"><?php echo $apartment['name']; ?></span></h2>
                    <p style="margin: 10px 0 5px 0" class="apartment-city">
                        <ion-icon name="pin"></ion-icon>
                        <?php echo $apartment['city']; ?></p>
                    <img alt="Apartment Photo" style="padding-top: 0" class="img-all"
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
                <form action="./edit/delete" method="post">
                    <button class="btn btn-delete" name="btn-delete" value="<?php echo $apartment['apartment_id'] ?>">
                        Delete
                    </button>
                </form>
                <a class="btn btn-edit" href="./edit/<?php echo $apartment['apartment_id'] ?>">Edit</a>
            </div>
        <?php endforeach; ?>
    </div>
</main>
</body>
</html>

