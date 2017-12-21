                <!--begin:: Widgets/Stats-->
<div class="m-portlet ">
  <div class="m-portlet__body  m-portlet__body--no-padding">
    <div class="row m-row--no-padding m-row--col-separator-xl">
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
      <div class="col-md-12 col-lg-6 col-xl-3">
        <!--begin::New Orders-->
        <div class="m-widget24">
          <div class="m-widget24__item">
                <h4 class="m-widget24__title">
                    New Orders
                </h4><br>
                <span class="m-widget24__desc">
                    Fresh Order Amount
                </span>
                <span class="m-widget24__stats m--font-danger">
                    567
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
        <!--end::New Orders--> 
      </div>
      <div class="col-md-12 col-lg-6 col-xl-3">
        <!--begin::New Users-->
        <div class="m-widget24">
           <div class="m-widget24__item">
                <h4 class="m-widget24__title">
                    New Users
                </h4><br>
                <span class="m-widget24__desc">
                    Joined New User
                </span>
                <span class="m-widget24__stats m--font-success">
                    276 
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
        <!--end::New Users--> 
      </div>
    </div>
  </div>
</div>
<!--end:: Widgets/Stats-->


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

      <div class="m-portlet__body" id="machine">
           
           @if(count($logs))
            @foreach($logs as $log)
            <p>{{ $log }}</p>
            @endforeach
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

      <div class="m-portlet__body" id="machine">


<!--            @if(count($machine->summary))
          <ul class="list-unstyled">
@php
$i = 5;
@endphp

  @foreach($machine->summary as $key => $val)
    @if($i > 0)
      <li>{{ $key }} : {{ $val }}</li>
    @php $i-- @endphp
    @endif  
  @endforeach

  @if(sizeof($machine->summary) > 5)
  <li>more...</li>
  @endif
</ul>
           @endif -->


      </div>
    </div>  
    <!--end::Portlet-->
  </div>
</div>