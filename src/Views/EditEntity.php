<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../../../css/entity.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Entity Form</title>
    <style>
        
    </style>
</head>
<body>
    <div class="container">
    <form method="POST" enctype="multipart/form-data">
    <div class="field-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" placeholder="Name" value="<?php echo $entity_old[0]['name']; ?>">
    </div>

    <div class="field-group">
        <label for="year">Year:</label>
        <select name="year" id="year">
            <option value=""></option>
            <?php foreach ($years as $y) { ?>
                <option value="<?php echo $y["year_id"]; ?>" 
                    <?php echo ($y["year_id"] == $entity_old[0]['yearID']) ? 'selected' : ''; ?>>
                    <?php echo $y["year"]; ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="field-group">
        <label>Type:</label>
        <div style="display:flex;">
            <input type="radio" name="type" id="movieType" value="1" disabled="true" 
            <?php echo ($entity_old[0]["type"] == 1) ? 'checked' : ''; ?>>
            <label for="movieType">Movie</label>
            <input type="radio" name="type" id="seriesType" value="2" disabled="true"
            <?php echo ($entity_old[0]["type"] == 2) ? 'checked' : ''; ?>>
            <label for="seriesType">Series</label>
        </div>
    </div>
    
    <div class="field-group">
        <label for="genre">Genre:</label>
        <select name="genre" id="genre">
            <option value=""></option>
            <?php foreach ($genres as $g) { ?>
                <option value="<?php echo $g["genre_id"]; ?>" 
                    <?php echo ($g["genre_id"] == $entity_old[0]['genre']) ? 'selected' : ''; ?>>
                    <?php echo $g["genre_name"]; ?>
                </option>
            <?php } ?>
        </select>
    </div>
    
    <?php if ($entity_old[0]["type"] == 1) { ?>
        <div class="field-group" id="movieFields">
            <label for="duration">Duration (minutes):</label>
            <input type="number" name="duration" id="duration" placeholder="Duration"
            value="<?php echo $entity_old[0]['duration_min']; ?>">
        </div>
    <?php } else { ?>
        <div class="field-group" id="seriesFields">
            <label for="num_seasons">Number of seasons:</label>
            <input type="number" name="num_seasons" id="num_seasons" placeholder="Number of seasons"
            value="<?php echo $entity_old[0]['num_seasons']; ?>">

            <label for="num_episodes">Number of episodes:</label>
            <input type="number" name="num_episodes" id="num_episodes" placeholder="Number of episodes"
            value="<?php echo $entity_old[0]['num_episodes']; ?>">

            <label for="year_end">Year of end:</label>
            <select name="year_end" id="year_end">
                <option value=""></option>
                <?php foreach ($years as $y) { ?>
                    <option value="<?php echo $y["year_id"]; ?>" 
                    <?php echo ($y["year_id"] == $entity_old[0]['year_end']) ? 'selected' : ''; ?>>
                    <?php echo $y["year"]; ?>
                </option>
                <?php } ?>
            </select>
        </div>
    <?php } ?>
    
    <div class="field-group">
        <label for="desc">Description:</label>
        <input type="text" name="desc" id="desc"
        value="<?php echo $entity_old[0]['entity_desc']; ?>">
    </div>

    <div class="field-group">
        <label for="image">Image:</label>
        <input type="file" name="image" id="image">
    </div>

    <input type="submit" name="submit" id="submit" value="Submit">
</form>
    </div>


</body>
</html>
