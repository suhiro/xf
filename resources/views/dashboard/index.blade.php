@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Dashboard</h1>

          <section class="row text-center placeholders">
            <div class="col-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
              <h4>Factory 1</h4>
              <div class="text-muted">Total XF: 20</div>
            </div>
            <div class="col-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIABAADcgwAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">
              <h4>Factory 2</h4>
              <span class="text-muted">Total XF: 40</span>
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