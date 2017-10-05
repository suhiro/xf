@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Dashboard</h1>

          <section class="row text-center placeholders">
            @if($factories)
              @foreach($factories as $f)

               <div class="col-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
              <h4>{{ $f->name }}</h4>
              <div class="text-muted">Total XF: {{ $f->machine->count() }}</div>
            </div>

              @endforeach
            @endif
           
           
          
              <div class="col-6 col-sm-3 my-auto placeholder">
              <h2 class="hover"><a href="/factory/create"><i class="fa fa-plus-square-o fa-3x" aria-hidden="true"></i></a></h2>
              </div>
        
           
          </section>

          <h2>Month to date output</h2>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Statistics</th>
                 
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>SOIC</td>
                  <td>99</td>
               
                </tr>
                <tr>
                  <td>RESOP</td>
                  <td>60</td>
                </tr>
                <tr>
                  <td>EDIP</td>
                  <td>80</td>
                </tr>
               
              </tbody>
            </table>
          </div>
        </main>
@endsection