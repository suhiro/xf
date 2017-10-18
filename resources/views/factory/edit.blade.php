@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Factory Edit</h1>

          <section class="row">

            <div class="col-md-5">
       <form method="POST" action="/factory/{{ $factory->id }}/update">
        {{csrf_field()}}
  <div class="form-group">
    {{ Form::label('name','Factory Name',['class' => '']) }}
    {{ Form::text('name',$factory->name,['class' => 'form-control']) }}
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
     {{ Form::label('description','Description',['class' => '']) }}
    {{ Form::text('description',$factory->description,['class' => 'form-control']) }}
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
            </div>
            
          </section>

    
        </main>
@endsection