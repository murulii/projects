<!-- index.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP MySQL Docker Demo</title>
</head>
<body>
    <h1>Welcome to PHP MySQL Docker Demo</h1>

    <?php
    // Get MySQL credentials from environment variables
    $db_host = getenv('DB_HOST');
    $db_user = getenv('DB_USER');
    $db_password = getenv('DB_PASSWORD');
    $db_name = getenv('DB_NAME');

    // Connect to MySQL database
    $conn = new mysqli($db_host, $db_user, $db_password, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $sql = "INSERT INTO demo_table (data) VALUES ('Hello, Docker!')";
    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
    ?>

</body>
</html>
