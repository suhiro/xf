


@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
         <h1>Logs</h1>

          <section class="row">
         
<div class="col-md-4">
<form method="post" action="{{url('log')}}" >
{{csrf_field()}}

<div class="form-group">
<label for="view_date">View Date: </label>
<input type="text" class="form-control" id="view_date" name="view_date" required>
</div>
<div class="form-group">
<label for="interval">Interval: </label>
<input type="number" step="100" min="100" max="10000" class="form-control"  name="interval" value="100">
</div>
<button type="submit" class="btn btn-primary">Choose</button>
</form>
@include('layouts.errors')

</div>

 </section>

@if($machineArray)
@foreach($machineArray as $m)
<div class="row">
<div id="machine{{$m->serial}}" class="machine-report col-md-8">	
<div class="machine-info">
<h4 class="machine-id">{{$m->serial}} - {{$m->model}}</h4>
<ul class="kpi">
<li>Assists: {{$m->errors}}</li>
<li>E.A: {{$m->assists}}</li>
<li>MUBA: {{$m->muba}}</li>
<li>Interval: {{$m->interval}}</li>
<li>Output: {{$m->output}}</li>
</ul>
	</div>
</div>

</div>
@endforeach 
@endif


<script>
document.addEventListener("DOMContentLoaded", function(event) { 
	@if($machineArray)


@foreach($machineArray as $m)

    var data{{$m->serial}} = [
	@foreach($m->logs as $l)
 {start:"{{$l->startTime}}",end:"{{$l->endTime}}"},
	@endforeach
				];
o2('machine{{$m->serial}}',data{{$m->serial}});
@endforeach
	@endif

$("#view_date").datepicker({
	dateFormat:'yy-mm-dd',

});



});


</script>
</main>

@endsection








