<?php

//fetch.php

$connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");

if($_POST["query1"] != '')
{
	$search_array = explode(",", $_POST["query1"]);
	$search_text = "'" . implode("', '", $search_array) . "'";
	$query1 = "
	SELECT * FROM tbl_customer 
	WHERE CustomerName IN (".$search_text.") 
	ORDER BY CustomerID DESC
	";
}
else
{
	$query1 = "SELECT * FROM tbl_customer ORDER BY CustomerID DESC";
}

$statement = $connect->prepare($query1);

$statement->execute();

$result = $statement->fetchAll();

$total_row = $statement->rowCount();

$output = '';

if($total_row > 0)
{
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row["CustomerName"].'</td>
			<td>'.$row["Address"].'</td>
			<td>'.$row["City"].'</td>
			<td>'.$row["PostalCode"].'</td>
			<td>'.$row["Country"].'</td>
		</tr>
		';
	}
}
else
{
	$output .= '
	<tr>
		<td colspan="5" align="center">No Data Found</td>
	</tr>
	';
}

echo $output;


?>