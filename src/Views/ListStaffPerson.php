<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../../css/userreview.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

</head>
<body>
<a href="../../people/<?php echo $people_data[0]['person_id'] ?>"><?php echo $people_data[0]["person_name"]." ".$people_data[0]["person_surname"];?></a>
<hr>
<h2>Filmography</h2>
<?php
if (!empty($staff_data)) { 
foreach($staff_data as $t){?>
    <article>
    <img style="width:7%; height:7%;" src="../../../<?php echo $t['poster']?>">

        <b><a style="padding-left:2%;" href="../../entities/<?php echo $t['entity_id']?>">
        <?php echo $t["name"];?></a></b><br>
        <b style="padding-left:10%;"><?php echo $t["profession_name"]; ?></b>
        <span><?php echo $t["year"] ?></span>
        <?php if ($t["profession_name"] == "Actor") { ?>
              <p style="padding-left:10%;"><?php echo $t["character_name"]; ?></p> <?php } ?>
    </article>
<?php
}}
?>

</body>
</html>