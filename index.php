<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
</head>

<body>
    <h2>Login Form</h2>
    <p>Enter your username = "admin' or ''='" to test injection
        <button id="try-btn">Try</button>
    </p>
    <form method="post" action="">
        Username: <input type="text" name="username" placeholder="Enter your name"><br><br>
        Password: <input type="password" name="password" placeholder="Enter your password"><br><br>
        <input type="submit" value="Submit">
    </form>

    </br>
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
        $password = $_POST['password'];

        // Vulnerable query (susceptible to SQL injection)
        $sql = "SELECT * FROM users WHERE username = '$username' and password = '$password'";

        echo 'SQL QUERY: ' . $sql;
        $result = $conn->query($sql);

        echo "</br> Results: </br>";
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "Loged in as<br>";
                echo "ID: " . $row["id"] . " - Username: " . $row["username"] . "<br>";
            }
        } else {
            echo "Login failed. Please try again.";
        }
    }

    // Close connection
    $conn->close();
    ?>
</body>

<script>
    document.querySelector('#try-btn').addEventListener('click', () => {
        document.querySelector('input[name="username"]').value = "admin' or ''='";
    });
</script>

</html>