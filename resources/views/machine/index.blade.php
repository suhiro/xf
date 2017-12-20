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


      <div class="m-portlet__body" id="machines"></div>
    </div>  
    <!--end::Portlet-->
  </div>
</div>


@endsection

@section('pageJS')

<script>
  var jString = '{!! $machines !!}';
  var dataJSONArray = JSON.parse(jString);
var options = {
    data: {
      type:'local',
      source: dataJSONArray,
      pageSize: 10
    },
    // layout definition
         layout: {
            theme: 'default',
                // datatable theme
            class: '',
                // custom wrapper class
            scroll: false,
                // enable/disable datatable scroll both horizontal and vertical when needed.
             height: 450, // datatable's body's fixed height
            footer: false,// display/hide footer
            header: true,
      
            },

            // column sorting
        sortable: true,
        pagination: true,

        

        columns: [
          {
            field: "id",
            title: '#',
            width: 40,
            sortable: false,
            textAlign: 'center',
            selector: {
              class: 'm-checkbox--solid m-checkbox--brand',
            },
          },
          {
            field: "serial",
            title: "Serial",
            width: 100,
            sortable: true,
            selector: false,
            taxtAlign: 'center'
          },
          {
            field: "user_serial",
            title: "User Serial",
            width: 100,
            sortable: true,
            selector: false,
            taxtAlign: 'center'
          },
          {
            field: "modName",
            title: "Model",
            width: 100,
            sortable: true,
            selector: false,
            taxtAlign: 'center'
          },
          {
            field: "currentPackage",
            title: "Package",
            width: 100,
            sortable: true,
            selector: false,
            taxtAlign: 'center'
          },
          {
            field: "location",
            title: "Factory",
            width: 100,
            sortable: true,
            selector: false,
            taxtAlign: 'center'
          },
          {
            field: "Actions",
            width: 110,
            title: "Actions",
            sortable: false,
            overflow: 'visible',
            template : function(row){
              return '<a class="btn btn-sm btn-primary" href="/machine/' + row.id + '/edit">Edit</a> ';
            }
          },
        ]
  }


  
  $('#machines').mDatatable(options);

  $('#machines').on('m-datatable--on-check',function(event,args){
    alert('checked '+ args);
  });
   $('#machines').on('m-datatable--on-uncheck',function(event,args){
    alert('uncheck ' + args );
  });



</script>
@endsection