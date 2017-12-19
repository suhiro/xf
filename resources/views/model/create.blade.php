@extends('layouts.master')
@section('content')

<main class="" role="main">
          <h2>Create New Model</h2>

<div class="row">
  <div class="col-lg-8 col-sm-12" >
        <form method="POST" action="/model/store">
          {{csrf_field()}}
  <div class="form-group">
    <label for="modelName">Model Name</label>
    <input type="text" class="form-control" id="modelName" name="modelName" aria-describedby="model name" placeholder="Provide a model name" required>
  <small id="modelName_help" class="form-text text-muted">a unique model ID</small>
  </div>

  <div class="form-group">
    <label for="package">Default Package</label>
    <select id="package" name="package" class="custom-select">
      @foreach($packages as $p)
      <option value="{{$p->id}}">{{$p->package}}</option>
      @endforeach
    </select>
  </div>

 

  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" id="description" name="description" class="form-control">
      
  </div>


  <button type="submit" class="btn btn-primary">Create Model</button>
</form>
  </div>
</div>       
</main>

@endsection