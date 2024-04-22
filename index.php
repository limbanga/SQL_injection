<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h2>Login Form</h2>
    <form method="post" action="">
        Username: <input type="text" name="username"><br><br>
        <input type="submit" value="Submit">
    </form>

    <?php

    // Establish database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sql_injection";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];

        // Vulnerable query (susceptible to SQL injection)
        $sql = "SELECT * FROM users WHERE username = '$username'";

        echo $sql;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"]. " - Username: " . $row["username"]. "<br>";
            }
        } else {
            echo "0 results";
        }
    }

    // Close connection
    $conn->close();
    ?>
</body>
</html>
