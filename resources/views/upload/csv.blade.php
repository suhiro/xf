
<html>
<head>
<title>Process CSV file</title>
</head>
<body>
<h1>Process CSV file</h1>
<table>
@foreach($data as $d)
<tr>
<td>{{$d['SN#']}}</td>
<td>{{$d['Customer']}}</td>
<td>{{$d['CustomerID']}}</td>
<td>{{$d['SetCode']}}</td>
<td>{{$d['TimeStart']}}</td>
<td>{{$d['TimeStop']}}</td>
<td>{{$d['WorkMinutes']}}</td>
<td>{{$d['Output']}}</td>

</tr>

@endforeach
<table>
</body>
</html>