@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>CSV File upload</h1>
<form method="post" action="/upload" enctype="multipart/form-data">
{{csrf_field()}}
<div class="form-group">
<input type="file" class="form-control" name="csv_file">
</div>
<button type="submit" class="btn btn-primary">Upload</button>

</form>

    
        </main>
@endsection