<?php
    require_once "include/app.php";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Course</title>
</head>
<body>
    <pre>
    <?php
        var_dump(Magasin::getById(5));
    ?>
    </pre>
</body>
</html>