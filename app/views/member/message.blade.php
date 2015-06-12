@extends("layouts.admin")
@section("content")

<div class="row-fluid">
    <div class="col-md-6 col-xs-12">

      
        <div id="container">
            <div class="panel-body">
                {{ Form::open(array('url' => 'member/sendMessage', 'data-abide', 'class'=>'form-horizontal', 'id' => 'memberMessageForm','files'=>true)) }}

                <div class="form-group">	
                    {{ Form::label('msg_body', 'Message', array('class' => 'col-lg-2 control-label')) }}
                    <div class="col-lg-10">
                       
                        {{Form::textarea('msg_body', Input::old('msg_body'),['size' => '75x10'],  array('class'=>'form-control','placeholder' => 'Compose your message here..','required' => 'required'))}}
                        @if ($errors->has('msg_body')) <p class="alert alert-danger">{{ $errors->first('msg_body') }}</p> @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10">
                     {{  Form::hidden('member_id', $data['member_id']);}}
                      {{  Form::hidden('member_id', $data['member_id']);}}
                        <button type="submit" class="btn btn-default">Send Message</button>
                        <a href="{{ URL::route('member.index') }}"><button type="button" class="btn">Cancel</button></a>
                    </div>
                </div>

            </div>
        </div>
    </div>	
    
</div>

@stop