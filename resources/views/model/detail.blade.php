@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Model Detail</h1>

          <h3>{{ $model->name }}</h3>
          <h5>Default Package <strong>{{ $model->package->package }}</strong></h5>
          <p>{{ $model->description }}</p>

 @if(sizeof($model->component))       
<div class="row">
  <div class="col-lg-6 col-md-10 col-sm-12">
  <table class="table table-sm">
          <thead>
            <tr><th>Component</th><th>Description</th><th>Action</th></tr>
          </thead>
          <tbody>
            @foreach($model->component as $c)
              <tr>
                <td>{{ $c->name }}</td>
           
                <td>{{ $c->description }}</td>
                <td>
                  <a class="btn btn-sm btn-primary" href="/model/component/{{$c->id}}/edit" disabled>Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
</div>
</div>

@endif
<div class="form-group">
<a class="btn btn-success" href="/model/{{ $model->id }}/component/create" role="button">New Component</a>
</div>

@if(sizeof($model->error))
<div class="row">
  <div class="col-lg-6 col-md-10 col-sm-12">
        <table class="table table-sm">
          <thead>
            <tr><th>Error Code</th><th>Description</th><th>Component</th><th>Action</th></tr>
          </thead>
          <tbody>
            @foreach($model->error as $e)
              <tr>
                <td>{{ $e->err_code }}</td>
           
                <td>{{ $e->description }}</td>
                <td>@if($e->component) {{ $e->component->name }} @endif</td>
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