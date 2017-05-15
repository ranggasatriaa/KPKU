<?php
if (isset($_FILES['myFile'])) {
    // Example:
    move_uploaded_file($_FILES['myFile']['tmp_name'], "gambar-kerusakan/". $_FILES['myFile']['name']);
    echo 'successful';
}
?>
