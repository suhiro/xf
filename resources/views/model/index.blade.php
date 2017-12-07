@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Model Manager</h1>

        @if(sizeof($models))

        <table class="table table-sm">
          <thead>
            <tr><th>Model Name</th><th>Default Package</th><th>Description</th><th>Action</th></tr>
          </thead>
          <tbody>
            @foreach($models as $m)
              <tr>
                <td>{{ $m->name }}</td>
                <td>{{ $m->package->package }}</td>
           
                <td>{{ $m->description }}</td>
                <td>
                  <a class="btn btn-sm btn-primary" href="/model/{{$m->id}}/edit">Edit</a>
                  <a class="btn btn-sm btn-info" href="/model/{{$m->id}}/show">Details</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>


        @endif

        <a class="btn btn-primary" href="/model/create" role="button">New Model</a>

</main>
@endsection