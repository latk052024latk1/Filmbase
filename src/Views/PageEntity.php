<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../../css/entitypage.css">
    <link rel="stylesheet" href="../../../css/entitystuff.css">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>

</head>
<body>
<script src="../../../js/entitypage.js"></script>
 <div class="container" style="text-align:center;">
        <h2><?php echo $entity[0]["name"]." (".$entity[0]["year"].")"; ?></h2>

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

        
       
    </div>

<div style="margin-bottom:200px;">

<button class="buttonForm" onclick="myFunction()">Tags</button>
<div id="myDIV" name="myDIV">
<h2>Add tag</h2>
<form class="fieldWrapper" method="POST" id="tagForm" name="tagForm">
    <input class="form-control" type="text" name="tagName" id="tagName">
    <input type="submit">
</form>
</div>


<button class="buttonForm" onclick="myFunction1()">Countries</button>

<div id="myDIV1" name="myDIV1">
    <h2>Add country</h2>
    <form  class="fieldWrapper"  method="POST" id="countryForm" name="countryForm">


        <select name="countryId">
            <option value=""></option>
            <?php foreach ($countries_list as $c){ ?>
            <option id="country_id" value=<?php echo $c["country_id"] ?>>
              <?php echo $c["country_name"] ?>
            </option>
            <?php } ?>
          </select>


        <input type="submit">
    </form>
    </div>

    
<button class="buttonForm" onclick="myFunction3()">Staff</button>

    <div id="myDIV3" name="myDIV3">
        <h2>Add staff</h2>
        <form  class="fieldWrapper"  method="POST" id="staffForm" name="staffForm">

            <input  class="form-control" type="text" name="person_full" id="person_full" placeholder="Person's full name">

            <select name="professionId">
                <option value=""></option>
                <?php foreach ($profession_list as $p){ ?>
                <option id="profession_id" value=<?php echo $p["profession_id"] ?>>
                  <?php echo $p["profession_name"] ?>
                </option>
                <?php } ?>
            </select>
    
    
            <input type="submit">
        </form>
        </div>

        
        <?php $p1 = "photo"; ?>

        <button class="buttonForm" onclick="myFunctionC()">Characters</button>

        <div id="DIVcharacter" name="DIVcharacter">
            <h2>Add characters</h2>
            <form  class="fieldWrapper"  method="POST" id="characterForm" name="characterForm">
    
                <input  class="form-control"  type="text" name="character_name" id="character_name" placeholder="Character's name">
    
                <select name="actorId">
                    <option value=""></option>
                    <?php foreach ($staff_by as $st){ if ($st["profession_name"] == "Actor") {?>
                    <option id="actor_id" value=<?php echo $st["person_id"] ?>>
                      <?php echo $st["person_name"]." ".$st["person_surname"] ?>
                    </option>
                    <?php } }?>
                  </select>
        
        
                <input type="submit">
            </form>
            </div>


            <button class="buttonForm" onclick="myFunctionR()">Reviews</button>
            
<div id="DIVreview" name="DIVreview">
<form  class="fieldWrapper"  class="left-aligned-form" method="POST" 
style="padding:10px;text-align:left;width:50%; height:auto">
<label for="review_name">Name:</label>
<input type="text" class="form-control" id="review_name" name="review_name" placeholder="Name of the review:">
    <label for="review_text">Review:</label>
    <textarea name="review_text" id="review_text" style="max-width:100%; max-height:100%; width: 75%; margin: 0 auto;"></textarea>
    <input style="margin-top:25px" type="submit">
</form>
</div>
</div>
</body>
</html>