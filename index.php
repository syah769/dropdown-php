<?php
//index.php

$connect = new PDO("mysql:host=localhost;dbname=testing", "root", "");

$query = "SELECT DISTINCT Country FROM tbl_customer ORDER BY Country ASC";
$query1 = "SELECT DISTINCT CustomerName FROM tbl_customer ORDER BY CustomerName ASC";

$statement = $connect->prepare($query);
$statement1 = $connect->prepare($query1);

$statement->execute();
$statement1->execute();


$result = $statement->fetchAll();
$result1 = $statement1->fetchAll();

?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Ajax Live Data Search using Multi Select Dropdown in PHP</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
		
		<link href="css/bootstrap-select.min.css" rel="stylesheet" />
		<script src="js/bootstrap-select.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			<h2 align="center">Ajax Live Data Search using Multi Select Dropdown in PHP</h2><br />
			
			<select name="multi_search_filter" id="multi_search_filter" multiple class="form-control selectpicker">
			<?php
			foreach($result as $row)
			{
				echo '<option value="'.$row["Country"].'">'.$row["Country"].'</option>';	
			}
			?>
			</select>

			<select name="multi_search_filter1" id="multi_search_filter1" multiple class="form-control selectpicker">
			<?php
			foreach($result1 as $row1)
			{
				echo '<option value="'.$row1["CustomerName"].'">'.$row1["CustomerName"].'</option>';	
			}
			?>
			</select>


			<input type="hidden" name="hidden_country" id="hidden_country" />
			<input type="hidden" name="hidden_customer" id="hidden_customer" />

			<div style="clear:both"></div>
			<br />
			<div class="table-responsive">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Customer Name</th>
							<th>Address</th>
							<th>City</th>
							<th>Postal Code</th>
							<th>Country</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<br />
			<br />
			<br />
		</div>
	</body>
</html>


<script>
$(document).ready(function(){

	load_data();
	
	function load_data(query='')
	{
		$.ajax({
			url:"fetch.php",
			method:"POST",
			data:{query:query},
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#multi_search_filter').change(function(){
		$('#hidden_country').val($('#multi_search_filter').val());
		var query = $('#hidden_country').val();
		load_data(query);
	});
	
});
</script>

<script>
$(document).ready(function(){

	load_data();
	
	function load_data(query1='')
	{
		$.ajax({
			url:"fetch1.php",
			method:"POST",
			data:{query1:query1},
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}

	$('#multi_search_filter1').change(function(){
		$('#hidden_customer').val($('#multi_search_filter1').val());
		var query1 = $('#hidden_customer').val();
		load_data(query1);
	});
	
});
</script>




