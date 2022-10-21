
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Apartment</title>
    <link rel="stylesheet" href="/../style.css">
</head>
<body>
<nav>
    <?php require (__DIR__ . './navigation.php')?>
</nav>

<h1>Add photo for <?php echo '"' . $apartments[count($apartments)-1]['name'] . '"'?></h1>

<div class="form">

<form method="POST" action="/../file.php" enctype="multipart/form-data">

        <input type="file" id="image" name="image" required><br>
        <button type="submit">Upload</button>
        </form>

</div>
</body>
</html>