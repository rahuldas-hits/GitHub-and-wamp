<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php

$q = intval($_GET['q']);
//echo "q value is : ".$q;
$con = mysqli_connect('localhost','Rahul','Koqa313*@3');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"testing");
$sql="SELECT * FROM bikes WHERE image_id = '".$q."'";
$result = mysqli_query($con,$sql);

echo "<table>
<tr>
<th>user_id</th>
<th>bike_id</th>
<th>start_date</th>
<th>end_date</th>
<th>image_id</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['user_id'] . "</td>";
    echo "<td>" . $row['bike_id'] . "</td>";
    echo "<td>" . $row['start_date'] . "</td>";
    echo "<td>" . $row['end_date'] . "</td>";
    echo "<td>" . $row['image_id'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
</body>
</html>