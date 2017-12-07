@extends('layouts.master')
@section('content')
<main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
          <h1>Edit Model</h1>

<div class="row">
  <div class="col-lg-8 col-sm-12" >
        <form method="POST" action="/model/{{ $model->id }}/update">
          {{csrf_field()}}
  <div class="form-group">
    <label for="modelName">Model Name</label>
    <input type="text" class="form-control" id="modelName" name="modelName" aria-describedby="model name" value="{{ $model->name }}" required>
  </div>

  <div class="form-group">
    <label for="package">Default Package</label>
    <select id="package" name="package" class="custom-select">
      @foreach($packages as $p)
        @if($model->package_id == $p->id)
         <option value="{{$p->id}}" selected="">{{$p->package}}</option>
        @else
      <option value="{{$p->id}}">{{$p->package}}</option>
        @endif
      @endforeach
    </select>
  </div>

 

  <div class="form-group">
    <label for="description">Description</label>
    <input type="text" id="description" name="description" class="form-control" value="{{ $model->description }}">
      
  </div>


  <button type="submit" class="btn btn-primary">Update Model</button>
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirmModal">Remove Model</button>
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
        Are you absolutely sure to remove this modal? Make sure all machines associated with this model have been taken care of..
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
function removeModel(){
  $.post(
      '/model/'+ {{ $model->id }} + '/remove',
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
    removeModel();
    $('#confirmModal').modal('hide');
    location.replace('/model');
  },false);


</script>
@endsection