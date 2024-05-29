<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../../css/userreview.css">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
    <?php include_once "Navbar.php"; ?>
<table style="margin:auto; padding: auto; width: 100%; text-align:center;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td><?php echo $profession_data[0]["profession_id"]; ?></td>
                <td><?php echo $profession_data[0]["profession_name"]; ?></td>
                <td><?php echo $profession_data[0]["profession_desc"]; ?></td>
                <td><?php echo $number[0]["count"]; ?></td>
            </tr>
    </tbody>
</table>
</body>
</html>
