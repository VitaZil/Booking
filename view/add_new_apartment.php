<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Apartment</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<nav>
    <?php require (__DIR__ . './navigation.php')?>
<!--    <a class="add" href="new/image">Add apartment photo</a>-->
</nav>

<h1>Add your own apartment for rent</h1>

<div class="form">
    <form method="POST" action="/apartments/new/image" enctype="multipart/form-data">

        <label for="name">Apartments name: </label>
        <input required type="text" name="name"><br>

        <label for="city">City: </label>
        <input required type="text" name="city"><br>

        <label for="description">Description: </label>
        <textarea name="description" id="description" cols="25" rows="3" ></textarea><br>

        <label for="daily_price">Daily price: </label>
        <input required type="number" name="daily_price"><br>
        <label for="deposit">Deposit: </label>
        <input required type="number" name="deposit" step="0.1"><br>

        <button type="submit">Submit</button>

    </form>
</div>
</body>
</html>