<html>
<title>Machine Work Log</title>
<link href="{{URL::asset('css/internal.css')}}" rel="stylesheet">
<link href="{{URL::asset('css/dc.min.css')}}" rel="stylesheet">

<body>
<h1>Logs</h1>

<div id="machine1" class="machine-report">
	<div class="machine-info">
<h4 class="machine-id">Machine ID</h4>
<ul class="kpi">
<li>a</li>
<li>b</li>
<li>c</li>
</ul>
	</div>
</div>
<div id="machine2" class="machine-report">	
<div class="machine-info">
<h4 class="machine-id">Machine ID</h4>
<ul class="kpi">
<li>a</li>
<li>b</li>
<li>c</li>
</ul>
	</div>
</div></div>








<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/logChart.js"></script>
<script src="js/d3.js"></script>
<script src="js/crossfilter.js"></script>
<script src="js/dc.min.js"></script>


@foreach($logs as $log)
{{var_dump($log)}}
@endforeach

</body>
</html>