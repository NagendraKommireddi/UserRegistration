<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<title>Users List</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/scroller/2.0.5/css/scroller.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<body>
<h2>Welcome User</h2>
<head>
<title>Display records</title>
<style>

table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
bottom: .5em;
}

body {
	background:  #0d6efd;
	font-family: 'Roboto', sans-serif;
}

</style>
</head>
 
<table id = "table1" class="table  table-hover table-bordered " width="100%" border="0" cellspacing="5" cellpadding="5">
  <thead>
    <th>User Id</th>
    <th>User Name</th>
    <th>Email Id</th>
  </tr>
  </thead>
  <?php
  $i=1;
  foreach($result as $row)
  {
  echo "<tr>";
  echo "<td>".$row['id']."</td>";
  echo "<td>".$row['user_name']."</td>";
  echo "<td>".$row['email_id']."</td>";
  echo "</tr>";
  $i++;
  }
   ?>
</table>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
	
	$(document).ready(function () {
		$('#table1').DataTable();
		$('.dataTables_length').addClass('bs-select');
    });

</script>

