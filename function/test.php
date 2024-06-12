<?php
header("Content-Type: text/html; charset=UTF-8");
$shangchuan = $_FILES['file'];

if ($shangchuan['type'] != "image/jpeg") {

    echo 'error: WRONG TYPE. ';
    echo '<br>';
    echo 'Please use jpg picture.';
    echo '<br>';
    echo '<a href="demo.php" style="color: black">back</a >';
    die();
}
if ($shangchuan['size'] > 800000) {

    echo 'error: OVERSIZE';
    echo '<a href="demo.php" style="color: black">back</a >';
    die();
}

copy($shangchuan['tmp_name'], 'C:\\xampp\\htdocs\\group12\\image\\' . $shangchuan['name']);

echo 'success!';
echo "<br>";
echo "<br>";

echo '<a href="demo.php" style="color: black">back</a >';
?>
