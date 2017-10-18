@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Machines</h1>

        @if($machines)

        <table class="table table-sm">
          <thead>
            <tr><th>Serial</th><th>user_serial</th><th>Model</th><th>Package</th><th>Factory</th><th>Edit</th></tr>
          </thead>
          <tbody>
            @foreach($machines as $m)
              <tr>
                <td>{{ $m->serial }}</td>
                <td>{{ $m->user_serial }}</td>
                <td>{{ $m->mod->name }}</td>
                <td>{{ $m->mod->package }}</td>
                <td>{{ $m->factory->name }}</td>
                <td><a class="btn btn-sm btn-primary" href="/machine/{{$m->id}}/edit">Edit</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>


        @endif

        <a class="btn btn-primary" href="/machine/create" role="button">New Machine</a>

          
        </main>
@endsection