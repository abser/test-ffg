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

    public static function checkRoute($route)
    {
    	if(!is_object(Route::getCurrentRoute()) || !$route){
    		return false;
    	}
    
    	return ($route == Route::getCurrentRoute()->getName());
    }

    public static function s3_upload($dest, $source)
    {
    	$s3_conf = Config::get('aws-s3');
    	$s3 = AWS::get('s3');
    
    	$s3->putObject(array(
    			'Bucket' => $s3_conf['bucket'],
    			'Key' => $dest,
    			'SourceFile' => $source,
    			"CacheControl" => "max-age=315360000",
    	));
    
    	$s3->putObjectAcl(array(
    			'ACL' => 'public-read',
    			'Bucket' => $s3_conf['bucket'],
    			'Key' => $dest,
    	));
    }
    
    public static function uploadFile($file, $dest_folder, $tmp = false)
    {
    	$file_input = Input::file($file);
    
    	$filename = $file_input->getClientOriginalName();
    	$file_ext = $file_input->getClientOriginalExtension();
    	$rand_name = str_random(8);
    
    	if ($dest_folder == 'img') {
    		$upload_success = Image::make(Input::file($file)->getRealPath())->
    		resize(200, 200)->save($dest_folder . '/' . $rand_name . '.' . $file_ext);
    
    		Input::file($file)->move($dest_folder . '/n', $rand_name . '.' . $file_ext);
    		Utils::s3_upload($dest_folder . '/n/' . $rand_name . '.' . $file_ext, public_path() . '/' . $dest_folder . '/n/' . $rand_name . '.' . $file_ext);
    		File::delete(public_path() . '/' . $dest_folder . '/n/' . $rand_name . '.' . $file_ext);
    	} else {
    		$upload_success = Input::file($file)->move($dest_folder, $rand_name . '.' . $file_ext);
    	}
    
    	$array = array('name' => $dest_folder . '/' . $rand_name . '.' . $file_ext,
    			'description' => $filename);
    
    	if ($upload_success) {
    		if (!$tmp) {
    			Utils::s3_upload($dest_folder . '/' . $rand_name . '.' . $file_ext, public_path() . '/' . $dest_folder . '/' . $rand_name . '.' . $file_ext);
    		}
    		return $array;
    	} else {
    		return false;
    	}
    }
    
    public static function sendAwsMail($to, $subject, $msg, $from = NULL, $format = 'html')
    {
    	$mail_config = Config::get('mail');
    
    	if (!$from)
    		$from = $mail_config['from']['address'];
    
    	if($format == 'html') {
    		$body = array('Html' => array(
    				// Data is required
    				'Data' => $msg,
    				'Charset' => 'UTF-8',
    		));
    
    	} else {
    		$body = array('Text' => array(
    				//Data is required
    				'Data' => $msg,
    				'Charset' => 'UTF-8',
    		));
    	}
    
    	$config = array(
    			// Source is required
    			'Source' => $from,
    			// Destination is required
    			'Destination' => array(
    					'ToAddresses' => array($to),
    			),
    			// Message is required
    			'Message' => array(
    					// Subject is required
    					'Subject' => array(
    							// Data is required
    							'Data' => $subject,
    							'Charset' => 'UTF-8',
    					),
    					// Body is required
    					'Body' => $body,
    			),
    			'ReturnPath' => $from,
    	);
    
    	try {
    
    		$ses_client = AWS::get('Ses');
    		/* $aws_config = array(
    		 'key'    => 'AKIAJ4FSUULOQJI5EA7A', // Your AWS Access Key ID
    		 'secret' => 'CF5d6dFPP530UEmgiOy8DQJyO08AeJFJPWOUTP4h', // Your AWS Secret Access Key
    		 'region' => 'us-east-1'
    		);
    		$ses_client = AWS::factory($aws_config)->get('Ses'); */
    
    		return $ses_client->sendEmail($config);
    		 
    	}
    	catch(Exception $e)
    	{
    		// return $e->getMessage();
    		return false;
    	}
    
    }
}

function filterArray($array)
{
    if (!is_array($array)) {
        return $array;
    }
    return array_filter(array_map('filterArray', $array));
}