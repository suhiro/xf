@extends('layouts.master')
@section('content')
<main class="" role="main">
          <h2>New Error Code</h2>

<div class="row">
  <div class="col-lg-8 col-sm-12" >
        <form method="POST" action="/model/error/{{ $model->id }}/store">
          {{csrf_field()}}

  <div class="form-group">
    <label for="compoent">Component</label>
    <select id="component" name="component" class="custom-select">
      @foreach($components as $c)
      <option value="{{$c->id}}">{{$c->name}}</option>
        
      @endforeach
    </select>
  </div>



  <div class="form-group">
    <label for="modelName">Error Code</label>
    <input type="text" class="form-control" id="errorCode" name="errorCode" aria-describedby="error code" placeholder="new error code" required>
  </div>


 

  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" id="description" name="description" class="form-control" placeholder="" ="description">
      
  </div>


  <button type="submit" class="btn btn-primary">Create Error</button>
  <a href="/model/{{ $model->id }}/show" class="btn btn-warning">Cancel</a>
</form>
  </div>
</div>       
</main>

@endsection
