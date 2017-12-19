@extends('layouts.master')
@section('content')
<main class="" role="main">
          <h1>Factory Edit</h1>

          <section class="row">

            <div class="col-md-5">
       <form method="POST" action="/factory/{{ $factory->id }}/update">
        {{csrf_field()}}
  <div class="form-group">
    {{ Form::label('name','Factory Name',['class' => '']) }}
    {{ Form::text('name',$factory->name,['class' => 'form-control']) }}

  </div>
  <div class="form-group">
     {{ Form::label('description','Description',['class' => '']) }}
    {{ Form::text('description',$factory->description,['class' => 'form-control']) }}
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
  <a href="/factory/{{ $factory->id }}/remove" class="btn btn-danger">Remove</a>
</form>
            </div>
            
          </section>

    
        </main>
@endsection