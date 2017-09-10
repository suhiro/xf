
<html>
<head>
<title>Processed CSV file</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</head>
<body>
<h1>Processed CSV file</h1>

<div class="form-group">
<a href="/upload" class="btn btn-success">Back</a>
</div>

<table class="table">
<thead>
	<tr>
	<th>MCGS_Time</th>
	<th>MCGS_TIMEMS</th>
	<th>serial</th>
	<th>user_id</th>
	<th>ERR_event</th>
	<th>TestSite_ON</th>
	<th>output</th>
	</tr>
</thead>
@foreach($data as $d)
<tr>
<td>{{$d['MCGS_Time']}}</td>
<td>{{$d['MCGS_TIMEMS']}}</td>
<td>{{$d['serial']}}</td>
<td>{{$d['user_id']}}</td>
<td>{{$d['ERR_event']}}</td>
<td>{{$d['TestSite_ON']}}</td>
<td>{{$d['output']}}</td>
</tr>

@endforeach
<table>

<table class="table">
<thead>
	<tr>
	<th>serial</th>
	<th>customerId</th>
	<th>setCode</th>
	<th>start</th>
	<th>stop</th>
	<th>workedMinutes</th>
	<th>output</th>
	</tr>
</thead>
@foreach($workLogs as $d)
<tr>
<td>{{$d['serial']}}</td>
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