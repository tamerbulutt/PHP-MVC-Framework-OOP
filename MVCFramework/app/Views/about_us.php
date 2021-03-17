<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
</head>
<body>
    <h2>About Us Page</h2>
    <?php
    //var_dump($data);
      foreach($data['users'] as $user)
        {
            echo "Name: " . $user->userName . "<br>";
        }
    ?>
</body>
</html>