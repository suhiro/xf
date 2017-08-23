<html>
<title>Machine Work Log</title>
<link href="{{URL::asset('css/internal.css')}}" rel="stylesheet">
<link href="{{URL::asset('css/dc.min.css')}}" rel="stylesheet">

<body>
<h1>Logs</h1>










<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/logChart.js"></script>
<script src="js/d3.js"></script>
<script src="js/crossfilter.js"></script>
<script src="js/dc.min.js"></script>


@foreach($machineArray as $m)
<div id="machine{{$m->serial}}" class="machine-report">	
<div class="machine-info">
<h4 class="machine-id">{{$m->serial}}</h4>
<ul class="kpi">
<li>a</li>
<li>b</li>
<li>c</li>
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
</html>