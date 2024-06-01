<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../../../css/userreview.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

</head>
<body>
<a href="../../people/<?php echo $people_data[0]['person_id'] ?>"><?php echo $people_data[0]["person_name"]." ".$people_data[0]["person_surname"];?></a>
<hr>
<h2>Filmography</h2>
<?php var_dump($staff_data);
foreach($staff_data as $t){?>
    <article>
        <b><a href="../../entities/<?php echo $t['entity_id']?>">
        <?php echo $t["name"];?></a></b><br>
        <b><?php echo $t["review_name"]; ?></b>
        <span><?php echo $t["review_date"] ?></span>
        <p><?php echo $t["review_text"]; ?></p>
        <a href="../reviews/<?php echo $t["review_id"] ?>/edit">Edit</a>
    </article>
<?php
}
?>

</body>
</html>