@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    <br>
                    {{var_dump(auth()->user()->name)}}
                     <br>
                    {{print_r(auth()->viaRemember())}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
