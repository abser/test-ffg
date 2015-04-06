@extends("layout")
@section("content")

<div class="row">
    <div class="medium-8 medium-centered columns end">
        <div class="panel">
            <h1>Reset password</h1>
            <div class="row">
                <div class="large-12 columns">
                    {{ Form::open(array(
                    "url"          => URL::to("reset"),
                    "autocomplete" => "off"
                    )) }}

                    {{ Form::label("code", "Code") }}
                    {{ Form::text("code", Input::get("code")) }}
                    @if ($error = $errors->first("code"))
                    <div class="error">
                        {{ $error }}
                    </div>
                    @endif

                    {{ Form::label("password", "New Password") }}
                    {{ Form::password("password", array(
                    "placeholder" => "••••••••••"
                    )) }}
                    @if ($error = $errors->first("password"))
                    <div class="error">
                        {{ $error }}
                    </div>
                    @endif
                    {{ Form::label("password_confirmation", "Confirm new password") }}
                    {{ Form::password("password_confirmation", array(
                    "placeholder" => "••••••••••"
                    )) }}
                    @if ($error = $errors->first("password_confirmation"))
                    <div class="error">
                        {{ $error }}
                    </div>
                    @endif
                    {{ Form::submit("RESET", array('class' => 'button tiny')) }}
                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>


@stop
@section("footer")
@parent
<script src="//polyfill.io"></script>
@stop