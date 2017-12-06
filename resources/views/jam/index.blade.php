@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Jams Summary</h1>
<div class="row">
<div class="col-5">

  <div class="form-group">
    <label for="viewRange">Period</label>
    <input type="text" class="form-control" id="viewRange" name="viewRange" aria-describedby="startTime" placeholder="Pick a time range">
  </div>
</div>

</div>

<section id="machines">
</section>
        

          
</main>


@endsection
@section('pageJS')
<script>
$('input[name="viewRange"]').daterangepicker({
  timePicker:true,
  timePickerIncrement:30,
  format: 'MM/DD/YYYY h:mm A'
}, function(start,end,label){
  console.log('from: ' + start.format('YYYY-MM-DD HH:mm:ss') + ' To: ' + end.format('YYYY-MM-DD HH:mm:ss'));

$.post(
  '/jams/summary',
  {
    _token: '{{ csrf_token() }}',
    start: start.format('YYYY-MM-DD HH:mm:ss'),
    end: end.format('YYYY-MM-DD HH:mm:ss')
  },
  function(data,status){
    if(status == 'success'){
      $('#machines').html(data);
 
    }
  }
  );

}

);
</script>
@endsection