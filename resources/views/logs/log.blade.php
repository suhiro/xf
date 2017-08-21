<html>
<title></title>
<link href="{{URL::asset('css/internal.css')}}" rel="stylesheet">
<link href="{{URL::asset('css/dc.min.css')}}" rel="stylesheet">

<body>
<h1>Logs</h1>
 <canvas id="myCanvas" style="background-color: #000000"></canvas>

 <br>
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

<br>
<canvas id="c2"></canvas> 
<h2>bar charts: payments by type</h2>



<div id="chart"></div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/logChart.js"></script>
<script src="js/d3.js"></script>
<script src="js/crossfilter.js"></script>
<script src="js/dc.min.js"></script>

<script>

	var data = [
  {date: "2011-11-14T16:17:54Z", quantity: 2, total: 190, tip: 100, type: "tab"},
  {date: "2011-11-14T16:20:19Z", quantity: 2, total: 190, tip: 100, type: "tab"},
  {date: "2011-11-14T16:28:54Z", quantity: 1, total: 300, tip: 200, type: "visa"},
  {date: "2011-11-14T16:30:43Z", quantity: 2, total: 90, tip: 0, type: "tab"},
  {date: "2011-11-14T16:48:46Z", quantity: 2, total: 90, tip: 0, type: "tab"},
  {date: "2011-11-14T16:53:41Z", quantity: 2, total: 90, tip: 0, type: "tab"},
  {date: "2011-11-14T16:54:06Z", quantity: 1, total: 100, tip: 0, type: "cash"},
  {date: "2011-11-14T16:58:03Z", quantity: 2, total: 90, tip: 0, type: "tab"},
  {date: "2011-11-14T17:07:21Z", quantity: 2, total: 90, tip: 0, type: "tab"},
  {date: "2011-11-14T17:22:59Z", quantity: 2, total: 90, tip: 0, type: "tab"},
  {date: "2011-11-14T17:25:45Z", quantity: 2, total: 200, tip: 0, type: "cash"},
  {date: "2011-11-14T17:29:52Z", quantity: 1, total: 200, tip: 100, type: "visa"}
];

var facts = crossfilter(data); 

var typeDimesion = facts.dimension(function(d){ console.log(d.type); return d.type; });





function print_filter(filter) {
    var f=eval(filter);
    if (typeof(f.length) != "undefined") {}else{}
    if (typeof(f.top) != "undefined") {f=f.top(Infinity);}else{}
    if (typeof(f.dimension) != "undefined") {f=f.dimension(function(d) { return "";}).top(Infinity);}else{}
    console.log(filter+"("+f.length+") = "+JSON.stringify(f).replace("[","[\n\t").replace(/}\,/g,"},\n\t").replace("]","\n]"));
  }
</script>
</body>
</html>