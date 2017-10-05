@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Add new machine</h1>

        <form method="POST" action="/machine/store">
          {{csrf_field()}}
  <div class="form-group">
    <label for="serial">Serial</label>
    <input type="text" class="form-control" id="serial" name="serial" aria-describedby="machine serial" placeholder="Enter machine serial" required>
  <small id="seiral_help" class="form-text text-muted">Univeral machine ID</small>
  </div>

  <div class="form-group">
    <label for="user_serial">User Serial</label>
    <input type="text" class="form-control" id="user_serial" name="user_serial" aria-describedby="user serial" placeholder="Enter user serial" required>
    <small id="user_seiral_help" class="form-text text-muted">used by the facotry to identify the machine</small>
  </div>
  <div class="form-group">
    <label for="model">model</label>
    <input type="text" class="form-control" id="model" name="model" aria-describedby="model" placeholder="Enter machine model" required>
   
  </div>

  <div class="form-group">
    <label for="package">package</label>
    <input type="text" class="form-control" id="package" name="package" aria-describedby="package" placeholder="Enter machine package" required>
   <small id="package-help" class="form-text text-muted">can be changed to selection</small>
   
   
  </div>

  <div class="form-group">
    <label for="factory">Factory</label>
    <select id="factory" name="factory" class="custome-select">
      @foreach($factories as $f)
      <option value="{{$f->id}}">{{$f->name}}</option>
      @endforeach
    </select>
  </div>


  <button type="submit" class="btn btn-primary">Create Machine</button>
</form>

          
        </main>
@endsection