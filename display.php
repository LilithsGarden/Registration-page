<?php 
include 'connect.php';
$sql = "SELECT id, username, `password`, time_stamp, is_encrypted FROM registration"; // adjust table & columns
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Item List</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table {
            border-collapse: collapse;
            width: 60%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">List of Items</h2>

<?php
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Username</th><th>Password</th><th>Time Stamp</th></tr>";

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        //pivk s umique idenyifier  $row["id"]
        $uniqueidentifier = $row["id"];
        $passwordFromDb = $row["password"];
        $password=password_hash($passwordFromDb,PASSWORD_BCRYPT);
        $is_encrypted = $row["is_encrypted"];
        $sql= "UPDATE `registration` SET `password` = '$password',`is_encrypted` = 1 WHERE `id` = $uniqueidentifier and $is_encrypted=0";
        mysqli_query($conn, $sql);
        //update your table where id = uniqueidentifier
        echo "<tr>
                <td>". $row["id"]. "</td>
                <td>". $row["username"]. "</td>
                <td>". $row["password"]. "</td>
                <td>". $row["time_stamp"]. "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p style='text-align:center;'>No items found.</p>";
}

// Close connection
$conn->close();
?>

</body>
</html>