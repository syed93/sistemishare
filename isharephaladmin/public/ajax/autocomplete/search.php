<?php
$mysqli = new mysqli('localhost', 'isharephal', 'rahsiajun', 'isharephal');
$text = $mysqli->real_escape_string($_GET['term']);

$query = "SELECT username FROM users WHERE username LIKE '%$text%' ORDER BY username ASC";
$result = $mysqli->query($query);
$json = '[';
$first = true;
while($row = $result->fetch_assoc())
{
    if (!$first) { $json .=  ','; } else { $first = false; }
    $json .= '{"value":"'.$row['username'].'"}';
}
$json .= ']';
echo $json;
?>