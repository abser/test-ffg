<!doctype html>
<!--[if IE 8]><html class="no-js lt-ie9" lang="en"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="en"><!--<![endif]-->
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
        <title>Gravity</title>
        @yield('css')
        {{ HTML::style('/min/?g=common_css') }} 
        {{ HTML::script('/min/?g=common_js_head') }}
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    </head>
    <body class="antialiased">
        <div id="root">

            <div class="row">
                <div class="large-4 columns">
                    &nbsp;
                </div>
                <div class="large-4 columns">
                    <div class="panel" style="margin-top: 30%; background-color: #fff; padding-top: 0;">
                        
                        <div class="row" style="padding: 1em; margin-bottom: 2em; text-align: center; 
                             background-color: #004582">
                            <div class="small-12 columns">
                                <img src="{{asset('images/dove-med-logo.png')}}" alt="Gravity LOGO" />
                             
                            </div>
                        </div>
                        <p style=" color:#288cca; text-align: center;">GRAVITY</p>
                        <div class="row">
                            <div class="large-12 columns">
                                {{ Form::open(array(
                                "route"        => "index",
                                "autocomplete" => "off"
                                )) }}
                                {{ Form::text("email", Input::get("email"), array(
                                "placeholder" => "email"
                                )) }}
                                {{ Form::password("password", array(
                                "placeholder" => "password"
                                )) }}

                                @if (count($errors))
                                <div data-alert class="alert-box alert">
                                    {{ HTML::ul($errors->all(), array('class' => 'no-bullet')) }}
                                </div>
                                @endif
                                {{ Form::submit("LOG IN", array('class' => 'button tiny')) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                        {{ link_to('request', 'Forgot password?'); }}
                    </div>
                </div>
                <div class="large-4 columns">
                    &nbsp;
                </div>
            </div>



        </div>        
        {{ HTML::script('/min/?g=login_js') }} 
    </body>
</html>


@section("footer")
@parent
<script src="//polyfill.io"></script>
@stop