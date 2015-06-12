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

                {{ Form::model($data['user'], array('route' => array('user.update', $data['user_id_edit']), 'method' => 'PUT', 'data-abide', 'class'=>'form-horizontal', 'id' => 'UserForm')) }}
                @include('user._form_edit', $data)
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

<script type="text/javascript">
    var region_id = {{ $data['club']->address->region_id or 0 }};
    var url_api_regions = "{{ url('api/regions/')}}"; 
</script>


@stop