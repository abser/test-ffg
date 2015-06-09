@extends("layouts.admin")
@section("content")
<div class="row-fluid">
    <div class="col-md-10 col-xs-12">

        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Add New User</h3>
            </div>
            <div class="panel-heading">
                <h3 class="panel-title">Profile Information</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('url' => 'user', 'data-abide', 'class'=>'form-horizontal', 'id' => 'userForm','files'=>true)) }}

                @include('user._form')
                {{ Form::close() }}
            </div>
        </div>

    </div>
</div>	
@stop

@section('js')
{{ HTML::script('/assets/js/bootstrap-multiselect.js') }}
{{ HTML::script('/assets/js/directoryTree.js') }}
{{ HTML::script('/assets/js/user.form.js') }} 
@stop