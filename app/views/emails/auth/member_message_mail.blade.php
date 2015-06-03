<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>{{Config::get('sprim.site_name')}}</h2>

        <p><b>Hi:</b> {{{ $fname }}}</p>
        <p><b>Message:</b> {{{ $msg_body}}}</p>
        <p>Thank you, <br />
            ~The Admin Team</p>
    </body>
</html>