@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Model Detail</h1>

          <h3>{{ $model->name }}</h3>
          <h5>Default Package <strong>{{ $model->package->package }}</strong></h5>
          <p>{{ $model->description }}</p>

        @if(sizeof($model->error))
<div class="row">
  <div class="col-lg-4 col-md-6 col-sm-12">
        <table class="table table-sm">
          <thead>
            <tr><th>Error Code</th><th>Description</th><th>Action</th></tr>
          </thead>
          <tbody>
            @foreach($model->error as $e)
              <tr>
                <td>{{ $e->err_code }}</td>
           
                <td>{{ $e->description }}</td>
                <td>
                  <a class="btn btn-sm btn-primary" href="/model/error/{{$e->id}}/edit">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
  </div>
</div>
        @endif

        <a class="btn btn-primary" href="/model/error/create" role="button">New Error Code</a>

</main>
@endsection