@extends('layouts.master')
@section('content')
<main class="" role="main">
          <h1>Create new package</h1>

        <form method="POST" action="/package/store">
          {{csrf_field()}}
  <div class="form-group">
    <label for="package">Package Name</label>
    <input type="text" class="form-control" name="package" aria-describedby="package name" placeholder="Enter the name of the package" required>
 
  </div>

  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" class="form-control"  name="description" aria-describedby="description" placeholder="A brief package description">
    
  </div>

  

 



  <button type="submit" class="btn btn-primary">Create Package</button>
</form>

          
        </main>
@endsection