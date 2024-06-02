<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../css/entitypageshow.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entity Details</title>

   
</head>
<body>
    <div class="container">
        <h2>Entity Details</h2>

        <img src="http://localhost/filmbase/images/entities/<?php echo $entity[0]["entity_id"] ?>.png" style="max-width: 80%;">

        <table>
            <tbody>
                <tr>
                    <th>Name</th>
                    <td><?php echo $entity[0]["name"]; ?></td>
                </tr>
                <tr>
                    <th>Year</th>
                    <td><?php echo $entity[0]["year"]; ?></td>
                </tr>
                <tr>
                    <th>Type</th>
                    <td><?php echo $entity[0]["type_name"]; ?></td>
                </tr>
                <tr>
                    <th>Genre</th>
                    <td><?php echo $entity[0]["genre_name"]; ?></td>
                </tr>
                <?php if ($entity[0]["type_name"] == "Movie") { ?>
                    <tr>
                        <th>Duration</th>
                        <td><?php echo $entity[0]["duration_min"]; ?> minutes</td>
                    </tr>
                <?php } else { ?>
                    <tr>
                        <th>Seasons</th>
                        <td><?php echo $entity[0]["num_seasons"]; ?></td>
                    </tr>
                    <tr>
                        <th>Episodes</th>
                        <td><?php echo $entity[0]["num_episodes"]; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
<hr>
        <div class="characters">
            <?php foreach ($chars as $c) { ?>
                <div class="character">
                    <img src='http://localhost/filmbase/images/people/<?php echo $c["person_id"] ?>.png'>
                    <div><a href="../people/<?php echo $c['person_id'] ?>">
                    <?php echo $c["person_name"]." ".$c["person_surname"]; ?></a></div>
                    <div><?php echo $c["character_name"]; ?></div>
                </div>
            <?php } ?>
        </div>
        <button><a href="../entities/<?php echo $entity[0]["entity_id"]; ?>/reviews">Reviews</a></button>
        <button><a href="../entities/<?php echo $entity[0]["entity_id"]; ?>/reviews/add">Write a review</a></button>

    </div>
</body>
</html>
