<!DOCTYPE html>
<html lang="en">
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
<h1>Edit "<?php echo $apartment['name']; ?>" apartment</h1>
<form method="post" action="<?php echo $apartment['apartment_id']; ?>/update">

    <label for="name">Apartment Name</label>
    <input type="text" id="name" name="name" placeholder="<?php echo $apartment['name']; ?>"><br>

    <label for="city">City</label>
    <input type="text" id="city" name="city" placeholder="<?php echo $apartment['city']; ?>"><br>

    <label for="daily_price">Price for 1 night</label>
    <input type="text" id="daily_price" name="daily_price" placeholder="<?php echo $apartment['daily_price']; ?>"><br>

    <label for="deposit">Deposit</label>
    <input type="number" id="deposit" name="deposit" step="0.1" placeholder="<?php echo $apartment['deposit']; ?>"><br>

    <label for="description">Description</label>
    <textarea placeholder="<?php echo $apartment['description']; ?>" name="description" id="description" cols="40" rows="5" ></textarea><br>

    <button class="btn" name="btn-submit" value="<?php echo $apartment['apartment_id'] ?>">Submit</button>
</form>

<div class="apartments">
    <div class="card card-choise">
        <p class="apartment-city"><ion-icon name="pin"></ion-icon>
            <?php echo $apartment['city']; ?></p>
        <h2 class="apartment-name"><?php echo $apartment['name']; ?></h2>
        <img class="img-one" src="<?='/../database/images/' . $apartment['apartment_id'].'.jpg'; ?>"/>
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
    </div>
</div>
</body>
</html>