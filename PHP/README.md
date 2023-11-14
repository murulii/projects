

1. Create a folder for your project and navigate into it:

```bash
mkdir php_mysql_docker
cd php_mysql_docker
```

2. Create an `index.php` file for your PHP code:

```php
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
```

3. Create a `Dockerfile`:

```Dockerfile
# Dockerfile

# Use the official PHP image
FROM php:7.4-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Set working directory
WORKDIR /var/www/html

# Copy the PHP files to the container
COPY index.php .

# Expose port 80 for the Apache server
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
```

4. Create a `.env` file to store your MySQL credentials:

```
# .env

DB_HOST=your_mysql_host
DB_USER=your_mysql_username
DB_PASSWORD=your_mysql_password
DB_NAME=your_mysql_database
```
## or 

```bash
docker run -p 8080:80 \
  -e DB_HOST=your_mysql_host \
  -e DB_USER=your_mysql_username \
  -e DB_PASSWORD=your_mysql_password \
  -e DB_NAME=your_mysql_database \
  your-docker-image
```
In Docker, you can use the `-e` or `--env` option to set environment variables when running a container. When you run a container, you can provide environment variables directly on the command line. Here's an example:

Replace `your_mysql_host`, `your_mysql_username`, `your_mysql_password`, and `your_mysql_database` with your actual MySQL credentials.

Now, you have your project structure and necessary files. To build and run the Docker image:

```bash
# Build the Docker image
docker build -t php_mysql_docker .

# Run the Docker container, providing the environment variables from the .env file
docker run -p 8080:80 --env-file .env php_mysql_docker
```

Visit `http://localhost:8080` in your web browser to see the PHP script in action. The data should be inserted into your MySQL database using the provided environment variables.



