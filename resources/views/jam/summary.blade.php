@foreach($machines as $m)


@if(sizeof($m->summary))

<div class="row jam-summary mb-3 p-3">
	<div class="col-4">

<p>{{ $m->serial }}</p>


<ul class="list-unstyled">
@php
$i = 5;
@endphp

	@foreach($m->summary as $key => $val)
		@if($i > 0)
			<li>{{ $key }} : {{ $val }}</li>
		@php $i-- @endphp
		@endif	
	@endforeach

	@if(sizeof($m->summary) > 5)
	<li>more...</li>
	@endif
</ul>


	</div>

	<div class="col-4">
		<div id="machine{{ $m->id }}"></div>
	</div>

</div> <!-- end of row -->

<script>
	var data = {
  labels: [
 	 @foreach($m->summary as $key => $val)
 	 '{{ $key }}',
 	 @endforeach
  ],
  series: [
   @foreach($m->summary as $key => $val)
 	 '{{ $val }}',
 	 @endforeach
  ]
};

	var options = {
  labelInterpolationFnc: function(value) {
    return value[0]
  }
};

var responsiveOptions = [
  ['screen and (min-width: 640px)', {
    chartPadding: 30,
    labelOffset: 100,
    labelDirection: 'explode',
    labelInterpolationFnc: function(value) {
      return value;
    }
  }],
  ['screen and (min-width: 1024px)', {
    labelOffset: 80,
    chartPadding: 10
  }]
];
	new Chartist.Pie('#machine'+{{$m->id}},data,options,responsiveOptions);
</script>

@endif

@endforeach