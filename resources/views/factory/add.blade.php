@extends('layouts.master')
@section('content')
<main class="" role="main">
          <h1>Add new factory</h1>

        <form method="POST" action="/factory/store">
          {{csrf_field()}}
  <div class="form-group">
    <label for="factoryName">Factory Name</label>
    <input type="text" class="form-control" id="factoryName" name="factoryName" aria-describedby="factory name" placeholder="Enter factory name" required>
  
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control" id="description" name="description" placeholder="factory description" required>
  </div>
  <button type="submit" class="btn btn-primary">Create Factory</button>
</form>

          
        </main>
@endsection