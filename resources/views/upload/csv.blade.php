
<html>
<head>
<title>Process CSV file</title>
</head>
<body>
<h1>Process CSV file</h1>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<table class="table">
<thead>
	<tr>
	<th>SN#</th>
	<th>Customer</th>
	<th>CustomerID</th>
	<th>SetCode</th>
	<th>TimeStart</th>
	<th>TimeStop</th>
	<th>WorkMinutes</th>
	<th>Output</th>
	</tr>
</thead>
@foreach($data as $d)
<tr>
<td>{{$d['serial']}}</td>
<td>{{$d['customer']}}</td>
<td>{{$d['customerId']}}</td>
<td>{{$d['setCode']}}</td>
<td>{{$d['timeStart']}}</td>
<td>{{$d['timeEnd']}}</td>
<td>{{$d['workMinutes']}}</td>
<td>{{$d['output']}}</td>

</tr>

@endforeach
<table>
</body>
</html>