<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../../css/userreview.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
</head>
<body>
<?php echo $name[0]["name"]; ?>
<hr>
<h2>Reviews</h2>
<?php
foreach($reviews_all as $r){?>
    <article><b>
        Author: <a href="../../users/<?php echo $r["review_author"] ?>"><?php echo $r["username"] ?></a></b><br>
<b><?php echo $r["review_name"];?></b></br>
<span><?php echo $r["review_date"] ?></span>

<p><?php echo $r["review_text"]; ?></p>

</article><?php
}
?>


</body>
</html>
