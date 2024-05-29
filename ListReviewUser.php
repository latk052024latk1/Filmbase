<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../../../css/userreview.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

</head>
<body>
<?php echo $user_data["username"]; ?>
<hr>
<h2>Reviews</h2>
<?php
foreach($review_top as $t){?>
    <article>
        <b><a href="../../../entities/<?php echo $t['review_entity']?>">
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