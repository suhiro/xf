@extends('layouts.master')
@section('content')
<main class="" role="main">
          <h2>Edit Error</h2>

<div class="row">
  <div class="col-lg-8 col-sm-12" >
        <form method="POST" action="/model/error/{{ $error->id }}/update">
          {{csrf_field()}}

  <div class="form-group">
    <label for="component">Belongs To Component</label>
    <select id="component" name="component" class="custom-select">
      @foreach($error->mod->component as $c)
        @if($error->component != null && $error->component->id == $c->id)
         <option value="{{$c->id}}" selected>{{$c->name}}</option>
        @else
      <option value="{{$c->id}}">{{$c->name}}</option>
        @endif
      @endforeach
    </select>
  </div>



  <div class="form-group">
    <label for="modelName">Error Code</label>
    <input type="text" class="form-control" id="errorCode" name="errorCode" aria-describedby="error code" value="{{ $error->err_code }}" required>
  </div>

  <div class="form-group">
    <label for="model">Belongs To Model</label>
    <select id="model" name="model" class="custom-select">
      @foreach($models as $model)
        @if($error->mod->id == $model->id)
         <option value="{{$model->id}}" selected>{{$model->name}}</option>
        @else
      <option value="{{$model->id}}">{{$model->name}}</option>
        @endif
      @endforeach
    </select>
  </div>

 

  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" id="description" name="description" class="form-control" value="{{ $error->description }}">
      
  </div>


  <button type="submit" class="btn btn-primary">Update Error</button>
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">Remove Error</button>
</form>
  </div>
</div>       
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
        Are you absolutely sure to remove this Error Code? Make sure all machines associated with this model have been taken care of..
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

function deleteError(error){
  $.post(
      '/model/error/destroy',
      {
        _token: '{{ csrf_token() }}',
        error: error
      },
      function (data,status){
        if(status == 'success'){
          window.location.href = '/model/'+ {{ $model->id }} + '/show';
        }
      }
    );
}

  var rmBtn = document.getElementById('removeConfirmBtn');
  rmBtn.addEventListener('click',function(){
    deleteError('{{ $error->id }}');
  },false);
</script>
@endsection
