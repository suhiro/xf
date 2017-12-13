@extends('layouts.master')
@section('content')


 <div class="row">
    <div class="col-lg-12">  
      <!--begin::Portlet-->
      <div class="m-portlet m-portlet--mobile">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
              Machines <small>under your account</small>
            </h3>
          </div>      
        </div>
      </div>
      <div class="m-portlet__body">
        @if($machines)

        <table class="table table-sm">
          <thead>
            <tr><th>Serial</th><th>user_serial</th><th>Model</th><th>Package</th><th>Factory</th><th>Actions</th></tr>
          </thead>
          <tbody>
            @foreach($machines as $m)
              <tr>
                <td>{{ $m->serial }}</td>
                <td>{{ $m->user_serial }}</td>
                <td>{{ $m->mod->name }}</td>
                <td>{{ $m->package->package }}</td>
                <td>{{ $m->factory->name }}</td>
                <td><a class="btn btn-sm btn-success" href="/machine/{{$m->id}}/edit">View Detail</a> 
                  <a class="btn btn-sm btn-primary" href="/machine/{{$m->id}}/edit">Edit</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>


        @endif
      </div>
    </div>  
    <!--end::Portlet-->
  </div>
</div>
@endsection