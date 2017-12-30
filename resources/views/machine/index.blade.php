@extends('layouts.master')
@section('content')

<main id="main">
 <div class="row">
    <div class="col-lg-12">  
      <!--begin::Portlet-->
      <div class="m-portlet m-portlet--mobile">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
              Machines <small>under this account</small>
            </h3>
          </div>      
        </div>
      </div>

      <div class="m-portlet__body" id="machines"></div>
    </div>  
    <!--end::Portlet-->
  </div>
</div>
</main>

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
              var buttons = '<button  type="button" class="btn btn-sm btn-primary" onclick="machineReport(' + row.id + ')">Report</button> ';
              buttons += '<a class="btn btn-sm btn-info singleReportBtn" href="/machine/' + row.id + '/edit">Edit</a> ';
              
              return buttons;
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

function managerAttendanceDetails(e){

  $.post(
    '/manager/attendance/detail',
    {
      _token: '{{ csrf_token() }}',
      employee: e.target.attributes.manager.value,
      from: e.target.attributes.from.value,
      to: e.target.attributes.to.value,
    },
    function(data,status){
      if(status == 'success'){
        $('#modal-body').html(data);
        $('#detailModal').modal();
      }
    }
    );
}


$('#m_dashboard_daterangepicker').on('apply.daterangepicker',function(ev,picker){
 //alert('applied: '+ picker.startDate.format("YYYY-MM-DD") + ' '+ picker.endDate.format("YYYY-MM-DD"));
 // managerAttendance(picker.startDate.format('YYYY-MM-DD'),picker.endDate.format('YYYY-MM-DD'));
  viewDateStart = picker.startDate;
  viewDateEnd = picker.endDate;
});

var viewDateStart = moment();
var viewDateEnd = moment();
function machineReport(machine){
  

    $.post(
      '/machine/'+ machine +'/report',
      {
        _token: '{{ csrf_token() }}',
        start: viewDateStart.format('YYYY-MM-DD'),
        end: viewDateEnd.format('YYYY-MM-DD'),
      },
      function(data,status){
        if(status == 'success'){
          $('#main').html(data);
        }
      }
      );

}


</script>
@endsection