<?php

include '../components/function.php';

$news_items = getJsonContent('news', 'nl');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>news</title>
</head>

<body>
    <div class="container row col-12">

    <?php
    // loopt door alle nieuwsitems heen
    // $key = id van nieuwsitem bijv: 1632480707
    // $item = nieuws bericht zelf
    foreach ($news_items as $key => $item) {
    ?>
        <div class="card col-3" style="width: 18rem;">
        <img src="../<?=$item->image?>" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title"><?= $item->title?></h5>
                <!-- laat de datum van het nieuws bericht zien -->
                <p><?= date('d/m/y', $key)?></p>
                <p class="card-text"><?= $item->beschrijving ?></p>
                <a href="./reaction.php?id=<?=$key?>" class="card-link">Reageer</a>
                <a href="" class="card-link">Reacties</a>
            </div>
        </div>
    <?php

    }
    ?>
    </div>

</body>

</html>