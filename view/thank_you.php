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
    <link rel="stylesheet" href="/../../style.css">
</head>
<body>
<nav>
    <?php require (__DIR__ . './navigation.php')?>
</nav>
<main>
    <h1>Thanks, for your reservation! <br>
    Waiting to see you here:</h1>
    <div style="text-align: center; padding: 50px;">

    <img  src=" <?= '/../database/images/' . $temporaryData['id'].'.jpg'; ?> ">
    </div>
</main>
</body>
</html>