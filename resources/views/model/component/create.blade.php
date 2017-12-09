@extends('layouts.master')
@section('content')

<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Create New Component for {{ $model->name }}</h1>

<div class="row">
  <div class="col-lg-8 col-sm-12" >
        <form method="POST" action="/model/component/store">
          {{csrf_field()}}
  <div class="form-group">
    <label for="componentName">Component Name</label>
    <input type="text" class="form-control" id="componentName" name="componentName" aria-describedby="componentName" placeholder="Provide a component name" required>
  <small id="componentName_help" class="form-text text-muted">for this unique model only</small>
  </div>

 

 

  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" id="description" name="description" class="form-control">
      
  </div>

  <input type="text" id="model_id" name="model_id" class="form-control" value="{{ $model->id }}" hidden>

  <button type="submit" class="btn btn-primary">Create Component</button>
</form>
  </div>
</div>       
</main>

@endsection