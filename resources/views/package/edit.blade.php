@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Package Edit</h1>
          <h4>{{$package->package}}</h4>

          <section class="row">

            <div class="col-md-5">
       <form method="POST" action="/package/{{ $package->id }}/update">
        {{csrf_field()}}
  <div class="form-group">
    {{ Form::label('package','Package name',['class' => '']) }}
    {{ Form::text('package',$package->package,['class' => 'form-control']) }}
    
  </div>

   <div class="form-group">
    {{ Form::label('description','Description',['class' => '']) }}
    {{ Form::text('description',$package->description,['class' => 'form-control']) }}
    
  </div>

   
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
            </div>
            
          </section>

    
        </main>
@endsection