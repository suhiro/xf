@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Factory List</h1>

          <section class="row">

            <div class="col-md-5">
            <table class="table ">
              <thead>
                <tr><th>Factory Name</th><th>Description</th></tr>
              </thead>
              @foreach($factories as $f)
             <tr><td>{{$f->name}}</td><td>{{$f->description}}</td><td><a class="btn btn-sm btn-primary" href="factory/{{ $f->id }}/show">Edit</a></td></tr>
              @endforeach
            </table>
          </div>
            
          </section>

    
        </main>
@endsection