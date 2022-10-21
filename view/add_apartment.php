<?php
require __DIR__ . './mainbooking.php';
$apartments = getApartments();
$bookings = getBookings();
if (isset($_POST['add-btn']) && $_POST['add-btn'] == 'Submit') {
    $fileTmpPath = $_FILES['uploadedFile']['tmp_name']; //C:\xampp\tmp\phpBFE2.tmp
    $fileName = $_FILES['uploadedFile']['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps)); //jpg
    $id = max(array_column($apartments, 'apartment_id')) + 1;
    $newFileName = $id . '.' . $fileExtension;
    $uploadFileDir = './';
    $dest_path = $uploadFileDir . $newFileName;
    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        echo 'File is successfully uploaded.';
    }
}
?>

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
    <a id="add" href="show_all.php">Go back and rent apartments</a>
</nav>
<h1>Add your own apartment for rent</h1>

<?php if (isset($_POST['name'])): ?>
    <?php addApartment($_POST['name'], $_POST['city'], $_POST['daily_price'], $_POST['deposit']);?>
    <div class="message"><?php echo "Apartaments \"{$_POST['name']}\" has been succsesfully added!" . PHP_EOL; ?></div>
<?php endif; ?>
<div class="form">
<form method="POST" action="add_apartment.php" enctype="multipart/form-data">

    <label for="name">Apartments name: </label>
    <input required type="text" name="name"><br>

    <label for="city">City: </label>
    <input required type="text" name="city"><br>

    <input type="file" id="file-upload" name="uploadedFile"><br>

    <label for="daily_price">Daily price: </label>
    <input required type="number" name="daily_price"><br>
    <label for="deposit">Deposit: </label>
    <input required type="number" name="deposit" step="0.1"><br>
    <input type="submit" name="add-btn" value="Submit" />

</form>
</div>
</body>
</html>