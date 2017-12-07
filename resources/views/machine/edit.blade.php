@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Machine Edit</h1>
          <h4>{{$machine->serial}}</h4>

          <section class="row">

            <div class="col-md-5">
       <form method="POST" action="/machine/{{ $machine->id }}/update">
        {{csrf_field()}}
  <div class="form-group">
    {{ Form::label('user_serial','User Serial',['class' => '']) }}
    {{ Form::text('user_serial',$machine->user_serial,['class' => 'form-control']) }}
    <small id="user_serial_help" class="form-text text-muted">User defined machine identification</small>
  </div>
  <div class="form-group">
    {{ Form::label('factory','Factory',['class' => '']) }}
    <select name="factory" id="factory" class="form-control">
      @foreach($factories as $f)
        @if($f->id == $machine->factory_id)
         <option value="{{$f->id}}" selected>{{$f->name}}</option>
        @else
        <option value="{{$f->id}}">{{$f->name}}</option>
        @endif
      @endforeach
    </select>
  </div>

   <div class="form-group">
    {{ Form::label('mod','Model',['class' => '']) }}
    <select name="mod" id="mod" class="form-control">
      @foreach($models as $m)
      @if($m->id == $machine->mod_id)
        <option value="{{$m->id}}" selected>{{$m->name}}</option> 
       @else
        <option value="{{$m->id}}">{{$m->name}}</option>
         @endif
      @endforeach
    </select>
  </div>

   <div class="form-group">
    {{ Form::label('package','Package',['class' => '']) }}
    <select name="package" id="package" class="form-control">
      @foreach($packages as $p)
      @if($p->id == $machine->package_id)
        <option value="{{$p->id}}" selected>{{$p->package}}</option> 
       @else
        <option value="{{$p->id}}">{{$p->package}}</option>
         @endif
      @endforeach
    </select>
  </div>
 
  <button type="submit" class="btn btn-primary">Update</button> 
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">Remove</button>
</form>
            </div>
            
          </section>

    
        </main>

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Removal Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure to remove this machine?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="removeConfirmBtn">Confirm</button>
      </div>
    </div>
  </div>
</div>




@endsection

@section('pageJS')
<script>
function removeMachine(){
  $.post(
      '/machine/'+ {{ $machine->id }} + '/remove',
      {
        _token:'{{ csrf_token() }}'
      },
      function(data,status){
        if(status == 'success'){
          console.log(data);
        }
      }
      );
}


  var rmConfirm = document.getElementById('removeConfirmBtn');
  rmConfirm.addEventListener('click',function(){
    removeMachine();
    $('#confirmModal').modal('hide');
    location.replace('/machine');
  },false);


</script>
@endsection