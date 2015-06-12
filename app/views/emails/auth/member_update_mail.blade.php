<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Your account in {{Config::get('sprim.site_name')}} has been updated.</h2>
        <p><b>Email:</b> {{{ $member_email }}}</p>
        <p>Thank you, <br />
            ~The Admin Team</p>
    </body>
</html>