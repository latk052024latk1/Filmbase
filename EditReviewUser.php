<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../../../../css/common.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

</head>
<body>



<form  class="fieldWrapper"  class="left-aligned-form" method="POST">
<label for="review_name">Name:</label>
<input type="text" class="form-control" id="review_name" name="review_name" placeholder="Name of the review:" value=
"<?php echo $review_old["review_name"] ?>">
    <label for="review_text">Review:</label>
    <textarea name="review_text" id="review_text" style="max-width:100%; max-height:100%; width: 100%; margin: 0 auto;">
    <?php echo $review_old["review_text"]; ?></textarea>
    <input type="submit">
</form>
</body>
</html>