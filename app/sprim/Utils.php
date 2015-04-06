<?php

# Class with methods that executes a task

Class Utils
{
    public static function trace($var, $exit = true)
    {
        echo '<pre>'; print_r($var); echo '</pre>';
        
        if ($exit) exit;

        return false;
    }
    
    public static function checkSubdomain($client)
    {
        $url                = explode('.', $_SERVER['HTTP_HOST']);
        $subdomain          = $url[0];
        
        if($client->subdomain != $subdomain)
        {
            return Redirect::to('https://'.$client->subdomain.'.'.Config::get('app.domain'));
        }
    }

    public static function logError($error, $code = '', $context = 'PHP')
    {
        $count = Session::get('error_count', 0);
        Session::put('error_count', ++$count);

        $data = array(
            'context' => $context,
            'user_id' => Sentry::check() ? Sentry::getUser()->id : 0,
            'user_name' => Sentry::check() ? Helpers::getDisplayName() : '',
            'url' => Request::url(),
            'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '',
            'ip' => Request::getClientIp(),
            'count' => $count,
            'code' => $code,
            'input' => Input::all()
        );
        Log::info($data);
    }
    
    public static function setColOptions ($columns)
    {
        $opts = [];
        foreach($columns as $val){
            $opts[$val[0]] = $val[1];
        }
        return $opts;
    }
    
    public static function filterArray($array)
    {

        if (!is_array($array)) {
            return $array;
        }

        return array_filter(array_map('filterArray', $array));
    }
}

function filterArray($array)
{
    if (!is_array($array)) {
        return $array;
    }
    return array_filter(array_map('filterArray', $array));
}