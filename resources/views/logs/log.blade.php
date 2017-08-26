<html>
<title>Machine Work Log</title>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

<link href="{{URL::asset('css/internal.css')}}" rel="stylesheet">
<link href="{{URL::asset('css/dc.min.css')}}" rel="stylesheet">

<body>
<h1>Logs</h1>
<h2>{{public_path('log')}}</h2>










<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<sctipt src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></sctipt>

<script src="js/moment.min.js"></script>
<script src="js/bootstrap-datetimepicker.js"></script>
<script src="js/logChart.js"></script>
<script src="js/d3.js"></script>
<script src="js/crossfilter.js"></script>
<script src="js/dc.min.js"></script>

<div class="row">
<div class="col-md-3">
<form method="post" action="/log" >
{{csrf_field()}}

<div class="form-group">
<label for="view_date">View Date: </label>
<input type="text" class="form-control" id="view_date" name="view_date">
</div>
<button type="submit" class="btn btn-primary">Choose</button>
</form>
</div>
</div>


@foreach($machineArray as $m)
<div class="row">
<div id="machine{{$m->serial}}" class="machine-report col-md-6">	
<div class="machine-info">
<h4 class="machine-id">{{$m->serial}} - {{$m->model}}</h4>
<ul class="kpi">
<li>Assists: {{$m->errors}}</li>
<li>MUBA: {{$m->muba}}</li>
<li>Output: {{$m->output}}</li>
</ul>
	</div>
</div>


</div>
<script>
var data = [
	@foreach($m->logs as $l)
 {start:"{{$l->startTime}}",end:"{{$l->endTime}}"},
	@endforeach
];
o2('machine{{$m->serial}}',data);
</script>

@endforeach 

</body>
<script>
$("#view_date").datetimepicker({
	format:'YYYY-MM-DD',
});

</script>



</body>
</html>