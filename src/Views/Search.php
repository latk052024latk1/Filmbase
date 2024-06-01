<?php ?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../css/common.css">
</head>

<body>
    <div class="container1">
        <?php include_once "Form.php"; ?>

        <div id="results">
            <?php
            if (isset($_POST["category"]) && isset($_SESSION["results"])) {
                echo "<h2>Results:</h2>";

                if ($_POST["category"] === "entities") {
                    foreach ($_SESSION["results"] as $result) {
                        echo "<a href='../entities/" . $result["entity_id"] . "'>" . $result["name"] . " (" . $result["year"] . ")</a>";
                        if ($_SESSION["role"] == 1) {
                            echo "<a href='../admin/entities/" . $result["entity_id"] . "'>" . " &#11122";")</a><br><br>";
                        }
                    }
                } elseif ($_POST["category"] === "people") {
                    foreach ($_SESSION["results"] as $result) {
                        echo "<a href='../people/" . $result["person_id"] . "'>" . $result["full_name"] . " (" . $result["person_birthdate"] . ")</a>";
                        if ($_SESSION["role"] == 1) {
                            echo "<a href='../admin/people/" . $result["person_id"] . "'>" . " &#11122";")</a><br><br>";
                        }
                    }
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
