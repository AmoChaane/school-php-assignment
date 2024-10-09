<?php
$servername = "localhost";
$username = "root";
$password = "@@AmoChaane200";
$dbname = "social_network";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$email = "amo@gmail.cdom";
$password = "amocdhaane";

$sql = "select count(*) as count from users as u where u.Email = '$email' and u.Password = '$password'";

$result = $conn -> query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $total_count = $row['count'];
  echo "Total count: " . $total_count;
} else {
  echo "No results found";
}

// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//       echo "Email: " . $row["Email"]. " - Password: " . $row["Password"] . "<br>";
//     }
//   } else {
//     echo "0 results";
//   }
  $conn->close();
?>