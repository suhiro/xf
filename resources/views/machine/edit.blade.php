@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Machine Edit</h1>
          <h4>{{$machine->serial}}</h4>

          <section class="row">

            <div class="col-md-5">
       <form method="POST" action="/machine/{{ $machine->id }}/update">
        {{csrf_field()}}
  <div class="form-group">
    {{ Form::label('user_serial','User Serial',['class' => '']) }}
    {{ Form::text('user_serial',$machine->user_serial,['class' => 'form-control']) }}
    <small id="user_serial_help" class="form-text text-muted">User defined machine identification</small>
  </div>
  <div class="form-group">
    {{ Form::label('factory','Factory',['class' => '']) }}
    <select name="factory" id="factory" class="form-control">
      @foreach($factories as $f)
        @if($f->id == $machine->factory_id)
         <option value="{{$f->id}}" selected>{{$f->name}}</option>
        @else
        <option value="{{$f->id}}">{{$f->name}}</option>
        @endif
      @endforeach
    </select>
  </div>

   <div class="form-group">
    {{ Form::label('mod','Model - Package',['class' => '']) }}
    <select name="mod" id="mod" class="form-control">
      @foreach($models as $m)
      @if($m->id == $machine->mod_id)
        <option value="{{$m->id}}" selected>{{$m->name}} - {{$m->package}}</option> 
       @else
        <option value="{{$m->id}}">{{$m->name}} - {{$m->package}}</option>
         @endif
      @endforeach
    </select>
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
            </div>
            
          </section>

    
        </main>
@endsection