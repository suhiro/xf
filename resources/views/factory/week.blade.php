@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>{{$factory->name}}</h1>
          <h3>Current Week {{$dt->startOfWeek()->toDateString().' ~ '.$dt->endOfWeek()->toDateString()}}</h3>

          <form method="POST" action="/factory/{{$factory->id}}">
            {{ csrf_field() }}
          <div class="form-group">
          {{ Form::label('viewWeek','Pick a week') }}
          {{ Form::text('viewWeek',null,['class'=>'form-control col-sm-2','id'=>'viewWeek'])}}
           </div>
          <div class="form-group">
             {{ Form::submit('View',['class'=>'btn btn-primary'])}}
          </div>
          </form>
        
          <section class="row text-center placeholders">

            <table class="table ">
              <thead>
                <tr><th>Serial</th><th>User_serial</th><th>Package</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th><th>Sunday</th></tr>
              </thead>
              @foreach($factory->machine as $m)
              <tr>
                <td>{{$m->serial}}</td>
                <td>{{$m->user_serial}}</td>
                <td>{{$m->mod->package}}</td>
                <td>{{ $m->output($dt->startOfWeek()->toDateString(),$m->serial)}}</td>
                <td>{{$m->output($dt->addDays(1)->toDateString(),$m->serial)}}</td>
                <td>{{$m->output($dt->addDays(1)->toDateString(),$m->serial)}}</td> 
                <td>{{$m->output($dt->addDays(1)->toDateString(),$m->serial)}}</td> 
                <td>{{$m->output($dt->addDays(1)->toDateString(),$m->serial)}}</td> 
                <td>{{$m->output($dt->addDays(1)->toDateString(),$m->serial)}}</td>
                 <td>{{$m->output($dt->addDays(1)->toDateString(),$m->serial)}}</td>

              </tr>
              @endforeach
            </table>
            
          </section>

    
        </main>


@endsection

@section('pageJS')
<script>


  $("#viewWeek").datepicker({
  dateFormat:'yy-mm-dd',
  showWeek:true,
  firstDay:1,
  });


</script>


@endsection