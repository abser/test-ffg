@extends("layout")
@section("content")

<div class="row">
    <div class="medium-8 medium-centered columns end">
        <div class="panel">

            {{ Form::open(["route" => "auth.request", "autocomplete" => "off", "data-abide"]) }}
            <h1>Reset password</h1>
            <div class="row">
                <div class="medium-8 columns">
                    {{ Form::email("email", Input::get("email"), ["placeholder" => "Enter your email address", 
                        "required" ]) }}
                    <small class="error">Valid email is required.</small>
                </div>

                <div class="medium-4 columns end">
                    {{ Form::submit("Send reset in email", ['class' => 'button']) }}
                </div>
            </div>
            {{ Form::close() }}

            @if (count($errors))
            <div data-alert class="alert-box alert">
                {{ HTML::ul($errors->all(), ['class' => 'no-bullet']) }}
            </div>
            @endif

        </div>
    </div>
</div>
@stop
