<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    print_r($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" name="name">
        <button type="submit">SUBMIT</button>
    </form>
</body>

</html>