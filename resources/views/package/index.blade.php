@extends('layouts.master')
@section('content')
<main class="" role="main">
          <h1>Packages</h1>

      
        <div class="row">
        <div class="col-6">
        <table class="table table-sm">
          <thead>
            <tr><th>Package</th><th>Description</th><th>Edit</th></tr>
          </thead>
          <tbody>
            @foreach($packages as $p)
              <tr>
                <td>{{ $p->package }}</td>
                <td>{{ $p->description }}</td>
              
                <td><a class="btn btn-sm btn-primary" href="/package/{{$p->id}}/edit">Edit</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>



        <a class="btn btn-primary" href="/package/create" role="button">New Package</a>

          
        </main>
@endsection