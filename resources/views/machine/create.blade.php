@extends('layouts.master')
@section('content')
<main class="" role="main">
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
    <select id="model" name="model" class="custom-select">
      @foreach($models as $m)
      <option value="{{$m->id}}">{{$m->name}}</option>
      @endforeach
    </select>
  </div>

  <div class="form-group">
    <label for="package">package</label>
    <select id="package" name="package" class="custom-select">
      @foreach($packages as $p)
      <option value="{{$p->id}}">{{$p->package}}</option>
      @endforeach
    </select>
  </div>

 

  <div class="form-group">
    <label for="factory">Factory</label>
    <select id="factory" name="factory" class="custom-select">
      @foreach($factories as $f)
      <option value="{{$f->id}}">{{$f->name}}</option>
      @endforeach
    </select>
  </div>


  <button type="submit" class="btn btn-primary">Create Machine</button>
</form>

          
        </main>
@endsection