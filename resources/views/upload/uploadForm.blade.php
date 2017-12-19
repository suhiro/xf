@extends('layouts.master')
@section('content')
<main class="" role="main">
          <h2>CSV File upload</h2>
<form method="post" action="/upload" enctype="multipart/form-data">
{{csrf_field()}}
<div class="form-group">
<input type="file" class="form-control" name="csv_file" required>
</div>
<button type="submit" class="btn btn-primary">Upload</button>

</form>

    
        </main>
@endsection