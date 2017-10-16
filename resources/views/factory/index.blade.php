@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>{{$factory->name}}</h1>

          <section class="row text-center placeholders">

            <table class="table ">
              <thead>
                <tr><th>Serial</th><th>User_serial</th><th>Package</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th><th>Sunday</th></tr>
              </thead>
              @foreach($factory->machine as $m)
              <tr><td>{{$m->serial}}</td><td>{{$m->user_serial}}</td><td>{{$m->mod->package}}</td>
                <td>{{ $m->output($dt->startOfWeek()->toDateString(),$m->serial)}}</td>
             <td>{{$m->output($dt->addDays(1)->toDateString(),$m->serial)}}</td>
               <td>{{$m->output($dt->addDays(1)->toDateString(),$m->serial)}}</td> <td>{{$m->output($dt->addDays(1)->toDateString(),$m->serial)}}</td> <td>{{$m->output($dt->addDays(1)->toDateString(),$m->serial)}}</td> <td>{{$m->output($dt->addDays(1)->toDateString(),$m->serial)}}</td> <td>{{$m->output($dt->addDays(1)->toDateString(),$m->serial)}}</td>

              </tr>
              @endforeach
            </table>
            
          </section>

    
        </main>
@endsection