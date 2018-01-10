                <!--begin:: Widgets/Stats-->
<div class="m-portlet ">
  <div class="m-portlet__body  m-portlet__body--no-padding">
    <div class="row m-row--no-padding m-row--col-separator-xl">
       <div class="col-md-12 col-lg-6 col-xl-3">
        <!--begin::Working Time-->
        <div class="m-widget24">
          <div class="m-widget24__item">
                <h4 class="m-widget24__title">
                    Working Time
                </h4><br>
                <span class="m-widget24__desc">
                    Time in service
                </span>
                <span class="m-widget24__stats m--font-danger">
                    {{ round($stats['time']/60,2) }}
                </span>   
                <div class="m--space-10"></div>
            <div class="progress m-progress--sm">
              <div class="progress-bar m--bg-danger" role="progressbar" style="width: 69%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <span class="m-widget24__change">
              Change
            </span>
            <span class="m-widget24__number">
              69%
                  </span>
            </div>    
        </div>
        <!--end::working time--> 
      </div>
        <div class="col-md-12 col-lg-6 col-xl-3">
        <!--begin::MUBA-->
        <div class="m-widget24">
           <div class="m-widget24__item">
                <h4 class="m-widget24__title">
                    MUBA
                </h4><br>
                <span class="m-widget24__desc">
                    Mean U B A
                </span>
                <span class="m-widget24__stats m--font-success">
                    {{ round($stats['output']/$stats['assists'],2) }}
                </span>   
                <div class="m--space-10"></div>
                <div class="progress m-progress--sm">
              <div class="progress-bar m--bg-success" role="progressbar" style="width: 90%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <span class="m-widget24__change">
              Change
            </span>
            <span class="m-widget24__number">
              90%
            </span>
            </div>    
        </div>
        <!--end::MUBA--> 
      </div>
      <div class="col-md-12 col-lg-6 col-xl-3">
        <!--begin::Total Profit-->
        <div class="m-widget24">           
            <div class="m-widget24__item">
                <h4 class="m-widget24__title">
                    Total Output
                </h4><br>
                <span class="m-widget24__desc">
                    {{ $machine->package->package }}
                </span>
                <span class="m-widget24__stats m--font-brand">
                   {{ $stats['output'] }}
                </span>   
                <div class="m--space-10"></div>
            <div class="progress m-progress--sm">
              <div class="progress-bar m--bg-brand" role="progressbar" style="width: 78%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <span class="m-widget24__change">
              Change
            </span>
            <span class="m-widget24__number">
              78%
              </span>
            </div>              
        </div>
        <!--end::Total Profit-->
      </div>
      <div class="col-md-12 col-lg-6 col-xl-3">
        <!--begin::New Feedbacks-->
        <div class="m-widget24">
           <div class="m-widget24__item">
                <h4 class="m-widget24__title">
                    Assists
                </h4><br>
                <span class="m-widget24__desc">
                    Period Total
                </span>
                <span class="m-widget24__stats m--font-info">
                     {{ $stats['assists'] }}
                </span>   
                <div class="m--space-10"></div>
            <div class="progress m-progress--sm">
              <div class="progress-bar m--bg-info" role="progressbar" style="width: 84%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <span class="m-widget24__change">
              Change
            </span>
            <span class="m-widget24__number">
              84%
              </span>
            </div>    
        </div>
        <!--end::New Feedbacks--> 
      </div>
     
    
    </div>
  </div>
</div>
<!--end:: Widgets/Stats-->

<div class="row">
  <div class="col-lg-12">
     <!--begin::Portlet-->
      <div class="m-portlet m-portlet--mobile">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
              Daily Output
            </h3>
          </div>      
        </div>
      </div>

      <div class="m-portlet__body" id="outputs">
        <div id="outputChart" style="width:100%; height:400px;"></div>
        <br>
           
           @if(count($outputs))
           
          <!--  <table class="table table-sm">
            <thead>
            <tr><th>Date</th><th>Output</th></tr>
            </thead>
            <tbody>
            @foreach($outputs as $key => $value)
              @if($value != 0)
            <tr>
              <td>{{ $key }}</td>
              <td>{{ $value }} </td>
            </tr>
              @endif
            @endforeach
          </tbody>
          </table> -->
           @endif


      </div>
    </div>  
    <!--end::Portlet-->
  </div>
</div>



<div class="row">
    <div class="col-lg-6">  
      <!--begin::Portlet-->
      <div class="m-portlet m-portlet--mobile">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
              {{ $machine->serial }} Work Logs <small>{{ $machine->mod->name }}</small>
            </h3>
          </div>      
        </div>
      </div>

      <div class="m-portlet__body" id="machine_logs">
        
           
           @if(count($logs))
           <table class="table table-sm">
            <thead>
            <tr><th>Date</th><th>setCode</th><th>timeStart</th><th>timeEnd</th><th>Minutes</th></tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
              <tr>
            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$log->timeStart)->toDateString() }}</td>
            <td>{{ $log->setCode }}</td>
            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$log->timeStart)->toTimestring() }}</td>
            <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$log->timeEnd)->toTimestring() }}</td>
            <td>{{ $log->workMinutes }}</td>
              </tr>
            @endforeach
          </tbody>
          </table>
           @endif


      </div>
    </div>  
    <!--end::Portlet-->
  </div>

   <div class="col-lg-6">  
      <!--begin::Portlet-->
      <div class="m-portlet m-portlet--mobile">
      <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
          <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text">
              {{ $machine->serial }} Jams <small>{{ $machine->mod->name }}</small>
            </h3>
          </div>      
        </div>
      </div>

      <div class="m-portlet__body" id="machine_jams">

           @if(count($machine->summary))
           <div id="jamChart" style="width:640px; height:400px;"></div>
           <br>

<table class="table table-sm">
  <thead>
    <tr><th>Error Code</th><th>Count</th><th>Component</th><th>Description</th></tr>
  </thead>
  <tbody>
  @foreach($machine->summary as $key => $val)
    <tr>
    <td>{{ $key }}</td>
    <td>{{ $val['count'] }}</td>
    <td>{{ isset($val['component']->name)?$val['component']->name:'' }}</td>
    <td>{{ $val['description'] }}</td>
    </tr>
  @endforeach
</tbody>
</table>
@else
<p>No data available</p>
           @endif


      </div>
    </div>  
    <!--end::Portlet-->
  </div>
</div>

<script>



var jamData = [
  @foreach($machine->summary as $key => $value)
    {
      'jamCode': '{{ $key }}',
      'occurence': {{ $value['count'] }},
      'component': '{{ isset($val['component']->name)?$val['component']->name:'' }}',
      'description' : '{{ $value['description'] }}',
    },
  @endforeach
]; 

 AmCharts.makeChart( "jamChart", {
  "type": "serial",
  "dataProvider": jamData,
  "categoryField": "jamCode",
  "graphs": [ {
    "valueField": "occurence",
    "type": "column",
    "fillAlphas": 0.8,
    "balloonText": "[[category]]:[[description]]<br>Count: <strong>[[value]]</strong>",
  } ],
  "categoryAxis": {
    "autoGridCount": false,
    "GridCount": jamData.length,
    "gridPosition": "start"
  }
} );


var outputData = [

  @foreach($outputs as $key => $value)
    {
            'date': '{{ $key }}',
            'output': '{{ $value }}'
    },
  @endforeach

];
 AmCharts.makeChart( "outputChart", {
  "type": "serial",
  "dataProvider": outputData,
  "categoryField": "date",
  "graphs": [ {
    "valueField": "output",
    "type": "line",
    "fillAlphas": 0,
    "bullet":"round",

    "balloonText":"[[category]]: <strong>[[value]]</strong>"
  } ],
  "categoryAxis": {
    "autoGridCount": false,
    "GridCount": outputData.length,
    "gridPosition": "start"
  }
} );

</script>
