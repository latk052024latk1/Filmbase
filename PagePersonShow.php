<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../css/entitypageshow.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
    
</head>
<body>

<div class="container">
    <?php include_once "Form.php" ?>

        <img src="http://localhost/filmbase/images/people/<?php echo $people_data[0]["person_id"] ?>.png" style="max-width: 80%;">

        <table>
            <tr>
                <tr>
                    <th>Name</th>
                    <td><?php echo $people_data[0]["person_name"]; ?></td>
                </tr>
                <tr>
                    <th>Surname</th>
                    <td><?php echo $people_data[0]["person_surname"]; ?></td>
                </tr>
                <tr>
                    <th>Birth date</th>
                    <td><?php echo $people_data[0]["person_birthdate"]; ?></td>
                </tr>
                <?php if ($people_data[0]["person_death_date"]){?> 
                <tr>
                    <th>Death date</th>
                    <td><?php echo $people_data[0]["person_death_date"]; } ?></td>
                </tr>
            </tbody>
        </table>

    </div>

</body>
</html>