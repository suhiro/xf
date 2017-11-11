@foreach($machines as $m)

@if(sizeof($m->summary))
<p>{{ $m->serial }}</p>
<ul>
	@foreach($m->summary as $key => $val)
	<li>{{ $key }} : {{ $val }}</li>
	@endforeach
</ul>
@endif

@endforeach