<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <title>Add new apartment</title>
</head>
<body>
<nav>
    <?php require (__DIR__ . './navigation.php')?>
</nav>
<main id="new-container">
<h1 class="basic-heading fixed-edit">ADD YOUR OWN APARTMENT FOR RENT</h1>
<div class="form fixed-edit">
    <form method="POST" action="/apartments/new/image" enctype="multipart/form-data">
        <label for="name">Apartments name: </label>
        <input required id="name" type="text" name="name"><br>
        <label for="city">City: </label>
        <input required type="text" id="city" name="city"><br>
        <label for="description">Description: </label>
        <textarea name="description" id="description" cols="25" rows="4" ></textarea><br>
        <label for="daily_price">Daily price: </label>
        <input required type="number" id="daily_price" name="daily_price"><br>
        <label for="deposit">Deposit: </label>
        <input required type="number" id="deposit" name="deposit" step="0.1"><br>
        <button type="submit" class="btn">SUBMIT</button>
    </form>
</div>
</main>
</body>
</html>